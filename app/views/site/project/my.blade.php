@extends('site.layouts.default')

{{-- Content --}}
@section('content')
	<h1>My Projects</h1>
	@if (!Auth::check())
		<div class="alert alert-info alert-block">You must create an account to access this feature.</div>
	@else
		<div class="container">
			@foreach ($projects as $project)
			<div class="well">
				 <dl class="dl-horizontal">
					 <dt></dt>
					 <dd><h3>{{ String::title($project->title) }}</h3></dd>
					 <dt>Project State</dt>
					 <dd>{{ String::title($project->state) }}</dd>
					 <p />
					 <dt>Description</dt>
					 <dd>{{ String::title(Str::limit($project->description, 750)) }}</dd>
					 <p />
					 <dt>Contact Info</dt>
					 <dd>{{ String::title($project->contact_firstname) }} {{ String::title($project->contact_lastname) }}</dd>
					 <dt></dt>
					 <dd><a href={{'"mailto:'.$project->contact_email.'"'}}>{{$project->contact_email}}</a></dd>
					 <dt></dt>
					 <dd>{{$project->contact_phone_number}} @if($project->contact_phone_number_ext != '') Ext. {{$project->contact_phone_number_ext}} @endif</dd>
					 <p />
					 <p />
					 <dd><a href={{ '"/project/'.$project->id.'"' }}><button type="button" class="btn btn-lg btn-primary">View Project</button></a></dd>
				 </dl>

			</div>
			@endforeach
		</div>
		<div class="text-center">
			{{$projects->links()}}
		</div>
	@endif
@stop
