<?php

use Illuminate\Database\Migrations\Migration;

class CreateProjectTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Creates the project table
		Schema::create('projects', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->string('title');
			$table->string('contact_firstname');
			$table->string('contact_lastname');
			$table->string('contact_email');
			$table->string('contact_phone_number');
			$table->string('contact_phone_number_ext');
			$table->text('description');
			$table->string('location');
			$table->enum('expected_time', array('lessMonth', 'aMonth', 'fourMonths', 'eightMonths', 'ayear', 'moreYear'));
			$table->string('motivation');
			$table->text('resources');
			$table->text('constraints');
			$table->enum('state', array('Application', 'Available', 'InProgress', 'Complete', 'Canceled', 'NA'));
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users');
		});

		// Creates the goals table
		Schema::create('goals', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('project_id')->unsigned()->index();
			$table->string('goal');
			$table->boolean('complete');
			$table->timestamps();

			$table->foreign('project_id')->references('id')->on('projects');
		});

		// Creates the tag table
		Schema::create('tag', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('tag');
		});

		// Creates the tags table
		Schema::create('tags', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('tag_id')->unsigned()->index();
			$table->integer('project_id')->unsigned()->index();
			$table->timestamps();

			$table->foreign('tag_id')->references('id')->on('tag');
			$table->foreign('project_id')->references('id')->on('projects');
		});

		// Creates the tags table
		Schema::create('feedback', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->integer('project_id')->unsigned()->index();
			$table->text('feedback');
			$table->boolean('title');
			$table->boolean('description');
			$table->boolean('location');
			$table->boolean('expected_time');
			$table->boolean('motivation');
			$table->boolean('resources');
			$table->boolean('constraints');
			$table->timestamps();

			$table->foreign('project_id')->references('id')->on('projects');
			$table->foreign('user_id')->references('id')->on('users');
		});

		// Creates the tags table
		Schema::create('assigned_project', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('project_id')->unsigned()->index();
			$table->integer('user_id')->unsigned()->index();
			$table->timestamps();

			$table->foreign('project_id')->references('id')->on('projects');
			$table->foreign('user_id')->references('id')->on('users');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('assigned_project');
		Schema::drop('feedback');
		Schema::drop('tags');
		Schema::drop('tag');
		Schema::drop('goals');
		Schema::drop('project');
	}

}