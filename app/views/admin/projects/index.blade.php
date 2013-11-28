@extends('admin.layouts.default')

{{-- Content --}}
@section('content')
<div class="container" style="margin-bottom: 20px;">
	<h1>Manage Projects</h1>
	<form class="form-horizontal" method="GET" action="{{ URL::to('admin/project') }}" accept-charset="UTF-8">
		{{ Form::open(array('url' => 'admin/project', 'method' => 'GET')) }}
		<div class="row search">
			<div class="col-md-12">
				<div class="input-group">
					{{ Form::label('search', 'Search', Array("class"=>"input-group-addon")) }}
					{{ 	Form::text('search',
							Input::get('search'),
							Array(	"placeholder" =>"Search for project title",
								"class"=>"form-control input-md"
							)
						)
					}}
					<span class="input-group-btn">
						<button class="btn btn-success btn-md" type="submit"><span class="glyphicon glyphicon-search"></span> Search</button>
					</span>
				</div>
				<p class="help-block">Search by the title of a project - Eg: "Community University Portal"</p>
			</div>
		</div>
	{{ Form::close() }}
</div>

<div class="container">
	@if(count($projects) == 0)
		<div class="panel panel-primary">
			<div class="panel-body">
				<h3 class="text-center">Sorry...No projects were found.</h3>
			</div>
		</div>
	@else
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
					<dd>{{ ucfirst(Str::limit($project->description, 750)) }}</dd>
					<p />
					<p />
					<dd>
						<a href={{ '"/project/'.$project->id.'"' }}><button type="button" class="btn btn-lg btn-primary"><span class="glyphicon"></span>View Project</button></a>
						<a href={{ '"/admin/project/'.$project->id.'/edit"' }}><button type="button" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-pencil"></span> Edit Project</button></a>
					</dd>
				</dl>
			</div>
		</div>
		@endforeach
	@endif
</div>

<div class="text-center">
	{{$projects->links()}}
</div>

@stop