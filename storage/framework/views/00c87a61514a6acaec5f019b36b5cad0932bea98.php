<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','System'); ?>

<div class="page-inner">
	<div class="page-title">
		<h3>System</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/admin/dashboard')); ?>">Home</a></li>
				<li class="active"><a href="<?php echo e(URL('/admin/systems')); ?>">System</a></li>
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
						<a href="<?php echo e(URL('/admin/export/system-sheet')); ?>" class="btn btn-danger pull-right" style="margin-top: -16px;margin-right: 10px;">Export Systems</a>
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
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $systems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $system): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($system->system_id); ?></td>
										<td><?php echo e($system->name); ?></td>
										<td>
											<?php if(!is_null($system->assign_to)): ?>
											<a href="<?php echo e(URL('/admin/employee/'.$system->assign_to)); ?>"><?php echo e(getUserById($system->assign_to)->first_name); ?></a></td>
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
											<a class="btn btn-danger" href="#" onclick="getSystem(<?php echo e($system->id); ?>)" data-toggle="modal" data-target=".view-asset-list">View Details</a> 
											<a class="btn btn-primary" href="<?php echo e(URL('/admin/system/'.$system->id)); ?>">Edit</a>
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
								<th>S.no</th>
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
	function getSystem(id){
		var systemUrl = "<?php echo e(URL('/getSystem/')); ?>";
		$.get(systemUrl+'/'+id, function(data) {
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
					$.get(assetUrl+'/'+asset.asset_id, function(data) {
						if(data.flag){
							
							if(data.asset.s_no == null){
								s_no = "<b>N/A</b>";
							}else{
								s_no = data.asset.s_no;
							}
							$("#assignedAssets").append('<tr><td>'+data.asset.asset_code+'</td><td>'+data.asset.name+'</td><td>'+s_no+'</td></tr>');
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
					if(data.flag){
						$('.empList-modal-lg').modal('toggle');
						swal('Success','File Upload Successfully','success');	
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