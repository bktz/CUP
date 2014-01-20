@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.settings') }}} ::
@parent
@stop

{{-- New Laravel 4 Feature in use --}}
@section('styles')
@parent
body {
	background: #f2f2f2;
}
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h3>Edit your settings</h3>
</div>
<form class="form-horizontal" method="post" action="{{ URL::to('user/' . $user->id . '/edit') }}"  autocomplete="off">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <!-- ./ csrf token -->
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <!-- username -->
        <div class="form-group {{{ $errors->has('username') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="username">Username</label>
            <div class="col-md-10">
                <input id= "username" disabled="true" class="form-control" type="text" name="username" value="{{{ Input::old('username', $user->username) }}}" />
                {{{ $errors->first('username', '<span class="help-inline">:message</span>') }}}
            </div>
        </div>
        <!-- ./ username -->

        <!-- Email -->
        <div class="form-group {{{ $errors->has('email') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="email">Email</label>
            <div class="col-md-10">
                <input id="email" class="form-control" type="text" name="email" value="{{{ Input::old('email', $user->email) }}}" />
                {{{ $errors->first('email', '<span class="help-inline">:message</span>') }}}
            </div>
        </div>
        <!-- ./ email -->

        <!-- Old Password -->
        <div class="form-group {{{ $errors->has('password') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="password_old">Old Password</label>
            <div class="col-md-10">
                <input id="password_old" class="form-control" type="password" name="password_old" value="" />
                {{{ $errors->first('password', '<span class="help-inline">:message</span>') }}}
            </div>
        </div>
        <!-- ./ password -->
        
        <!-- New Password -->
        <div class="form-group {{{ $errors->has('password') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="password">New Password</label>
            <div class="col-md-10">
                <input id="password" class="form-control" type="password" name="password" value="" />
                {{{ $errors->first('password', '<span class="help-inline">:message</span>') }}}
            </div>
        </div>
        <!-- ./ password -->

        <!-- Password Confirm -->
        <div class="form-group {{{ $errors->has('password_confirmation') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="password_confirmation">Password Confirm</label>
            <div class="col-md-10">
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" value="" />
                {{{ $errors->first('password_confirmation', '<span class="help-inline">:message</span>') }}}
            </div>
        </div>
        <!-- ./ password confirm -->
        
        <br>
        <br>
        
        <!-- First Name -->
        <div class="form-group {{{ $errors->has('first_name') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="first_name">First Name</label>
            <div class="col-md-10">
                <input id="first_name" class="form-control" type="text" name="first_name" value="{{{ Input::old('first_name', $user->first_name) }}}" />
                {{{ $errors->first('first_name', '<span class="help-inline">:message</span>') }}}
            </div>
        </div>
        <!-- ./ First Name -->
        
        <!-- Last Name -->
        <div class="form-group {{{ $errors->has('last_name') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="last_name">Last Name</label>
            <div class="col-md-10">
                <input id="last_name" class="form-control" type="text" name="last_name" value="{{{ Input::old('last_name', $user->last_name) }}}" />
                {{{ $errors->first('last_name', '<span class="help-inline">:message</span>') }}}
            </div>
        </div>
        <!-- ./ Last Name -->
        
        <!-- Organization -->
        <div class="form-group {{{ $errors->has('organization') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="organization">Organization</label>
            <div class="col-md-10">
                <input id="organization" class="form-control" type="text" name="organization" value="{{{ Input::old('organization', $user->organization) }}}" />
                {{{ $errors->first('organization', '<span class="help-inline">:message</span>') }}}
            </div>
        </div>
        <!-- ./ Organization -->
        
        <!-- Phone Number -->
        <div class="form-group {{{ $errors->has('phone_number') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="phone_number">Phone Number</label>
            <div class="col-md-10">
                <input id="phone_number" class="form-control" type="text" name="phone_number" value="{{{ Input::old('phone_number', $user->phone_number) }}}" />
                {{{ $errors->first('phone_number', '<span class="help-inline">:message</span>') }}}
            </div>
        </div>
        <!-- ./ Phone Number -->
        
        <!-- Phone Number Ext -->
        <div class="form-group {{{ $errors->has('phone_number_ext') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="phone_number_ext">Phone Number Extension</label>
            <div class="col-md-10">
                <input id="phone_number_ext" class="form-control" type="text" name="phone_number_ext" value="{{{ Input::old('phone_number_ext', $user->phone_number_ext) }}}" />
                {{{ $errors->first('phone_number_ext', '<span class="help-inline">:message</span>') }}}
            </div>
        </div>
        <!-- ./ Phone Number Ext -->
        
    </div>
    <!-- ./ general tab -->

    <!-- Form Actions -->
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </div>
    <!-- ./ form actions -->
</form>
</form>
@stop
