@extends('admin.layouts.default')

{{-- Content --}}
@section('content')

<h1 xmlns="http://www.w3.org/1999/html">Edit Project</h1>


<fieldset>
	<legend>General Information</legend>
	<div class="panel panel-primary">
		<div class="panel-body">
			<div class="form-group">
				<div class="col-md-2 custom-label">Created By</div>
				<div class="col-md-3">
					<div style="width: 100%;height: 34px; padding: 6px 12px;font-size: 14px;">{{ ucfirst($creator->first_name).' '.ucfirst($creator->last_name) }}</div>
				</div>
				<div class="col-md-2 custom-label">Email</div>
				<div class="col-md-4">
					<div id="creator_email" style="width: 100%;height: 34px; padding: 6px 12px;font-size: 14px;"><a href="mailto:{{ $creator->email }}?Subject=Community%20University%20Portal" target="_top">{{ $creator->email }}</a></div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-2 custom-label">Date Created</div>
				<div class="col-md-3">
					<div id="created_at" style="width: 100%;height: 34px; padding: 6px 12px;font-size: 14px;">{{ $project->created_at }}</div>
				</div>
				<div class="col-md-2 custom-label">Last Update</div>
				<div class="col-md-4">
					<div id="updated_at" style="width: 100%;height: 34px; padding: 6px 12px;font-size: 14px;">{{ $project->updated_at }}</div>
				</div>
			</div>
		</div>
	</div>
</fieldset>



<fieldset>

	<legend>Assigned Users</legend>
	<div class="panel panel-primary">
		<div class="panel-body">
			@if (sizeof($users) > 0)
				<div class="panel panel-primary">
					<table class="table table-condensed table-hover table-striped">
						<thead>
						<tr>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Email</th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						@foreach ($users as $user)
						<tr>
							<td>{{ ucfirst($user->first_name) }}</td>
							<td>{{ ucfirst($user->last_name) }}</td>
							<td><a href="mailto:{{ $user->email }}?Subject=Community%20University%20Portal" target="_top">{{ $user->email }}</a></td>
							<td>
								<a onclick="delete_confirm({{ $user->id }});" data-toggle="modal" title="Delete this tag" data-id="{{ $user->id }}" href="#confirm_modal" class=".delete-confirm btn-sm btn-danger">Remove</a>
							</td>
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			@endif
			<form class="form-horizontal" method="POST" action="{{ URL::to('admin/project/'.$project->id.'/assign') }}" accept-charset="UTF-8">
				{{ Form::open(array('url' => 'admin/project/'.$project->id.'/assign', 'method' => 'POST')) }}
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
				<div class="form-group">
					{{ Form::label('assign_new', 'Assign New User', Array("class"=>"col-md-2 control-label")) }}
					<div class="col-md-5">
						{{	Form::text('assign_new',
								Input::old('assign_new'),
								Array(	"placeholder" =>"exmaple@example.com",
										"class"=>"form-control",
										"required"
								)
							)
						}}
					</div>
					<div class="col-md-2">
						<button type="submit" class="btn btn-success btn-sm">Submit</button>
					</div>
				</div>
			{{ Form::close() }}

		</div>
	</div>



</fieldset>




<form class="form-horizontal" method="POST" action="{{ URL::to('admin/project/'.$project->id) }}" accept-charset="UTF-8">
{{ Form::open(array('url' => 'admin/project/'.$project->id, 'method' => 'PUT')) }}

<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

<fieldset>
	<legend>Project Details</legend>
	<div class="form-group {{ ($errors->has('title')) ? 'has-error' : '' }}">
		{{ Form::label('title', 'Project Title', Array("class"=>"col-md-2 control-label")) }}
		<div class="col-md-10">
			{{	Form::text('title',
			(Input::old('title') != '') ? Input::old('title') : $project->title,
			Array(	"placeholder" =>"Project Title",
			"class"=>"form-control",
			"required",
			(Auth::check() ? '' : 'disabled')
			)
			)
			}}
		</div>
	</div>
	<div class="form-group {{ ($errors->has('expected_time')) ? 'has-error' : '' }}">
		{{ Form::label('state', 'Project Status', Array("class"=>"col-md-2 control-label")) }}
		<div class="col-md-10">
			{{ 	Form::select('state',
			Array('1' => 'Application',
			'2' => 'Available',
			'3' => 'In Progress',
			'4' => 'Complete',
			'5' => 'Canceled',
			'6' => 'N/A'
			),
			(Input::old('state') != '') ? Input::old('state') : $project->state,
			Array("class"=>"form-control",
			"required",
			(Auth::check() ? '' : 'disabled')
			)
			)
			}}
		</div>
	</div>
