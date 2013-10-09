@extends('site.layouts.default')

{{-- Content --}}
@section('content')
    <h1>Projects</h1>
    @if (!Auth::check())
	    <div class="alert alert-danger"><b>WARNING! </b>You must create an account to access this feature.</div>
	@else
        <div class="container">
            @foreach ($projects as $project)
            <div class="well">                 
                 <dl class="dl-horizontal">
                     <dt><a href={{ '"/project/'.$project->id.'"' }}> <h3>{{ $project->title }}</h3></a></dt>
                     <dd></dd>             
                     <dt>Description</dt>
                     <dd>{{$project->description}}</dd>
                     <dt>Project Champion</dt>
                     <dd>{{$project->contact_firstname}} {{$project->contact_lastname}}</dd>
                     <dt>Contact Email</dt>
                     <dd><a href={{'"mailto:'.$project->contact_email.'"'}}>{{$project->contact_email}}</a></dd>
                     <dt>Contact Phone</dt>
                     <dd>{{$project->contact_phone_number}} @if($project->contact_phone_number_ext != '') Ext. {{$project->contact_phone_number_ext}} @endif</dd>
                     <dt>Project State</dt>
                     <dd>{{$project->state}}</dd>
                 </dl>
            </div>             
            @endforeach
        </div>
	@endif
	{{$projects->links()}}
@stop
