@extends('site.layouts.default')

{{-- Content --}}
@section('content')

<div class="page-header">
        @if ($disabled == "disabled")
            <h2>You must create an account to use this feature.</h3>
        @else
	        <h1>Pitch an idea to the community university portal!</h1>            
        @endif
</div>
<form class="form-horizontal" method="POST" action="{{ URL::to('project') }}" accept-charset="UTF-8">
    
        @if ( Session::get('error') )
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        @if ( Session::get('notice') )
        <div class="alert">{{ Session::get('notice') }}</div>
        @endif
    
       
 
    
    <fieldset>
        <div class="form-group">
            <label class="col-md-2 control-label" for="title">Project Title</label>
            <div class="col-md-10">
                <input class="form-control" {{$disabled}} tabindex="1" placeholder="My awesome project title" type="text" name="title" id="title" value="{{ Input::old('title') }}">
            </div>
        </div>
        <div class="form-group">
            <h4>Who will be the project champion?</h4>
            <label class="col-md-2 control-label" for="contact_firstname">First Name</label>
            <div class="col-md-10">
                <input class="form-control" {{$disabled}} tabindex="1" placeholder="John" type="text" name="contact_firstname" id="contact_firstname" value="{{ Input::old('contact_firstname') }}">
            </div>
            <label class="col-md-2 control-label" for="contact_lastname">Last Name</label>
            <div class="col-md-10">
                <input class="form-control" {{$disabled}} tabindex="1" placeholder="Doe" type="text" name="contact_lastname" id="contact_lastname" value="{{ Input::old('contact_lastname') }}">
            </div>
            <label class="col-md-2 control-label" for="contact_email">Email</label>
            <div class="col-md-10">
                <input class="form-control" {{$disabled}} tabindex="1" placeholder="JohnDoe@gmail.com" type="text" name="contact_email" id="contact_email" value="{{ Input::old('contact_email') }}">
            </div>
            <label class="col-md-2 control-label" for="contact_phone_number">Phone Number</label>
            <div class="col-md-10">
                <input class="form-control" {{$disabled}} tabindex="1" placeholder="1519" type="text" name="contact_phone_number" id="contact_phone_number" value="{{ Input::old('contact_phone_number') }}">
            </div>
            <label class="col-md-2 control-label" for="contact_phone_number_ext">Extension</label>
            <div class="col-md-10">
                <input class="form-control" {{$disabled}} tabindex="1" type="text" name="contact_phone_number_ext" id="contact_phone_number_ext" value="{{ Input::old('contact_phone_number_ext') }}">
            </div>
        </div>
        <h4>Tell us more about your project</h4>
        <div class="form-group">
            <label class="col-md-2 control-label" for="description">What do you want to project to do?</label>
            <div class="col-md-10">
                <input class="form-control" {{$disabled}} tabindex="1" placeholder="Description" type="text" name="description" id="description" value="{{ Input::old('description') }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="location">Where will the project work be done?</label>
            <div class="col-md-10">
                <input class="form-control" {{$disabled}} tabindex="1" placeholder="University of Guelph" type="text" name="location" id="location" value="{{ Input::old('location') }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="expected_time">When do you expect the project to be complete?</label>
            <div class="col-md-10">
                <input class="form-control" {{$disabled}} tabindex="1" placeholder="Before the end of this year" type="text" name="expected_time" id="expected_time" value="{{ Input::old('expected_time') }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="motivation">Why do you want to see this project complete?</label>
            <div class="col-md-10">
                <input class="form-control" {{$disabled}} tabindex="1" placeholder="It will help the Guelph community" type="text" name="motivation" id="motivation" value="{{ Input::old('motivation') }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="resources">Opportunities and resources available?</label>
            <div class="col-md-10">
                <input class="form-control" {{$disabled}} tabindex="1" placeholder="Organization's volunteers can help with the project" type="text" name="resources" id="resources" value="{{ Input::old('resources') }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="constraints">Barriers for project completion?</label>
            <div class="col-md-10">
                <input class="form-control" {{$disabled}} tabindex="1" placeholder="Work requires many volunteers" type="text" name="constraints" id="constraints" value="{{ Input::old('constraints') }}">
            </div>
        </div>
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        
        @if (Auth::check())
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <button tabindex="3" type="submit" class="btn btn-primary">Submit!</button>
            </div>
        </div>        
        @endif
        
    </fieldset>
</form>

@stop