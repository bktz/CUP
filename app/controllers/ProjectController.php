<?php

class ProjectController extends BaseController {

    /**
     * Project Model
     * @var User
     */
    protected $project;

	public function __construct(Project $project)
	{
	    $this->beforeFilter('csrf', array('on' => array('post', 'delete', 'put')));
	}
	
	
	/**
	 * Website Index Page
	 */
	public function getIndex() {
		$projects = Project::paginate(10);

		// Show the page
		return View::make('site/project/index', compact('projects'));
	}

	/**
	 * My Projects Page
	 */
	public function getMy(){
	    $userId = Auth::user()->id;
	    $projects = Project::where('user_id', '=', $userId)->paginate(5);
		return View::make('site/project/my', compact('projects'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
		$projects = Project::paginate(10);
		return View::make('site/project/index', compact('projects'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(){
		return View::make('site/project/create');
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
			return Redirect::to('/project/create')->with('info', 'The project application has been submitted.');
		} else {
			return Redirect::to('/project/create')->withErrors($project->errors());
		}


	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id){

		$projects = Array();
		return View::make('site/project/index', compact('projects'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id){

		$projects = Array();
		return View::make('site/project/index', compact('projects'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id){
		$projects = Array();
		return View::make('site/project/index', compact('projects'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id){
		$projects = Array();
		return View::make('site/project/index', compact('projects'));
	}

}
