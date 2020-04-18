<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','Resignations'); ?>
<style>
.countet-text-color
{
	color:#fff !important;
}
.list-item {
	text-decoration:  none;
	margin:  0;
	padding:  0;
}

.list-item li {
	display: inline-block;
	background-color: #2c7569;
	padding: 5px 5px 5px 5px;
	color: #fff;
}

.table-reg-mod{
	width: 30%;
	height: auto;
	border-right: 1px solid #2c7569;
}

</style>
<div class="page-inner">
	<div class="page-title">
		<h3>Resignation</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/employee/dashboard')); ?>">Home</a></li>
				<li class="active">Resignations</a></li>
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
						<h4 class="panel-title">Resignations</h4>
					</div>
					<div class="panel-body">
						<div class="table-responsive table-remove-padding">
							<table class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Resignation Date</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $resignations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resignation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($resignation->id); ?></td>
										<td><?php echo e($resignation->date_of_resign); ?></td>
										<td>
											<?php if($resignation->is_active == 1): ?>
											<span class="label label-danger">Active</span>
											<?php elseif($resignation->is_active == 0): ?>
											<span class="label label-danger">Draft</span>
											<?php else: ?>
											<span class="label label-danger">Retracted</span>
											<?php endif; ?>
										</td>
										<td>
											<?php if($resignation->is_active == 1): ?>
											<a href="<?php echo e(URL('/employee/resignation/retract/'.$resignation->id)); ?>" class="btn btn-primary"><i class="fa fa-reply m-r-xs"></i>Retract</a>
											<?php elseif($resignation->is_active == 0): ?>
											<a href="javascript::void()" data-link="<?php echo e(URL('/employee/resignation/submit/'.$resignation->id)); ?>" id="submitBtn" class="btn btn-danger"><i class="fa fa-arrow-right m-r-xs"></i>Submit</a> 
											<?php endif; ?>
											<a href="javascript::void()" onclick="view(<?php echo e($resignation->id); ?>)" class="btn btn-warning"><i class="fa fa-eye m-r-xs"></i>View</a>
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
	<!-- preview Modal -->

	<div class="modal fade in" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel">Resignation Details</h4>
				</div>
				<div class="modal-body">
					<div class="list">
						<ul class="list-item">
							<li><span>Resignation Date: </span><span id="date_of_resign"></span></li>
							<li><span>Last Working Day: </span><span id="last_working_day"></span></li>
							<li><span>FNF Date: </span><span id="fnf_date"></span></li>
						</ul>
					</div>
					<div class="reg-decripation">
						<table class="table">
							<tbody>
								<tr>
									<td class="table-reg-mod">Reporting  Manager</td>
									<td id="reporting_manager"></td>
								</tr>
								<tr>
									<td class="table-reg-mod">Reason For Leaving</td>
									<td id="reason"></td>
								</tr>
								<tr>
									<td class="table-reg-mod">Message</td>
									<td id="message"></td>
								</tr>

							</tbody>
						</table>
					</div>


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	<!-- preview Modal -->
	<div class="page-footer">
		<p class="no-s"><?php echo e(date('Y')); ?> &copy; Coding Brains Software Solution Pvt Ltd.</p>
	</div>
</div><!-- Page Inner -->
<?php $__env->startSection('script'); ?>
<script>
	function view(id){
		var resignUrl = "<?php echo e(URL('/resignation/')); ?>";
		$.get(resignUrl+'/'+id, function(data) {
			if(data.flag){
				$('#date_of_resign').empty().text(data.resign.date_of_resign);
				$('#last_working_day').empty().text(data.resign.last_working_day);
				$('#fnf_date').empty().text(data.resign.fnf_date);
				$('#reason').empty().text(data.resign.reason);
				$('#message').empty().text(data.resign.message);
				var userUrl = "<?php echo e(URL('/getUser/')); ?>";
				if(data.resign.manager_id == null){
					var manager = "N/A";
					$('#reporting_manager').text(' '+manager);
				}else{
					$.get(userUrl+'/'+data.resign.manager_id, function(data) {
						if(data.flag){
							var manager = data.user.first_name+' '+data.user.last_name;
							$('#reporting_manager').text(' '+manager);
						}
					});
				}
			}else{
				swal('Oops','Something Went Wrong!','error')
			}
		});
		$('#previewModal').modal('toggle');
	}
	$(document).ready(function() {
		$('#submitBtn').on('click',function(event) {
			swal({
				title: 'Are you sure?',
				text: "",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, Submit!'
			}).then(function () {
				window.location.href = $('#submitBtn').data('link');
			}, function (dismiss) {
				if (dismiss === 'cancel') {
					swal('Cancelled','Your Resignation is cancelled','error')
				}
			})
		});
	});
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('employee.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>