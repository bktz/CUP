<?php
use LaravelBook\Ardent\Ardent;

class Project extends Ardent{

	// Table name
	protected $table = 'projects';

	protected $guarded = array();

	// Validation rules
	public static $rules = array(
		'user_id'                  => 'required|exists:users,id',
		'title'                    => 'required|between:1,255',
		'contact_firstname'        => 'required|between:1,255',
		'contact_lastname'         => 'required|between:1,255',
		'contact_lastname'         => 'required|between:1,255',
		'contact_email'            => 'required|email|between:1,255',
		'contact_phone_number'     => 'required|between:1,255',
		'contact_phone_number_ext' => 'between:1,255',
		'description'              => 'required',
		'location'                 => 'required|between:1,255',
		'expected_time'            => 'required|integer|between:1,6', //enum('lessMonth','aMonth','fourMonths','eightMonths','aYear','moreYear')
		'motivation'               => 'required|between:1,255',
		'resources'                => 'required',
		'constraints'              => 'required',
		'constraints'              => 'required',
		'state'                    => 'required|integer|between:1,6', // enum('Application','Available','InProgress','Complete','Canceled','NA')
	);


}
