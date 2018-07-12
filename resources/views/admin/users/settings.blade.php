@extends('admin.default')
@section('adminContent')

<div class="container">

	<h4 class="text-primary"><i class="fa fa-user-cog"></i>&nbspUser Profile</h4>
	<hr>
	
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header bg-dark">
						<h5 class="font-weight-bold text-light"><i class="fa fa-info-circle fa-lg"></i>&nbspUSER: {{ $users->first_name }} {{$users->last_name}}</h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-6">
								<p class="form-control"><span class="font-weight-bold">USERNAME:</span>&nbsp{{ $users->username}}</p>
								<p class="form-control"><span class="font-weight-bold">EMAIL ADD:</span>&nbsp{{ $users->email}}</p>
								<p class="form-control"><span class="font-weight-bold">LOCATION:</span>&nbsp{{ $users->location}}</p>						
							</div>
							<div class="col-6">
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header bg-dark">
						<h5 class="font-weight-bold text-light"><i class="fa fa-clipboard-list fa-lg
"></i>&nbspPOSTS</h5>
					</div>
					<div class="card-body">
						
						@if(count($statuses) > 0 )	
							<div class="table-responsive">
									<table class=" table table-hover">
										<tr>
											<th>All Statuses</th>
											<th>Attachment</th>
											<th>Post Since</th>
											<th>Likes</th>
											

										</tr>

									@foreach($statuses as $status)
										<tr>
											<td>{{ $status->body}}</td>
											<td>
												@if($status->statusImageUpload)
													{{ $status->statusImageUpload}}
												
												@else
													No attached file/image.
												@endif

											</td>
											<td>{{ $status->created_at->diffForHumans()}}</td>
											<td>{{ $status->likes->count() }}</td>
											
										</tr>
									@endforeach
									</table>
							</div>
							
						@else
							<p>No posts found.</p>
						@endif
					</div>
				</div>
				<div class="card-footer">
					<small>FriendsHub Inc/rpluangcodev</small>
				</div>
			</div>
		</div>


</div>

@endsection