<?php $__env->startSection('content'); ?>

<?php $__env->startSection('title','Holidays'); ?>



<style>

.holiday {

	background-color: green;

	color: #fff;

	font-weight:700;

	font-size:1em;

}



.table td:nth-child(2)

{background-color:#FFC200;

	

}



.table td:nth-child(9)

{background-color:#FFC200;

	border-right: 3px solid #34425a;

}



.table td:nth-child(16)

{background-color:#FFC200;

	border-right: 3px solid #34425a;

}



.table td:nth-child(16)

{background-color:#FFC200;

	border-right: 3px solid #34425a;

}



.table td:nth-child(23)

{background-color:#FFC200;

	border-right: 3px solid #34425a;

}



.table td:nth-child(30)

{background-color:#FFC200;

	border-right: 3px solid #34425a;

}
.table td:nth-child(37)

{background-color:#FFC200;

	border-right: 3px solid #34425a;

}
.table td:nth-child(36)

{background-color:#FFC200;

	border-right: 3px solid #34425a;

}



.table td:nth-child(8)

{background-color:#FFC200;

}



.table td:nth-child(15)

{background-color:#FFC200;

}



.table td:nth-child(22)

{background-color:#FFC200;

}



.table td:nth-child(29)

{background-color:#FFC200;

}



.table th:nth-child(1)

{background-color:#34425a

	color:#fff;

	font-weight:700;

}

.table td:nth-child(1)

{background-color:#34425a;

	color:#fff;

	font-weight:700;

}



.table th {

	background-color: #22baa0;

	color: #fff;

	font-weight: 700;

}



.table tbody td {

	border: 1px solid;

	font-weight: 700;

}



.table thead th {

	border: 1px solid;

	font-weight: 700;

}



.table td:nth-child(n) {

	min-width:37px;



}



.table td, .table>tbody>tr>td, .table>tbody>tr>th, .table>thead>tr>td, .table>thead>tr>th {

	padding: 4px!important;

	text-align: center;

}

</style>



