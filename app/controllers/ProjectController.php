<?php

class ProjectController extends BaseController {

    /**
     * Project Model
     * @var User
     */
    protected $project;

	public function __construct(Project $project){
	    $this->beforeFilter('csrf', array('on' => array('post', 'delete', 'put')));
	}

	/**
	 * My Projects Page
	 */
	public function getMy(){
		if(Auth::check()){
			$user_id = Auth::user()->id;
			$projects = Project::where('user_id', '=', $user_id)->orderBy('updated_at', 'DESC')->paginate(5);
			return View::make('site/project/my', compact('projects'));
		}
		else{
			return View::make('site/project/my')->with('info', 'You must create an account to access this feature.');
		}

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
		if (Input::get('search') == null || Input::get('search') == ''){
			$projects = Project::where('state', '=', 'Available')->orWhere('state', '=', 'InProgress')->orderBy('created_at', 'DESC')->paginate(5);
		}
		else{
			$projects = Project::join('tags', 'projects.id', '=', 'tags.project_id')
				->join('tag', 'tags.tag_id', '=', 'tag.id')
				->select('projects.*')
				->groupby('projects.id')
				->where(function($query){
					$count= 0;
					foreach(explode(', ', Input::get('search')) as $searchToken){
						if($count == 1){
							$query->orWhere('tag.tag', 'like', '%'.strtolower($searchToken).'%');
						}
						else{
							$query->where('tag.tag', 'like', '%'.strtolower($searchToken).'%');
							$count = 1;
						}
					}
				})
				->where(function($query){
					$query->where('state', '=', 'Available')
						  ->orWhere('state', '=', 'InProgress');
				})
				->orderBy('projects.created_at', 'DESC')->paginate(5);

		}
		return View::make('site/project/index', compact('projects'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(){

		$tags = Tag::orderby('tag')->lists('tag', 'id');
		return View::make('site/project/create', compact('tags'));
	}

	/**
	 * Store a newly created Project in the database.
	 *
	 * @return Response
	 */
	public function store(){
		$project = new Project();
		$input = Input::all();

		$project->title = $input['title'];
		$project->contact_firstname = $input['contact_firstname'];
		$project->contact_lastname = $input['contact_lastname'];
		$project->contact_email = $input['contact_email'];
		$project->contact_phone_number = $input['contact_phone_number'];
		$project->contact_phone_number_ext = $input['contact_phone_number_ext'];
		$project->description = $input['description'];
		$project->location = $input['location'];
		$project->expected_time = $input['expected_time'];
		$project->motivation =$input['motivation'];
		$project->resources = $input['resources'];
		$project->constraints = $input['constraints'];
		$project->state = 1; //Application state
		$project->user_id = Auth::user()->id;

		if ($project->save()) {

			foreach($input['goals'] as $goal){
				if($goal == ''){
					continue;
				}
				else{
					$goalObj = new Goal();
					$goalObj->project_id = $project->id;
					$goalObj->goal = $goal;
					$goalObj->complete = 0;
					$goalObj->save();
				}
			}

			foreach($input['tags'] as $tag){
				if($tag == ''){
					continue;
				}
				else{
					$tagObj = Tag::find($tag);
					$project->tags()->attach($tagObj);
				}
			}


			return Redirect::to('/project/create')->with('info', 'The project application has been submitted.');
		} else {
			return Redirect::to('/project/create')->withErrors($project->errors());
		}


	}

	/**
	 * Display the specified resource.
	 *
	 * @param  Project  $project
	 * @return Response
	 */
	public function show($project){
		if((Auth::check() && (Auth::user()->id == $project->user_id)) || $project->state != 'Application' || Auth::user()->can("manage_projects")){
			$goals = Goal::where('project_id', '=', $project->id)->get();
			$tags = $project->tags()->lists('tag_id');
			return View::make('site/project/show', compact('project','goals','tags'));
		}
		else{
			return Redirect::to('/');
		}


	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  Project  $project
	 * @return Response
	 */
	public function edit($project){
		if(Auth::check() && (Auth::user()->id == $project->user_id)){
			$goals = Goal::where('project_id', '=', $project->id)->get();
			$tags_all = Tag::orderby('tag')->lists('tag', 'id');
			$tags = $project->tags()->lists('tag_id');

			/** format enum for expected time */
			switch ($project->expected_time)
			{
			case 'lessMonth':
				$project->expected_time = 1;
			  break;
			case 'aMonth':
				$project->expected_time = 2;
			  break;
			case 'fourMonths':
				$project->expected_time = 3;
			  break;
			case 'eightMonths':
				$project->expected_time = 4;
			  break;
			case 'ayear':
				$project->expected_time = 5;
			  break;
			case 'moreYear':
				$project->expected_time = 6;
			  break;
			}

			return View::make('site/project/edit', compact('project','goals', 'tags_all', 'tags'));
		}
		else{
			return Redirect::to('/');
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Project  $project
	 * @return Response
	 */
	public function update($project){

		$input = Input::all();

		$project->contact_firstname = $input['contact_firstname'];
		$project->contact_lastname = $input['contact_lastname'];
		$project->contact_email = $input['contact_email'];
		$project->contact_phone_number = $input['contact_phone_number'];
		$project->contact_phone_number_ext = $input['contact_phone_number_ext'];
		$project->description = $input['description'];
		$project->location = $input['location'];
		$project->expected_time = $input['expected_time'];
		$project->motivation =$input['motivation'];
		$project->resources = $input['resources'];
		$project->constraints = $input['constraints'];
        
		/** format enum for state */
		switch ($project->state)
		{
		    case 'Application':
		        $project->state = 1;
		        break;
		    case 'Available':
		        $project->state = 2;
		        break;
		    case 'InProgress':
		        $project->state = 3;
		        break;
		    case 'Complete':
		        $project->state = 4;
		        break;
		    case 'Canceled':
		        $project->state = 5;
		        break;
		    case 'NA':
		        $project->state = 6;
		        break;
		}
		
		
		$input['tags'] = isset($input['tags']) ? $input['tags'] : array(); //verify that there are some goals and tags in the $input
		$input['goals'] = isset($input['goals']) ? $input['goals'] : array();
		
		if ($project->update()) {

			// Delete project goals and then re-create them
			$project->goals()->delete();
			$loop_index = 0;
			foreach($input['goals'] as $goal){
				//Ignore empty goals
				if($goal == ''){
					$loop_index++;
					continue;
				}
				else{
					$goalObj = new Goal();
					$goalObj->goal = $goal;

					// The completed variable posted is an array containing the indexes for the goals that are marked as complete
					// This will swap the array's index  with the value (ie. [0] => a, [1] => b will become [a] => 0, [b] => 1)
					// This then allows us to see if the current loop index has a goal that is complete without needing to use a for loop
					$completed = isset($input['completed']) ? array_flip($input['completed']) : array();
					if(isset($completed[$loop_index])){
						$goalObj->complete = 1;
					}
					else{
						$goalObj->complete = 0;
					}

					$project->goals()->save( $goalObj );
				}
				$loop_index++;
			}

			$project->tags()->detach();
			foreach($input['tags'] as $tag){
				if($tag == ''){
					continue;
				}
				else{
					$tagObj = Tag::find($tag);
					$project->tags()->attach($tagObj);
				}
			}

			return Redirect::to('/project/'.$project->id.'/edit')->with('info', 'The project has been updated.');
		} else {
			return Redirect::to('/project/'.$project->id.'/edit')->withErrors($project->errors());
		}

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  Project  $project
	 * @return Response
	 */
	public function destroy($project){
		return View::make('site/index');
	}

}
