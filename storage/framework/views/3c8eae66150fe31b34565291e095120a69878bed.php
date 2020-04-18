<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','Asset'); ?>

<div class="page-inner">
	<div class="page-title">
		<h3>Asset</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/admin/dashboard')); ?>">Home</a></li>
				<li><a href="<?php echo e(URL('/admin/assets')); ?>">Asset</a></li>
				<li class="active">Add Asset</li>
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
						<h4 class="panel-title">Add asset Form</h4>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" method="post" enctype="multipart/form-data">
							<div class="box-body">
								<?php echo e(csrf_field()); ?>

								<div class="form-group">
									<label for="asset_type" class="col-sm-2 control-label">Asset Type</label>
									<div class="col-sm-10">
										<select name="asset_type" id="asset_type" class="form-control"  required="required">
											<option value="">--Select Asset Type--</option>
											<?php $__currentLoopData = $asset_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($asset_type->id); ?>"><?php echo e($asset_type->type); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
										<?php if($errors->has('asset_type')): ?>
										<span class="label label-danger"><?php echo e($errors->first('asset_type')); ?></span>
										<?php endif; ?>
									</div>
								</div>

								<div class="form-group">
									<label for="master_asset" class="col-sm-2 control-label">Master Asset</label>
									<div class="col-sm-10">
										<select name="master_asset" id="master_asset" class="form-control"  required="required">
											<option value="">--Select Master Asset--</option>
										</select>
										<?php if($errors->has('master_asset')): ?>
										<span class="label label-danger"><?php echo e($errors->first('master_asset')); ?></span>
										<?php endif; ?>
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
									<label for="s_no" class="col-sm-2 control-label">S.No</label>
									<div class="col-sm-10">
										<input type="text" name="s_no" id="s_no" class="form-control">
										<?php if($errors->has('s_no')): ?>
										<span class="label label-danger"><?php echo e($errors->first('s_no')); ?></span>
										<?php endif; ?>
									</div>
								</div>

								<div class="form-group">
									<label for="purchase_bill_date" class="col-sm-2 control-label">Purchase/Bill Date</label>
									<div class="col-sm-10">
										<input type="text" name="purchase_bill_date" id="purchase_bill_date" class="form-control datepicker">
										<?php if($errors->has('purchase_bill_date')): ?>
										<span class="label label-danger"><?php echo e($errors->first('purchase_bill_date')); ?></span>
										<?php endif; ?>
									</div>
								</div>

								<div class="form-group">
									<label for="repair_replacement_date" class="col-sm-2 control-label">Repair/Replacement Date</label>
									<div class="col-sm-10">
										<input type="text" name="repair_replacement_date" id="repair_replacement_date" class="form-control datepicker">
										<?php if($errors->has('repair_replacement_date')): ?>
										<span class="label label-danger"><?php echo e($errors->first('repair_replacement_date')); ?></span>
										<?php endif; ?>
									</div>
								</div>
								<div class="form-group">
									<label for="is_warranty" class="col-sm-2 control-label">Warranty</label>
									<div class="col-sm-10">
										<select name="is_warranty" id="is_warranty" class="form-control">
											<option value="">--Select Warranty--</option>
											<option value="1">Yes</option>
											<option value="0">No</option>
										</select>
									</div>
								</div>

								<div class="form-group" id="warranty_end_date_div" style="display: none;">
									<label for="warranty_end_date" class="col-sm-2 control-label">Warranty End Date</label>
									<div class="col-sm-10">
										<input type="text" name="warranty_end_date" id="warranty_end_date" class="form-control datepicker">
										<?php if($errors->has('warranty_end_date')): ?>
										<span class="label label-danger"><?php echo e($errors->first('warranty_end_date')); ?></span>
										<?php endif; ?>
									</div>
								</div>

								<div class="form-group">
									<label for="user_id" class="col-sm-2 control-label">Assign To</label>
									<div class="col-sm-10">
										<select class="form-control select2" name="user_id" id="user_id" style="width: 100%;">
											<option value="">--Select User--</option>
											<option value="1">User 1</option>
											<option value="2">user 2</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="asset_status" class="col-sm-2 control-label">Status</label>
									<div class="col-sm-10">
										<select class="form-control" name="asset_status" id="asset_status" style="width: 100%;">
										</select>
									</div>
								</div>

							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<a href="<?php echo e(URL('/admin/assets')); ?>" class="btn btn-default">Cancel</a>
								<button type="submit" class="btn btn-info pull-right">Add</button>
							</div>
							<!-- /.box-footer -->
						</form>
					</div>
				</div>
			</div>
		</div><!-- Row -->
	</div><!-- Main Wrapper -->
	<div class="page-footer">
		<p class="no-s">2015 &copy; Modern by Steelcoders.</p>
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
		$("#asset_type").on('change',function(e){
			var asset_type_id = e.target.value;
			url = "<?php echo e(URL('asset_master/')); ?>";
			$("#asset").empty();
			$.get(url+'/'+asset_type_id, function(data) {
				$("#master_asset").empty();
				$("#master_asset").append('<option value="">--Select Master Asset--</option>');
				$.each(data, function(index, master_asset) {
					$("#master_asset").append('<option value="'+master_asset.id+'">'+master_asset.name+'</option>');
				});
			});
		})

		$("#master_asset").on('change',function(e){
			var asset_type = $('#asset_type option:selected').val();
			var master_asset_id = e.target.value;
			url = "<?php echo e(URL('assetsByTypeMaster/')); ?>";
			$.get(url+'/'+asset_type+'/'+master_asset_id, function(data) {
				$("#asset").empty();
				$("#asset").append('<option value="">--Select Asset--</option>');
				$.each(data, function(index, asset) {
					$("#asset").append('<option value="'+asset.id+'">'+asset.name+'</option>');
				});
			});
		})

		$("#is_warranty").on('change',function(e){
			var is_warranty = e.target.value;
			console.log(is_warranty);
			if(is_warranty == 1){
				$('#warranty_end_date_div').show();
				$('#warranty_end_date').removeAttr('disabled');
				$('#warranty_end_date').attr('required','required');
			}else{
				$('#warranty_end_date_div').hide();
				$('#warranty_end_date').attr('disabled');
			}
		})
		$("#user_id").on('change',function(e){
			var user_id = $('#user_id option:selected').val();
			if(user_id != ""){
				$("#asset_status").empty();
				$("#asset_status").append(`<option value="assigned">Assigned</option>`);
			}else{
				$("#asset_status").empty();
				$("#asset_status").append(`<option value="">--Select Status--</option>
					<option value="free">Free</option><option value="discarded">Discarded</option>`);
			}
		})
		var user_id = $('#user_id option:selected').val();
		if(user_id != ""){
			$("#asset_status").empty();
			$("#asset_status").append(`<option value="assigned">Assigned</option>`);
		}else{
			$("#asset_status").empty();
			$("#asset_status").append(`<option value="">--Select Status--</option>
				<option value="free">Free</option><option value="discarded">Discarded</option>`);
		}
	});
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>