<?php

class ProjectController extends BaseController {

    /**
     * Project Model
     * @var User
     */
    protected $project;

	public function __construct(Project $project){
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
		$projects = Array();
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
		$projects = Array();
		return View::make('site/project/index', compact('projects'));

	}

	/**
	 * Store a newly created User in database.
	 *
	 * @return Response
	 */
	public function store(){

		$projects = Array();
		return View::make('site/project/index', compact('projects'));
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