</fieldset>

<fieldset>
	<legend>Who Will Be The Project Champion?</legend>
	<div class="form-group {{ ($errors->has('contact_firstname')) ? 'has-error' : '' }}">
		{{ Form::label('contact_firstname', 'First Name', Array("class"=>"col-md-2 control-label")) }}
		<div class="col-md-10">
			{{	Form::text('contact_firstname',
			(Input::old('contact_firstname') != '') ? Input::old('contact_firstname') : $project->contact_firstname,
			Array(	"placeholder" =>"John",
			"class"=>"form-control",
			"required",
			(Auth::check() ? '' : 'disabled')
			)
			)
			}}
		</div>
	</div>
	<div class="form-group {{ ($errors->has('contact_lastname')) ? 'has-error' : '' }}">
		{{ Form::label('contact_lastname', 'Last Name', Array("class"=>"col-md-2 control-label")) }}
		<div class="col-md-10">
			{{	Form::text('contact_lastname',
			(Input::old('contact_lastname') != '') ? Input::old('contact_lastname') : $project->contact_lastname,
			Array(	"placeholder" =>"Doe",
			"class"=>"form-control",
			"required",
			(Auth::check() ? '' : 'disabled')
			)
			)
			}}
		</div>
	</div>
	<div class="form-group {{ ($errors->has('contact_email')) ? 'has-error' : '' }}">
		{{ Form::label('contact_email', 'Email', Array("class"=>"col-md-2 control-label")) }}
		<div class="col-md-10">
			{{	Form::text('contact_email',
			(Input::old('contact_email') != '') ? Input::old('contact_email') : $project->contact_email,
			Array(	"placeholder" =>"JohnDoe@gmail.com",
			"class"=>"form-control",
			"required",
			(Auth::check() ? '' : 'disabled')
			)
			)
			}}
		</div>
	</div>
	<div class="form-group {{ ($errors->has('contact_phone_number')) ? 'has-error' : '' }}">
		{{ Form::label('contact_phone_number', 'Phone Number', Array("class"=>"col-md-2 control-label")) }}
		<div class="col-md-10">
			{{	Form::text('contact_phone_number',
			(Input::old('contact_phone_number') != '') ? Input::old('contact_phone_number') : $project->contact_phone_number,
			Array(	"placeholder" =>"1112223333",
			"class"=>"form-control",
			"required",
			(Auth::check() ? '' : 'disabled')
			)
			)
			}}
		</div>
	</div>
	<div class="form-group {{ ($errors->has('contact_phone_number_ext')) ? 'has-error' : '' }}">
		{{ Form::label('contact_phone_number_ext', 'Extension', Array("class"=>"col-md-2 control-label")) }}
		<div class="col-md-10">
			{{	Form::text('contact_phone_number_ext',
			(Input::old('contact_phone_number_ext') != '') ? Input::old('contact_phone_number_ext') : $project->contact_phone_number_ext,
			Array(	"placeholder" =>"123",
			"class"=>"form-control",
			(Auth::check() ? '' : 'disabled')
			)
			)
			}}
		</div>
	</div>
