<?php

class AdminTagController extends BaseController{

	/**
	 * Project Model
	 *
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

		$tags = Tag::orderby('tag')->paginate(25);

		return View::make('admin/tag/index', compact('tags'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(){
		return View::make('admin/dashboard');
	}

	/**
	 * Store a newly created User in database.
	 *
	 * @return Response
	 */
	public function store(){
		return View::make('admin/dashboard');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id){
		return View::make('admin/dashboard');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id){
		return View::make('admin/dashboard');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function update($id){
		return View::make('admin/dashboard');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id){
		return View::make('admin/dashboard');
	}

}
