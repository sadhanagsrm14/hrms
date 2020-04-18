<?php $__env->startSection('content'); ?>

<?php $__env->startSection('title','EODs'); ?>



<div class="page-inner">

	<div class="page-title">

		<h3>EODs</h3>

		<div class="page-breadcrumb">

			<ol class="breadcrumb">

				<li><a href="<?php echo e(URL('/admin/dashboard')); ?>">Home</a></li>

				<li class="active">All EODs</a></li>

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

						<!-- <h4 class="panel-title">Sent EODs</h4> -->

					</div>
                      <div class="panel">
						<form action="<?php echo e(url('admin/eods')); ?>" method="post">
							<?php echo e(csrf_field()); ?>

					Filter:-
                    <select name="filter">
                    	<option>--select--</option>
                    	<?php echo e($eods_filter); ?>

						 <?php $__currentLoopData = $eods_filter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						  
						<option value="<?php echo e($name->project_id); ?>"><?php echo e(getProject($name->project_id)->name); ?></option>
						 
						 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       
                          
                            
                       
						</select>
						<input type="submit" value="GO">
                         </form>
					</div>
					<div class="panel-body">

						<div class="table-responsive table-remove-padding">

							<table class="table" id="datatable">

								<thead>

									<tr>
                                        <th>Date</th>
										<th>Employee</th>

										

										<th>Project Name</th>

										<th>Hours Spent</th>

										<th>Task</th>

										<th>Comment</th>

										<th>Action</th>

									</tr>

								</thead>

								<tbody>

									<?php $__currentLoopData = $eods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

									<tr>

										<td><?php echo e($eod->date_of_eod); ?></td>

										<td><a href="<?php echo e(URL('/admin/employee/profile/'.$eod->user_id)); ?>"><?php echo e(getUserById($eod->user_id)->first_name); ?></a></td>

										<td><a href="<?php echo e(url('/admin/project/'.$eod->project_id)); ?>"><?php echo e(getProject($eod->project_id)->name); ?></a></td>

										<td><?php echo e($eod->hours_spent); ?></td>

										<td><?php echo e(substr($eod->task, 0, 30)); ?></td>

										<td>

											<?php if(is_null($eod->comment)): ?>

											<b>N/A</b>

											<?php else: ?>

											<?php echo e($eod->comment); ?>


											<?php endif; ?>

										</td>

										<td>
                                            <button class="btn btn-info btn-sm eod_details" rel="<?php echo e($eod->id); ?>">  See Details </button> 
											<a href="<?php echo e(URL('admin/eod/delete/'.$eod->id)); ?>" class="btn btn-danger">Delete</a>

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


	<!-- Modal -->
	<div id="eodModel" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Employee EOD Details</h4>
	      </div>
	      <div class="modal-body" id="eodModelDetails">
	            
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

	<?php $__env->startSection('script'); ?>
    <script type="text/javascript">

		$(document).ready(function(){ 
			 $(document).on('click','.eod_details',function(){  
			 	var id = $(this).attr('rel');
			 	    $.ajax({
			 	    	url:"<?php echo e(route('admin.eod_details')); ?>", 
			 	    	type:"GET",
			 	    	data:{id:id},
			 	    	success:function(res){ 
			 	    		$('#eodModelDetails').html(res); 
			                $('#eodModel').modal('show');  
			 	    	}
			 	    });
		     });
		});
		
	</script>
	<?php $__env->stopSection(); ?>

	<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>