<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','System'); ?>

<div class="page-inner">
	<div class="page-title">
		<h3><?php echo e($system->name); ?> (<?php echo e($system->system_id); ?>)</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/itExecutive/dashboard')); ?>">Home</a></li>
				<li><a href="<?php echo e(URL('/itExecutive/systems')); ?>">System</a></li>
				<li class="active">Update System</li>
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
			</div>
			
			<div class="col-md-8">
				<div class="panel panel-white">
					<div class="panel-heading clearfix">
						<h4 class="panel-title">Update System</h4>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" action="<?php echo e(URL('/itExecutive/system/update')); ?>" method="post" enctype="multipart/form-data">
							<div class="box-body">
								<?php echo e(csrf_field()); ?>

								<input type="hidden" name="id" value="<?php echo e($system->id); ?>">
								<div class="form-group">
									<label for="asset_type" class="col-sm-2 control-label">Asset Type</label>
									<div class="col-sm-10">
										<select name="asset_type" id="asset_type" class="form-control select2"  required="required" style="width: 100%;">
											<option value="">--Select Asset Type--</option>
											<?php $__currentLoopData = $asset_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($asset_type->id); ?>" <?php echo e($asset_type->id == $system->asset_type_id?"selected":""); ?>><?php echo e($asset_type->type); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
										<?php if($errors->has('asset_type')): ?>
										<span class="label label-danger"><?php echo e($errors->first('asset_type')); ?></span>
										<?php endif; ?>
									</div>
								</div>

								<div class="form-group">
									<label for="system_name" class="col-sm-2 control-label">System Name</label>
									<div class="col-sm-10">
										<select name="system_name" id="system_name" class="form-control select2"  required="required" style="width: 100%;">
											<option value="">--Select System Name--</option>
											
											<?php $__currentLoopData = $system_names; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $system_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($system_name->id); ?>" <?php echo e($system_name->id == $system->master_system_id?"selected":""); ?>><?php echo e($system_name->name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
										<?php if($errors->has('system_name')): ?>
										<span class="label label-danger"><?php echo e($errors->first('system_name')); ?></span>
										<?php endif; ?>
									</div>
								</div>

								<div class="form-group">
									<label for="assign_to" class="col-sm-2 control-label">Assign To User</label>
									<div class="col-sm-10">
										<select class="form-control select2" name="assign_to" id="assign_to" style="width: 100%;">
											<option value="">--Select User--</option>
											<option value="">None</option>
											<?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($employee->id); ?>" <?php echo e($employee->id == $system->assign_to?"selected":""); ?>><?php echo e($employee->first_name); ?> <?php echo e($employee->last_name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-7">
										<a href="" data-toggle="modal" id="openAssetModel" data-target="#assignAssetModel" class="btn btn-primary text-center pull-right">Assign Assets</a>
									</div>
								</div>

								

							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<a href="<?php echo e(URL('/itExecutive/systems')); ?>"  class="btn btn-default">Cancel</a>
								<button type="submit" class="btn btn-info pull-right">Update</button>
							</div>
							<!-- /.box-footer -->
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-white">
					<div class="panel-heading clearfix">
						<h4 class="panel-title">Assigned Assets List</h4>
					</div>
					<div class="panel-body">
						<div class="table-responsive table-remove-padding">
							<table class="table">
								<thead>
									<tr>
										<th>Assets Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $system->assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $system_asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e(getAssetById($system_asset->asset_id)->name); ?>(<?php echo e(getAssetById($system_asset->asset_id)->asset_code); ?>)</td>
										<td><a class="btn btn-success" href="<?php echo e(URL('/itExecutive/release-system-asset/'.$system_asset->system_id.'/'.$system_asset->id)); ?>">Release</a></td>

									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
			<!--</div>-->
		</div><!-- Row -->
	</div><!-- Main Wrapper -->
	<div class="modal fade" id="assignAssetModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-body">
				<div class="panel panel-white">
					<div class="panel-heading clearfix">
						<h4 class="panel-title" id="msg">Assign Assets</h4>	
					</div>
					<div class="panel-body">
						<form class="form-horizontal" id="assignAssetForm">
							<div class="form-group">
								<label for="asset_type1" class="col-sm-2 control-label">Asset Type</label>
								<div class="col-sm-10">
									<select name="asset_type1" id="asset_type1" class="form-control"  required="required">
										<option value="">--Select Asset Type--</option>
										<?php $__currentLoopData = $asset_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($asset_type->id); ?>"><?php echo e($asset_type->type); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="asset" class="col-sm-2 control-label">Asset</label>
								<div class="col-sm-10">
									<select name="asset" id="asset" class="form-control"  required="required">
										<option value="">--Select Asset --</option>
									</select>
									<?php if($errors->has('asset')): ?>
									<span class="label label-danger"><?php echo e($errors->first('asset')); ?></span>
									<?php endif; ?>
								</div>
							</div>

							<div class="form-group">
								<label for="asset" class="col-sm-2 control-label">Free Asset</label>
								<div class="col-sm-10">
									<select name="free_asset" id="free_asset" class="form-control"  required="required">
										<option value="">--Select Asset --</option>
									</select>	
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<a  id="assignAssetBtn"  class="btn btn-success">Update</a>
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
<?php echo e(Html::script("assets/plugins/waves/waves.min.js")); ?>

