<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','EOD'); ?>

<div class="page-inner">
	<div class="page-title">
		<h3>Sent EOD</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/employee/dashboard')); ?>">Home</a></li>
				<li><a href="<?php echo e(URL('/employee/sent-eods')); ?>">EODs</a></li>
				<li class="active">EOD</li>
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
						<!-- <h4 class="panel-title">EOD</h4> -->
					</div>
					<div class="panel-body">
						<form class="form-horizontal" method="post" enctype="multipart/form-data">
							<div class="box-body">
								<?php echo e(csrf_field()); ?>

								<div class="form-group">
									<label for="project_name" class="col-sm-2 control-label">Project Name</label>
									<div class="col-sm-10">
										<input type="text" readonly="readonly" class="form-control" name="project_name" id="Project Name" value="<?php echo e($eod->project_name); ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="hours_spent" class="col-sm-2 control-label">Hours Spent</label>
									<div class="col-sm-10">
										<input type="text" readonly="readonly" class="form-control" name="hours_spent" id="Contact Number" value="<?php echo e($eod->hours_spent); ?>">
									</div>
								</div>

								<div class="form-group">
									<label for="comments" readonly="readonly" class="col-sm-2 control-label">Comments</label>
									<div class="col-sm-10">
										<textarea name="comments" id="comments" cols="30" rows="10" class="form-control">
											<?php echo e($eod->comments); ?>

										</textarea>
									</div>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<a href="<?php echo e(URL('/employee/sent-eods')); ?>" class="btn btn-default">Back</a>
							</div>
							<!-- /.box-footer -->
						</form>
					</div>
				</div>
			</div>
		</div><!-- Row -->
	</div><!-- Main Wrapper -->
	<div class="page-footer">
		<p class="no-s">2015 &copy; Modern by Steelcoders.</p>
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


<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('employee.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>