
@extends('templates.default')

@section('content')
<hr>
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header bg-dark">
					<h3 class="font-weight-bold text-light"><i class="fa fa-ban fa-lg"></i>&nbspReport User</h3>
				</div>
					<form method="post" action="{{ route('status.report_user',['statusId'=> $findReportedStatuses->id])}}">
						<div class="card-body">
							<div class="row">
								<div class="col-6">
									<div class="media mt-2 mb-2">
										<a class="pull-left" href="{{ route('profile.index', ['username'=> $users->username])}}">
											<img class="media-object prof_image"  alt="{{ $users->getNameOrUsername() }}" src="/storage/prof_images/{{ $users->avatar}}">

										</a>

										<div class="media-body ml-2">
											<h4 class="media-heading"><a href="{{ route('profile.index', ['username'=> $users->username])}}">{{ $users->getNameOrUsername() }}</a></h4>
											
											@if($users->getCivilStatus())
												<p>{{ $users->getCivilStatus() }}</p>
											@endif

											@if($users->getLocation())
												<p>Lives in {{ $users->getLocation() }}</p>
											@endif

										</div>
									</div>

								</div>
								<div class="col-6">
									
								</div>
							</div>
							<div class="row">
								<div class="col-6">
									
								</div>
								<div class="col-6">
		
								</div>
								
							</div>

						<hr class="profile-separator">
							<ul class="list-inline">
								<li class="list-inline-item"><small class="text-primary">{{$users->getNameorUsername()}}</small></li> |
								<li class="list-inline-item"><small class="text-primary">{{$users->getLocation()}}</small></li>
							</ul>
						<hr>
							<div class="row mt-3 mb-3">
								<div class="col-7">
									<div class="card">
										<div class="card-header">
											<ul class="list-inline">
												<li class="list-inline-item font-weight-bold">Status Details</li> |
												<li class="list-inline-item"><small>Date:&nbsp{{$findReportedStatuses->created_at}}</small></li>
											</ul>
										</div>
										<div class="card-body">
											<p class="text-justify">{{ $findReportedStatuses->body }}</p>

										</div>
									</div>
									
								</div>
								<div class="col-5">
									
										@if($findReportedStatuses->statusImageUpload)
											<img class="reported-image" src="/storage/images/{{$findReportedStatuses->statusImageUpload}}">
										@else
											<p>No file attaced to this post.</p>
										@endif
									
									
								</div>
								
							</div>

							<div class="row">
								<div class="col-6">
									
								</div>
								<div class="col-6">
									<label for="blockReasons">Why you want to report this user?</label>
									<select class="form-control" name="blockReasons" id="blockReasons">
										<option value="Copyright Infringement">Copyright Infringement</option>
										<option value="Racist or Hateful Post">Racist/Hateful Post</option>
										<option value="Nudity or Pornographic">Nudity/Pornographic</option>
										<option value="Spamming">Spamming</option>
										<option value="Potential Fake Account">Potential Fake Account</option>
									</select>
									
								</div>
							</div>


						<div class="form-group mt-3">
							<button type="submit" class="btn btn-danger btn-md float-right mr-2 mb-3" >Submit</button>
							<input type="hidden" name="_token" value="{{ Session::token() }}">		
						</div>
						</div>
				</form>
			</div>
		</div>

		<div class="col-3">

		</div>
		
	</div>
</div>
@stop