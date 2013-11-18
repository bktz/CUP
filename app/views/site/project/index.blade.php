@extends('site.layouts.default')

{{-- Content --}}
@section('content')
<h1>View Projects</h1>
<div class="container" style="margin-bottom: 20px;">
	<form class="form-horizontal" method="GET" action="{{ URL::to('project') }}" accept-charset="UTF-8">
		{{ Form::open(array('url' => 'project', 'method' => 'GET')) }}
		<div class="row search">
			<div class="col-md-12">
				<div class="input-group">
					{{ Form::label('search', 'Search', Array("class"=>"input-group-addon")) }}
					{{ 	Form::text('search',
							Input::get('search'),
							Array(	"placeholder" =>"Search for tags",
								"class"=>"form-control input-md"
							)
						)
					}}
					<span class="input-group-btn">
						<button class="btn btn-success btn-md" type="submit"><span class="glyphicon glyphicon-search"></span> Search</button>
					</span>
				</div>
				<p class="help-block">Separate search tags with a comma followed by a space ", " - Eg: "Math, Art"</p>
			</div>
		</div>
	{{ Form::close() }}
</div>

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
				<dd>{{ ucfirst(Str::limit($project->description, 750)) }}</dd>
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
