<?php $__env->startSection('style'); ?>

<?php echo e(Html::style("assets/plugins/datatables/css/jquery.datatables.min.css")); ?>


<?php echo e(Html::style("assets/plugins/datatables/css/jquery.datatables_themeroller.css")); ?>


<style>

table.dataTable.cell-border tbody td {padding: 5px 15px !important;}

table#example1 tr td {padding: 5px 15px !important;}

.empList-modal-sm .panel-body {overflow-y: scroll;height: 420px;}

.table>tbody>tr>td {padding: 5px 14px !important;border: 1px solid #e1e1e1;}

.table>tbody>tr>th {background: #22baa0;color: #fff;font-weight: 600;}

table::-webkit-scrollbar {height: 8px;}

table::-webkit-scrollbar-track {-webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);}

table::-webkit-scrollbar-thumb {background-color: #22baa0;outline: 1px solid #168e79;border-radius: 50px;}

.attenreg tr:last-child td { text-align: center; padding: 5px 0px!important;}

.attenreg td {text-align: center;}

.panel-body .attenreg tr th {padding: 8px 15px 20px !important;position:  relative;text-align: center;font-size: 14px;}

.attenreg tr th span {font-size: 10px;position: absolute;bottom: 4px;left: 0;right: 0;}

</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->startSection('title','Calender'); ?>



<div class="page-inner">

	<div class="page-title">

		<h3>Attendance</h3>

		<div class="page-breadcrumb">

			<ol class="breadcrumb">

				<li><a href="<?php echo e(URL('/hrManager/dashboard')); ?>">Home</a></li>

				<li class="active"><a href="<?php echo e(URL('/hrManager/attendance')); ?>">Attendance</a></li>

			</ol>

		</div>

	</div>

	<div id="main-wrapper">

		<div class="row">

			<div class="col-md-12">				



				<div class="panel panel-white">

					

					<div class="panel-heading clearfix">

						<h4 class="panel-title">Show Calender By Month</h4>

					</div>

					<div class="panel-body">

						<div class="col-md-4">

							<form class="form-inline" >

								<div class="form-group">

									<label class="sr-only" for="exampleInputEmail2">Month</label>

									<select name="month" class="form-control m-b-sm">

										<option value="1" <?php echo e($current_month == 1 ? 'selected':''); ?>>January</option>

										<option value="2" <?php echo e($current_month == 2 ? 'selected':''); ?>>February</option>

										<option value="3" <?php echo e($current_month == 3 ? 'selected':''); ?>>March</option>

										<option value="4" <?php echo e($current_month == 4 ? 'selected':''); ?>>April</option>

										<option value="5" <?php echo e($current_month == 5 ? 'selected':''); ?>>May</option>

										<option value="6" <?php echo e($current_month == 6 ? 'selected':''); ?>>June</option>

										<option value="7" <?php echo e($current_month == 7 ? 'selected':''); ?>>July</option>

										<option value="8" <?php echo e($current_month == 8 ? 'selected':''); ?>>August</option>

										<option value="9" <?php echo e($current_month == 9 ? 'selected':''); ?>>September</option>

										<option value="10" <?php echo e($current_month == 10 ? 'selected':''); ?>>October</option>

										<option value="11" <?php echo e($current_month == 11 ? 'selected':''); ?>>November</option>

										<option value="12" <?php echo e($current_month == 12 ? 'selected':''); ?>>December</option>

									</select>

								</div>

								<div class="form-group">

									<label class="sr-only" for="exampleInputPassword2">Year</label>

									<select class="form-control m-b-sm" name="year">

										<?php for($y = $current_year; $y >= 2010; $y--): ?>

										<option value="<?php echo e($y); ?>" <?php echo e($search_year == $y ? 'selected' : ''); ?>><?php echo e($y); ?></option>

										<?php endfor; ?>

									</select>

								</div>



								<div class="form-group">

									<label class="sr-only" for="exampleInputPassword2">Year</label>

									<select class="form-control m-b-sm " name="type">

										<option value="development" <?php echo e($emp_type == "development" ? "selected":''); ?>>DEVELOPMENT</option>

										<option value="sales" <?php echo e($emp_type == "sales" ? "selected":''); ?>>SALES</option>

									</select>

								</div>



								<button type="submit" class="btn btn-info" style="margin-top: -16px;">Show</button>

							</form>

						</div>

						<div class="col-md-8">



							<button  data-toggle="modal" data-target=".empList-modal-sm" class="btn btn-success pull-right" style="margin-top: -16px;">Review Today's Attendance</button>

							<!-- <button type="submit" data-toggle="modal" data-target=".empList-modal-lg" class="btn btn-primary pull-right" style="margin-top: -16px;margin-right: 10px;">Upload Attendance Excel</button>

								<a href="<?php echo e(URL('/hrManager/export/attendance-sheet')); ?>" class="btn btn-warning pull-right" style="margin-top: -16px;margin-right: 10px;">Export Attendance</a> -->

							</div>

							<div class="col-md-12">

								<h2 class="pull-left">Attendance Report of Month <?php echo e(date("F", strtotime('2018-'.$current_month.'-01'))); ?> of <?php echo e($search_year); ?></h2>

							</div>

						</div>

						<div class="panel-body" style="padding:0px 20px">

							<div class="col-md-12 colorpanel table-responsive">

								<table  class="display colorpaneltable" cellspacing="0" width="auto" style="float: left;border-right: 1px solid #e4e4e4">

									<tr>

										<td class="colorswach P"></td>

										<td>Present</td>

										<td class="colorswach HD"></td>

										<td>Half Day</td>

										<td class="colorswach UI"></td>

										<td>Un-Informed Leave</td>

										<td class="colorswach OT"></td>

										<td>Over Time</td>

										<td class="colorswach AB"></td>

										<td>Absent</td>

										<td class="colorswach myHoliday"></td>

										<td>Company Holiday</td>

										<td class="colorswach sun"></td>

										<td>Weekend</td>

									</tr>

								</table>

							</div>

						</div>

						<div class="panel-body">				

							<div class="" style="overflow:hidden; position: relative;">

								<table  class="display table cell-border" cellspacing="0" width="100%" style="width: 25%;float: left;border-right: 1px solid #e4e4e4">

									<tr>

										<th style="border: 1px solid #ddd;">EmpId</th>

										<th style="border: 1px solid #ddd;">EmpName</th>

									</tr>

									<?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

									<tr>

										<td><?php echo e($employee->employee_id); ?></td>

										<td style="white-space:nowrap;"><?php echo e($employee->first_name); ?> <?php echo e($employee->last_name); ?></td>

									</tr>                                          

									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

								</table> 

								<table class="display table cell-border hr_sale attenreg" cellspacing="0" width="100%" style="width: 75%;display: inline-block;overflow-x: scroll;">

									<tr>



										<?php for($i = 1; $i <= $day_in_month; $i++): ?>

										<th style="border: 1px solid #ddd;"><?php echo e(str_pad($i, 2, "0", STR_PAD_LEFT)); ?>


											<?php $date=$search_year.'-'.$current_month.'-'.$i; 

											$get_name = date('l', strtotime($date)); 

											$day_name = substr($get_name, 0, 3); 

											?>

											<span><?php echo e($day_name); ?></span></th>

											<?php endfor; ?>



										</tr>

										<?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

										<tr>									

											<?php for($i = 1; $i <= $day_in_month; $i++): ?>



											<?php 



											$date=$search_year.'-'.$current_month.'-'.$i; 

											$hdate=str_pad($current_month, 2, "0", STR_PAD_LEFT).'/'.str_pad($i, 2, "0", STR_PAD_LEFT).'/'.$search_year; 

											$get_name = date('l', strtotime($date)); 

											$day_name = substr($get_name, 0, 3); 

											?>



											<?php if($day_name == "Sat" || $day_name =="Sun"): ?>

											<td class="sun">

												<span>

													<?php echo e($day_name); ?>


												</span> 

											</td>

											<?php elseif(isHoliday($hdate,$emp_type)): ?>



											<td class="myHoliday">

												<span>

													

												</span> 

											</td>

											<?php else: ?>

											<td class="<?php echo e(getAttendanceBydate($search_year.'-'.$current_month.'-'.$i,$employee->employee_id)); ?>">

												<span>

													<?php echo e(getAttendanceBydate($search_year.'-'.$current_month.'-'.$i,$employee->employee_id)); ?></span> 

												</td>



												<?php endif; ?>





												<?php endfor; ?>



											</tr>    



											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

											<tr>

												<?php for($i = 1; $i <= $day_in_month; $i++): ?>

												<?php 



												$date=$search_year.'-'.$current_month.'-'.$i; 

												$hdate=str_pad($current_month, 2, "0", STR_PAD_LEFT).'/'.str_pad($i, 2, "0", STR_PAD_LEFT).'/'.$search_year; 

												$get_name = date('l', strtotime($date)); 

												$day_name = substr($get_name, 0, 3); 

												$curdate=strtotime(date('Y-m-d'));

												$mydate=strtotime($date);



												?>

												<?php if(isHoliday($hdate,$emp_type) || $day_name == "Sat" || $day_name =="Sun" || $curdate < $mydate): ?>

												<td ></td>

												<?php elseif($curdate == $mydate): ?>

												<td><a class="btn btn-reponsive btn-primary UpdateAttendance" data-mydate="<?php echo e($date); ?>" data-emptype="<?php echo e($emptype); ?>" >Edit</a></td>



												<?php else: ?>

												<td></td>

												<?php endif; ?>

												<?php endfor; ?>

											</tr>

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



				<!-- Modal -->

				<div class="modal fade empList-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

					<div class="modal-dialog">

						<form class="modal-content" action="<?php echo e(URL('hrManager/submitAttendance')); ?>" id="assignAssetForm" method="post">

							<?php echo e(csrf_field()); ?>


							<input type="hidden" name="attendanceDate" id="attendanceDate" value="<?php echo e(date('Y-m-d')); ?>">

							<div class="modal-body">

								<div class="panel panel-white">

									<div class="panel-heading clearfix">

										<h4 class="panel-title" id="msg">Add Attendance for <?php echo e(date('Y-m-d')); ?></h4>	



									</div>

									<div class="panel-body">



										<div class="table-responsive" style="overflow: hidden;">

											<table id="example1" class="display table" style="width: 100%; cellspacing: 0;">

												<thead>

													<tr>

														<th>Employee Id</th>

														<th>Employee Name</th>

														<th>Action</th>

													</tr>

												</thead>

												<tbody id="myAttendanceData">



													<?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

													<tr>

														<td><b>

															<?php echo e($employee->employee_id); ?></b> 

															<input type="hidden" name="attendance[<?php echo e($key); ?>][employee_id]" value="<?php echo e($employee->employee_id); ?>">



														</td>

														<td><?php echo e($employee->first_name); ?> <?php echo e($employee->last_name); ?></td>

														<td >



															<select id="ST<?php echo e($employee->employee_id); ?>" class="<?php echo e(getAttendanceBydate(date('Y-m-d'),$employee->employee_id)); ?>" name="attendance[<?php echo e($key); ?>][status]" onchange="changeColor(this,'ST<?php echo e($employee->employee_id); ?>')">

																<?php $__currentLoopData = $dayTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dayType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

																<option class="<?php echo e($dayType->short_name); ?>" style="color:#262626;" value="<?php echo e($dayType->short_name); ?>"

																	<?php if(getAttendanceBydate(date('Y-m-d'),$employee->employee_id) == $dayType->short_name): ?>

																	selected

																	<?php endif; ?>

																	><?php echo e($dayType->short_name); ?></option>

																	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



																</select> 

															</td>

														</tr>

														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

													</tbody>

												</table> 



											</div>

										</div>

									</div>

								</div>

								<div class="modal-footer">

									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

									<button type="submit"  class="btn btn-success">Update</button>

								</div>

							</form> 

						</div>

					</div>



					

				</div>



			</div><!-- Page Inner -->



			<?php $__env->stopSection(); ?>

			<?php $__env->startSection('script'); ?>

			<?php echo e(Html::script("assets/plugins/datatables/js/jquery.datatables.min.js")); ?>


			<script type="text/javascript">

				$('#example').DataTable({

					"scrollX":true,

					"scrollY":false,

					"ordering":false,

					"paging":false,

				});

				function makeAttendance(employees_id,mydate,t){



					alert(t.value);

				}

				function changeColor(t,id){

					document.getElementById(id).className = t.value;

				}



				$(document).ready(function(){



					$('#assignAssetForm').submit(function(){



						var url = $('#assignAssetForm').attr('action');

						var mydata = $('#assignAssetForm').serialize();

						//console.log(mydata);

						$.ajax({

							url:url,

							data:mydata,

							dataType:'json',

							type:'post',

							success:function(responce){

								if(responce.success == true){

									$('#myModal').modal('hide');

									location.reload();

								}



							},

							error:function(responce){

								console.log(responce.responseText);

							}

						});



						return false;

					});



					$('.UpdateAttendance').click(function(){

						

						var mydate = $(this).data('mydate');
						var emptype = $(this).data('emptype');

						$('#myModal').modal('show');

						var url = window.origin+"/hrManager/getcurentAttendance";

						var token = $('meta[name="_token"]').attr('content');

						var mdata = {"muydate":mydate,"emptype":emptype,"_token":token};

						$('#attendanceDate').val(mydate);

						$("#msg").html("Add Attendance for "+mydate);

						$.ajax({

							url:url,

							data:mdata,

							dataType:'json',

							type:'post',

							success:function(responce){

								var html="";

								console.log(responce);

								var attendanceData = responce.employees;

								var dayTypes = responce.dayTypes;

								$.each(attendanceData , function(index,value){

									html +='<tr><td><b>'+value.employee_id+'</b>';

									html +='<input type="hidden" name="attendance['+index+'][employee_id]" value="'+value.employee_id+'"></td>';

									html +='<td>'+value.first_name+' '+value.last_name+'</td>';				

									html +='<td>';

									html +='<select  class="'+value.status+'"  id="ST"'+value.employee_id+'"  name="attendance['+index+'][status]" onchange="changeColor(this,"\'ST'+value.employee_id+'")">';



									$.each(dayTypes , function(index1,value1){

										html +='<option class="'+value1.short_name+'" style="color:#262626;" value="'+value1.short_name+'"';

										if(value1.short_name == value.status){

											html +=' selected';

										}

										html +='>'+value1.short_name+'</option>';

									});

									html +='</select>';

									html +='</td>';

									html +='</tr>';

								});

								$("#myAttendanceData").html(html);



							},

							error:function(responce){

								console.log(responce.responseText);

							}

						});

						return false;

					});



					$('#uploadAttendance').on('click',function(){

						var attendanceFile = document.querySelector('#attendanceFile');

						if(attendanceFile.files[0]) {

							var file_data = $('#attendanceFile').prop('files')[0];

							var form_data = new FormData();

							form_data.append('attendanceFile', file_data);

							$.ajaxSetup({

								headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}

							});

							var url  = "<?php echo e(URL('/hrManager/import/attendance-sheet')); ?>";

							$.ajax({

								url: url,

								type: 'POST',

								data: form_data,

								success: function (data) {

									if(data.flag){

										$('.empList-modal-lg').modal('toggle');

										swal('Success','File Upload Successfully','success');	

									}else{

										$('.empList-modal-lg').modal('toggle');

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
<?php echo $__env->make('hrManager.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>