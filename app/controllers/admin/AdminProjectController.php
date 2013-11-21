<?php

class AdminProjectController extends BaseController {

    /**
     * Project Model
     * @var User
     */
    protected $project;

	public function __construct(Project $project){
	    $this->beforeFilter('csrf', array('on' => array('post', 'delete', 'put')));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
		if (Input::get('search') == null || Input::get('search') == ''){
			$projects = Project::orderBy('created_at', 'DESC')->paginate(5);
		}
		else{
			$projects = Project::where('title', 'like', '%'.Input::get('search').'%')
				->orderBy('projects.created_at', 'DESC')->paginate(5);
		}
		return View::make('admin/projects/index', compact('projects'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(){
		return Redirect::to('admin/dashboard');
	}

	/**
	 * Store a newly created User in database.
	 *
	 * @return Response
	 */
	public function store(){
		return Redirect::to('admin/dashboard');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  Project  $project
	 * @return Response
	 */
	public function show($project){
		return Redirect::to('admin/dashboard');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  Project  $project
	 * @return Response
	 */
	public function edit($project){
		$goals = Goal::where('project_id', '=', $project->id)->get();
		$tags_all = Tag::orderby('tag')->lists('tag', 'id');
		$tags = $project->tags()->lists('tag_id');
		$users = $project->users;
		$creator = User::find($project->user_id);

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


		return View::make('admin/projects/edit', compact('project','goals', 'tags_all', 'tags', 'users', 'creator'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Project  $project
	 * @return Response
	 */
	public function update($project){
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

			// Delete project tags and then re-create them
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

			return Redirect::to('/admin/project/'.$project->id.'/edit')->with('info', 'The project has been updated.');
		} else {
			return Redirect::to('/admin/project/'.$project->id.'/edit')->withErrors($project->errors());
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  Project  $project
	 * @return Response
	 */
	public function destroy($project){
		return Redirect::to('admin/dashboard');
	}

}
