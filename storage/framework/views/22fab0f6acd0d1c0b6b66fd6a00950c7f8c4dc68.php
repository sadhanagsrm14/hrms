<?php $__env->startSection('content'); ?>

<?php $__env->startSection('title','System'); ?>



<div class="page-inner">

	<div class="page-title">

		<h3>System</h3>

		<div class="page-breadcrumb">

			<ol class="breadcrumb">

				<li><a href="<?php echo e(URL('/admin/dashboard')); ?>">Home</a></li>

				<li class="active"><a href="<?php echo e(URL('/admin/assets/all_system')); ?>">System</a></li>

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

						<a href="<?php echo e(URL('/admin/export_desktop/system-sheet')); ?>" class="btn btn-danger pull-right" style="margin-top: -16px;margin-right: 10px;">Export Systems</a>

					</div>

					<div class="panel-body">

						<div class="table-responsive table-remove-padding">

							<table class="table" id="datatable">

								<thead>

									<tr>

										<th>System Code</th>

										<th>Name</th>

										<th>Assigned To</th>

										<th>Status</th>

										<th>Action</th>
										<th style="display:none;">Descriptions</th>
                                         <th >Last edited by</th>
									</tr>

								</thead>

								<tbody>

									<?php $__currentLoopData = $systems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $system): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

									<tr>

										<td><?php echo e($system->system_id); ?></td>

										<td><?php echo e($system->name); ?></td>

										<td>

											<?php if(!is_null($system->assign_to)): ?>

											
												<span style="color: #900ba9;"><?php echo e(getEmpId($system->assign_to)); ?> </span>  <?php echo e(getUserById($system->assign_to)->first_name); ?> <?php echo e(getUserById($system->assign_to)->last_name); ?></td>

											<?php else: ?>

											<b>N/A</b>

											<?php endif; ?>

										</td>

										<td>

											<?php if(is_null($system->assign_to)): ?>

											<b>Free</b>

											<?php else: ?>

											<b>Assigned</b>

											<?php endif; ?>

										</td>

										<td>

											<a class="btn btn-danger" href="#" onclick="getSystem(<?php echo e($system->id); ?>,<?php echo e($system->master_system_id); ?>)" data-toggle="modal" data-target=".view-asset-list">View Details</a> 

											<a class="btn btn-primary" href="<?php echo e(URL('/admin/system/'.$system->id.'/'.$system->master_system_id)); ?>">Edit</a>

										</td>

                                         <td style ="display:none;"><?php echo e(getAssetDescriptionsById(getSystemAssetById($system->id))); ?></td>
                                          <td ><?php echo e(getUserById($system->last_updated_by)->first_name); ?>

                                          	<?php echo e(getUserById($system->last_updated_by)->last_name); ?></td>


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







<div class="modal fade view-asset-list" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

	<div class="modal-dialog modal-sm">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

				<h4 class="modal-title" id="mySmallModalLabel" ><i class="fa fa-cogs fa-2x assetName" aria-hidden="true"> Assigned Assets</i></h4>

				<p>System Code:1110</p>

			</div>

			<div class="modal-body">

				<h5>Assigned To:<span id="assignedTo"></span></h5>



				<div class="table-responsive table-remove-padding">

					<table class="table">

						<thead>

							<tr>

								<th>Assets Code</th>

								<th>Assets Name</th>

								<th>Descriptions</th>

							</tr>

						</thead>

						<tbody id="assignedAssets">

						</tbody>

					</table>

				</div>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>



			</div>

		</div>

	</div>

</div>



<?php $__env->startSection('script'); ?>

