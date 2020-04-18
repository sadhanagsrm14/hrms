<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','Leave Type'); ?>

<div class="page-inner">
	<div class="page-title">
		<h3>Leave</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/employee/dashboard')); ?>">Home</a></li>
				<li class="active">Apply Leave</li>
			</ol>
		</div>
	</div>
	<div id="main-wrapper">
		<div class="row">
			<div class="col-md-12">
				
				<?php if(session('success')): ?>
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<?php echo e(session('success')); ?>

				</div>
				<?php endif; ?>
				<?php if(session('error')): ?>
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<?php echo e(session('error')); ?>

				</div>
				<?php endif; ?>
				<div class="panel panel-white">
					<div class="panel-heading clearfix">
						<h4 class="panel-title">Apply Leave Form</h4>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" method="post" enctype="multipart/form-data">
							<div class="box-body">
								<?php echo e(csrf_field()); ?>

								<div class="form-group">
									<label for="leave_type" class="col-sm-2 control-label">Leave Type</label>
									<div class="col-sm-10">
										<select name="leave_type" id="leave_type" class="form-control select2">
											<option value="">--Select Leave Type--</option>
											<?php $__currentLoopData = $leave_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($leave_type->id); ?>"><?php echo e($leave_type->leave_type); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
										<?php if($errors->has('leave_type')): ?>
										<span class="label label-danger"><?php echo e($errors->first('leave_type')); ?></span>
										<?php endif; ?>
									</div>
								</div>

								<div class="form-group">
									<label for="date_from" class="col-sm-2 control-label">Date From</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="date_from" id="date_from" placeholder="Date From">
										<?php if($errors->has('date_from')): ?>
										<span class="label label-danger"><?php echo e($errors->first('date_from')); ?></span>
										<?php endif; ?>
									</div>
								</div>
								<div class="form-group">
									<label for="date_to" class="col-sm-2 control-label">Date To</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="date_to" id="date_to" placeholder="Date To"> 
										<?php if($errors->has('date_to')): ?>
										<span class="label label-danger"><?php echo e($errors->first('date_to')); ?></span>
										<?php endif; ?>
									</div>
								</div>
								
								<div class="form-group">
									<label for="days" class="col-sm-2 control-label">Days</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="days" id="days" readonly="readonly">
										<?php if($errors->has('days')): ?>
										<span class="label label-danger"><?php echo e($errors->first('days')); ?></span>
										<?php endif; ?>
									</div>
								</div>
								<div class="form-group">
									<label for="contact_number" class="col-sm-2 control-label">Contact Number</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="contact_number" id="Contact Number">
										<?php if($errors->has('contact_number')): ?>
										<span class="label label-danger"><?php echo e($errors->first('contact_number')); ?></span>
										<?php endif; ?>
									</div>
								</div>

								<div class="form-group">
									<label for="reason" class="col-sm-2 control-label">Reason</label>
									<div class="col-sm-10">
										<textarea name="reason" id="reason" cols="30" rows="10" class="form-control"></textarea>
										<?php if($errors->has('reason')): ?>
										<span class="label label-danger"><?php echo e($errors->first('reason')); ?></span>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<a href="<?php echo e(URL('/employee/my-leaves')); ?>" class="btn btn-default">Cancel</a>
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
		<p class="no-s"><?php echo e(date('Y')); ?> &copy; Coding Brains Software Solution Pvt Ltd.</p>
	</div>
</div><!-- Page Inner -->
<?php $__env->startSection('script'); ?>
<?php echo e(Html::script("assets/plugins/waves/waves.min.js")); ?>

<?php echo e(Html::script("assets/plugins/select2/js/select2.min.js")); ?>

<?php echo e(Html::script("assets/plugins/summernote-master/summernote.min.js")); ?>

<?php echo e(Html::script("assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js")); ?>

<?php echo e(Html::script("assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js")); ?>

<?php echo e(Html::script("assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js")); ?>

<?php echo e(Html::script("assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js")); ?>

<?php echo e(Html::script("assets/plugins/fullcalendar/lib/moment.min.js")); ?>

<?php echo e(Html::script("assets/js/pages/form-elements.js")); ?>

<script type="text/javascript">
	
	$("#date_from" ).datepicker({startDate: '0m'});
	$("#date_to" ).datepicker({startDate: '0m'});
	$('.select2').select2();
	$('#date_to').on('change', function () {
		var date_from = $('#date_from').val();
		var new_date_from = new Date(date_from);
		var date_to = $('#date_to').val();
		var new_date_to = new Date(date_to);
		if (date_from > date_to) {
			alert('To Date cannot be smaller than From Date');
			$('#date_to').val('');
		}
		else {
			var timeDiff = Math.abs(new_date_to.getTime() - new_date_from.getTime());
			var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
			$('#days').val(diffDays+1);
			// if (diffDays == 1) {
			// 	diffDays = 2;
			// }

			// if (diffDays == 0) {
			// 	var time_from = date_from + ' ' + $('#time_from').val() + ':00';
			// 	var time_to = date_to + ' ' + $('#time_to').val() + ':00';

			// 	var diff = moment.duration(moment(time_to).diff(moment(time_from)));
			// 	diff = diff / 3600 / 1000;
			// 	if (diff <= 4) {
			// 		$('#days').val('Half day leave');
			// 	}
			// 	else if (diff > 4) {
			// 		$('#days').val('Full day leave');
			// 	}
			// }
			// else {
			// 	if (diffDays > 1) {
			// 		$('#days').val(diffDays);
			// 	}
			// 	else {
			// 		$('#days').val(diffDays);
			// 	}
			// }
		}
	});

	$('#date_from').on('change', function () {
		var date_from = $('#date_from').val();
		var new_date_from = new Date(date_from);
		var date_to = $('#date_to').val();
		var new_date_to = new Date(date_to);
		if($('#date_to').val() != ''){
			
			if (date_from > date_to) {
				alert('From Date cannot be after To Date');
				$('#date_from').val('');
			}
		}
		var timeDiff = Math.abs(new_date_to.getTime() - new_date_from.getTime());
		var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
		$('#days').val(diffDays+1);
		// if (diffDays == 1) {
		// 	diffDays = 2;
		// }

		// if (diffDays == 0) {
		// 	var time_from = date_from + ' ' + $('#time_from').val() + ':00';
		// 	var time_to = date_to + ' ' + $('#time_to').val() + ':00';

		// 	var diff = moment.duration(moment(time_to).diff(moment(time_from)));
		// 	diff = diff / 3600 / 1000;
		// 	if (diff <= 5) {
		// 		$('#days').val('Half day leave');
		// 	}
		// 	else if (diff > 5) {
		// 		$('#days').val('Full day leave');
		// 	}
		// }
		// else {
		// 	if (diffDays > 1) {
		// 		$('#days').val(diffDays);
		// 	}
		// 	else {
		// 		$('#days').val(diffDays);
		// 	}
		// }
    //}
});





</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('employee.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>