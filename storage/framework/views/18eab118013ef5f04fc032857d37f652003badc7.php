<?php $__env->startSection('content'); ?>



<?php $__env->startSection('title','Teams'); ?>







<div class="page-inner">



	<div class="page-title">



		<h3>Teams</h3>



		<div class="page-breadcrumb">



			<ol class="breadcrumb">



				<li><a href="<?php echo e(URL('/admin/dashboard')); ?>">Home</a></li>



				<li class="active"><a href="<?php echo e(URL('/admin/teams')); ?>">Teams</a></li>



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



					</div>



					<div class="panel-body">



						<div class="table-responsive table-remove-padding">



							<table class="table"  id="datatable">



								<thead>



									<tr>



										<th>Employee ID</th>



										<th>Image</th>



										<th>Team Leader</th>



										<th>Action</th>



									</tr>



								</thead>



								<tbody>



									<?php $__currentLoopData = $team_leaders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team_leader): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



									<tr>



										<td><?php echo e($team_leader->cb_profile->employee_id); ?></td>



										<td><img src="<?php echo e($team_leader->cb_profile->employee_pic); ?>" alt="" height="50" width="50"></td>



										<td><a href="<?php echo e(url('/admin/employee/profile/'.$team_leader->id)); ?>"><?php echo e(getUserById($team_leader->id)->first_name); ?> <?php echo e(getUserById($team_leader->id)->last_name); ?></a></td>



										<td><a href="javascript::void()" class="btn btn-primary" onclick="view(<?php echo e($team_leader->id); ?>)"><i class="fa fa-users"></i> View Team Members(<?php echo e(calculateteammem($team_leader->cb_profile->user_id)); ?>)</a></td>



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







	<!-- preview Modal -->







	<div class="modal fade in" id="teamMembersModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">



		<div class="modal-dialog">



			<div class="modal-content">



				<div class="modal-header">



					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>



					<h4 class="modal-title" id="myModalLabel">Team Members</h4>



				</div>



				<div class="modal-body">



					<table class="table"  id="datatable2">



						<thead>



							<tr>



								<th>Employee ID</th>



								<th>Image</th>



								<th>Team Member</th>



								<th>Designation</th>



							</tr>



						</thead>



						<tbody id="teamMembers">







						</tbody>



					</table>



				</div>



				<div class="modal-footer">



					<button type="button" id="can" class="btn btn-default" data-dismiss="modal"">Cancel</button>



				</div>



			</div>



		</div>



	</div>



	<!-- preview Modal -->



	<div class="page-footer">



		<p class="no-s"><?php echo e(date('Y')); ?> &copy; Coding Brains Software Solution Pvt Ltd.</p>



	</div>



</div><!-- Page Inner -->



<?php $__env->startSection('script'); ?>



<script>



	function remove(id){



		var teamMemberUrl = "<?php echo e(URL('/admin/remove/team-member/')); ?>";



		$.get(teamMemberUrl+'/'+id, function(data) {



			if(data.flag){



				$('#member_'+id).remove();



			//	swal('Success','Team Member removed Successfully','success');

                 

			}else{



				swal('Oops','Something Went Wrong','error');



			}



		});



	}







	function view(id){



		var member_name = '';



		var teamMemberUrl = "<?php echo e(URL('/admin/team-members/')); ?>";



		$.get(teamMemberUrl+'/'+id, function(data) {



			if(data.flag){



				$('#teamMembers').empty();



				$.each(data.team_members, function(index, team_member) {



					var userUrl = "<?php echo e(URL('/getUser/')); ?>";



					$.get(userUrl+'/'+team_member.team_member_id, function(user_data) {



						



						if(user_data.flag){



							member_name = user_data.user.first_name+' '+user_data.user.last_name;



						}



						var html = `<tr id="member_`+user_data.user.id+`"><td>`+user_data.user.cb_profile.employee_id+`</td><td><img src="`+user_data.user.cb_profile.employee_pic+`" height="50" weight="50"></td><td><a href="/admin/employee/profile/`+user_data.user.id+`">`+member_name+`</a></td><td>`+user_data.user.cb_profile.designation+`</td><td><a href="javascript::void()" class="btn btn-primary" onclick="remove(`+user_data.user.id+`)"><i class="fa fa-times"></i>Remove</a></td></tr>`;



						$('#teamMembers').append(html);



					});



				});



				$('#teamMembersModal').modal('toggle');



			}else{



				swal('Oops','No Team Members Found','error')



			}



		});



		



	}

		$('#teamMembersModal,#can,.close').click(function(){

        location.reload();

	});

		$('#datatable2').DataTable({
    	 'columnDefs': [ {
			        'targets': [1,3], /* column index */ 
			        'orderable': false, /* true or false */
			     }]
        });



</script>



<?php $__env->stopSection(); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>