<script>

	function getSystem(id,master_system_id){

		var systemUrl = "<?php echo e(URL('/getSystem/')); ?>";

		$.get(systemUrl+'/'+id+'/'+master_system_id, function(data) {

			if(data.flag){

				var userUrl = "<?php echo e(URL('/getUser/')); ?>";

				if(data.system.assign_to == null){

					var username = "N/A";

					$('#assignedTo').text(' '+username);

				}else{

					$.get(userUrl+'/'+data.system.assign_to, function(data) {

						if(data.flag){

							var username = data.user.first_name+' '+data.user.last_name;

							$('#assignedTo').text(' '+username);

						}

					});

				}

				$('.assetName').text(data.system.name+' ('+data.system.system_id+')');

				$("#assignedAssets").empty();

				$.each(data.system.assets, function(index, asset) {
                     
					var assetUrl = "<?php echo e(URL('/getAsset/')); ?>";

					$.get(assetUrl+'/'+asset.asset_id+'/'+asset.asset_type_id, function(data) {

						if(data.flag){

							

							if(data.asset.s_no == null){

								s_no = "<b>N/A</b>";

							}else{

								s_no = data.asset.s_no;

							}
                            if(asset.asset_type_id == 1){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/monitor/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/monitor/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 2){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/keyboard/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/keyboard/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 3){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/mouse/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/mouse/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 4){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/cabinet/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/cabinet/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 5){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/motherboard/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/motherboard/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 6){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/ram/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/ram/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 7){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/processer/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/processer/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 8){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/ups_battery/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/ups_battery/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 9){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/smps/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/smps/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 10){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/hdd/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/hdd/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 11){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/desktop/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/desktop/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 12){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/laptop/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/laptop/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 13){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/mac_mini/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/mac_mini/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 14){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/i_mac/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/i_mac/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 15){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/network_switch/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/network_switch/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 16){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/router/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/router/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 17){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/repeater/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/repeater/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 18){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/ups/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/ups/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 19){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/pen_drive/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/pen_drive/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 20){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/dvr/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/dvr/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 21){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/camera/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/camera/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 22){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/web_cam/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/web_cam/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 23){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/printer/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/printer/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 24){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/chair/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/chair/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 25){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/desk/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/desk/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 26){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/fan/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="fan/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 27){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/ac/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/ac/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 28){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/almirah/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/almirah/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }
                             if(asset.asset_type_id == 29){
                            	$("#assignedAssets").append('<tr><td><a href="/admin/headphone/'+data.asset.id+'">'+data.asset.asset_code+'</a></td><td><a href="/admin/headphone/'+data.asset.id+'">'+data.asset.name+'</a></td><td>'+data.asset.descriptions+'</td></tr>');
                            }

                           
						}

					});

				});

			}else{

				swal('Oops','Something Went Wrong!','error')

			}

		});

	}

	function empList(id){

		$('.systemValue').val(id);

		$('.empList-modal-sm').modal('toggle');

	}

	function assignsystem(){

		var data = $('#assignsystemForm').serialize();

		var queryString = data.split('&');

		var emp = queryString[1].split('=');

		var system_id = $('.systemValue').val();

		var emp_id = emp[1];

		url = "<?php echo e(URL('admin/assignsystem/')); ?>";

		$.get(url+'/'+system_id+'/'+emp_id, function(data) {

			if(data.flag){

				$('.empList-modal-sm').modal('toggle');

				swal('Assigned','Assigned Successfully!','success');

				setTimeout(function(){

					location.reload();

				}, 2000)  

			}else{

				swal('Oops','Something Went Wrong!','error')



			}

		});

	}



	function releasesystem(system_id){

		var url = "<?php echo e(URL('admin/systemRelease/')); ?>";

		$.get(url+'/'+system_id, function(data) {

			if(data.flag){

				swal('Released','Released Successfully!','success');

				setTimeout(function(){

					location.reload();

				}, 2000)  

			}else{

				swal('Oops','Something Went Wrong!','error')

			}

		});

	}



	$('#uploadsystem').on('click',function(){

		var systemFile = document.querySelector('#systemFile');

		if(systemFile.files[0]) {

			var file_data = $('#systemFile').prop('files')[0];

			var form_data = new FormData();

			form_data.append('systemFile', file_data);

			$.ajaxSetup({

				headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}

			});

			var url  = "<?php echo e(URL('/admin/import/system-sheet')); ?>";

			$.ajax({

				url: url,

				type: 'POST',

				data: form_data,

				success: function (data) {
                       console.log(data);
					if(data.flag){

						$('.empList-modal-lg').modal('toggle');

						swal('Success','File Uploaded Successfully','success');	

						setTimeout(function(){

							window.location.reload();

						}, 2000);

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

</script>

<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>