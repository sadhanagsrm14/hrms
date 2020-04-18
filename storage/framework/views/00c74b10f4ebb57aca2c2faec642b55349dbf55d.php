<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','Assign Team members'); ?>

<div class="page-inner">
	<div class="page-title">
		<h3>Assign Team members</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/admin/dashboard')); ?>">Home</a></li>
				<li class="active">Assign Team members</a></li>
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
					</div>
					<div class="panel-body">
						<form class="form-horizontal" method="post" enctype="multipart/form-data">
							<div class="box-body">
								<?php echo e(csrf_field()); ?>


								<div class="form-group">
									<label for="team_leader" class="col-sm-2 control-label">Team Leader</label>
									<div class="col-sm-10">
										<select name="team_leader" id="team_leader" class="form-control select">
											<option value="">--Select Team Leader--</option>
											<?php $__currentLoopData = $team_leaders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team_leader): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($team_leader->id); ?>"><?php echo e($team_leader->first_name); ?> <?php echo e($team_leader->last_name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
										<?php if($errors->has('team_leader')): ?>
										<span class="label label-danger"><?php echo e($errors->first('team_leader')); ?></span>
										<?php endif; ?>
									</div>
								</div>

								<div class="form-group">
									<label for="team_members" class="col-sm-2 control-label">Team Members</label>
									<div class="col-sm-10">
										<select name="team_members[]" id="team_members" class="form-control select" multiple="multiple">
											<option value="">--Select Team members--</option>
											<?php $__currentLoopData = $team_members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team_member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($team_member->id); ?>"><?php echo e($team_member->first_name); ?> <?php echo e($team_member->last_name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
										<?php if($errors->has('team_members')): ?>
										<span class="label label-danger"><?php echo e($errors->first('team_members')); ?></span>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<a href="<?php echo e(URL('/admin/dashboard')); ?>" class="btn btn-default">Cancel</a>
								<button type="submit" class="btn btn-info pull-right">Assign</button>
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
<?php echo e(Html::script("assets/plugins/select2/js/select2.min.js")); ?>

<script>
	$(document).ready(function() {
		$('select').select2();
	});
</script>	
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>