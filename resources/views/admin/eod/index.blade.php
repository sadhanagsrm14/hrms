@extends('admin.layouts.app')

@section('content')

@section('title','EODs')



<div class="page-inner">

	<div class="page-title">

		<h3>EODs</h3>

		<div class="page-breadcrumb">

			<ol class="breadcrumb">

				<li><a href="{{URL('/admin/dashboard')}}">Home</a></li>

				<li class="active">All EODs</a></li>

			</ol>

		</div>

	</div>

	<div id="main-wrapper">

		<div class="row">

			<div class="col-md-12">

				@if (session('success'))

				<div class="alert alert-success">

					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

					{{ session('success') }}

				</div>

				@endif

				@if (session('error'))

				<div class="alert alert-danger">

					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

					{{ session('error') }}

				</div>

				@endif

				<div class="panel panel-white">

					<div class="panel-heading clearfix">

						<!-- <h4 class="panel-title">Sent EODs</h4> -->

					</div>
                      <div class="panel">
						<form action="{{url('admin/eods')}}" method="post">
							{{ csrf_field() }}
					Filter:-
                    <select name="filter">
                    	<option>--select--</option>
                    	{{$eods_filter}}
						 @foreach($eods_filter as $name)
						  
						<option value="{{$name->project_id}}">{{getProject($name->project_id)->name}}</option>
						 
						 @endforeach
                       
                          
                            
                       
						</select>
						<input type="submit" value="GO">
                         </form>
					</div>
					<div class="panel-body">

						<div class="table-responsive table-remove-padding">

							<table class="table" id="datatable">

								<thead>

									<tr>
                                        <th>Date</th>
										<th>Employee</th>

										

										<th>Project Name</th>

										<th>Hours Spent</th>

										<th>Task</th>

										<th>Comment</th>

										<th>Action</th>

									</tr>

								</thead>

								<tbody>

									@foreach($eods as $eod)

									<tr>

										<td>{{$eod->date_of_eod}}</td>

										<td><a href="{{URL('/admin/employee/profile/'.$eod->user_id)}}">{{getUserById($eod->user_id)->first_name}}</a></td>

										<td><a href="{{url('/admin/project/'.$eod->project_id)}}">{{getProject($eod->project_id)->name}}</a></td>

										<td>{{$eod->hours_spent}}</td>

										<td>{{substr($eod->task, 0, 30)}}</td>

										<td>

											@if(is_null($eod->comment))

											<b>N/A</b>

											@else

											{{$eod->comment}}

											@endif

										</td>

										<td>
                                            <button class="btn btn-info btn-sm eod_details" rel="{{ $eod->id }}">  See Details </button> 
											<a href="{{URL('admin/eod/delete/'.$eod->id)}}" class="btn btn-danger">Delete</a>

										</tr>

										@endforeach

									</tbody>

								</table>

							</div>
							{{--<div class="row">
								<div class="col-md-6">Showing {{$eods->firstItem()}} to {{$eods->lastItem()}} of {{$eods->total()}} entries</div> 
								<div class="col-md-6 pull-right">{{ $eods->links() }}</div> 
							
							</div>--}}

						</div>

					</div>

				</div>

			</div><!-- Row -->

		</div><!-- Main Wrapper -->

		<div class="page-footer">

			<p class="no-s">{{date('Y')}} &copy; Coding Brains Software Solution Pvt Ltd.</p>

		</div>

	</div><!-- Page Inner -->


	<!-- Modal -->
	<div id="eodModel" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Employee EOD Details</h4>
	      </div>
	      <div class="modal-body" id="eodModelDetails">
	            
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

	@section('script')
    <script type="text/javascript">

		$(document).ready(function(){ 
			 $(document).on('click','.eod_details',function(){  
			 	var id = $(this).attr('rel');
			 	    $.ajax({
			 	    	url:"{{route('admin.eod_details')}}", 
			 	    	type:"GET",
			 	    	data:{id:id},
			 	    	success:function(res){ 
			 	    		$('#eodModelDetails').html(res); 
			                $('#eodModel').modal('show');  
			 	    	}
			 	    });
		     });
		});
		
	</script>
	@endsection

	@endsection