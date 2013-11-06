@extends('site.layouts.default')

{{-- Content --}}
@section('content')

<h1>{{ String::title($project->title) }}</h1>
<form class="form-horizontal" method="PUT" action="{{ URL::to('project'.$project->id) }}" accept-charset="UTF-8">
{{ Form::open(array('url' => 'project'.$project->id, 'method' => 'PUT')) }}

<fieldset>
	<legend>Who Will Be The Project Champion?</legend>
		<div class="form-group {{ ($errors->has('contact_firstname')) ? 'has-error' : '' }}">
			{{ Form::label('contact_firstname', 'First Name', Array("class"=>"col-md-2 control-label")) }}
			<div class="col-md-10">
				{{	Form::text('contact_firstname',
						(Input::old('contact_firstname') != '') ? Input::old('contact_firstname') : $project->contact_firstname,
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
				{{	Form::text('contact_lastname',
						(Input::old('contact_lastname') != '') ? Input::old('contact_lastname') : $project->contact_lastname,
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
				{{	Form::text('contact_email',
						(Input::old('contact_email') != '') ? Input::old('contact_email') : $project->contact_email,
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
				{{	Form::text('contact_phone_number',
						(Input::old('contact_phone_number') != '') ? Input::old('contact_phone_number') : $project->contact_phone_number,
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
				{{	Form::text('contact_phone_number_ext',
						(Input::old('contact_phone_number_ext') != '') ? Input::old('contact_phone_number_ext') : $project->contact_phone_number_ext,
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
	<legend>Tell Us More About Your Project</legend>
	<div class="form-group {{ ($errors->has('description')) ? 'has-error' : '' }}">
			{{ Form::label('description', 'What do you want the project to do?', Array("class"=>"col-md-2 control-label")) }}
			<div class="col-md-10">
				{{ 	Form::textarea('description',
						(Input::old('description') != '') ? Input::old('description') : $project->description,
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
				{{ 	Form::text('location',
					(Input::old('location') != '') ? Input::old('location') : $project->location,
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
						(Input::old('expected_time') != '') ? Input::old('expected_time') : $project->expected_time,
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
				{{ 	Form::textarea('motivation',
						(Input::old('motivation') != '') ? Input::old('motivation') : $project->motivation,
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
					{{	Form::textarea('resources',
							(Input::old('resources') != '') ? Input::old('resources') : $project->resources,
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
				{{	Form::textarea('constraints',
						(Input::old('constraints') != '') ? Input::old('constraints') : $project->constraints,
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
			@if (sizeof($goals) > 0)
				<? $count = 0; ?>
				@foreach($goals as $goal)
					<div class="form-group">
						{{ Form::label('goals'.$count, 'Goal', Array("class"=>"col-md-2 control-label")) }}
						<div class="col-md-8">
							<input id="goals{{$count}}" class="form-control" placeholder="Project Goal" type="text" name="goals[]" value="{{ $goal->goal }}" {{ (Auth::check() ? '' : 'disabled') }} / >
						</div>
						{{ Form::label('complete'.$goal->id, 'Completed', Array("class"=>"col-md-1 control-label")) }}
						<div class="col-md-1">
							{{ Form::checkbox('completed[]', $goal->id, $goal->complete, array("id"=>"complete".$goal->id, "class"=>"form-control", "style"=>"box-shadow: none; margin-top: 0px;")); }}
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
	<legend>Project Tags</legend>
		<div class="form-group">
			{{ Form::label('tags[]', 'Tags', Array("class"=>"col-md-2 control-label")) }}
			<div class="col-md-10">
				{{
					Form::select('tags[]',
						$tags_all,
						(Input::old('tags') != '') ? Input::old('tags') : $tags,
						Array('size' => '10',
							'class' => 'form-control',
							'multiple',
							(Auth::check() ? '' : 'disabled')
						)
					);
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

<!--########################-->
<!--Script for adding a goal-->
<!--########################-->
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