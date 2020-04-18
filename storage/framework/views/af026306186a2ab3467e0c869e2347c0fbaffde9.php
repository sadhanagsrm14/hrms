<?php $__env->startSection('content'); ?>

<?php $__env->startSection('title','System'); ?>



<div class="page-inner">

	<div class="page-title">

		<h3>System</h3>

		<div class="page-breadcrumb">

			<ol class="breadcrumb">

				<li><a href="<?php echo e(URL('/admin/dashboard')); ?>">Home</a></li>

				<li><a href="<?php echo e(URL('/admin/assets/all_system')); ?>">System</a></li>

				<li class="active">View Systems</li>

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

						<h4 class="panel-title">View Systems list </h4>

					</div>

					<div class="panel-body">

						<form class="form-horizontal" action="<?php echo e(url('/admin/assets/all_system')); ?>" method="post" enctype="multipart/form-data">

							<div class="box-body">

								<?php echo e(csrf_field()); ?>


								<div class="form-group">

									<label for="asset_type" class="col-sm-2 control-label">Asset Type</label>

									<div class="col-sm-10">

										<select name="asset_type" id="asset_type" class="form-control select2"  required="required">

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

									<label for="system_name" class="col-sm-2 control-label">System Name</label>

									<div class="col-sm-10">

										<select name="system_name" id="system_name" class="form-control select2"  required="required">

											<option value="">--Select System Name--</option>

										</select>

										<?php if($errors->has('system_name')): ?>

										<span class="label label-danger"><?php echo e($errors->first('system_name')); ?></span>

										<?php endif; ?>

									</div>

								</div>

								


							</div>

							<!-- /.box-body -->

							<div class="box-footer">

								<a href="<?php echo e(URL('/admin/assets/all_system')); ?>" class="btn btn-default">Cancel</a>

								<button type="submit" class="btn btn-info pull-right">Show</button>

							</div>

							<!-- /.box-footer -->

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

	$(document).ready(function() {

		$('.select2').select2();

		$("#asset_type").on('change',function(e){

			var asset_type_id = e.target.value;

			url = "<?php echo e(URL('admin/asset_master/')); ?>";

			$.get(url+'/'+asset_type_id, function(data) {

				$("#system_name").empty();

				$("#system_name").append('<option value="">--Select Master Asset--</option>');

				$.each(data, function(index, system_name) {

					$("#system_name").append('<option value="'+system_name.id+'">'+system_name.name+'</option>');

				});

			});

		})

		// $("#system_name").on('change',function(e){

		// 	var system_name_id = e.target.value;

		// 	if(system_name_id != ""){

		// 		url = "<?php echo e(URL('/getNewSystemId/')); ?>";

		// 		$.get(url, function(system_data) {

		// 			if(system_data.flag){

		// 				maste_url = "<?php echo e(URL('/getMasterSystemById/')); ?>";

		// 				$.get(maste_url+'/'+system_name_id, function(master_data) {

		// 					if(master_data.flag){

		// 						$("#system_code").empty();

		// 						$("#system_code").val(master_data.master_system.asset_code+"00"+(system_data.system.id+1));

		// 						$("#system_code").attr('disabled','disabled');

		// 						$(".system_code").show();

		// 					}

		// 				});





		// 			}

		// 		});

		// 	}else{

		// 		$(".system_code").hide();

		// 	}

		// })

		

	});

</script>

<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>