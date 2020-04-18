<?php $__env->startSection('title','Employee Projects'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-inner">
	<div class="page-title">
		<h3>Employee Projects</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/admin/dashboard')); ?>">Home</a></li>
				<li><a href="<?php echo e(URL('/admin/employee-projects')); ?>">Employee Projects</a></li>
				<li class="active">Assign Project</li>
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
						<h4 class="panel-title">Assign Project Form</h4>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" method="post" enctype="multipart/form-data">
							<div class="box-body">
								<?php echo e(csrf_field()); ?>

								
								<div class="form-group">
									<label for="project_id" class="col-sm-2 control-label">Project</label>
									<div class="col-sm-10">
										<select name="project" id="project" class="form-control select2">
											<option value="">--Select Project--</option>	
											<?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($project->id); ?>"><?php echo e($project->name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>	
										<?php if($errors->has('project')): ?>
										<span class="label label-danger"><?php echo e($errors->first('project')); ?></span>
										<?php endif; ?>
									</div>
								</div>

								<div class="form-group">
									<label for="assign_to" class="col-sm-2 control-label">Assign To</label>
									<div class="col-sm-10">
										<select name="assign_to" id="assign_to" class="form-control select2">
											<option value="">--Select Employee--</option>	
											<?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($employee->id); ?>"><?php echo e($employee->first_name); ?> <?php echo e($employee->last_name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>	
										<?php if($errors->has('assign_to')): ?>
										<span class="label label-danger"><?php echo e($errors->first('assign_to')); ?></span>
										<?php endif; ?>
									</div>
								</div>

								<div class="form-group">
									<label for="reporting_to" class="col-sm-2 control-label">Reporting To</label>
									<div class="col-sm-10">
										<select name="reporting_to" id="reporting_to" class="form-control select2">
											<option value="">--Select Reporting Person--</option>
											<?php $__currentLoopData = $upperEmployees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upperEmployee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($upperEmployee->id); ?>"><?php echo e($upperEmployee->first_name); ?> <?php echo e($upperEmployee->last_name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>	
										<?php if($errors->has('reporting_to')): ?>
										<span class="label label-danger"><?php echo e($errors->first('reporting_to')); ?></span>
										<?php endif; ?>
									</div>
								</div>
								

								<div class="form-group">
									<label for="from_date" class="col-sm-2 control-label">From Date</label>
									<div class="col-sm-10">
										<input type="text" class="datepicker form-control" name="from_date" placeholder="From Date">
										<?php if($errors->has('from_date')): ?>
										<span class="label label-danger"><?php echo e($errors->first('from_date')); ?></span>
										<?php endif; ?>
									</div>
								</div>

								<div class="form-group">
									<label for="end_date" class="col-sm-2 control-label">End Date</label>
									<div class="col-sm-10">
										<input type="text" class="datepicker form-control" name="end_date" placeholder="Project End Date">
										<?php if($errors->has('end_date')): ?>
										<span class="label label-danger"><?php echo e($errors->first('end_date')); ?></span>
										<?php endif; ?>
									</div>
								</div>

								<div class="form-group">
									<label for="project_status" class="col-sm-2 control-label">Project Status</label>
									<div class="col-sm-10">
										<select name="project_status" id="project_status" class="form-control">
											<option value="-1">Not Started</option>
											<option value="0">In Progress</option>
											<option value="1">Completed</option>
										</select>
										<?php if($errors->has('project_status')): ?>
										<span class="label label-danger"><?php echo e($errors->first('project_status')); ?></span>
										<?php endif; ?>
									</div>
								</div>


								<div class="form-group">
									<label for="feedback" class="col-sm-2 control-label">Feedback</label>
									<div class="col-sm-10">
										<textarea name="feedback" id="feedback" cols="30" rows="10" class="form-control"></textarea>
										<?php if($errors->has('feedback')): ?>
										<span class="label label-danger"><?php echo e($errors->first('feedback')); ?></span>
										<?php endif; ?>
									</div>
								</div>

							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<a href="<?php echo e(URL('/admin/employee-projects')); ?>" class="btn btn-default">Cancel</a>
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