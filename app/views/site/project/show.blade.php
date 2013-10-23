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
				<p/>
				<dt>Description</dt>
				<dd>{{ ucfirst($project->description) }}</dd>
				<p/>
				<dt>Contact Info</dt>
				<dd>{{ String::title($project->contact_firstname) }} {{ String::title($project->contact_lastname) }}
				</dd>
				<dt></dt>
				<dd><a href={{'"mailto:'.$project->contact_email.'"'}}>{{$project->contact_email}}</a></dd>
				<dt></dt>
				<dd>{{ String::phone_number_expand($project->contact_phone_number) }}
					@if($project->contact_phone_number_ext != '') Ext. {{$project->contact_phone_number_ext}} @endif
				</dd>
				<p/>
				<dt>Location:</dt>
				<dd>{{ ucfirst($project->location) }}</dd>
				<p/>
				<dt>Expected Completion:</dt>
				<dd>{{ ucfirst($project->expected_time) }}</dd>
				<p/>
				<dt>Motivation:</dt>
				<dd>{{ ucfirst($project->motivation) }}</dd>
				<p/>
				<dt>Resources:</dt>
				<dd>{{ ucfirst($project->resources) }}</dd>
				<p/>
				<dt>Constraints:</dt>
				<dd>{{ ucfirst($project->constraints) }}</dd>
				<p />
				<dt>Goals:</dt>
				<dd>
					@if (sizeof($goals) > 0)
					<div class="panel panel-primary">
						<table class="table table-condensed table-bordered table-hover">
							<thead>
							<tr>
								<th>Completed</th>
								<th>Goal</th>
							</tr>
							</thead>
							<tbody>
							@foreach ($goals as $goal)
								@if ($goal->complete == 1)
									<tr class="success">
										<td class="text-center" style="width:10%;">
											<span class="glyphicon glyphicon-check icon-green"></span>
								@else
									<tr class="danger">
										<td class="text-center" style="width:10%;">
											<span class="glyphicon glyphicon-unchecked icon-red"></span>
								@endif
										</td>
									<td>{{ ucfirst($goal->goal) }}</td>
									</tr>
							@endforeach
							</tbody>
						</table>
					</div>
					@else
						N/A
					@endif
				</dd>
				<p />
				<dt>Tags:</dt>
				<dd>
					@if (sizeof($tags) > 0)
					<div class="panel panel-primary">
						<table class="table table-condensed table-hover table-striped">
							<thead>
							<tr>
								<th></th>
								<th>Tag</th>
							</tr>
							</thead>
							<tbody>
							@foreach ($tags as $tag)
							<tr>
								<td class="text-center" style="width:10%;"><span class="glyphicon glyphicon-tag icon-blue"></span></td>
								<td>{{ ucfirst($tag->tag) }}</td>
							</tr>
							@endforeach
							</tbody>
						</table>
					</div>
					@else
					N/A
					@endif
				</dd>
				@if (Auth::check() && (Auth::user()->id == $project->user_id))
				<p />
				<dd>
					<a href={{ '"/project/'.$project->id.'/edit"' }}><button type="button" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-pencil"></span> Edit Project</button></a>
				</dd>
				@endif
			</dl>
		</div>
	</div>
</div>

@stop