<div class="page-inner">

	<div class="page-title">

		<h3>Holidays Calender</h3>

		<div class="page-breadcrumb">

			<ol class="breadcrumb">

				<li><a href="<?php echo e(URL('/admin/dashboard')); ?>">Home</a></li>

				<li class="active">Holidays Calender</a></li>

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

						<div class="table-responsive" id="select-year110">

							<form class="form-inline">

								<div class="form-group">
                                  
									<label class="sr-only">Select Year: </label>
                                        
									<select name="year" id="year" class="form-control">
                                      <?php for($curyear = date('Y'); $curyear >= 2017; $curyear--): ?>
                                     <option value="<?php echo e($curyear); ?>" <?php echo e($year == "$curyear"?"selected":''); ?>><?php echo e($curyear); ?></option>
										
										
										<?php endfor; ?>
									</select>

								</div>

								<div class="form-group">

									<label class="sr-only">Select Category: </label>

									<select name="category" id="category" class="form-control">

										<option value="development" <?php echo e($category == "development"?"selected":''); ?>>Development</option>

										<option value="sales" <?php echo e($category == "sales"?"selected":''); ?>>Sales</option>

									</select>

								</div>

								<button id="filterCalender" class="btn btn-primary">Show</button>	

							</form>

							<table id="example" class="display table" style="width: 100%; cellspacing: 0;">

								<thead>

									<tr>

										<th>Month</th>

										<th>Sun</th>

										<th>Mon</th>

										<th>Tue</th>

										<th>Wed</th>

										<th>Thu</th>

										<th>Fri</th>

										<th>Sat</th>



										<th>Sun</th>

										<th>Mon</th>

										<th>Tue</th>

										<th>Wed</th>

										<th>Thu</th>

										<th>Fri</th>

										<th>Sat</th>



										<th>Sun</th>

										<th>Mon</th>

										<th>Tue</th>

										<th>Wed</th>

										<th>Thu</th>

										<th>Fri</th>

										<th>Sat</th>



										<th>Sun</th>

										<th>Mon</th>

										<th>Tue</th>

										<th>Wed</th>

										<th>Thu</th>

										<th>Fri</th>

										<th>Sat</th>



										<th>Sun</th>

										<th>Mon</th>

										<th>Tue</th>

										<th>Wed</th>

										<th>Thu</th>

										<th>Fri</th>

										<th>Sat</th>



										<th>Sun</th>

										<th>Mon</th>

										<th>Tue</th>

										<th>Wed</th>

										



									</tr>

								</thead>

								<tbody>

									<?php for($i = 1; $i <= 12; $i++): ?>



									<tr>

										<td><?php echo e(date("F", mktime(0, 0, 0, $i, 15))); ?></td>

										<?php $days = cal_days_in_month(CAL_GREGORIAN,$i,$year);?>

										<?php for($j = 1; $j <= $days; $j++): ?>

										<?php

										$date = $year.'/'.$i.'/'.$j; 

										if(strlen($j) == 1){$j = '0'.$j;}

										if(strlen($i) == 1){$i = '0'.$i;}

										$current_date = $i.'/'.$j.'/'.$year; 

										$get_name = date('l', strtotime($date)); 

										$day_name = substr($get_name, 0, 3);

										$holiday = holidayComment($current_date,$category);

										if($j == 1 && $day_name == 'Sun'){

											if(isHoliday($current_date,$category)){?>

											<td class="holiday" data-toggle="tooltip" data-placement="top" title="<?php echo e($holiday->comments); ?>"><?php echo e($j); ?></td>

											<?php }else{?>

											<td><?php echo e($j); ?></td>

											<?php }?>

											<?php }elseif( $j == 1 && $day_name == 'Mon'){?>

											<?php if(isHoliday($current_date,$category)){?>

											<td></td><td class="holiday" data-toggle="tooltip" data-placement="top" title="<?php echo e($holiday->comments); ?>"><?php echo e($j); ?></td>

											<?php }else{?>

											<td></td><td><?php echo e($j); ?></td>

											<?php }?>

											<?php }elseif( $j == 1 && $day_name == 'Tue'){

												if(isHoliday($current_date,$category)){?>

												<td></td><td></td><td class="holiday" data-toggle="tooltip" data-placement="top" title="<?php echo e($holiday->comments); ?>"><?php echo e($j); ?></td>

												<?php }else{?>

												<td></td><td></td><td><?php echo e($j); ?></td>

												<?php }?>



												<?php }elseif( $j == 1 && $day_name == 'Wed'){

													if(isHoliday($current_date,$category)){?>

													<td></td><td></td><td></td><td class="holiday" data-toggle="tooltip" data-placement="top" title="<?php echo e($holiday->comments); ?>"><?php echo e($j); ?></td>

													<?php }else{?>

													<td></td><td></td><td></td><td><?php echo e($j); ?></td>

													<?php }?>



													<?php }elseif( $j == 1 && $day_name == 'Thu'){

														if(isHoliday($current_date,$category)){?>

														<td></td><td></td><td></td><td></td><td class="holiday" data-toggle="tooltip" data-placement="top" title="<?php echo e($holiday->comments); ?>"><?php echo e($j); ?></td>

														<?php }else{?>

														<td></td><td></td><td></td><td></td><td><?php echo e($j); ?></td>

														<?php }?>



														<?php }elseif( $j == 1 && $day_name == 'Fri'){

															if(isHoliday($current_date,$category)){?>

															<td></td><td></td><td></td><td></td><td></td><td class="holiday" data-toggle="tooltip" data-placement="top" title="<?php echo e($holiday->comments); ?>"><?php echo e($j); ?></td>

															<?php }else{?>

															<td></td><td></td><td></td><td></td><td></td><td><?php echo e($j); ?></td>

															<?php }?>

															<?php }elseif( $j == 1 && $day_name == 'Sat'){

																if(isHoliday($current_date,$category)){?>

																<td></td><td></td><td></td><td></td><td></td><td></td><td class="holiday" data-toggle="tooltip" data-placement="top" title="<?php echo e($holiday->comments); ?>"><?php echo e($j); ?></td>

																<?php }else{?>

																<td></td><td></td><td></td><td></td><td></td><td></td><td><?php echo e($j); ?></td>

																<?php }?>

																<?php }else{

																	if(isHoliday($current_date,$category)){?>

																	<td class="holiday" data-toggle="tooltip" data-placement="top" title="<?php echo e($holiday->comments); ?>"><?php echo e($j); ?></td>

																	<?php }else{?>

																	<td><?php echo e($j); ?></td>

																	<?php } } ?>

																	<?php endfor; ?>

																</tr>

																<?php endfor; ?>

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

							<?php $__env->startSection('script'); ?>

							<script>

								$(document).ready(function() {

									$('#filterCalender').on('click',function(event) {

										var year = $('#year option:selected').val();

										var category = $('#category option:selected').val();

										var url = "<?php echo e(URL('/admin/holiday-calender')); ?>";

										window.location = url+'?year='+year+'&category='+category;

									});

								});

							</script>

							<?php $__env->stopSection(); ?>

							<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>