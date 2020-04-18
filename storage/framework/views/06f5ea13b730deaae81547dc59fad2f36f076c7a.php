      <div class="page-sidebar sidebar">
      	<div class="page-sidebar-inner slimscroll">
      		<div class="sidebar-header">
      			<div class="sidebar-profile">
              <!-- <a href="javascript:void(0);" id="profile-menu-link"> -->
                <a href="javascript:void(0);">
                 <div class="sidebar-profile-image">
                   <img src="<?php echo e(\Auth::user()->cb_profile->employee_pic); ?>" class="img-circle img-responsive" alt="">
                 </div>
                 <div class="sidebar-profile-details">
                  <span><?php echo e(\Auth::user()->first_name); ?><br><small><?php echo e(getRoleById(\Auth::user()->role)); ?></small></span>
                </div>
              </a>
            </div>
          </div>

          <ul class="menu accordion-menu">
           <li class="<?php echo e(setActive('itExecutive/dashboard')); ?>"><a href="<?php echo e(URL('/itExecutive/dashboard')); ?>" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>

           <li class="droplink <?php echo e(setActive('itExecutive/assets')); ?>

           <?php echo e(setActive('itExecutive/add-asset')); ?>

           <?php echo e(setActive('itExecutive/systems')); ?>

           <?php echo e(setActive('itExecutive/add-system')); ?>

           "><a href="#" class="waves-effect waves-button"><span class="menu-icon fa fa-cogs"></span><p>Asset Management</p><span class="arrow"></span></a>
           <ul class="sub-menu">
            <li><a href="<?php echo e(URL('/itExecutive/assets')); ?>">Asset List</a></li>
            <li><a href="<?php echo e(URL('/itExecutive/add-asset')); ?>">Create Asset</a></li>
            <li><a href="<?php echo e(URL('/itExecutive/systems')); ?>">Systems</a></li>
            <li><a href="<?php echo e(URL('/itExecutive/add-system')); ?>">Create System</a></li>
          </ul>
        </li>

        <li class="droplink <?php echo e(setActive('itExecutive/apply-leave')); ?>  <?php echo e(setActive('itExecutive/my-leaves')); ?>"><a href="#" class="waves-effect waves-button"><span class="menu-icon fa fa-calendar"></span><p>Leaves</p><span class="arrow"></span></a>
          <ul class="sub-menu">
            <li><a href="<?php echo e(URL('/itExecutive/apply-leave')); ?>">Apply Leave</a></li>
            <li><a href="<?php echo e(URL('/itExecutive/my-leaves')); ?>">My Leaves</a></li>
          </ul>
        </li>
        
          <li class="droplink <?php echo e(setActive('resign')); ?>">
            <a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Resignation</p><span class="arrow"></span></a>
            <ul class="sub-menu">
              <?php if(is_null(\Auth::user()->resignation)): ?>
              <li><a href="<?php echo e(URL('/resign')); ?>">Apply Resignation</a></li>
              <?php else: ?>
              <li><a href="<?php echo e(URL('/resign')); ?>">View Resignation</a></li>
              <?php endif; ?>
            </ul>
          </li>
          
          

        </ul>
      </div><!-- Page Sidebar Inner -->
      </div><!-- Page Sidebar -->