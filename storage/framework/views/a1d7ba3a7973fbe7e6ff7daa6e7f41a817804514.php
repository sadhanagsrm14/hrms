<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','EOD'); ?>
<style>
.table>tbody>tr>td {

	border-top: 1px solid #dddddd08;
}
</style>

<div class="page-inner">
	<div class="page-title">
		<h3>Send EOD</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/employee/dashboard')); ?>">Home</a></li>
				<li><a href="<?php echo e(URL('/employee/sent-eods')); ?>">EODs</a></li>
				<li class="active">Send EOD</li>
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
						<h4 class="panel-title">Send EOD Form</h4>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" method="post" enctype="multipart/form-data" id="eodForm" novalidate>
							<div class="form-group col-md-3">
								<input type="text" class="form-control datepicker" name="date_of_eod" id="date_of_eod" required placeholder="Date Of EOD" >
							</div>
							<table class="table">
								<thead>
									<tr>
										<th></th>
										<th>Project Name</th>
										<th>Task</th>
										<th>Hours Spent</th>
										

									</tr>
								</thead>

								<tbody id="eod">
									<tr>
										
										<?php echo e(csrf_field()); ?>


										<td>
											<div class="form-group col-md-3">
												<a class="btn btn-danger" id="addMoreBtn"><i class="fa fa-plus"></i> </a>
											</div>
										</td>
										<td>
											<div class="form-group col-md-12">
												<select name="project[]" class="form-control project" required>
													<option value="">--Select Project--</option>
													<?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<option value="<?php echo e($project->id); ?>"><?php echo e($project->name); ?></option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select>
											</div>
										</td>
										<td>
											<div class="form-group col-md-12">
												<textarea name="task[]" cols="30" rows="2" class="form-control task" required placeholder="Task Details"></textarea>
											</div>
										</td>
										<td>
											<div class="form-group col-md-12">
												<input type="text" class="form-control hours" onkeypress="return event.charCode >= 46 && event.charCode <= 57" onkeyup="calculateHour()" placeholder="Hours Spent" name="hours_spent[]" required>
												
											</div>
										</td>
									</tr>

								</tbody>
							</table>
							<div class="form-group col-md-6" id="comment" style="display: none;">
								<textarea id="comment" cols="30" rows="10" class="form-control" placeholder="Why EOD is Delayed?" name="comment" required></textarea>
							</div>
							<div class="col-md-12">
								
								<button type="submit" id="sendBtn" class="btn btn-info pull-right" disabled="disabled">Send</button>

							</div>
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

<script>
	$( "#date_of_eod" ).datepicker({endDate: '0m'});
	function removeRow(row){
		$(row).closest('tr').remove();
		var total = 0;
		$('.hours').each(function(){
			total +=  parseFloat($(this).val());
		});
		if(parseFloat(total) >= 8){
			$('#sendBtn').removeAttr('disabled');
		}else{
			$('#sendBtn').attr('disabled','disabled');
		}
	}
	function calculateHour(){
		var total = 0;
		$('.hours').each(function(){
			total +=  parseFloat($(this).val());
		});
		if(parseFloat(total) >= 8){
			$('#sendBtn').removeAttr('disabled');
		}else{
			$('#sendBtn').attr('disabled','disabled');
		}
	}
	$(document).ready(function() {
		var d = new Date();
		var month = d.getMonth()+1;
		var day = d.getDate();
		var output =  
		(month<10 ? '0' : '') + month + '/' +
		(day<10 ? '0' : '') + day+ '/' +d.getFullYear();
		$('#date_of_eod').val(output);
		$('#date_of_eod').on('change',function(){
			if(output !== $('#date_of_eod').val()){
				$('#comment').show();
			}else{
				$('#comment').hide();
			}
		})
		

		$('#addMoreBtn').on('click',function(){
			var html = `<tr>
			<td>
			<div class="form-group col-md-3">
			</div>
			</td>
			<td>
			<div class="form-group col-md-12">
			<select name="project[]" class="form-control project" required="required">
			<option value="">--Select Project--</option>
			<?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<option value="<?php echo e($project->id); ?>"><?php echo e($project->name); ?></option>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
			</div>
			</td>
			<td>
			<div class="form-group col-md-12">
			
			<textarea name="task[]" placeholder="Task Details" cols="30" rows="2" class="form-control task" required="required"></textarea>
			</div>
			</td>
			<td>
			<div class="form-group col-md-12">
			<input type="text" class="form-control hours" onkeyup="calculateHour()" placeholder="Hours Spent" name="hours_spent[]" required="required">
			</div>
			</td>
			<td><a href="#" onclick="removeRow(this)"><span class="badge"><i class="fa fa-times"></i></span></a></td>
			</tr>`;
			$('#eod').prepend(html);
		});

		$('#eodForm').submit(function(event) {
			var projectErr;
			var taskErr;
			var hourErr;
			$('.project').each(function(){
				if($(this).val() == ""){
					projectErr = true;
				}
			});
			$('.task').each(function(){
				if($(this).val() == ""){
					taskErr = true;
				}
			});
			$('.hours').each(function(){
				if($(this).val() == ""){
					hourErr = true;
				}
			});
			if($('#date_of_eod').val() == "" ){
				swal('Oops','Date Of EOD Should Not be empty','error');
				$('#date_of_eod').val(output);
				$('#comment').hide();
				return false;
			}
			else if(projectErr){
				swal('Oops','Project Should Not be empty','error');
				return false;
			}else if(taskErr){
				swal('Oops','Task Should Not be empty','error');
				return false;
			}else if(hourErr){
				swal('Oops','Hour Should Not be empty','error');
				return false;
			}else{
				return true;
			}
		});
	});
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('employee.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>