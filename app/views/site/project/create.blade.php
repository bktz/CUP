@extends('site.layouts.default')

{{-- Content --}}
@section('content')
<h1>Pitch An Idea To The Community University Portal</h1>
<form class="form-horizontal" method="POST" action="{{ URL::to('project') }}" accept-charset="UTF-8">
{{ Form::open(array('url' => 'project', 'method' => 'post')) }}

		@if (!Auth::check())
			<div class="alert alert-info alert-block">You must create an account to access this feature.</div>
		@endif
<fieldset>
	<legend>Project Title</legend>
		<div class="form-group {{ ($errors->has('title')) ? 'has-error' : '' }}">
			{{ Form::label('title', 'Project Title', Array("class"=>"col-md-2 control-label")) }}
			<div class="col-md-10">
				{{	Form::text('title', Input::old('title'),
						Array(	"placeholder" =>"My awesome project title",
							"class"=>"form-control",
							"required",
							(Auth::check() ? '' : 'disabled')
							)
					)
				}}
			</div>
		</div>
</fieldset>
<fieldset>
	<legend>Who will be the project champion?</legend>
		<div class="form-group {{ ($errors->has('contact_firstname')) ? 'has-error' : '' }}">
			{{ Form::label('contact_firstname', 'First Name', Array("class"=>"col-md-2 control-label")) }}
			<div class="col-md-10">
				{{	Form::text('contact_firstname', Input::old('contact_firstname'),
						Array(	"placeholder" =>"John",
							"class"=>"form-control",
							"required",
							(Auth::check() ? '' : 'disabled')
						)
					)
				}}
			</div>
		</div>
		<div class="form-group {{ ($errors->has('contact_lastname')) ? 'has-error' : '' }}">
		{{ Form::label('contact_lastname', 'Last Name', Array("class"=>"col-md-2 control-label")) }}
			<div class="col-md-10">
				{{	Form::text('contact_lastname', Input::old('contact_lastname'),
						Array(	"placeholder" =>"Doe",
							"class"=>"form-control",
							"required",
							(Auth::check() ? '' : 'disabled')
						)
					)
				}}
			</div>
		</div>
		<div class="form-group {{ ($errors->has('contact_email')) ? 'has-error' : '' }}">
		{{ Form::label('contact_email', 'Email', Array("class"=>"col-md-2 control-label")) }}
			<div class="col-md-10">
				{{	Form::text('contact_email', Input::old('contact_email'),
						Array(	"placeholder" =>"JohnDoe@gmail.com",
							"class"=>"form-control",
							"required",
							(Auth::check() ? '' : 'disabled')
						)
					)
				}}
			</div>
		</div>
		<div class="form-group {{ ($errors->has('contact_phone_number')) ? 'has-error' : '' }}">
		{{ Form::label('contact_phone_number', 'Phone Number', Array("class"=>"col-md-2 control-label")) }}
			<div class="col-md-10">
				{{	Form::text('contact_phone_number', Input::old('contact_phone_number'),
						Array(	"placeholder" =>"1112223333",
							"class"=>"form-control",
							"required",
							(Auth::check() ? '' : 'disabled')
						)
					)
				}}
			</div>
		</div>
		<div class="form-group {{ ($errors->has('contact_phone_number_ext')) ? 'has-error' : '' }}">
		{{ Form::label('contact_phone_number_ext', 'Extension', Array("class"=>"col-md-2 control-label")) }}
			<div class="col-md-10">
				{{	Form::text('contact_phone_number_ext', Input::old('contact_phone_number_ext'),
						Array(	"placeholder" =>"123",
							"class"=>"form-control",
							(Auth::check() ? '' : 'disabled')
						)
					)
				}}
			</div>
		</div>
