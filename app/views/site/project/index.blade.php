@extends('site.layouts.default')

{{-- Content --}}
@section('content')
<h1>View Projects</h1>
<div class="container">
	@foreach ($projects as $project)
	<div class="panel panel-primary">
		<div class="panel-body">
			<dl class="dl-horizontal">
				<dt></dt>
				<dd><h3>{{ String::title($project->title) }}</h3></dd>
				<dt>Project State</dt>
				<dd>{{ String::title($project->state) }}</dd>
				<p />
				<dt>Description</dt>
				<dd>{{ Str::limit($project->description, 750) }}</dd>
				<p />
				<p />
				<dd><a href={{ '"/project/'.$project->id.'"' }}><button type="button" class="btn btn-lg btn-primary">View Project</button></a></dd>
			</dl>
		</div>
	</div>
	@endforeach
</div>
<div class="text-center">
	{{$projects->links()}}
</div>

@stop
