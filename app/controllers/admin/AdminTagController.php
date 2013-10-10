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
		return Redirect::to('/admin/tag');
	}

	/**
	 * Store a newly created User in database.
	 *
	 * @return Response
	 */
	public function store(){

		$input = Input::all();

		$tag = new Tag();
		$tag->tag = $input['tag'];

		if ($tag->save()) {
			return Redirect::to('/admin/tag')->with('info', 'The new tag has been created.');
		} else {
			return Redirect::to('/admin/tag')->withErrors($tag->errors());
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id){
		return Redirect::to('/admin/tag');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id){
		return Redirect::to('/admin/tag');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function update($id){
		return Redirect::to('/admin/tag');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id){

		$tag = Tag::find($id);

		if ($tag->delete()) {
			return Redirect::to('/admin/tag')->with('info', 'The tag has been deleted.');
		} else {
			return Redirect::to('/admin/tag');
		}
	}

}