</fieldset>
<fieldset>
	<legend>Tell Us More About Your Project</legend>
	<div class="form-group {{ ($errors->has('description')) ? 'has-error' : '' }}">
		{{ Form::label('description', 'What do you want the project to do?', Array("class"=>"col-md-2 control-label")) }}
		<div class="col-md-10">
			{{ 	Form::textarea('description',
			(Input::old('description') != '') ? Input::old('description') : $project->description,
			Array(	"placeholder" =>"I would like to create a clean nuclear reactor",
			"class"=>"form-control",
			"rows"=>"3",
			"required",
			(Auth::check() ? '' : 'disabled')
			)
			)
			}}
		</div>
	</div>
	<div class="form-group {{ ($errors->has('location')) ? 'has-error' : '' }}">
		{{ Form::label('location', 'Where will the project work be done?', Array("class"=>"col-md-2 control-label")) }}
		<div class="col-md-10">
			{{ 	Form::text('location',
			(Input::old('location') != '') ? Input::old('location') : $project->location,
			Array(	"placeholder" =>"University of Guelph",
			"class"=>"form-control",
			"required",
			(Auth::check() ? '' : 'disabled')
			)
			)
			}}
		</div>
	</div>
	<div class="form-group {{ ($errors->has('expected_time')) ? 'has-error' : '' }}">
		{{ Form::label('expected_time', 'When do you expect the project to be complete?', Array("class"=>"col-md-2 control-label")) }}
		<div class="col-md-10">
			{{ 	Form::select('expected_time',
			Array('1' => 'Less than a month',
			'2' => 'A month',
			'3' => 'Four months',
			'4' => 'Eight months',
			'5' => 'A year',
			'6' => 'More than a year'
			),
			(Input::old('expected_time') != '') ? Input::old('expected_time') : $project->expected_time,
			Array("class"=>"form-control",
			"required",
			(Auth::check() ? '' : 'disabled')
			)
			)
			}}
		</div>
	</div>
	<div class="form-group {{ ($errors->has('motivation')) ? 'has-error' : '' }}">
		{{ Form::label('motivation', 'Why do you want to see this project complete?', Array("class"=>"col-md-2 control-label")) }}
		<div class="col-md-10">
			{{ 	Form::textarea('motivation',
			(Input::old('motivation') != '') ? Input::old('motivation') : $project->motivation,
			Array(	"placeholder" =>"It will help the Guelph community",
			"class"=>"form-control",
			"rows"=>"3",
			"required",
			(Auth::check() ? '' : 'disabled')
			)
			)
			}}
		</div>
	</div>
	<div class="form-group {{ ($errors->has('resources')) ? 'has-error' : '' }}">
		{{ Form::label('resources', 'Opportunities and resources available?', Array("class"=>"col-md-2 control-label")) }}
		<div class="col-md-10">
			{{	Form::textarea('resources',
			(Input::old('resources') != '') ? Input::old('resources') : $project->resources,
			Array(	"placeholder" =>"Organization's volunteers can help with the project",
			"class"=>"form-control",
			"rows"=>"3",
			"required",
			(Auth::check() ? '' : 'disabled')
			)
			)
			}}
		</div>
	</div>
	<div class="form-group {{ ($errors->has('constraints')) ? 'has-error' : '' }}">
		{{ Form::label('constraints', 'Barriers for project completion?', Array("class"=>"col-md-2 control-label")) }}
		<div class="col-md-10">
			{{	Form::textarea('constraints',
			(Input::old('constraints') != '') ? Input::old('constraints') : $project->constraints,
			Array(	"placeholder" =>"Work requires many volunteers",
			"class"=>"form-control",
			"rows"=>"3",
			"required",
			(Auth::check() ? '' : 'disabled')
			)
			)
			}}
		</div>
	</div>
</fieldset>
<fieldset>
	<legend>Project Goals</legend>
	<div id="goals_form">
		@if (sizeof(Input::old('goals')) > 0)
		<? $count = 0; ?>
		@foreach(Input::old('goals') as $goal)
		@if($goal == '')
		@endif
		<? $completed = array_flip(Input::old('completed')); ?>
		<div class="form-group">
			{{ Form::label('goals'.$count, 'Goal', Array("class"=>"col-md-2 control-label")) }}
			<div class="col-md-8">
				<input id="goals{{$count}}" class="form-control" placeholder="Project Goal" type="text" name="goals[]" value="{{ $goal }}" {{ (Auth::check() ? '' : 'disabled') }} / >
				@if ($count == 0)
				    <p class="help-block">Leave a goal blank to delete it.</p>
				@endif		
			</div>
			{{ Form::label('complete'.$count, 'Completed', Array("class"=>"col-md-1 control-label")) }}
			<div class="col-md-1">
				{{ Form::checkbox('completed[]', $count, (isset($completed[$count])) ? '1' : '0', array("id"=>"complete".$count, "class"=>"form-control", "style"=>"box-shadow: none; margin-top: 0px;")); }}
			</div>
		</div>
		<? $count++; ?>
		@endforeach
		@elseif (sizeof($goals) > 0)
		<? $count = 0; ?>
		@foreach($goals as $goal)
		<div class="form-group">
			{{ Form::label('goals'.$count, 'Goal', Array("class"=>"col-md-2 control-label")) }}
			<div class="col-md-8">
				<input id="goals{{$count}}" class="form-control" placeholder="Project Goal" type="text" name="goals[]" value="{{ $goal->goal }}" {{ (Auth::check() ? '' : 'disabled') }} / >
				@if ($count == 0)
				    <p class="help-block">Leave a goal blank to delete it.</p>
				@endif						
			</div>
			{{ Form::label('complete'.$goal->id, 'Completed', Array("class"=>"col-md-1 control-label")) }}
			<div class="col-md-1">
				{{ Form::checkbox('completed[]', $count, $goal->complete, array("id"=>"complete".$goal->id, "class"=>"form-control", "style"=>"box-shadow: none; margin-top: 0px;")); }}
			</div>
		</div>
		<? $count++; ?>
		@endforeach
		@else
		<div class="form-group">
			{{ Form::label('goals[]', 'Goal', Array("class"=>"col-md-2 control-label")) }}
			<div class="col-md-8">
				<input id="goals[]" class="form-control" placeholder="Project Goal" type="text" name="goals[]" {{ (Auth::check() ? '' : 'disabled') }} / >
				<p class="help-block">Leave a goal blank to delete it.</p>				
			</div>
			{{ Form::label('complete', 'Completed', Array("class"=>"col-md-1 control-label")) }}
			<div class="col-md-1">
				{{ Form::checkbox('completed[]', 0, 0, array("id"=>"complete", "class"=>"form-control", "style"=>"box-shadow: none; margin-top: 0px;")); }}
			</div>
		</div>
		@endif
	</div>

	@if (Auth::check())
	<div class="form-group">
		<div class="col-md-offset-2 col-md-10">
			<button type="button" id="goal_button" val="2" onclick="add_goal();" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-plus-sign"></span> Add Another Goal</button>
		</div>
	</div>
	@endif
