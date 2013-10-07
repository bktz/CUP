<?php

use LaravelBook\Ardent\Ardent;

class Feedback extends Ardent {
	// Table name
	protected $table = 'feedback';

	protected $guarded = array();

	// Validation rules
	public static $rules = array(
		'project_id' => 'required|exists:projects,id',
		'user_id' => 'required|exists:users,id',
		'feedback' => 'required',
		'title'   => 'required|integer|in:0,1',
		'description'   => 'required|integer|in:0,1',
		'location'   => 'required|integer|in:0,1',
		'expected_time'   => 'required|integer|in:0,1',
		'motivation'   => 'required|integer|in:0,1',
		'resources'   => 'required|integer|in:0,1',
		'constraints'   => 'required|integer|in:0,1',
	);
}
