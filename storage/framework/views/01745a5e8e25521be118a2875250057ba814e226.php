      <div class="page-sidebar sidebar">
      	<div class="page-sidebar-inner slimscroll">
      		<div class="sidebar-header">
      			<div class="sidebar-profile">
              <!-- <a href="javascript:void(0);" id="profile-menu-link"> -->
                <a href="javascript:void(0);">
                 <div class="sidebar-profile-image">
                  <img src="http://hrms.projects-codingbrains.com/images/employees/default-user.png" class="img-circle img-responsive" alt="">
                </div>
                <div class="sidebar-profile-details">
                  <span><?php echo e(\Auth::user()->first_name); ?><br><small><?php echo e(getRoleById(\Auth::user()->role)); ?></small></span>
                </div>
              </a>
            </div>
          </div>

          <ul class="menu accordion-menu">
           <li class="<?php echo e(setActive('admin/dashboard')); ?>"><a href="<?php echo e(URL('/admin/dashboard')); ?>" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>

           <li class="droplink  <?php echo e(setActive('admin/employees')); ?>   <?php echo e(setActive('admin/add-employee')); ?>   <?php echo e(setActive('admin/upload-employee')); ?>  "><a href="#" class="waves-effect waves-button"><span class="menu-icon fa fa-users"></span><p>Employees</p><span class="arrow"></span></a>
            <ul class="sub-menu">
              <li><a href="<?php echo e(URL('/admin/employees')); ?>">Employee Listing</a></li>
              <li><a href="<?php echo e(URL('/admin/add-employee')); ?>">Add New Employee</a></li>
              
            </ul>
          </li>



          <li class="droplink <?php echo e(setActive('admin/add-system')); ?>

          <?php echo e(setActive('admin/assets')); ?>

          <?php echo e(setActive('admin/add-asset')); ?>

          <?php echo e(setActive('admin/systems')); ?> 
          "><a href="#" class="waves-effect waves-button"><span class="menu-icon fa fa-cogs"></span><p>Asset Management</p><span class="arrow"></span></a>
          <ul class="sub-menu">
            <li><a href="<?php echo e(URL('/admin/assets')); ?>">Asset List</a></li>
            <li><a href="<?php echo e(URL('/admin/add-asset')); ?>">Create Asset</a></li>
            <li><a href="<?php echo e(URL('/admin/systems')); ?>">Systems</a></li>
            <li><a href="<?php echo e(URL('/admin/add-system')); ?>">Create System</a></li>
          </ul>
        </li>

        <li class="droplink <?php echo e(setActive('admin/projects')); ?> 
        <?php echo e(setActive('admin/add-project')); ?> 
        <?php echo e(setActive('admin/assign-project')); ?> 
        <?php echo e(setActive('admin/employee-projects')); ?> "><a href="#" class="waves-effect waves-button"><span class="menu-icon fa fa-folder"></span><p>Project</p><span class="arrow"></span></a>
        <ul class="sub-menu">
          <li><a href="<?php echo e(URL('/admin/projects')); ?>">Project List</a></li>
          <li><a href="<?php echo e(URL('/admin/add-project')); ?>">Add New Project</a></li>
          <li><a href="<?php echo e(URL('/admin/assign-project')); ?>">Assign Project</a></li>
          <li><a href="<?php echo e(URL('/admin/employee-projects')); ?>">Assigned Project List</a></li>
        </ul>
      </li>


      <li class="droplink <?php echo e(setActive('admin/assign-team-members')); ?> <?php echo e(setActive('admin/teams')); ?> "><a href="#" class="waves-effect waves-button"><span class="menu-icon fa fa-users"></span><p>Teams</p><span class="arrow"></span></a>
        <ul class="sub-menu">
          <li><a href="<?php echo e(URL('/admin/assign-team-members')); ?>">Assign Team Members</a></li>
          <li><a href="<?php echo e(URL('/admin/teams')); ?>">Teams</a></li>
        </ul>
      </li>

      <li class="droplink <?php echo e(setActive('admin/attendance')); ?>

      <?php echo e(setActive('admin/leave-details')); ?>  
      <?php echo e(setActive('admin/leave-types')); ?>

      <?php echo e(setActive('admin/add-leave-type')); ?>

      <?php echo e(setActive('admin/leave-listing')); ?>

      <?php echo e(setActive('admin/holidays')); ?>

      <?php echo e(setActive('admin/add-holiday')); ?>

      <?php echo e(setActive('admin/holiday-calender')); ?>"><a href="#" class="waves-effect waves-button"><span class="menu-icon fa fa-calendar"></span><p>Attendance / Leave</p><span class="arrow"></span></a>
      <ul class="sub-menu">
        <li><a href="<?php echo e(URL('/admin/attendance')); ?>">Attendance List</a></li>
        <li><a href="<?php echo e(URL('/admin/leave-types')); ?>">Leave Types</a></li>
        <li><a href="<?php echo e(URL('/admin/add-leave-type')); ?>">Add Leave Types</a></li>
        <li><a href="<?php echo e(URL('/admin/leave-listing')); ?>">Leave Listing</a></li>
        <li><a href="<?php echo e(URL('/admin/holidays')); ?>">Holidays List</a></li>
        <li><a href="<?php echo e(URL('/admin/add-holiday')); ?>">Add Holiday</a></li>
        <li><a href="<?php echo e(URL('/admin/holiday-calender')); ?>">Holiday Calender</a></li>
      </ul>
    </li>


    <li class="droplink <?php echo e(setActive('admin/eods')); ?> "><a href="#" class="waves-effect waves-button"><span class="menu-icon fa fa-book"></span><p>EODs</p><span class="arrow"></span></a>
      <ul class="sub-menu">
        <li><a href="<?php echo e(URL('/admin/eods')); ?>">Eod List</a></li>
      </ul>
    </li>



    <li class="droplink <?php echo e(setActive('admin/resignations')); ?>"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-briefcase"></span><p>Resignations</p><span class="arrow"></span></a>
      <ul class="sub-menu">
        <li><a href="<?php echo e(URL('/admin/resignations')); ?>">Resignation List</a></li>

      </ul>
    </li>

    

      <li class="droplink <?php echo e(setActive('admin/request/profile-update')); ?>"><a href="#" class="waves-effect waves-button"><span class="menu-icon fa fa-inbox"></span><p>Requests</p><span class="arrow"></span></a>
        <ul class="sub-menu">
          <li><a href="<?php echo e(URL('/admin/request/profile-update')); ?>">Profile Update Requests</a></li>
          <li><a href="<?php echo e(URL('/admin/leave-listing?type=pending')); ?>">Leave Requests</a></li>
        </ul>
      </li>

      
      
    </ul>
  </div><!-- Page Sidebar Inner -->
      </div><!-- Page Sidebar -->