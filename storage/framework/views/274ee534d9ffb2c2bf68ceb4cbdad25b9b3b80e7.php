<?php $__env->startSection('content'); ?>

<?php $__env->startSection('title','HR EODs'); ?>

<style type="text/css">
	.pagination{float: right !important;}
</style>


<div class="page-inner">

	<div class="page-title">

		<h3>HR EODs</h3>

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
					<div class="panel-body">

						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
                                        <th>Date</th>
										<th>Employee</th>
										<th>Recruitment</th>
										<th>Generalist</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $eods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td> <?php echo e($eod->date_of_eod); ?> </td>

										<td> <?php echo e($eod->user->first_name); ?> <?php echo e($eod->user->last_name); ?> </td>  

										<td> <?php echo e(substr($eod->recruitment,0,30)); ?> </td>   

										<td> <?php echo e(substr($eod->generalist,0,30)); ?> </td> 
										<td>
											<button class="btn btn-info btn-sm eod_details" rel="<?php echo e($eod->id); ?>">  See Details </button> 
											<a onclick="return confirm('Are you sure, You want to delete EOD ?')" class="btn btn-danger btn-sm" href="<?php echo e(route('admin.hr_eod_delete',['eod_id'=> $eod->id ])); ?>">  Delete </a>
										</td> 
									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</tbody>
								</table>
                                
							</div>
							<div class="row">
								<div class="col-md-6">Showing <?php echo e($eods->firstItem()); ?> to <?php echo e($eods->lastItem()); ?> of <?php echo e($eods->total()); ?> entries</div> 
								<div class="col-md-6 pull-right"><?php echo e($eods->links()); ?></div> 
							
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
        <h4 class="modal-title">HR EOD Details</h4>
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
		 	    	url:"<?php echo e(route('admin.hr_eod_details')); ?>", 
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