<?php echo e(Html::script("assets/plugins/select2/js/select2.min.js")); ?>

<?php echo e(Html::script("assets/plugins/summernote-master/summernote.min.js")); ?>

<?php echo e(Html::script("assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js")); ?>

<?php echo e(Html::script("assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js")); ?>

<?php echo e(Html::script("assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js")); ?>

<?php echo e(Html::script("assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js")); ?>

<?php echo e(Html::script("assets/js/pages/form-elements.js")); ?>

<script>
	$(document).ready(function() {
		$('.select2').select2();
		$("#asset_type").attr('disabled','disabled');
		$("#system_name").attr('disabled','disabled');
		$("#asset_type").on('change',function(e){
			var asset_type_id = e.target.value;
			url = "<?php echo e(URL('itExecutive/asset_master/')); ?>";
			$.get(url+'/'+asset_type_id, function(data) {
				$("#system_name").empty();
				$("#system_name").append('<option value="">--Select Master Asset--</option>');
				$.each(data, function(index, system_name) {
					$("#system_name").append('<option value="'+system_name.id+'">'+system_name.name+'</option>');
				});
			});
		})
		$("#asset_type1").on('change',function(e){
			var asset_type_id = e.target.value;
			url = "<?php echo e(URL('itExecutive/assetsByAssetType/')); ?>";
			$.get(url+'/'+asset_type_id, function(data) {

				$("#asset").empty();
				$("#asset").append('<option value="">--Select Asset--</option>');
				$.each(data, function(index, asset) {
					$("#asset").append('<option value="'+asset.id+'">'+asset.name+'</option>');
				});
			});
		})
		$("#asset").on('change',function(e){
			var asset_type_id = $('#asset_type1 option:selected').val();
			var asset_assoc_id = $('#asset option:selected').val();
			url = "<?php echo e(URL('itExecutive/free_assets/')); ?>";
			$.get(url+'/'+asset_type_id+'/'+asset_assoc_id, function(data) {
				if(data.length == 0){
					swal('Oops','No Free Assets Found','error')
					$("#free_asset").empty();
					$("#free_asset").append('<option value="">--Select Free Asset--</option>');
				}else{
					$("#free_asset").empty();
					$("#free_asset").append('<option value="">--Select Free Asset--</option>');
					$.each(data, function(index, free_asset) {
						$("#free_asset").append('<option value="'+free_asset.id+'">'+free_asset.name+' '+free_asset.asset_code+'</option>');
					});
				}
			});
		})

		$("#assignAssetBtn").on('click',function(e){
			var asset_type1 = $('#asset_type1 option:selected').val();
			var asset_assoc_id = $('#asset option:selected').val();
			var free_asset_id = $('#free_asset option:selected').val();
			if(asset_type1 == ""){
				swal('Oops','Select Asset Type','error')
			}else if(asset_assoc_id == ""){
				swal('Oops','Select Asset','error')
			}else if(free_asset_id == ""){
				swal('Oops','Select Free Asset','error')
				
			}else{
				var data = $('#assignAssetForm').serialize();
				var queryString = data.split('&');
				var asset = queryString[2].split('=');
				var system_id = "<?php echo e($system->id); ?>";
				var asset_id = asset[1];
				console.log(asset_id);
				url = "<?php echo e(URL('itExecutive/assignAsset/')); ?>";
				$.get(url+'/'+system_id+'/'+asset_id, function(data) {
					if(data.flag){
						$('#assignAssetModel').modal('toggle');
						swal('Assigned','Assigned Successfully!','success');
						setTimeout(function(){
							location.reload();
						}, 2000)  
					}else{
						$('#assignAssetModel').modal('toggle');
						swal('Oops',data.error,'error')

					}
				});
			}
		})
	});
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('itExecutive.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>