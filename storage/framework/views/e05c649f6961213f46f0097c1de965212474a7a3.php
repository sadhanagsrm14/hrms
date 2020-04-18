
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','Holidays'); ?>

<div class="page-inner">
	<div class="page-title">
		<h3>Holidays</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/admin/dashboard')); ?>">Home</a></li>
				<li><a href="<?php echo e(URL('/admin/holidays')); ?>">Holidays</a></li>
				<li class="active">Update Holiday</li>
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
						<h4 class="panel-title">Update Holiday Form</h4>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" action="<?php echo e(URL('/admin/holiday/update')); ?>"  method="post" enctype="multipart/form-data">
							<div class="box-body">
								<?php echo e(csrf_field()); ?>

								<input type="hidden" name="id" value="<?php echo e($holiday->id); ?>">
								<div class="form-group">
									<label for="month" class="col-sm-2 control-label">Month</label>
									<div class="col-sm-10">
										<select name="month" class="select2 form-control" id="">
											<option value="">--Select Month--</option>
											<option value="1" <?php echo e($holiday->month == 1 ? "selected":""); ?>>January</option>
											<option value="2" <?php echo e($holiday->month == 2 ? "selected":""); ?>>February</option>
											<option value="3" <?php echo e($holiday->month == 3 ? "selected":""); ?>>March</option>
											<option value="4" <?php echo e($holiday->month == 4 ? "selected":""); ?>>April</option>
											<option value="5" <?php echo e($holiday->month == 5 ? "selected":""); ?>>May</option>
											<option value="6" <?php echo e($holiday->month == 6 ? "selected":""); ?>>June</option>
											<option value="7" <?php echo e($holiday->month == 7 ? "selected":""); ?>>July</option>
											<option value="8" <?php echo e($holiday->month == 8 ? "selected":""); ?>>August</option>
											<option value="9" <?php echo e($holiday->month == 9 ? "selected":""); ?>>September</option>
											<option value="10" <?php echo e($holiday->month == 10 ? "selected":""); ?>>October</option>
											<option value="11" <?php echo e($holiday->month == 11 ? "selected":""); ?>>November</option>
											<option value="12" <?php echo e($holiday->month == 12 ? "selected":""); ?>>December</option>
										</select>
										<?php if($errors->has('month')): ?>
										<span class="label label-danger"><?php echo e($errors->first('month')); ?></span>
										<?php endif; ?>
									</div>
								</div>
								<div class="form-group">
									<label for="date" class="col-sm-2 control-label">Date</label>
									<div class="col-sm-10">
										<input type="text" class="form-control datepicker" name="date" value="<?php echo e($holiday->date); ?>" placeholder="Date of Holiday">	
										<?php if($errors->has('date')): ?>
										<span class="label label-danger"><?php echo e($errors->first('date')); ?></span>
										<?php endif; ?>
									</div>
								</div>
								<div class="form-group">
									<label for="category" class="col-sm-2 control-label">Category</label>
									<div class="col-sm-10">
										<select name="category" class="select2 form-control" id="">
											<option value="">--Select Category--</option>
											<option value="development" <?php echo e($holiday->category == "development" ? "selected":""); ?>>Development</option>
											<option value="sales" <?php echo e($holiday->category == "sales" ? "selected":""); ?>>Sales</option>
										</select>
										<?php if($errors->has('category')): ?>
										<span class="label label-danger"><?php echo e($errors->first('category')); ?></span>
										<?php endif; ?>
									</div>
								</div>
								<div class="form-group">
									<label for="comments" class="col-sm-2 control-label">Description</label>
									<div class="col-sm-10">
										<textarea name="comments" id="comments" cols="30" rows="10" class="form-control"><?php echo e($holiday->comments); ?></textarea>
										<?php if($errors->has('comments')): ?>
										<span class="label label-danger"><?php echo e($errors->first('comments')); ?></span>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<a href="<?php echo e(URL('/admin/holidays')); ?>" class="btn btn-default">Cancel</a>
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

<?php echo e(Html::script("assets/js/pages/form-elements.js")); ?>

<script>
	$(document).ready(function() {
		$('.select2').select2();
	});
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>