<?php
use LaravelBook\Ardent\Ardent;
use Robbo\Presenter\PresentableInterface;

class Project extends Ardent implements PresentableInterface{

	// Table name
	protected $table = 'projects';

	protected $guarded = array();

	// Validation rules
	public static $rules = array(
		'user_id'                  => 'required|exists:users,id',
		'title'                    => 'required|between:1,255',
		'contact_firstname'        => 'required|between:1,255',
		'contact_lastname'         => 'required|between:1,255',
		'contact_email'            => 'required|email|between:1,255',
		'contact_phone_number'     => 'required|integer',
		'contact_phone_number_ext' => 'integer',
		'description'              => 'required',
		'location'                 => 'required|between:1,255',
		'expected_time'            => 'required|integer|between:1,6', //enum('lessMonth','aMonth','fourMonths','eightMonths','aYear','moreYear')
		'motivation'               => 'required|between:1,255',
		'resources'                => 'required',
		'constraints'              => 'required',
		'state'                    => 'integer|between:1,6', //enum('Application','Available','InProgress','Complete','Canceled','NA')
	);

	public static $customMessages = array(
	        'integer' => 'The :attribute must be only numbers, and cannot contain spaces or \'-\'',
	);
	
	public function tags(){
		return $this->belongsToMany('Tag', 'tags');
	}

	public function users(){
		return $this->belongsToMany('User', 'assigned_project');
	}

	public function goals(){
		return $this->hasMany('Goal');
	}

	public function getPresenter()
	{
		return new ProjectPresenter($this);
	}

}
