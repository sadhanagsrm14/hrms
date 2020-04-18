<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','Resignation'); ?>



<div class="page-inner">
	<div class="page-title">
		<h3>Resignation</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/itExecutive/dashboard')); ?>">Home</a></li>
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
				<div class="panel panel-white info-box-re">
					<div class="panel-heading clearfix">
						<h4 class="panel-title">Exit Formality Form</h4>
					</div>
					<div class="row">
						<div class="col-lg-3 col-md-4 col-lg-offset-2">
							<div class="panel info-box panel-white">
								<div class="panel-body">
									<div class="info-box-stats">
										<p class="counter countet-text-color"><?php echo e(date('d M Y',strtotime($date_of_resign))); ?></p>
										<span class="info-box-title">Resignation Date</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-4">
							<div class="panel info-box panel-white">
								<div class="panel-body">
									<div class="info-box-stats">
										<p class="counter countet-text-color"><?php echo e(date('d M Y',strtotime($last_working_day))); ?></p>
										<span class="info-box-title">Last Working Day <br>
											Notice Period: <?php echo e(\Auth::user()->cb_profile->notice_period); ?>

										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-4">
							<div class="panel info-box panel-white">
								<div class="panel-body">
									<div class="info-box-stats">
										<p><span class="counter countet-text-color"><?php echo e(date('d M Y',strtotime($fnf_date))); ?></span></p>
										<span class="info-box-title">FNF Date</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" method="post" enctype="multipart/form-data" id="resignForm">
							<div class="box-body">
								<?php echo e(csrf_field()); ?>

								<input type="hidden" name="date_of_resign" id="date_of_resign" value="<?php echo e($date_of_resign); ?>">
								<input type="hidden" name="last_working_day" id="last_working_day" value="<?php echo e($last_working_day); ?>"> 
								<input type="hidden" name="fnf_date" id="fnf_date" placeholder="FNF Date" value="<?php echo e($fnf_date); ?>"> 

								<div class="form-group">
									<label for="current_project" class="col-sm-2 control-label">Current Project</label>
									<div class="col-sm-10">
										<select name="current_project" id="current_project" class="form-control select2">
											<?php if(count($current_projects) > 0): ?>
											<option value="">--Select Project--</option>
											<?php $__currentLoopData = $current_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $current_project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($current_project->project_id); ?>"><?php echo e(getProjectById($current_project->project_id)->name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php else: ?>
											<option value="None" selected="selected">None</option>
											<?php endif; ?>
										</select>
										<?php if($errors->has('current_project')): ?>
										<span class="label label-danger"><?php echo e($errors->first('current_project')); ?></span>
										<?php endif; ?>
									</div>
								</div>

								<div class="form-group">
									<label for="reporting_manager" class="col-sm-2 control-label">Reporting Manager</label>
									<div class="col-sm-10">
										<select name="reporting_manager" id="reporting_manager" class="form-control select2">
											<?php if(count($reporting_managers) > 0): ?>
											<option value="">--Select Reporting Manager--</option>
											<?php $__currentLoopData = $reporting_managers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reporting_manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($reporting_manager->team_leader_id); ?>"><?php echo e(getUserById($reporting_manager->team_leader_id)->first_name); ?> <?php echo e(getUserById($reporting_manager->team_leader_id)->last_name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php else: ?>
											<option value="None" selected="selected">None</option>
											<?php endif; ?>
										</select>
										<?php if($errors->has('reporting_manager')): ?>
										<span class="label label-danger"><?php echo e($errors->first('reporting_manager')); ?></span>
										<?php endif; ?>
									</div>
								</div>

								<div class="form-group">
									<label for="reason" class="col-sm-2 control-label">Reason For Leaving</label>
									<div class="col-sm-10">
										<select name="reason" id="reason" class="form-control select2">
											<option value="">--Select Reason--</option>
											<option value="You Found a New Job">You Found a New Job</option>
											<option value="You Hate Your Job">You Hate Your Job.</option>
											<option value="Illness">Illness</option>
											<option value="Difficult Work Environment">Difficult Work Environment</option>
											<option value="Schedules and Hours">Schedules and Hours</option>
											<option value="Career Change">Career Change</option>
											<option value="You Got a Permanent Position">You Got a Permanent Position.</option>
										</select>
										<?php if($errors->has('reason')): ?>
										<span class="label label-danger"><?php echo e($errors->first('reason')); ?></span>
										<?php endif; ?>
									</div>
								</div>
								<input type="hidden" id="resignation_reason">
								<input type="hidden" id="type" name="type">
								<div class="form-group">
									<label for="message" class="col-sm-2 control-label">Message</label>
									<div class="col-sm-10">
										<textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
										<?php if($errors->has('message')): ?>
										<span class="label label-danger"><?php echo e($errors->first('message')); ?></span>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<a href="<?php echo e(URL('/')); ?>" class="btn btn-default">Cancel</a>
								<a href="#" id="previewBtn" class="btn btn-info pull-right">Preview</a>
							</div>
							<!-- /.box-footer -->

							<!-- preview Modal -->

							<div class="modal fade in" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header modal-bg-color">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
											<h4 class="modal-title" id="myModalLabel">Resignation Details</h4>
										</div>
										<div class="modal-body">
											<div class="list">
												<ul class="list-item">
													<li><span>Resignation Date: </span><span id="date_of_resign1"></span></li>
													<li><span>Last Working Day: </span><span id="last_working_day1"></span></li>
													<li><span>FNF Date: </span><span id="fnf_date1"></span></li>
												</ul>
											</div>
											<div class="reg-decripation">
												<table class="table">
													<tbody>
														<tr>
															<td class="table-reg-mod">Current Project</td>
															<td id="current_project1"></td>
														</tr>
														<tr>
															<td class="table-reg-mod">Reporting  Manager</td>
															<td id="reporting_manager1"></td>
														</tr>
														<tr>
															<td class="table-reg-mod">Reason For Leaving</td>
															<td id="reason1"></td>
														</tr>
														<tr>
															<td class="table-reg-mod">Message</td>
															<td id="message1"></td>
														</tr>

													</tbody>
												</table>
											</div>

											
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal" onclick="window.location.reload()">Cancel</button>
											<button type="submit" class="btn btn-info pull-right btn-info-re">Submit</button>
										</div>
									</div>
								</div>
							</div>
							<!-- preview Modal -->
						</form>
					</div>
				</div>
			</div>
		</div><!-- Row -->
	</div>
	<!-- Main Wrapper -->
	

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

<?php echo e(Html::script("assets/plugins/fullcalendar/lib/moment.min.js")); ?>

<?php echo e(Html::script("assets/js/pages/form-elements.js")); ?>

<script type="text/javascript">
	$('.select2').select2();
	$(document).ready(function() {
		$('#previewBtn').on('click',function(event) {
			if($('#reason option:selected').val() == ""){
				swal('Oops','Please Select Reason','warning');
			}else if($('#message').val() == ""){
				swal('Oops','Please Add message','warning');
			}else{
				$('#date_of_resign1').empty().text($('#date_of_resign').val());
				$('#last_working_day1').empty().text($('#last_working_day').val());
				$('#fnf_date1').empty().text($('#fnf_date').val());
				$('#current_project1').empty().text($('#current_project option:selected').text());
				$('#reporting_manager1').empty().text($('#reporting_manager option:selected').text());
				$('#message1').empty().text($('#message').val());
				$('#reason1').empty().text($('#reason option:selected').val());
				$('#previewModal').modal('toggle');
			}

		});
	});
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('itExecutive.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>