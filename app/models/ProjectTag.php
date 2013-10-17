<?php
use LaravelBook\Ardent\Ardent;

class ProjectTag extends Ardent{

	// Table name
	protected $table = 'tags';

	protected $guarded = array();

	// Validation rules
	public static $rules = array(
		'tag_id'                  => 'required|exists:tag,id',
		'project_id'                  => 'required|exists:projects,id',
		'user_id'                  => 'required|exists:users,id'
	);

}
