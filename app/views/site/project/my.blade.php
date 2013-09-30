@extends('site.layouts.default')

{{-- Content --}}
@section('content')
@foreach ($projects as $project)
	<h4><strong>{{ String::title($project->title) }}</strong></h4>
@endforeach
@stop
