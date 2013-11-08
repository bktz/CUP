<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8" />
		<title>
			@section('title')
			Community University Portal
			@show
		</title>
		<meta name="keywords" content="your, awesome, keywords, here" />
		<meta name="author" content="Benjamin Katznelson & Justin Tempelman" />
		<meta name="description" content="Lorem ipsum dolor sit amet, nihil fabulas et sea, nam posse menandri scripserit no, mei." />

		<!-- Mobile Specific Metas
		================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- CSS
		================================================== -->
        {{ Basset::show('public.css') }}

		<style>
		@section('styles')
		@show
		</style>

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Favicons
		================================================== -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" href="{{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}}">
		<link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.png') }}}">
	</head>

	<body>
		<!-- To make sticky footer need to wrap in a div -->
		<div id="wrap">
		<!-- Navbar -->

			<div id="logoContainer" class="container">
				<a class="UoGLogo" href="{{{ URL::to('') }}}"><img alt="Homepage" src="/assets/img/template/UoG_Logo.gif"/></a>
			</div>

		<div class="navbar navbar-default navbar-inverse">
			 <div class="container">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
						<li class="home" {{ (Request::is('/') ? ' class="active"' : '') }}><a href="{{{ URL::to('/') }}}">Home</a></li>
						<li {{ (Request::is('project') ? ' class="active"' : '') }}><a href="{{{ URL::to('project') }}}">View Projects</a></li>
						<li {{ (Request::is('process') ? ' class="active"' : '') }}><a href="{{{ URL::to('process') }}}">The Process</a></li>
						<li {{ (Request::is('project/create') ? ' class="active"' : '') }}><a href="{{{ URL::to('project/create') }}}">Pitch An Idea</a></li>
						<li {{ (Request::is('project/my') ? ' class="active"' : '') }}><a href="{{{ URL::to('project/my') }}}">My Projects</a></li>
					</ul>
					<ul class="nav navbar-nav menu-right">
						@if (Auth::check())
                        	<li  {{ (Request::is('user') ? ' class="active"' : '') }}><a href="{{{ URL::to('user') }}}">Profile</a></li>
                        	<li><a href="{{{ URL::to('user/logout') }}}">Logout</a></li>
							@if (Auth::user()->hasRole('admin'))
								<li><a href="{{{ URL::to('admin') }}}">Admin Panel</a></li>
							@endif
                        @else
                        	<li {{ (Request::is('user/login') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/login') }}}">Login</a></li>
                        	<li {{ (Request::is('user/create') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/create') }}}">{{{ Lang::get('site.sign_up') }}}</a></li>
                        @endif
					</ul>
					<!-- ./ nav-collapse -->
				</div>
			</div>
		</div>
		<!-- ./ navbar -->

		<!-- Container -->
		<div class="container">
			<!-- Notifications -->
			@include('notifications')
			<!-- ./ notifications -->

			<!-- Content -->
			@yield('content')
			<!-- ./ content -->
		</div>
		<!-- ./ container -->

		<!-- the following div is needed to make a sticky footer -->
		<div id="push"></div>
		</div>
		<!-- ./wrap -->


	<div id="footer">
		<div class="container">
			<p class="muted credit">Copyright &copy; 2013 <a target="_blank" href="http://ca.linkedin.com/in/benikatznelson">Benjamin Katznelson</a> & <a target="_blank" href="http://ca.linkedin.com/pub/justin-tempelman/63/a02/332">Justin Tempelman</a>
				<block class="pull-right">
					<a href="/privacy">Privacy Policy</a> | <a href="#">Terms of Use</a> | <a href="/license">License</a> | <a href="/contact-us">Contact Us</a>
				</block>
			</p>
		</div>
	</div>

		<!-- Javascripts
		================================================== -->
        {{ Basset::show('public.js') }}
	</body>
</html>
