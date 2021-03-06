@extends('site.layouts.default')
@section('content')

<div class="page-header">
	<h1>Signup for an Account</h1>
</div>
<!-- {{ Confide::makeSignupForm()->render() }} //is all mangled for some reason, apparantly conflicting bootstrap versions-->

<div>
	<form class="form-horizontal" method="POST" action="{{ URL::to('user') }}" accept-charset="UTF-8">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">		
		<fieldset>
			<div class="form-group">
				<label class="col-md-2 control-label" for="Account_Type">Select account type </label>
				<div class="col-md-10">
					<input id="Account_Type" type="radio" name="Account_Type" value="0" alt="Community Option" required <?php if(Input::old('Account_Type')== "0") { echo 'checked="checked"'; }?>> Community
					<input id="Account_Type" type="radio" name="Account_Type" value="1" alt="Campus Option" <?php if(Input::old('Account_Type')== "1") { echo 'checked="checked"'; }?>> Campus
					<p class="help-block">Your account is a Campus account if you want to take on projects and a Community account if you are submitting them.</p>			
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-2 control-label" for="username">Username </label>
				<div class="col-md-10">
					<input id="username" type="text" class="form-control" name="username" value="{{Input::old('username')}}" alt="Username Input Box" placeholder="BigJohnyD" required><br>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-2 control-label" for="email">Email </label>
				<div class="col-md-10">
					<input id="email" type="text" class="form-control" name="email" value="{{Input::old('email')}}" alt="Email Input Box" placeholder="John@doe.com" required><br>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-2 control-label" for="password">Password </label>
				<div class="col-md-10">
					<input id="password" type="password" class="form-control" name="password" value="" alt="Password Input Box" placeholder="*********" required><br>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-2 control-label" for="re-enter-password">Re-Enter Password </label>
				<div class="col-md-10">
					<input id="re-enter-password" type="password" class="form-control" name="password_confirmation" value="" alt="Re-Enter Password Input Box" placeholder="*********" required><br>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-md-offset-2 col-md-10">
					<label class="control-label" for="recaptcha_response_field">reCaptcha</label>
					<div id="recaptcha_widget_div">
						{{ Form::captcha(array('theme' => 'clean')); }}
					</div>					
					<button type="submit" class="btn btn-success btn-lg">Submit</button>
				</div>
			</div>
		</fieldset>
	</form>
</div>
@stop

<!-- <div class="form-group"> -->
<!-- 				<label class="col-md-2 control-label" for="username">Username: </label> -->
<!-- 				<div class="col-md-10"> -->
<!-- 					<input type="text" name="Username Input" value="" alt="Username Input Box" placeholder="BigJohnyD"><br> -->
<!-- 				</div> -->
<!-- 			</div> -->
