<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','Sent EODs'); ?>

<div class="page-inner">
	<div class="page-title">
		<h3>Sent EODs</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/employee/dashboard')); ?>">Home</a></li>
				<li class="active">Sent EODs</a></li>
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
						<h4 class="panel-title">Sent EODs</h4>
					</div>
					<div class="panel-body">
						<div class="table-responsive table-remove-padding">
							<table class="table" id="datatable">
								<thead>
									<tr>
										<th>EOD Date</th>
										<th>Project Name</th>
										<th>Hours Spent</th>
										<th>Tasks</th>
										<th>Comment</th>
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $eods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($eod->date_of_eod); ?></td>
										<td><?php echo e(getProject($eod->project_id)->name); ?></td>
										<td><?php echo e($eod->hours_spent); ?></td>
										<td><?php echo e($eod->task); ?></td>
										<td>
											<?php if(is_null($eod->comment)): ?>
											<b>N/A</b>
											<?php else: ?>
											<?php echo e($eod->comment); ?>

											<?php endif; ?>
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


	<div class="modal fade view-eod-list" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="mySmallModalLabel" ><i class="fa fa-pencil fa-2x" aria-hidden="true"> EOD Details</i></h4>
					<p>System Code:1110</p>
				</div>
				<div class="modal-body">
					<h5>Date:<span id="eodDate"></span></h5>
					<div class="table-responsive table-remove-padding">
						<table class="table">
							<thead>
								<tr>
									<th>Project</th>
									<th>Hours Spent</th>
									<th>Task</th>
								</tr>
							</thead>
							<tbody id="subEods">
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

				</div>
			</div>
		</div>
	</div>

	<div class="page-footer">
		<p class="no-s"><?php echo e(date('Y')); ?> &copy; Coding Brains Software Solution Pvt Ltd.</p>
	</div>
</div><!-- Page Inner -->
<?php $__env->startSection('script'); ?>
<script>
	function getEod(id){
		var eodUrl = "<?php echo e(URL('/getEod/')); ?>";
		$.get(eodUrl+'/'+id, function(data) {
			if(data.flag){
				
				$('#eodDate').text(' '+data.main_eod.created_at);
				$("#subEods").empty();
				$.each(data.main_eod.sub_eods, function(index, sub_eod) {
					var subEodUrl = "<?php echo e(URL('/getSubEod/')); ?>";
					$.get(subEodUrl+'/'+sub_eod.id, function(sub_data) {
						if(sub_data.flag){
							var projectUrl = "<?php echo e(URL('/getProject/')); ?>";
							var project = null;
							$.get(projectUrl+'/'+sub_data.sub_eod.project_id, function(pro) {
								if(pro.flag){
									project = pro.project.name;
								}
								$("#subEods").append('<tr><td>'+project+'</td><td>'+sub_data.sub_eod.hours_spent+'</td><td>'+sub_data.sub_eod.task+'</td></tr>');
							});
						}
					});
				});
			}else{
				swal('Oops','Something Went Wrong!','error')
			}
		});
	}
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('employee.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>