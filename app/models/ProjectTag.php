<?php

use LaravelBook\Ardent\Ardent;

class Tags extends Ardent {
	// Table name
	protected $table = 'tags';

	protected $guarded = array();

	// Validation rules
	public static $rules = array(
        'tag_id'        => 'required|exists:tag,id',	         
        'project_id'    => 'required|exists:project,id',	         
	    'user_id'       => 'required|exists:users,id',
	);
	
}
