<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','Asset'); ?>

<div class="page-inner">
	<div class="page-title">
		<h3>Asset</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/admin/dashboard')); ?>">Home</a></li>
				<li><a href="<?php echo e(URL('admin/assets/all_assets')); ?>">All Assets</a></li>
				<li class="active">Pen drive</li>
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
						<a href="<?php echo e(URL('/admin/export/asset-sheet-pen_drive')); ?>" class="btn btn-danger pull-right" style="margin-top: -16px;margin-right: 10px;">Export Assets</a>
						<button type="submit" data-toggle="modal" data-target="#importAssetModal" class="btn btn-primary pull-right" style="margin-top: -16px;margin-right: 10px;">Import Assets</button>
						<a href="<?php echo e(URL('/templates/AssetExcel.xls')); ?>" class="btn btn-warning pull-right" style="margin-top: -16px;margin-right: 10px;">Asset Template</a>
						
					</div>
					<div class="panel-body">
						<div class="table-responsive table-remove-padding">
							<table class="table"  id="datatable">
								<thead>
									<tr>
										<th>Asset Code</th>
										<th>System</th>
										<th>S.No</th>
										<th>Purchase/Bill Date</th>
										
										<th>Repair/Replacement Date</th>
										<th>Descriptions</th>
										<th>Purchase from store</th>
										<th>Warranty</th>
										<th>Warranty End Date</th>
										
										<th>Status</th>
										<th>Action</th>
										
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($asset->asset_code); ?></td>
										<td><?php echo e($asset->name); ?></td>
										<td><b><?php echo e(is_null($asset->s_no)?"N/A":$asset->s_no); ?></b></td>
										<td><b><?php echo e(is_null($asset->purchase_bill_date)?"N/A":$asset->purchase_bill_date); ?></b></td>
										<td><b><?php echo e(is_null($asset->repair_replacement_date)?"N/A":$asset->repair_replacement_date); ?></b></td>
										<td><b><?php echo e(is_null($asset->descriptions)?"N/A":$asset->descriptions); ?></b></td>
										<td><b><?php echo e(is_null($asset->purchase_from_store)?"N/A":$asset->purchase_from_store); ?></b></td>
										<td><b><?php echo e($asset->is_warranty == 1 ?"Yes":"No"); ?></b></td>
										<td><b><?php echo e(is_null($asset->warranty_end_date)?"N/A":$asset->warranty_end_date); ?></b></td>
										
										<td><?php echo e($asset->status); ?></td>
										<td><a class="btn btn-primary" href="<?php echo e(URL('/admin/pen_drive/'.$asset->id)); ?>">Edit</a></td>

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
	<!-- Modal -->
	<div class="modal fade" id="importAssetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-body">
				<div class="panel panel-white">
					<div class="panel-heading clearfix">
						<h4 class="panel-title" id="msg">Upload Asset Excel Sheet</h4>	

					</div>
					<div class="panel-body">
						<form class="form-horizontal" >
							<?php echo e(csrf_field()); ?>

							<div class="form-group">
								<label for="assetFile" class="col-sm-2 control-label">File</label>
								<div class="col-sm-10">
									<input type="file" class="form-control" id="assetFile" name="assetFile">	
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<a  id="uploadAsset"  class="btn btn-success">Update</a>
					</div>
				</div>
			</div>

		</div>
	</div>


</div><!-- Page Inner -->
<?php $__env->startSection('script'); ?>
<script>
	function empList(id){
		$('.assetValue').val(id);
		$('.empList-modal-sm').modal('toggle');
	}
	function assignAsset(){
		var data = $('#assignAssetForm').serialize();
		var queryString = data.split('&');
		var emp = queryString[1].split('=');
		var asset_id = $('.assetValue').val();
		var emp_id = emp[1];
		url = "<?php echo e(URL('admin/assignAsset/')); ?>";
		$.get(url+'/'+asset_id+'/'+emp_id, function(data) {
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

	function releaseAsset(asset_id){
		var url = "<?php echo e(URL('admin/assetRelease/')); ?>";
		$.get(url+'/'+asset_id, function(data) {
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

	$('#uploadAsset').on('click',function(){
		var assetFile = document.querySelector('#assetFile');
		if(assetFile.files[0]) {
			var file_data = $('#assetFile').prop('files')[0];
			var form_data = new FormData();
			form_data.append('assetFile', file_data);
			$.ajaxSetup({
				headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
			});
			var url  = "<?php echo e(URL('/admin/import_pen_drive/asset-sheet')); ?>";
			$.ajax({
				url: url,
				type: 'POST',
				data: form_data,
				success: function (data) {
					if(data.flag){
						$('#importAssetModal').modal('toggle');
						swal('Success','File Upload Successfully','success');	
						setTimeout(function(){
							window.location.reload();
						}, 2000);
					}else{
						$('#importAssetModal').modal('toggle');
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