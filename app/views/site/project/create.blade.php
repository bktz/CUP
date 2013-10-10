@extends('site.layouts.default')

{{-- Content --}}
@section('content')
<h1>Pitch An Idea To The Community University Portal</h1>
<form class="form-horizontal" method="POST" action="{{ URL::to('project') }}" accept-charset="UTF-8">
	<fieldset>
		@if (!Auth::check())
			<div class="alert alert-info alert-block">You must create an account to access this feature.</div>
		@endif

		<div {{ ($errors->has('title')) ? 'class="form-group has-error"' : 'class="form-group"' }}>
			<label class="col-md-2 control-label" for="title">Project Title</label>
			<div class="col-md-10">
				<input class="form-control" required tabindex="1" placeholder="My awesome project title" type="text" name="title" id="title" value="{{ Input::old('title') }}" {{ (Auth::check() ? '' : 'disabled') }} >
			</div>
		</div>
		<h4>Who will be the project champion?</h4>
		<div {{ ($errors->has('contact_firstname')) ? 'class="form-group has-error"' : 'class="form-group"' }}>
			<label class="col-md-2 control-label" for="contact_firstname">First Name</label>
			<div class="col-md-10">
				<input class="form-control" required tabindex="1" placeholder="John" type="text" name="contact_firstname" id="contact_firstname" value="{{ Input::old('contact_firstname') }}" {{ (Auth::check() ? '' : 'disabled') }} >
			</div>
		</div>
		<div {{ ($errors->has('contact_lastname')) ? 'class="form-group has-error"' : 'class="form-group"' }}>
			<label class="col-md-2 control-label" for="contact_lastname">Last Name</label>
			<div class="col-md-10">
				<input class="form-control" required tabindex="1" placeholder="Doe" type="text" name="contact_lastname" id="contact_lastname" value="{{ Input::old('contact_lastname') }}" {{ (Auth::check() ? '' : 'disabled') }} >
			</div>
		</div>
		<div {{ ($errors->has('contact_email')) ? 'class="form-group has-error"' : 'class="form-group"' }}>
			<label class="col-md-2 control-label" for="contact_email">Email</label>
			<div class="col-md-10">
				<input class="form-control" required tabindex="1" placeholder="JohnDoe@gmail.com" type="text" name="contact_email" id="contact_email" value="{{ Input::old('contact_email') }}" {{ (Auth::check() ? '' : 'disabled') }} >
			</div>
		</div>
		<div {{ ($errors->has('contact_phone_number')) ? 'class="form-group has-error"' : 'class="form-group"' }}>
			<label class="col-md-2 control-label" for="contact_phone_number">Phone Number</label>
			<div class="col-md-10">
				<input class="form-control" required tabindex="1" placeholder="1519" type="text" name="contact_phone_number" id="contact_phone_number" value="{{ Input::old('contact_phone_number') }}" {{ (Auth::check() ? '' : 'disabled') }} >
			</div>
		</div>
		<div {{ ($errors->has('contact_phone_number_ext')) ? 'class="form-group has-error"' : 'class="form-group"' }}>
			<label class="col-md-2 control-label" for="contact_phone_number_ext">Extension</label>
			<div class="col-md-10">
				<input class="form-control" tabindex="1" type="text" name="contact_phone_number_ext" id="contact_phone_number_ext" value="{{ Input::old('contact_phone_number_ext') }}" {{ (Auth::check() ? '' : 'disabled') }} >
			</div>
		</div>
		<h4>Tell us more about your project</h4>
		<div {{ ($errors->has('description')) ? 'class="form-group has-error"' : 'class="form-group"' }}>
			<label class="col-md-2 control-label" for="description">What do you want the project to do?</label>
			<div class="col-md-10">
				<textarea rows="3" class="form-control" required tabindex="1" placeholder="I would like to create a clean nuclear reactor" value="{{ Input::old('description') }}" type="text" name="description" id="description" {{ (Auth::check() ? '' : 'disabled') }} ></textarea>
			</div>
		</div>
		<div {{ ($errors->has('location')) ? 'class="form-group has-error"' : 'class="form-group"' }}>
			<label class="col-md-2 control-label" for="location">Where will the project work be done?</label>
			<div class="col-md-10">
				<input class="form-control" required tabindex="1" placeholder="University of Guelph" type="text" name="location" id="location" value="{{ Input::old('location') }}" {{ (Auth::check() ? '' : 'disabled') }} >
			</div>
		</div>
		<div {{ ($errors->has('expected_time')) ? 'class="form-group has-error"' : 'class="form-group"' }}>
			<label class="col-md-2 control-label" for="expected_time">When do you expect the project to be complete?</label>
			<div class="col-md-10">
				<select tabindex="1" class="form-control" name="expected_time" id="expected_time" required {{ (Auth::check() ? '' : 'disabled') }} >
					<option value="1">Less than a month</option>
					<option value="2">A month</option>
					<option value="3">Four months</option>
					<option value="4">Eight months</option>
					<option value="5">A year</option>
					<option value="6">More than a year</option>
				</select>
			</div>
		</div>
		<div {{ ($errors->has('motivation')) ? 'class="form-group has-error"' : 'class="form-group"' }}>
			<label class="col-md-2 control-label" for="motivation">Why do you want to see this project complete?</label>
			<div class="col-md-10">
				<textarea rows="3" class="form-control" required tabindex="1" placeholder="It will help the Guelph community" type="text" name="motivation" id="motivation" value="{{ Input::old('motivation') }}" {{ (Auth::check() ? '' : 'disabled') }} ></textarea>
			</div>
		</div>
		<div {{ ($errors->has('resources')) ? 'class="form-group has-error"' : 'class="form-group"' }}>
			<label class="col-md-2 control-label" for="resources">Opportunities and resources available?</label>
			<div class="col-md-10">
				<textarea rows="3" class="form-control" required tabindex="1" placeholder="Organization's volunteers can help with the project" type="text" name="resources" id="resources" value="{{ Input::old('resources') }}" {{ (Auth::check() ? '' : 'disabled') }} ></textarea>
			</div>
		</div>
		<div {{ ($errors->has('constraints')) ? 'class="form-group has-error"' : 'class="form-group"' }}>
			<label class="col-md-2 control-label" for="constraints">Barriers for project completion?</label>
			<div class="col-md-10">
				<textarea rows="3" class="form-control" required tabindex="1" placeholder="Work requires many volunteers" type="text" name="constraints" id="constraints" value="{{ Input::old('constraints') }}" {{ (Auth::check() ? '' : 'disabled') }} ></textarea>
			</div>
		</div>

		<h4>Project Goals</h4>
		<div id="goals">
			<div class="form-group">
				<label class="col-md-2 control-label">Goal</label>
				<div class="col-md-10">
					<input class="form-control" tabindex="1" placeholder="Project Goal" type="text" name="goals[]" {{ (Auth::check() ? '' : 'disabled') }} / >
				</div>
			</div>
		</div>

		@if (Auth::check())
		<div class="form-group">
			<div class="col-md-offset-2 col-md-10">
				<button tabindex="3" type="button" id="goal_button" val="2" onclick="add_goal();" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-plus-sign"></span> Add Another Goal</button>
			</div>
		</div>


		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

		<div class="form-group">
			<div class="col-md-offset-2 col-md-10">
				<button tabindex="3" type="submit" class="btn btn-success btn-lg">Submit</button>
			</div>
		</div>

		<script>
			function add_goal(){
				var goal = '<div class="form-group"><label class="col-md-2 control-label">Goal</label><div class="col-md-10">	<input class="form-control" tabindex="1" placeholder="Project Goal" type="text" name="goals[]" / >	</div></div>';
				$("#goals").append(goal);
			}
		</script>


		@endif

	</fieldset>
</form>

@stop