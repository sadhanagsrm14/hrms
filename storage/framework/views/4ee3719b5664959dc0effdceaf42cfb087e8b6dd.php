

<?php $__env->startSection('content'); ?>

<?php $__env->startSection('title','Employees'); ?>

<style>

.table td, .table>tbody>tr>td

{

	

	vertical-align:  middle;

}
span.pad {
    padding-left: 5px;
}
</style>



<div class="page-inner">

	<div class="page-title">

		<h3>Employees</h3>

		<div class="page-breadcrumb">

			<ol class="breadcrumb">

				<li><a href="<?php echo e(URL('/admin/dashboard')); ?>">Home</a></li>

				<li class="active"><a href="<?php echo e(URL('/admin/employees')); ?>">Employees</a></li>

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

						<h4 class="panel-title">Employees</h4>

					</div>



					<div class="panel-heading clearfix">

						<a href="<?php echo e(URL('/admin/export/employee-sheet')); ?>" class="btn btn-danger pull-right" style="margin-top: -16px;margin-right: 10px;">Export Employees</a>

						<button type="submit" data-toggle="modal" data-target="#importEmployeeModal" class="btn btn-primary pull-right" style="margin-top: -16px;margin-right: 10px;">Import Employees</button>

						<a href="<?php echo e(URL('/templates/Employees.xls')); ?>" class="btn btn-warning pull-right" style="margin-top: -16px;margin-right: 10px;">Employee Template</a>

						

					</div>
                   <div class="panel">
						<form action="<?php echo e(url('/admin/employees')); ?>" method="get">
							<?php echo e(csrf_field()); ?>

					      <span class="pad">Filter By Department:-</span>
                    <select name="filter_dep" id="filter_emp">
                    	
                    	<option value="">--select--</option>
                        
						
						  
						<option value="development">Development</option>
						 <option value="sales">Sales</option>
					
						  
					
						 
						
                          
                            
                       
						</select>
						
					Filter By Role:-
                    <select name="filter_dep1" id="filter_emp">
                    	
                    	<option value="">--select--</option>
                        
						
						  
						<option value="2">HrManager</option>
						 <option value="4">Team Lead</option>
					     <option value="5">It Executive</option>
						 <option value="6">Employee</option>
						  
					
						 
						
                          
                            
                       
						</select>
						<input type="submit" id="fil" value="GO">
                         </form>
					</div>
					<div class="panel-body">

						<div class="table-responsive table-remove-padding">

							<table class="table" id="datatable">

								<thead>

									<tr>

										<th>#</th>

										<th>Photo</th>

										<th>Employee ID</th>

										<th>Name</th>

										<th>Email</th>

										<th>Designation</th>
											<th>Department</th>

										<th>Action</th>

									</tr>

								</thead>

								<tbody>

									<?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

									<tr>

										<td><?php echo e($employee->id); ?></td>

										<td><img src="<?php echo e(is_null($employee->cb_profile->employee_pic) ? 'assets/images/profile-picture.png':$employee->cb_profile->employee_pic); ?>" alt="" height="50" width="50" class="img-circle"></td>

										<td><b><?php echo e($employee->cb_profile->employee_id); ?></b></td>

										<td><?php echo e($employee->first_name); ?> <?php echo e($employee->last_name); ?></td>

										<td><?php echo e($employee->email); ?></td>

										<td><?php echo e(getRoleById($employee->role)); ?></td>
                                        <td><?php echo e($employee->department); ?></td>
										<td>

											<a class="btn btn-primary" href="<?php echo e(URL('admin/employee/profile/'.$employee->id)); ?>">View</a>

											<a class="btn btn-primary" href="<?php echo e(URL('admin/employee/'.$employee->id)); ?>">Edit</a></td>

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



	<!-- Modal -->

	<div class="modal fade" id="importEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		<div class="modal-dialog">

			<div class="modal-body">

				<div class="panel panel-white">

					<div class="panel-heading clearfix">

						<h4 class="panel-title" id="msg">Upload Employees Excel Sheet</h4>	



					</div>

					<div class="panel-body">

						<form class="form-horizontal" >

							<?php echo e(csrf_field()); ?>


							<div class="form-group">

								<label for="employeeFile" class="col-sm-2 control-label">File</label>

								<div class="col-sm-10">

									<input type="file" class="form-control" id="employeeFile" name="employeeFile">	

								</div>

							</div>

						</form>

					</div>

					<div class="modal-footer">

						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

						<a  id="uploadEmployee"  class="btn btn-success">Update</a>

					</div>

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

	$(document).ready(function() {

		$('#uploadEmployee').on('click',function(){

			var employeeFile = document.querySelector('#employeeFile');

			if(employeeFile.files[0]) {

				var file_data = $('#employeeFile').prop('files')[0];

				var form_data = new FormData();

				form_data.append('employeeFile', file_data);

				$.ajaxSetup({

					headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}

				});

				var url  = "<?php echo e(URL('/admin/import/employee-sheet')); ?>";

				$.ajax({

					url: url,

					type: 'POST',

					data: form_data,

					success: function (data) {

						if(data.flag){

							$('#importEmployeeModal').modal('toggle');

							swal('Success','File Upload Successfully','success');	

							setTimeout(function(){

								window.location.reload();

							}, 2000);

						}else{

							$('#importEmployeeModal').modal('toggle');

							swal('Oops',data.error,'warning');	

						}

					},

					contentType: false,

					cache: false,

					processData: false

				});

			}

		});

	});

</script>

<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>