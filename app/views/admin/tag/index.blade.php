@extends('admin.layouts.default')

{{-- Content --}}
@section('content')
<div class="container">
	<h1>Tag Management</h1>

	<div class="panel panel-primary">
		<div class="panel-heading">Create New Tag</div>
		<div class="panel-body">
			<form class="form-horizontal" method="POST" action="{{{ URL::to('admin/tag') }}}" accept-charset="UTF-8">
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
				<fieldset>
					<legend>Create New Tag</legend>
					<div class="form-group">
					<label for="new_tag" class="col-md-1 control-label" for="title">Tag</label>
					<div class="col-md-5">
						<input class="form-control" required placeholder="Project tag" type="text" name="tag" id="new_tag" value="{{ Input::old('tag') }}" >

					</div>
					<div class="col-md-6">
						<button type="submit" class="btn btn-success">Save</button>
					</div>
			</form>
		</div>
		</div>
	</div>

	<div class="panel panel-primary">
		<div class="panel-heading">Tags</div>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Tag</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($tags as $tag)
						<tr>
							<td><div id="{{{ String::title($tag->id) }}}">{{{ String::title($tag->tag) }}}</div></td>
							<td>
								<a onclick="edit_tag( {{{ String::title($tag->id) }}} )" data-toggle="modal" title="Edit this tag" data-id="{{{ String::title($tag->id) }}}" href="#edit_modal" class=".edit-modal btn btn-default">Edit</a>
								<a onclick="delete_confirm({{{ String::title($tag->id) }}});" data-toggle="modal" title="Delete this tag" data-id="{{{ String::title($tag->id) }}}" href="#confirm_modal" class=".delete-confirm btn btn-danger">Delete</a>
							</td>
						</tr>
				@endforeach
				</tbody>
		</table>
	</div>




</div>
<div class="text-center">
	{{$tags->links()}}
</div>

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

				<form id="delete_form" method="POST" action="{{ URL::to('admin/tag/') }}" accept-charset="UTF-8">
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

<!-- Modal -->
<div class="modal modal-small fade" id="edit_modal" role="dialog" aria-labelledby="edit-modal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">


				<form id="edit_form" method="POST" action="{{ URL::to('admin/tag/') }}" accept-charset="UTF-8">
					<input type="hidden" name="_method" value="PATCH">
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
					<legend>Edit Tag</legend>
					<div class="form-group">
						<label class="col-lg-1 control-label" for="edit_tag_form">Tag</label>
						<div class="col-lg-10">
							<input class="form-control" required placeholder="Edit project tag" type="text" name="edit_tag" id="edit_tag_form" value="{{ Input::old('edit_tag') }}" >
						</div>
						<div class="col-md-offset-4 col-md-10">
							<br>
							<button type="submit" class="btn btn-success">Save</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						</div>
					</div>

				</form>
				<br>
				<br>
				<br>
			</div>
			<div class="modal-footer">

			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.Edit Tags modal -->

<script type="text/javascript">

	function delete_confirm(tagId) {
		$("#delete_form").attr("action","/admin/tag/"+tagId);
	}

	function edit_tag(tagId) {
		$("#edit_form").attr("action","/admin/tag/"+tagId);
	}

</script>



@stop