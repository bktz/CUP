<?php

use LaravelBook\Ardent\Ardent;

class Goal extends Ardent {
	// Table name
	protected $table = 'goals';

	protected $guarded = array();

	// Validation rules
	public static $rules = array(
		'project_id' => 'required|exists:projects,id',
		'goal'       => 'required|between:1,255',
		'complete'   => 'required|integer|in:0,1',
	);
}
