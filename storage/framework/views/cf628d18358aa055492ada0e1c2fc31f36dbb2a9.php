
<?php $__env->startSection('title','Projects'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-inner">
	<div class="page-title">
		<h3>Projects</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/admin/dashboard')); ?>">Home</a></li>
				<li><a href="<?php echo e(URL('/admin/projects')); ?>">Projects</a></li>
				<li class="active">Update Project</li>
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
						<h4 class="panel-title">Update Project Form</h4>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" action="<?php echo e(URL('/admin/project/update')); ?>" method="post" enctype="multipart/form-data">
							<div class="box-body">
								<?php echo e(csrf_field()); ?>

								<input type="hidden" name="id" value="<?php echo e($project->id); ?>">
								<div class="form-group">
									<label for="project_name" class="col-sm-2 control-label">Project Name</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="project_name" value="<?php echo e($project->name); ?>" placeholder="Project Name">
										<?php if($errors->has('project_name')): ?>
										<span class="label label-danger"><?php echo e($errors->first('project_name')); ?></span>
										<?php endif; ?>
									</div>
								</div>

								<div class="form-group">
									<label for="start_date" class="col-sm-2 control-label">Start Date</label>
									<div class="col-sm-10">
										<input type="text" class="datepicker form-control" name="start_date" value="<?php echo e($project->start_date); ?>" placeholder="Project Start Date">
										<?php if($errors->has('start_date')): ?>
										<span class="label label-danger"><?php echo e($errors->first('start_date')); ?></span>
										<?php endif; ?>
									</div>
								</div>

								<div class="form-group">
									<label for="end_date" class="col-sm-2 control-label">End Date</label>
									<div class="col-sm-10">
										<input type="text" class="datepicker form-control" name="end_date" value="<?php echo e($project->end_date); ?>" placeholder="Project End Date">
										<?php if($errors->has('end_date')): ?>
										<span class="label label-danger"><?php echo e($errors->first('end_date')); ?></span>
										<?php endif; ?>
									</div>
								</div>

								<div class="form-group">
									<label for="client_name" class="col-sm-2 control-label">Client Name</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="client_name" value="<?php echo e($project->client_name); ?>" placeholder="Client Name">
										<?php if($errors->has('client_name')): ?>
										<span class="label label-danger"><?php echo e($errors->first('client_name')); ?></span>
										<?php endif; ?>
									</div>
								</div>

								<div class="form-group">
									<label for="project_comments" class="col-sm-2 control-label">Comments</label>
									<div class="col-sm-10">
										<textarea name="project_comments" id="project_comments" cols="30" rows="10" class="form-control" placeholder="Project Comments"><?php echo e($project->project_comments); ?></textarea>
										<?php if($errors->has('project_comments')): ?>
										<span class="label label-danger"><?php echo e($errors->first('project_comments')); ?></span>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<a href="<?php echo e(URL('/admin/projects')); ?>" class="btn btn-default">Cancel</a>
								<button type="submit" class="btn btn-info pull-right">Update</button>
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


<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>