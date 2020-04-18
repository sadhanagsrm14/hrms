@extends('itExecutive.layouts.app')

@section('content')

@section('title','Dashboard')





<div class="page-inner">

	<div class="page-title">

		<h3>Dashboard</h3>

		<div class="page-breadcrumb">

			<ol class="breadcrumb">

				<li><a href="{{URL('/')}}">Home</a></li>

				<li class="active">Dashboard</li>

			</ol>

		</div>

	</div>

	<div id="main-wrapper">

		<div class="row" id="dashboard">

			

			<div class="col-lg-4 col-md-6">

				<a href="{{URL('/itExecutive/assets/all_assets')}}" class="weight-hover">

					<div class="panel info-box panel-white">

						<div class="panel-body">

							<div class="info-box-icon">

								<i class="fa fa-th-list"></i>

							</div>

							<div class="info-box-stats">

								<span class="info-box-title">Asset List</span>

							</div>

						</div>

					</div>

				</a>

			</div>



			<div class="col-lg-4 col-md-6">

				<a href="{{URL('/itExecutive/assets/all_system')}}" class="weight-hover">

					<div class="panel info-box panel-white">

						<div class="panel-body">

							<div class="info-box-icon">

								<i class="fa fa-cogs"></i>

							</div>

							<div class="info-box-stats">

								<span class="info-box-title">System List</span>

							</div>

						</div>

					</div>

				</a>

			</div>



			<div class="col-lg-4 col-md-6">

				<a href="#" data-toggle="modal" data-target="#myModal" title="" class="weight-hover">

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



			<div class="col-lg-4 col-md-6">

				<a href="{{URL('/itExecutive/holiday-calender')}}" title="" class="weight-hover">

					<div class="panel info-box panel-white">

						<div class="panel-body">

							<div class="info-box-icon">

								<i class="fa fa-calendar"></i>

							</div>

							<div class="info-box-stats">



								<span class="info-box-title">Holiday Calender / Attendance</span>

							</div>



						</div>

					</div>

				</a>

			</div>









			<div class="col-lg-4 col-md-6">

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



			<div class="col-lg-4 col-md-6">

				<a href="{{URL('/logout')}}" title="" class="weight-hover">

					<div class="panel info-box panel-white">

						<div class="panel-body">

							<div class="info-box-icon">

								<i class="fa fa-sign-out m-r-xs"></i>

							</div>

							<div class="info-box-stats">

								<span class="info-box-title">Logout</span>

							</div>

						</div>

					</div>

				</a>

			</div>

		</div>

	</div><!-- Main Wrapper -->

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

