      <div class="page-sidebar sidebar">
      	<div class="page-sidebar-inner slimscroll">
      		<div class="sidebar-header">
      			<div class="sidebar-profile">
      				<a href="javascript:void(0);" id="profile-menu-link">
      					<div class="sidebar-profile-image">
      						<img src="assets/images/profile-menu-image.png" class="img-circle img-responsive" alt="">
      					</div>
      					<div class="sidebar-profile-details">
      						<span>David Green<br><small>Art Director</small></span>
      					</div>
      				</a>
      			</div>
      		</div>

      		<ul class="menu accordion-menu">
      			<li class=""><a href="index-2.html" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>

                        <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-briefcase"></span><p>Employees</p><span class="arrow"></span></a>
                              <ul class="sub-menu">
                                    <li><a href="<?php echo e(URL('/admin/employees')); ?>">Employee Listing</a></li>
                                    <li><a href="<?php echo e(URL('/admin/add-employee')); ?>">Add New Employee</a></li>
                                    <li><a href="<?php echo e(URL('/admin/upload-employee')); ?>">Upload</a></li>
                              </ul>
                        </li>

                        <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-briefcase"></span><p>Project</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                              <li><a href="<?php echo e(URL('/admin/projects')); ?>">Project List</a></li>
                              <li><a href="<?php echo e(URL('/admin/add-project')); ?>">Add New</a></li>
                        </ul>
                  </li>

                  <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-briefcase"></span><p>Holidays</p><span class="arrow"></span></a>
                      <ul class="sub-menu">
                        <li><a href="<?php echo e(URL('/admin/holidays-list')); ?>">Holiday List</a></li>
                  </ul>
            </li>

            <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-briefcase"></span><p>Attendance / Leave</p><span class="arrow"></span></a>
                <ul class="sub-menu">
                  <li><a href="<?php echo e(URL('/admin/attendance')); ?>">attendance List</a></li>
                  <li><a href="<?php echo e(URL('/admin/create-invitation')); ?>">Create attendance</a></li>
            </ul>
      </li>

      <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-briefcase"></span><p>Meeting Invitation</p><span class="arrow"></span></a>
          <ul class="sub-menu">
            <li><a href="<?php echo e(URL('/admin/inivitations')); ?>">Invitation List</a></li>
            <li><a href="<?php echo e(URL('/admin/create-invitation')); ?>">Create Invitation</a></li>
      </ul>
</li>
</ul>
</div><!-- Page Sidebar Inner -->
      </div><!-- Page Sidebar -->