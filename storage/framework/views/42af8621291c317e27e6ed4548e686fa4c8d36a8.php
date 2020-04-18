<?php $__env->startSection('content'); ?>

<?php $__env->startSection('title','Resignations'); ?>



<div class="page-inner">

	<div class="page-title">

		<h3>Resignations</h3>

		<div class="page-breadcrumb">

			<ol class="breadcrumb">

				<li><a href="<?php echo e(URL('/admin/dashboard')); ?>">Home</a></li>

				<li class="active">Retract</a></li>

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

						<h4 class="panel-title">Retract List</h4>

					</div>

					<div class="panel-body">

						<div class="table-responsive table-remove-padding">

							<table class="table">

								<thead>

									<tr>

										<th>#</th>

										<th>Employee</th>

										<th>Status</th>

										<th>Action</th>

									</tr>

								</thead>

								<tbody>

									<?php $__currentLoopData = $retracts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $retract): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

									<tr>

										<td><?php echo e($retract->id); ?></td>

										<td><?php echo e(getUserById($retract->user_id)->first_name); ?> <?php echo e(getUserById($retract->user_id)->last_name); ?></td>


										<td>

											<?php if($retract->is_active == 1): ?>
											<span class="label label-success">Accepted</span>

											<?php elseif($retract->is_active == 0): ?>
											<b class="text-warning">Pending</b>
											<?php elseif($retract->is_active == -1): ?>
											<b class="text-primary">Rejected</b>
											<?php endif; ?>

										</td>

										<td><a href="javascript::void()" onclick="view(<?php echo e($retract->id); ?>)" class="btn btn-primary"><i class="fa fa-eye"></i>View</a></td>

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

					<h4 class="modal-title" id="myModalLabel">Retract Details</h4>

				</div>

				<div class="modal-body">

					

					<div class="reg-decripation">

						<table class="table">

							<tbody>
                               
								

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
					<a class="btn btn-primary " href="#" id="acceptedid">Accpted</a>
                    <a class="btn btn-danger " href="#" id="rejectedid">Rejected</a>
						
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

		
		var resignUrlaccept = "<?php echo e(URL('/admin/retract/accepted/')); ?>";
		var resignUrlaccept1 = (resignUrlaccept +'/' + id) ;
		var resignUrlrejected = "<?php echo e(URL('/admin/retract/rejected/')); ?>";
		var resignUrlrejected1 = (resignUrlrejected +'/' + id) ;
		$('#acceptedid').attr("href",resignUrlaccept1 );
		$('#rejectedid').attr("href",resignUrlrejected1);
         var resignUrl = "<?php echo e(URL('/retract/')); ?>";
		$.get(resignUrl+'/'+id, function(data) {
		

			if(data.flag){

				
                $('#reason').empty().text(data.retracts.reason);                
				$('#message').empty().text(data.retracts.message);

			}else{

				swal('Oops','Something Went Wrong!','error')

			}

		});

		$('#previewModal').modal('toggle');

	}

</script>

<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>