</fieldset>
<fieldset>
	<legend>Tell us more about your project</legend>
	<div class="form-group {{ ($errors->has('description')) ? 'has-error' : '' }}">
			{{ Form::label('description', 'What do you want the project to do?', Array("class"=>"col-md-2 control-label")) }}
			<div class="col-md-10">
				{{ 	Form::textarea('description', Input::old('description'),
						Array(	"placeholder" =>"I would like to create a clean nuclear reactor",
							"class"=>"form-control",
							"rows"=>"3",
							"required",
							(Auth::check() ? '' : 'disabled')
						)
					)
				}}
			</div>
		</div>
		<div class="form-group {{ ($errors->has('location')) ? 'has-error' : '' }}">
		{{ Form::label('location', 'Where will the project work be done?', Array("class"=>"col-md-2 control-label")) }}
			<div class="col-md-10">
				{{ 	Form::text('location', Input::old('location'),
						Array(	"placeholder" =>"University of Guelph",
							"class"=>"form-control",
							"required",
							(Auth::check() ? '' : 'disabled')
						)
					)
				}}
			</div>
		</div>
		<div class="form-group {{ ($errors->has('expected_time')) ? 'has-error' : '' }}">
		{{ Form::label('expected_time', 'When do you expect the project to be complete?', Array("class"=>"col-md-2 control-label")) }}
			<div class="col-md-10">
				{{ 	Form::select('expected_time',
						Array('1' => 'Less than a month',
							'2' => 'A month',
							'3' => 'Four months',
							'4' => 'Eight months',
							'5' => 'A year',
							'6' => 'More than a year'
						),
						Input::old('expected_time'),
						Array("class"=>"form-control",
							"required",
							(Auth::check() ? '' : 'disabled')
						)
					)
				}}
			</div>
		</div>
		<div class="form-group {{ ($errors->has('motivation')) ? 'has-error' : '' }}">
			{{ Form::label('motivation', 'Why do you want to see this project complete?', Array("class"=>"col-md-2 control-label")) }}
			<div class="col-md-10">
				{{ 	Form::textarea('motivation', Input::old('motivation'),
						Array(	"placeholder" =>"It will help the Guelph community",
								"class"=>"form-control",
								"rows"=>"3",
								"required",
								(Auth::check() ? '' : 'disabled')
						)
					)
				}}
			</div>
		</div>
		<div class="form-group {{ ($errors->has('resources')) ? 'has-error' : '' }}">
			{{ Form::label('resources', 'Opportunities and resources available?', Array("class"=>"col-md-2 control-label")) }}
			<div class="col-md-10">
					{{	Form::textarea('resources', Input::old('resources'),
							Array(	"placeholder" =>"Organization's volunteers can help with the project",
									"class"=>"form-control",
									"rows"=>"3",
									"required",
									(Auth::check() ? '' : 'disabled')
							)
						)
					}}
			</div>
		</div>
		<div class="form-group {{ ($errors->has('constraints')) ? 'has-error' : '' }}">
		{{ Form::label('constraints', 'Barriers for project completion?', Array("class"=>"col-md-2 control-label")) }}
			<div class="col-md-10">
				{{	Form::textarea('constraints', Input::old('constraints'),
					Array(	"placeholder" =>"Work requires many volunteers",
						"class"=>"form-control",
						"rows"=>"3",
						"required",
						(Auth::check() ? '' : 'disabled')
						)
					)
				}}
			</div>
		</div>
</fieldset>
<fieldset>
	<legend>Project Goals</legend>
	<div id="goals_form">
			@if (sizeof(Input::old('goals')) > 0)
				<? $count = 0; ?>
				@foreach(Input::old('goals') as $goal)
					<div class="form-group">
						{{ Form::label('goals'.$count, 'Goal', Array("class"=>"col-md-2 control-label")) }}
						<div class="col-md-10">
							<input id="goals{{$count}}" class="form-control" placeholder="Project Goal" type="text" name="goals[]" value="{{ $goal }}" {{ (Auth::check() ? '' : 'disabled') }} / >
						</div>
					</div>
					<? $count++; ?>
				@endforeach
			@else
			<div class="form-group">
				{{ Form::label('goals[]', 'Goal', Array("class"=>"col-md-2 control-label")) }}
				<div class="col-md-10">
					<input id="goals[]" class="form-control" placeholder="Project Goal" type="text" name="goals[]" {{ (Auth::check() ? '' : 'disabled') }} / >
				</div>
			</div>
			@endif
		</div>

		@if (Auth::check())
		<div class="form-group">
			<div class="col-md-offset-2 col-md-10">
				<button type="button" id="goal_button" val="2" onclick="add_goal();" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-plus-sign"></span> Add Another Goal</button>
			</div>
		</div>
		@endif
</fieldset>
<fieldset>
	<legend>Project tags</legend>
		<div class="form-group">
			{{ Form::label('tags[]', 'Tags', Array("class"=>"col-md-2 control-label")) }}
			<div class="col-md-10">
				{{
					Form::select('tags[]', $tags, Input::old('tags'), Array('size' => '10', 'class' => 'form-control', 'multiple', (Auth::check() ? '' : 'disabled')));
				}}
			</div>
		</div>

		@if (Auth::check())
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

		<div class="form-group">
			<div class="col-md-offset-2 col-md-10">
				<button type="submit" class="btn btn-success btn-lg">Submit</button>
			</div>
		</div>

		<script>
			var goal_count = 0;
			function add_goal(){
				var goal = '<div class="form-group"><label class="col-md-2 control-label" for="goalsx'+goal_count+'">Goal</label><div class="col-md-10">	<input id="goalsx'+goal_count+'" class="form-control" placeholder="Project Goal" type="text" name="goals[]" / >	</div></div>';
				$("#goals_form").append(goal);
				goal_count++;
			}
		</script>


		@endif

	</fieldset>

{{ Form::close() }}

@stop