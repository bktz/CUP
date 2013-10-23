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
		$projects = Project::where('state', '=', 'Available')->orWhere('state', '=', 'InProgress')->orderBy('created_at', 'DESC')->paginate(5);
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
	 * Store a newly created User in database.
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
					$projectTag = new ProjectTag();
					$projectTag->tag_id = $tag;
					$projectTag->project_id = $project->id;
					$projectTag->user_id = Auth::user()->id;
					$projectTag->save();
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
	 * @param  int  $project
	 * @return Response
	 */
	public function show($project){
	    $goals = Goal::where('project_id', '=', $project->id)->get();
//         $tags = Tag::where('project_id', '=', $project->id)->get()->toArray();
//         var_dump($tags);
//         die;
//         $tags = DB::table('tag')->whereIn('id', $tags)->get();        
//         print_r($tags);
//         die;
        
        $tags = DB::table('tag')->join('tags','tag.id','=','tags.tag_id')->select('tag.tag')->where('project_id', '=', $project->id)->get();
        
//         print_r($tags);
//         die;
        
		return View::make('site/project/show', compact('project','goals','tags'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id){
		return View::make('site/index');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id){
		return View::make('site/index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id){
		return View::make('site/index');
	}

}