</fieldset>
<fieldset>
	<legend>Project Tags</legend>
	<div class="form-group">
		{{ Form::label('tags[]', 'Tags', Array("class"=>"col-md-2 control-label")) }}
		<div class="col-md-10">
			{{
			Form::select('tags[]',
			$tags_all,
			(Input::old('tags') != '') ? Input::old('tags') : $tags,
			Array('size' => '10',
			'class' => 'form-control',
			'multiple',
			(Auth::check() ? '' : 'disabled')
			)
			);
			}}
			<p class="help-block">Hold down the ctrl or &#8984;cmd button and click to select multiple tags.</p>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-offset-2 col-md-10">
			<button type="submit" class="btn btn-success btn-lg">Submit</button>
		</div>
	</div>

</fieldset>

{{ Form::close() }}

	<!--########################-->
	<!--Script for adding a goal & checkbox-->
	<!--########################-->
	<script>
		var goal_count = 0;
		function add_goal(){
			var checkboxes = $('input:checkbox').length;
			var goal = '<div class="form-group"><label class="col-md-2 control-label" for="goalsx'+goal_count+'">Goal</label><div class="col-md-8">	<input id="goalsx'+goal_count+'" class="form-control" placeholder="Project Goal" type="text" name="goals[]" / >	</div>   <label for="completex'+goal_count+'" class="col-md-1 control-label">Completed</label><div class="col-md-1"><input id="completex'+goal_count+'" class="form-control" style="box-shadow: none; margin-top: 0px;" name="completed[]" type="checkbox" value="'+checkboxes+'"></div>    </div>';
			$("#goals_form").append(goal);
			goal_count++;
		}
	</script>

<!--########################-->
<!--Confirm delete dialog box-->
<!--########################-->

<script type="text/javascript">

	function delete_confirm(userID) {
		$("#delete_form").attr("action","/admin/project/{{ $project->id }}/unassign/"+userID);
	}

</script>

<!-- Delete Confirmation Modal -->
<div class="modal modal-small fade" id="confirm_modal" role="dialog" aria-labelledby="delete-confirmation-modal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h2 class="modal-title">Confirm</h2>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<div class="col-md-offset-4 col-md-10">
						<h3>Are you sure?</h3>
					</div>
				</div>

				<form id="delete_form" method="POST" action="{{ URL::to('/admin/project/'.$project->id.'/unassign/') }}" accept-charset="UTF-8">
					<input type="hidden" name="_method" value="DELETE">
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
					<div class="form-group">
						<div class="col-md-offset-4 col-md-10">
							<button type="submit" class="btn btn-success">Yes</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						</div>
					</div>

				</form>
				<br>
				<br>
			</div>
			<div class="modal-footer">

			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<!-- /.Delete Confirmation Modal -->

@stop