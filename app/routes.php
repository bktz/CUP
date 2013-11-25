<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('role', 'Role');
Route::model('project', 'Project');

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function (){

	# Project Management
	// remove a user from project a project
	Route::delete('project/{project}/unassign/{user}', 'AdminProjectController@unassign')
		->where('project', '[0-9]+')->where('user', '[0-9]+');
	// assign a user to project a project
	Route::post('project/{project}/assign', 'AdminProjectController@assign')
		->where('project', '[0-9]+');

	Route::resource('project', 'AdminProjectController');

	# Tags Management
	Route::resource('tag', 'AdminTagController');

	# User Management
	Route::get('users/{user}/show', 'AdminUsersController@getShow')
		->where('user', '[0-9]+');
	Route::get('users/{user}/edit', 'AdminUsersController@getEdit')
		->where('user', '[0-9]+');
	Route::post('users/{user}/edit', 'AdminUsersController@postEdit')
		->where('user', '[0-9]+');
	Route::get('users/{user}/delete', 'AdminUsersController@getDelete')
		->where('user', '[0-9]+');
	Route::post('users/{user}/delete', 'AdminUsersController@postDelete')
		->where('user', '[0-9]+');
	Route::controller('users', 'AdminUsersController');

	# User Role Management
	Route::get('roles/{role}/show', 'AdminRolesController@getShow')
		->where('role', '[0-9]+');
	Route::get('roles/{role}/edit', 'AdminRolesController@getEdit')
		->where('role', '[0-9]+');
	Route::post('roles/{role}/edit', 'AdminRolesController@postEdit')
		->where('role', '[0-9]+');
	Route::get('roles/{role}/delete', 'AdminRolesController@getDelete')
		->where('role', '[0-9]+');
	Route::post('roles/{role}/delete', 'AdminRolesController@postDelete')
		->where('role', '[0-9]+');
	Route::controller('roles', 'AdminRolesController');

	# Admin Dashboard
	Route::controller('/', 'AdminDashboardController');
});


/** ------------------------------------------
 *  Project Routes
 *  ------------------------------------------
 */

// Static Routes
Route::group(array('prefix' => 'project'), function (){
	Route::get('/my', 'ProjectController@getMy');
});

// RESTful Routes
Route::resource('project', 'ProjectController');

/** ------------------------------------------
 *  User Routes
 *  ------------------------------------------
 */

// User reset routes
Route::get('user/reset/{token}', 'UserController@getReset')
	->where('token', '[0-9a-z]+');
// User password reset
Route::post('user/reset/{token}', 'UserController@postReset')
	->where('token', '[0-9a-z]+');
//:: User Account Routes ::
Route::post('user/{user}/edit', 'UserController@postEdit')
	->where('user', '[0-9]+');

//:: User Account Routes ::
Route::post('user/login', 'UserController@postLogin');

# User RESTful Routes (Login, Logout, Register, etc)
Route::controller('user', 'UserController');

/** ------------------------------------------
 *  Static Page Routes
 *  ------------------------------------------
 */

# Contact Us Static Page
Route::get('contact-us', function (){
	// Return about us page
	return View::make('site/contact-us');
});

# The Process Static Page
Route::get('process', function (){
	// Return process page
	return View::make('site/process');
});

# The Privacy Policy Static Page
Route::get('privacy', function (){
	// Return Privacy Policy page
	return View::make('site/privacy');
});

# The License Static Page
Route::get('license', function (){
	// Return License page
	return View::make('site/license');
});


# Index Page - Last route, no matches
Route::get('/', function (){
	// Return License page
	return View::make('site/index');
});
