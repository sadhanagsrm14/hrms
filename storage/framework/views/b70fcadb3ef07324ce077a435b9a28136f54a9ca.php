<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','Employee Projects'); ?>

<div class="page-inner">
	<div class="page-title">
		<h3>Team Projects List</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/employee/dashboard')); ?>">Home</a></li>
				<li class="active">Team Projects List</a></li>
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
						<h4 class="panel-title">Team Projects List</h4>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table" id="datatable">
								<thead>
									<tr>
										<th>#</th>
										<th>Project</th>
										<th>Assigned To</th>
										<th>Reporting To</th>
										<th>From Date</th>
										<th>End Date</th>
										<th>Status</th>
										<th>Assign By</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $employee_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee_project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($employee_project->id); ?></td>
										<td><a href="<?php echo e(URL('/teamLead/project/'.$employee_project->project_id)); ?>"><?php echo e(getProjectById($employee_project->project_id)->name); ?></a></td>
										<td><a href="<?php echo e(URL('/teamLead/profile/'.$employee_project->user_id)); ?>"><?php echo e(getUserById($employee_project->user_id)->first_name); ?></a></td>
										<td><?php echo e(getUserById($employee_project->reporting_to)->first_name); ?> <?php echo e(getUserById($employee_project->reporting_to)->last_name); ?></td>
										<td><?php echo e($employee_project->from_date); ?></td>
										<td><?php echo e($employee_project->end_date); ?></td>
										<td>
											<?php if($employee_project->project_status == -1): ?>
											<b class="text-warning">Not Started</b>
											<?php elseif($employee_project->project_status == 0): ?>
											<b class="text-primary">In Progress</b>
											<?php elseif($employee_project->project_status == 1): ?>
											<b class="text-danger">Completed</b>
											<?php endif; ?>
										</td>
										<td><?php echo e(getUserById($employee_project->assign_by)['first_name']); ?> <?php echo e(getUserById($employee_project->assign_by)['last_name']); ?></td>
										<td>
											<a href="<?php echo e(URL('teamLead/employee-project/'.$employee_project->id)); ?>" class="btn btn-primary">Edit</a>
											<a href="<?php echo e(URL('/teamLead/employee-project/delete/'.$employee_project->id)); ?>" class="btn btn-danger">Delete</a>
										</td>
									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>
						</div>
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
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('employee.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>