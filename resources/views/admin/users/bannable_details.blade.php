@extends('admin.default')
@section('adminContent')

<div class="container  mb-4">
	<h3>Reported User's List</h3>
	<hr>
	<div class="row">

		<div class="col-6">
			<div class="card">
				<div class="card-header bg-dark">
					<p class="text-light">USER INFO:</p>
				</div>

			<ul class="list-group list-group-flush">
			  <li class="list-group-item"><span class="font-weight-bold mr-2">Name:</span>{{ $bannableUsers->first_name}} {{ $bannableUsers->last_name}}</li>

			  <li class="list-group-item"><span class="font-weight-bold mr-2">Username:</span>{{ $bannableUsers->username}}</li>

			  <li class="list-group-item"><span class="font-weight-bold mr-2">Email Address:</span>{{ $bannableUsers->email}}</li>

			  <li class="list-group-item"><span class="font-weight-bold mr-2">Civil Status:</span>{{ $bannableUsers->civil_status}}</li>
			  <li class="list-group-item"><span class="font-weight-bold mr-2">Location:</span>{{ $bannableUsers->location}}</li>
			  <li class="list-group-item"><span class="font-weight-bold mr-2">Intro:</span>{{ $bannableUsers->intro}}</li>

			</ul>
			</div>
		</div>
		<div class="col-6">
			<div class="card">
				<div class="card-header bg-dark">
					<p class="text-light">INCIDENT REPORT/S:</p>
				</div>

					<table class="table">
						<tr>
							<th>Reported By</th>
							<th>Reported For</th>
							<th>Report Log</th>
						</tr>
					
					@if(count($statusBannables) < 1)
						<tr>
							<td>No record found.</td>
						</tr>
					@else
						@foreach($statusBannables as $status_bannable)
						
						<tr>
							<td>{{ $status_bannable->reportedBy}}</td>
							<td>{{ $status_bannable->reportedFor}}</td>
							<td>{{ $status_bannable->updated_at}}</td>
						</tr>
						@endforeach
					@endif
					</table>
				
			</div>
			

		</div>
	</div>

	

	<div class="container">
		@if(count($statusBannables) > 0)
			<hr>
			<h4 class="font-weight-bold">REPORTED POST</h4>
			<div class="card-header">
				<p><span class="text-danger">WARNING!</span><small class="text-danger">&nbsp&nbspOnce submitted, you cannot undo the changes that you have made.</small></p>
			</div>
			<hr>
			@foreach($statusBannables as $postBannable)
				<div class="card mt-2 mb-2">
					<div class="card-header bg-dark text-light">
						<ul class="list-inline">
							<li class="list-inline-item">POST DETAILS</li> |
							<li class="list-inline-item"><small>Status Date: {{ $postBannable->created_at }}</small></li> |
							<li class="list-inline-item"><small>Reported for {{ $postBannable->reportedFor }}</small></li>
							<li class="list-inline-item text-warning">
								
									<small>
										<a href="{{route('admin.bannablePost',['bannableId'=> $postBannable->bannable_id ])}}">Invalid Report</a>
									</small>

								
							
							</li> |

							<li class="list-inline-item text-warning">
								<small>
									<a href="{{route('admin.bannablePostInTimeline',['bannableId' => $postBannable->bannable_id])}}">Valid Report</a>
								</small>

							</li>

						</ul>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-8">
								<q>{{ $postBannable->body }}</q>
							</div>
							<div class="col-4">
								@if($postBannable->statusImageUpload)
									<img class="reported_image_admin" src="/storage/images/{{$postBannable->statusImageUpload}}">
									
								@else
									<p>No image attached to this post.</p>
								@endif
							</div>
							
						</div>
						
						

					</div>
				</div>			
			@endforeach
		@else
			<div class="jumbotron">
				<h3>No record found.</h3>
			</div>
		@endif
	</div>	
	

	<hr>
	@if(count($statusBannables) > 0 )
	<div class="card">
		<form method="post" action="{{ route('admin.deleteOptions',['userId'=> $bannableUsers->id])}}">

			<div class="card-body">
				<label for="banUserValidation"><h5 class="font-weight-bold">OTHER ACTION:</h5></label>
				 <div class="form-check">
				  
					  <input type="checkbox" class="form-check-input" id="exampleCheck1" name="delUser1" value="delUser1">
					   <label class="form-check-label" for="exampleCheck1">Delete User's Account</label>
				</div>
				

			</div>
			<div class="card-footer">
				<ul class="list-inline">
					<li class="list-inline-item ">
						<button type="submit" class="btn btn-warning btn-md"><i class="fa fa-save"></i>&nbsp Submit</button>
						<input type="hidden" name="_token" value="{{ Session::token() }}">
					</li>
				</ul>
			</div>
		</form>
	</div>
	@else
	@endif

</div>
@endsection