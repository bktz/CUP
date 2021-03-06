<?php

use LaravelBook\Ardent\Ardent;

class Tag extends Ardent {
	// Table name
	protected $table = 'tag';

	protected $guarded = array();

	public $timestamps = false;

	// Validation rules
	public static $rules = array(
		'tag'       => 'required|between:1,255'
	);
}
