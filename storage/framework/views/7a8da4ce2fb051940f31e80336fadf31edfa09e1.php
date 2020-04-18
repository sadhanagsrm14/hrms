<?php $__env->startSection('content'); ?>

<?php $__env->startSection('title','Resignation'); ?>



<div class="page-inner">

	<div class="page-title">

		<h3>Resignation</h3>

		<div class="page-breadcrumb">

			<ol class="breadcrumb">

				<li><a href="<?php echo e(URL('/employee/dashboard')); ?>">Home</a></li>

				<li class="active">Resignation</a></li>

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

				<div class="mailbox-content">

					<div class="message-header">

						<h3>Resignation letter </h3>

                        <div class="list">

												<ul class="list-item">

													<li><span>Resignation Date: </span><?php echo e($resign->date_of_resign); ?></li>

													<li><span>Last Working Day: </span><?php echo e($resign->last_working_day); ?></li>

													<li><span>FNF Date: </span><?php echo e($resign->fnf_date); ?></li>

												</ul>

                                                

											</div>

						

					</div>
					 <div class="form-group">
						<form method="post" action="<?php echo e(url('/employee/assignkt/')); ?>">
							<?php echo e(csrf_field()); ?>

									<label for="reason" class="col-sm-2 control-label">Knowledge Transfer To</label>
									<div class="col-sm-10">
									
									
										<a href="#" id="add_employee" class="btn bg-primary">Assign Knowledge Transfer</a>
									 
								     
									
						
						

										 <?php if($kt_status): ?>
										 <span>Kt Confirmation Status:<?php if($kt_status->is_actived == 2): ?>
											<b class="text-success">Confirmed</b>

											<?php elseif($kt_status->is_actived == 1): ?>
											<b class="text-warning">In process..</b>
											<?php elseif($kt_status->is_actived == -1): ?>
											<b class="text-danger">Rejected</b>
											<?php elseif($kt_status->is_actived == 0): ?>
											<b class="text-primary">Not given</b>
											<?php endif; ?></span>
											<?php endif; ?>
										
                                        <div class="modal fade in" id="add_employee1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

								<div class="modal-dialog">

									<div class="modal-content">

										<div class="modal-header modal-bg-color">

											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

											<h4 class="modal-title" id="myModalLabel">Knowledge Transfer Details</h4>

										</div>
                                       <?php if(count($current_projects) > 0): ?>
										<div class="modal-body">

											<div class="reg-decripation">
                                             	
												<table class="table">

													<tbody>
														<tr style="background: black;;">
															<th class="table-reg-mod ">Current Project</th>
															<th class="">Employee</th>
														</tr>
													
                                                      <?php $__currentLoopData = $current_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $current_project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<tr>
															

															<td class="table-reg-mod"><input type="hidden" name="ktproject[]" value="<?php echo e($current_project->project_id); ?>"/><?php echo e(getProjectById($current_project->project_id)->name); ?></td>

															<td id="ktemp">
																<select name="konwledge_transfer_to[]"  class="form-control select2 konwledge_transfer_to">
											<?php if(count($employees) > 0): ?>
											<option value="">--Select Employee--</option>
											<?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($employee->id); ?>"><?php echo e($employee->first_name); ?> <?php echo e($employee->last_name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php else: ?>

											<option value="0" selected="selected">None</option>
											<?php endif; ?>
										</select> </td>
									

														</tr>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															
															
														

														



													</tbody>

												</table>
											
														
													
	                                            
											</div>



											

										</div>

										<div class="modal-footer">

											<button type="button" class="btn btn-default" data-dismiss="modal" onclick="window.location.reload()">Cancel</button>

											<button type="submit" id="kt_submit"class="btn btn-info pull-right btn-info-re">Submit</a>

										</div>
											<?php else: ?>
                                                      <div class="modal-body">
															<p class="text-danger">There are no Current Projects</p>
														</div>
															 <?php endif; ?>

									</div>

								</div>

							</div>
					

										
									</div>
								</div>
							</form>
								</div>

					<div class="message-content">

						<div class="reg-decripation">

							<table class="table">

								<tbody>

									<tr>

										<td class="table-reg-mod">Current Project</td>

										<td><?php if(is_null($resign->current_project_id)): ?>

											<b>N/A</b>

											<?php else: ?>

											<b><?php echo e(getProjectById($resign->current_project_id)->name); ?> </b>

											<?php endif; ?>

										</td>

									</tr>

									<tr>

										<td class="table-reg-mod">Reporting  Manager</td>

										<td><?php if(is_null($resign->manager_id)): ?>

											<b>N/A</b>

											<?php else: ?>

											<b><?php echo e(getUserById($resign->manager_id)->first_name); ?> <?php echo e(getUserById($resign->manager_id)->last_name); ?></b>

											<?php endif; ?>

										</td>

									</tr>

									<tr>

										<td class="table-reg-mod">Reason For Leaving</td>

										<td><?php echo e($resign->reason); ?></td>

									</tr>

									<tr>

										<td class="table-reg-mod">Message</td>

										<td ><?php echo e($resign->message); ?></td>

									</tr>



								</tbody>

							</table>

							

						</div>
						<?php if($kt_status): ?>
						<?php if($kt_status->is_actived == 2): ?>
                        <div class="form-group">
							
															<label for="message" class="col-sm-2 control-label">Your Knowledge Transfer Document here </label>
															<div class="col-sm-10"><a type="file" name="upload_file" href="https://drive.google.com/open?id=0B0nPn4pq9cYyS0prQ2VuU0FSMEU" target="_blank" id="upload_knowledge_tranfer_file">Knowledge Transfer Document</a>
																<?php if($errors->has('knowledge_tranfer_file_url')): ?>
										<span class="label label-danger"><?php echo e($errors->first('knowledge_tranfer_file_url')); ?></span>
										<?php endif; ?>
															</div>
															
														
                             </div>
                             <?php endif; ?>
                              <?php endif; ?>
					</div>
						

					</div>

					

					<div class="message-options pull-right">
                       <?php if($resign->is_active == 0 || $resign->is_active== 1): ?>
						<a href="<?php echo e(URL('/retract/')); ?>" class="btn btn-danger"><i class="fa fa-reply m-r-xs"></i>Retract</a> 
                     <?php elseif($resign->is_active == -1): ?>
					  Click here to retract	<a href="<?php echo e(URL('/employee/resignation/retract/'.$resign->user_id)); ?>" class="btn btn-danger"><i class="fa fa-reply m-r-xs"></i>Retract</a>
                       <?php endif; ?>
					</div>
					<div class="pull-left">
					<p>Resign Status:<?php if($resign->is_active == 1): ?>
											<b class="label label-success">Accepted</b>

											<?php elseif($resign->is_active== 0): ?>
											<b class="label label-warning">Pending</b>
											<?php elseif($resign->is_active == -1): ?>
											<b class="label label-danger">Rejected</b>
											<?php endif; ?></p>
										</div>

					

				</div>

				

			</div>

		</div>

	</div><!-- Row -->

	<!-- Main Wrapper -->

	<div class="page-footer">

		<p class="no-s"><?php echo e(date('Y')); ?> &copy; Coding Brains Software Solution Pvt Ltd.</p>

	</div>

</div><!-- Page Inner -->

<?php $__env->startSection('script'); ?>
<script>
	$(document).ready(function() {
		$('#add_employee').on('click',function() {
		$('#add_employee1').modal('toggle');
		//$('#kt_submit').modal('toggle');
	});
		$('#kt_submit').on('click',function() {
		
		$('#add_employee1').modal('toggle');
	});

		// 
      
	});
   
   

	</script>

<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('employee.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>