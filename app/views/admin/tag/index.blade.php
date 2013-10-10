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
					<div class="form-group">
					<label class="col-md-1 control-label" for="title">Tag</label>
					<div class="col-md-5">
						<input class="form-control" required tabindex="1" placeholder="Project tag" type="text" name="tag" id="new_tag" value="{{ Input::old('tag') }}" >

					</div>
					<div class="col-md-6">
						<button tabindex="3" type="submit" class="btn btn-success">Save</button>
					</div>
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
								<a onclick="edit_tag( {{{ String::title($tag->id) }}} )" class="btn btn-default">Edit</a>
								<a href="#" class="btn btn-danger">Delete</a>
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

@stop