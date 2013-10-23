@extends('site.layouts.default')

{{-- Content --}}
@section('content')

<div class="container">
    <div class="panel panel-primary">
	    <div class="panel-body">
		    <dl class="dl-horizontal">
			    <dt></dt>
				<dd><h3>{{ String::title($project->title) }}</h3></dd>
				<dt>Project State</dt>
				<dd>{{ String::title($project->state) }}</dd>
				<p />
				<dt>Description</dt>
				<dd>{{ $project->description }}</dd>
				<p />
				<dt>Contact Info</dt>
				<dd>{{ String::title($project->contact_firstname) }} {{ String::title($project->contact_lastname) }}</dd>
				<dt></dt>
				<dd><a href={{'"mailto:'.$project->contact_email.'"'}}>{{$project->contact_email}}</a></dd>
				<dt></dt>
				<dd>{{ String::phone_number_expand($project->contact_phone_number) }} @if($project->contact_phone_number_ext != '') Ext. {{$project->contact_phone_number_ext}} @endif</dd>
				<p />					 
				<dt>Location:</dt>
				<dd>{{ $project->location }}</dd>
				<p />
				<dt>Expected Completion:</dt>
				<dd>{{ $project->expected_time }}</dd>
				<p />
				<dt>Motivation:</dt>
				<dd>{{ $project->motivation }}</dd>
				<p />
				<dt>Resources:</dt>
				<dd>{{ $project->resources }}</dd>
				<p />
				<dt>Constraints:</dt>
				<dd>{{ $project->constraints }}</dd>
            </dl>
			<div class="panel panel-primary">
			    <div class="panel-heading">Goals</div>
                    <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Completed</th>
                            <th>Goal</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($goals as $goal)					                           
                        <tr>
                            <td class="span1">
                                @if ($goal->complete == 1)
                                    <span class="glyphicon glyphicon-check icon-green"></span>
                                @else
                                    <span class="glyphicon glyphicon-unchecked icon-red"></span>
                                @endif
                            </td>
                            <td>{{ $goal->goal }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
		    </div>			 
		    <div class="panel panel-primary">
			    <div class="panel-heading">Tags</div>
                <table class="table table-condensed">
                    <tbody>
                    @foreach ($tags as $tag)					                           
                        <tr>
                            <td class="span1"><span class="glyphicon glyphicon-tag icon-x"></span></td>
                            <td>{{ $tag->tag }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
		    </div>			 
        </div>
    </div>			     			     
</div>

@stop