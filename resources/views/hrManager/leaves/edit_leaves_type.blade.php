@extends('hrManager.layouts.app')
@section('content')
@section('title','Leave Type')

<div class="page-inner">
	<div class="page-title">
		<h3>Leave Type</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="{{URL('/hrManager/dashboard')}}">Home</a></li>
				<li><a href="{{URL('/hrManager/leave-types')}}">Leave Types</a></li>
				<li class="active">Update Leave Type</li>
			</ol>
		</div>
	</div>
	<div id="main-wrapper">
		<div class="row">
			<div class="col-md-12">
				@if (session('success'))
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					{{ session('success') }}
				</div>
				@endif
				@if (session('error'))
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					{{ session('error') }}
				</div>
				@endif
				<div class="panel panel-white">
					<div class="panel-heading clearfix">
						<h4 class="panel-title">Update Leave Type Form</h4>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" action="{{URL('/hrManager/leave-type/update')}}" method="post" enctype="multipart/form-data">
							<div class="box-body">
								{{csrf_field()}}
								<input type="hidden" name="id" value="{{$leave_type->id}}">
								<div class="form-group">
									<label for="leave_type" class="col-sm-2 control-label">Leave Type</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="leave_type" value="{{$leave_type->leave_type}}" placeholder="Leave type">
										@if ($errors->has('leave_type'))
										<span class="label label-danger">{{ $errors->first('leave_type') }}</span>
										@endif
									</div>
								</div>
								<div class="form-group">
									<label for="description" class="col-sm-2 control-label">Description</label>
									<div class="col-sm-10">
										<textarea name="description" id="description" cols="30" rows="10" class="form-control"  placeholder="Leave Type Description">{{$leave_type->description}}</textarea>
										@if ($errors->has('description'))
										<span class="label label-danger">{{ $errors->first('description') }}</span>
										@endif
									</div>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<a href="{{URL('/hrManager/leave-types')}}" class="btn btn-default">Cancel</a>
								<button type="submit" class="btn btn-info pull-right">Add</button>
							</div>
							<!-- /.box-footer -->
						</form>
					</div>
				</div>
			</div>
		</div><!-- Row -->
	</div><!-- Main Wrapper -->
	<div class="page-footer">
		<p class="no-s">{{date('Y')}} &copy; Coding Brains Software Solution Pvt Ltd.</p>
	</div>
</div><!-- Page Inner -->
@section('script')
{{ Html::script("assets/plugins/waves/waves.min.js") }}
{{ Html::script("assets/plugins/select2/js/select2.min.js") }}
{{ Html::script("assets/plugins/summernote-master/summernote.min.js") }}
{{ Html::script("assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js") }}
{{ Html::script("assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js") }}
{{ Html::script("assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js") }}
{{ Html::script("assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js") }}
{{ Html::script("assets/js/pages/form-elements.js") }}

@endsection
@endsection