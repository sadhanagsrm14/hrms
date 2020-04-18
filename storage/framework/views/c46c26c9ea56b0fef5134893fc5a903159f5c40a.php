<?php $__env->startSection('content'); ?>

<?php $__env->startSection('title','Employee'); ?>



<div class="page-inner">

	<div class="page-title">

		<h3>Add Project</h3>

		<div class="page-breadcrumb">

			<ol class="breadcrumb">

				<li><a href="/admin/dashboard">Home</a></li>

				<li><a href="#">Project</a></li>

				<li class="active">Add Project</li>

			</ol>

		</div>

	</div>

	<div id="main-wrapper">

		<div class="row">

			<div class="col-md-12">

				<div class="panel panel-white">

					<div class="panel-body">

						<div id="rootwizard">

							<div class="row">
								<div class="col-md-6">
									<div class="panel panel-white">
										<div class="panel-heading clearfix">
											<h4 class="panel-title">Basic Form</h4>
										</div>
										<div class="panel-body">
											<form>
												<div class="form-group">
													<label for="exampleInputEmail1">Email address</label>
													<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
												</div>
												<div class="form-group">
													<label for="exampleInputPassword1">Password</label>
													<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox"> Check me out
													</label>
												</div>
												<button type="submit" class="btn btn-primary">Submit</button>
											</form>
										</div>
									</div>
								</div>
							</div>



						

						</div>

					</div>

				</div>

			</div>

		</div><!-- Row -->

	</div><!-- Main Wrapper -->

	<div class="page-footer">

		<p class="no-s">2015 &copy; Modern by Steelcoders.</p>

	</div>

</div>



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

		

	});

</script>

<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>