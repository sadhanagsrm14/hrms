@extends('hrManager.layouts.app')

@section('content')

@section('title','Dashboard')





<div class="page-inner">

	<div class="page-title">

		<h3>Dashboard</h3>

		<div class="page-breadcrumb">

			<ol class="breadcrumb">

				<li><a href="{{URL('/hrManager/dashboard')}}">Home</a></li>

				<li class="active">Dashboard</li>

			</ol>

		</div>

	</div>

	<div id="main-wrapper">

		<div class="row" id="dashboard">

			<div class="col-lg-3 col-md-6">

				<a href="{{URL('/hrManager/employees?type=active')}}" title="" class="weight-hover">

					<div class="panel info-box panel-white">

						<div class="panel-body">

							<div class="info-box-icon">

								<i class="icon-users"></i>

							</div>

							<div class="info-box-stats">

								<span class="info-box-title">Active Employees</span>
                                <span class="white">{{count($employees)}}</span>
							</div>



						</div>

					</div>

				</a>

			</div>



			<div class="col-lg-3 col-md-6">

				<a href="{{URL('/hrManager/leave-listing?type=pending')}}" title="" class="weight-hover">

					<div class="panel info-box panel-white">

						<div class="panel-body">

							<div class="info-box-icon">

								<i class="icon-users"></i>

							</div>

							<div class="info-box-stats">

								

								<span class="info-box-title">Leave Requests</span>
                                 <span class="white" >{{count($leaves)}}</span>
							</div>

							

							

						</div>

					</div>

				</a>

			</div>



			<div class="col-lg-3 col-md-6">

				<a href="{{URL('/hrManager/request/profile-update')}}" title="" class="weight-hover">

					<div class="panel info-box panel-white">

						<div class="panel-body">

							<div class="info-box-icon">

								<i class="icon-users"></i>

							</div>

							<div class="info-box-stats">

								

								<span class="info-box-title">Profile Update Requests</span>
								 <span class="white" >{{count($profile_requests)}}</span>

							</div>

							

							

						</div>

					</div>

				</a>

			</div>



			<!--add new div -->

			<div class="col-lg-3 col-md-6">

				<a href="https://drive.google.com/drive/" title="" class="weight-hover">

					<div class="panel info-box panel-white">

						<div class="panel-body">

							<div class="info-box-icon">

								<i class="fa fa-google"></i>

							</div>

							<div class="info-box-stats">

								

								<span class="info-box-title">Google Drive</span>

							</div>

							

							

						</div>

					</div>

				</a>

			</div>

			<div class="col-lg-3 col-md-6">

				<a href="#" data-toggle="modal" data-target="#myModal-changepass" title="" class="weight-hover">

					<div class="panel info-box panel-white">

						<div class="panel-body">

							<div class="info-box-icon">

								<i class="icon-pencil"></i>

							</div>



							<div class="info-box-stats">

								

								<span class="info-box-title">Change password</span>

							</div>

							

							



						</div>

					</div>

				</a>

			</div>



			<div class="col-lg-3 col-md-6">

				<a href="{{URL('/hrManager/holiday-calender')}}" title="" class="weight-hover">

					<div class="panel info-box panel-white">

						<div class="panel-body">

							<div class="info-box-icon">

								<i class="fa fa-calendar"></i>

							</div>

							<div class="info-box-stats">

								

								<span class="info-box-title">Holiday Calender</span>

							</div>

							

						</div>

					</div>

				</a>

			</div>



			<!--add new div -->

			<div class="col-lg-3 col-md-6">

				<a href="{{URL('/hrManager/attendance')}}" title="" class="weight-hover">

					<div class="panel info-box panel-white">

						<div class="panel-body">

							<div class="info-box-icon">

								<i class="icon-users"></i>

							</div>

							<div class="info-box-stats">

								

								<span class="info-box-title">Attendance</span>

							</div>

							

							

						</div>

					</div>

				</a>

			</div>

			<div class="col-lg-3 col-md-6">

				<a href="{{URL('/profile')}}" title="" class="weight-hover">

					<div class="panel info-box panel-white">

						<div class="panel-body">

							<div class="info-box-icon">

								<i class="icon-eye"></i>

							</div>

							<div class="info-box-stats">

								

								<span class="info-box-title">View Profile</span>

							</div>

							

							

						</div>

					</div>

				</a>

			</div>





            <!--add new div --->

			

        </div><!-- Row -->

    </div>





    <div class="page-footer">

    	<p class="no-s">{{date('Y')}} &copy; Coding Brains Software Solution Pvt Ltd.</p>

    </div>

</div><!-- Page Inner -->

@section('script')



{{ Html::script("assets/plugins/waypoints/jquery.waypoints.min.js") }}

{{ Html::script("assets/plugins/jquery-counterup/jquery.counterup.min.js") }}

{{ Html::script("assets/plugins/toastr/toastr.min.js") }}

{{ Html::script("assets/plugins/flot/jquery.flot.min.js") }}

{{ Html::script("assets/plugins/flot/jquery.flot.time.min.js") }}

{{ Html::script("assets/plugins/flot/jquery.flot.symbol.min.js") }}

{{ Html::script("assets/plugins/flot/jquery.flot.resize.min.js") }}

{{ Html::script("assets/plugins/flot/jquery.flot.tooltip.min.js") }}

{{ Html::script("assets/plugins/curvedlines/curvedLines.js") }}

{{ Html::script("assets/plugins/metrojs/MetroJs.min.js") }}

{{ Html::script("assets/js/pages/dashboard.js") }}

@endsection

@endsection

