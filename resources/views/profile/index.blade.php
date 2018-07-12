@extends('templates.default')

@section('content')
<hr>
<div class="container-fluid mt-4 mb-4">
	<div class="row">
			<div class="col-3">
				<div class="card profile">
					<div class="card-header">
						<p class="text-info font-weight-bold">My Profile</p>
					</div>

					<div class="card-body">
						<div class="media mt-2 mb-2">
							<a class="pull-left" href="{{ route('profile.index', ['username'=>$user->username])}}">
								<img class="media-object prof_image"  alt="{{ $user->getNameOrUsername() }}" src="/storage/prof_images/{{$user->avatar}}">

							</a>

							<div class="media-body ml-2">
								<h4 class="media-heading"><a href="{{ route('profile.index', ['username'=>$user->username])}}">{{ $user->getNameOrUsername() }}</a></h4>
								@if($user->getCivilStatus())
									<p><small>{{ $user->getCivilStatus() }}</small></p>
								@endif

								@if($user->getLocation())
									<p><small>Lives in {{ $user->getLocation() }}</small></p>
								@endif

							</div>
						</div>

							<div class="row">
								<div class="col-12">
									<i class="fa fa-globe-asia">&nbspIntro:</i>
									<hr class="prof_lineStyle">
									@if($user->getIntro())
										<q class="intro">{{ $user->getIntro()}}</q>
									@endif
									<hr class="prof_lineStyle">		
								</div>
							</div>
					</div>
				</div>
			</div>
		<div class="col-9">
			<img class="cover_photo" src="/storage/cover_images/{{$user->cover_image}}">

			<form method="post" action="{{route('profile.index',['username'=>$user->username])}}" 
				enctype="multipart/form-data">
				
				<div class="uploadCoverPhoto">
					<label for="upload_coverPhoto">
						    <i class="fa fa-camera-retro fa-2x"></i>
					</label>

					<input class="btn btn-sm btn-outline-warning" type="file" name="cover_image" id="upload_coverPhoto" onchange="form.submit()" />
				</div>
			<input type="hidden" name="_token" value="{{ csrf_token()}}">

			</form>
		</div>

	</div>
	<hr class="profile-separator">
	<div class="row">
				<div class="col-3">

			<div class="card mt-3 mb-3">
				<div class="card-header">
					<p  class="text-info font-weight-bold">Friends and Friend Requests</p>
				</div>
				<div class="card-body">
					@if(Auth::user()->hasFriendRequestPending($user))
				<p>Waiting for {{ $user->getFirstNameOrUsername() }} to accept your request.</p>
				@elseif (Auth::user()->hasFriendRequestReceived($user))
			
				<a href="{{ route('friend.accept',['username'=> $user->username ])}}" class="btn btn-primary">Accept Friend request.</a>

				@elseif (Auth::user()->isFriendsWith($user))
				
				<p>You and {{$user->getNameOrUsername()}} are friends.</p>

				<form action="{{ route('friend.delete' ,['username' => $user->username])}}" method="post">
					<input type="submit" value="Delete Friend" class="btn btn-danger">
					<input type="hidden" name="_token" value="{{ csrf_token()}}">

				</form>

			@elseif (Auth::user()->id !== $user->id)

			<a href="{{route('friend.add',['username'=>$user->username])}}" class="btn btn-primary">Add as friend</a>
		
			@endif

			<h4>{{ $user->getFirstNameOrUsername() }}'s friends.</h4>


			@if(!$user->friends()->count())
			<p>{{ $user->getFirstNameOrUsername() }} has no friends.</p>
			@else
			@foreach($user->friends() as $user)
				@include('user/partials/userblock')
			@endforeach

			@endif
					
				</div>
				
			</div>
	
		</div>
		<div class="col-9">
			<!-- end of status -->

			@if(!$statuses->count())
					<p> You have not posted anything yet.</p>
					@else
						@foreach($statuses as $status)
						<div class="card mt-3 mb-3">
							<div class="media ml-3 mt-3 mb-3">
								<a class="pull-left" href="{{ route('profile.index', ['username' =>$status->user->username]) }}">

									<img class="media-object prof_image mr-2" alt="{{ $status->user->getNameOrUsername()}}" src="/storage/prof_images/{{ $status->user->avatar}}">

								</a>
								
								<div class="media-body">
									<h4 class="media-heading">
										<a href="{{ route('profile.index', ['username' =>$status->user->username])}}">{{ $status->user->getNameOrUsername() }}</a>
									</h4>

									<p>
										{{ $status->body }}
									</p>
									
									@if($status->statusImageUpload == null )
									@else
									
										<div class="row mt-2 mb-2">
												<div class="col-12">
													<img class="thumbnail"  src="/storage/images/{{$status->statusImageUpload}}">
												</div>
										</div>
									@endif

									<ul class="list-inline">
										<li>{{ $status->created_at->diffForHumans() }}</li>
										

										@if ($status->user->id !==  Auth::user()->id)
											
											@if(Auth::user()->hasLikedStatus($status))
												<li><a href="{{ route('status.unlike', ['statusId' => $status->id ])}}">UnLike</a></li>
											@else
												<li><a href="{{ route('status.like', ['statusId' => $status->id ])}}">Like</a></li>
											@endif
										@endif
											
											<li>{{ $status->likes->count() }} {{str_plural('like', $status->likes->count()) }}</li>
										
									</ul>


										@foreach ($status->replies as $reply)
											<div class="media">
												<a class="pull-left" href="{{ route('profile.index', ['username' =>$reply->user->username]) }}">
													<img class="media-object prof_image mr-2" alt="{{ $reply->user->getNameOrUsername()}}" src="/storage/prof_images/{{ $reply->user->avatar}}">
												</a>
												<div class="media-body">
													<h5 class="meadia-heading">
														<a href="{{ route('profile.index', ['username' =>$reply->user->username]) }}">{{ $reply->user->getNameOrUsername() }}</a>
													</h5>
													<p>
														{{ $reply->body }}
													</p>
													<ul class="list-inline">
														<li>{{ $reply->created_at->diffForHumans() }}</li>
														
														@if ($reply->user->id !==  Auth::user()->id)
															@if(Auth::user()->hasLikedStatus($reply))
																<li><a href="{{ route('status.unlike', ['statusId' => $reply->id ])}}">UnLike</a></li>
															@else

																<li><a href="{{ route('status.like', ['statusId' => $reply->id ])}}">Like</a></li>
															@endif
																					
														@endif
														<li>{{ $reply->likes->count() }} {{str_plural('like', $reply->likes->count()) }}</li>
													</ul>
												</div>

											</div>

										@endforeach
									
										@if($authUserIsFriend || Auth::user()->id === $status->user->id)

											<form role ="form" action="{{ route('status.reply', ['statusId' => $status->id ] ) }}" method="post">

												<div class="form-group{{ $errors->has("reply-{$status->id}") ? ' has-error': ''}}">

													<div class="col-11">
														<textarea name="reply-{{ $status->id}}" class="form-control txtAreaStatus" rows="1" placeholder="Reply to this status"></textarea>
													</div>
													

												@if($errors->has("reply-{$status->id}"))
													<span class="help-block">{{ $errors->first("reply-{$status->id}")}}</span>
												@endif
												</div>
												
												

												<input type="submit" value="Reply" class="btn btn-primary btn-sm">
												
												
												<input type="hidden" name="_token" value="{{ Session::token() }}">
											</form>
										@endif
								</div>

							</div>
						</div>
						@endforeach

					@endif

				
			
				

		</div>


	</div>
	
</div>

@stop