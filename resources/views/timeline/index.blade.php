@extends('templates.default')

@section('content')

<div class="container mt-2 mb-2">

	<div class="row mb-3">
		<div class="col-12 mt-4">
			<div class="card ">
				<form role="form" action="{{route('status.post')}}" method="post" enctype="multipart/form-data">
					<div class="card-header bg-dark">
						<div class="image-upload">
						    <input class="btn btn-outline-info" id="file-input" name="statusImageUpload" type="file"/>
						</div>
					</div>
					<div class="card-body">

						<div class="form-group{{ $errors->has('status') ? ' has-error' : ''}}">
							<textarea placeholder="What's up {{Auth::user()->getFirstNameorUsername()}}?" name="status" class="form-control txtAreaStatus mt-4 border-1" rows="2"></textarea>

							@if($errors->has('status'))
								<span class="help-block">{{ $errors->first('status')}}</span>
							@endif

						</div>


						<input type="hidden" name="_token" value="{{ Session::token()}}">

					</div>
					
						<button type="submit" class="btn btn-primary btn-sm pb-2 mb-3 mr-2  ml-2 float-right">Post Status</button>
				
				</form>
			</div>

		</div>
	</div>
	<hr class="lineStyle">
	<div class="row">
		<div class="col-lg-8">
			<!-- Timeline statuses and replies -->
			<div class="card">
				<div class="card-body bg-dark">
					<h4 class="text-primary font-weight-bold text-light">Posts</h4>
				</div>
				
			</div>
			@if(!$statuses->count())

				<p>There is nothing in your timeline,yet.</p>

			@else
				@foreach($statuses as $status)
				<div class="card mb-3 mt-3 pt-3 pb-3 pl-3 pr-4 bg-light timelineFontStyle">
					<div class="media">
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
										<li class="list-inline-item"><a href="{{ route('status.unlike', ['statusId' => $status->id ])}}">UnLike</a></li>
											
										<li class="list-inline-item"><a href="{{ route('status.report', ['statusId'=>$status->id])}}">Report This Post</a></li>
										
										

										<li >{{ $status->likes->count() }} {{str_plural('like', $status->likes->count()) }}</li>
										
									@else
										<li class="list-inline-item"><a href="{{ route('status.like', ['statusId' => $status->id ])}}">Like</a></li>

										<li class="list-inline-item"><a href="{{ route('status.report', ['statusId'=>$status->id])}}">Report This Post</a></li>

										<li>{{ $status->likes->count() }} {{str_plural('like', $status->likes->count()) }}</li>
									@endif

								@else
									<li class="list-inline-item"><a href="{{ route('status.delMyPost',['delStatusId' => $status->id])}}">Delete</a></li>		

								@endif
									
		
							</ul>


								@foreach ($status->replies as $reply)
									<div class="media">
										<a class="pull-left" href="{{ route('profile.index', ['username' =>$status->user->username]) }}">
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
							

							<form role ="form" action="{{ route('status.reply', ['statusId' => $status->id ] ) }}" method="post">

								<div class="form-group{{ $errors->has("reply-{$status->id}") ? ' has-error': ''}}">

									<textarea name="reply-{{ $status->id}}" class="form-control txtAreaStatus" rows="1" placeholder="Reply to this status"></textarea>

								@if($errors->has("reply-{$status->id}"))
									<span class="help-block">{{ $errors->first("reply-{$status->id}")}}</span>
								@endif
								</div>
								
								

								<input type="submit" value="Reply" class="btn btn-primary btn-sm">
								
								<input type="hidden" name="_token" value="{{ Session::token() }}">
							</form>
						</div>

					</div>
				
				</div>

				@endforeach

				{!!$statuses->render()!!}

			@endif
			
		</div>

		<div class="col-4">
			<div class="card">
				<div class="card-body bg-dark">
					<h4 class="text-primary font-weight-bold text-light">Friends</h4>
				</div>
				
				<div class="ml-3 mb-3">
					
					<h4 class="text-dark mt-2">{{ Auth::user()->getFirstNameOrUsername() }}'s friends</h4>
					<hr>

						@if(!Auth::user()->friends()->count())

						<p>{{ Auth::user()->getFirstNameOrUsername() }} has no friends.</p>

						@else
							@foreach(Auth::user()->friends() as $user)
								@include('user/partials/userblock')
							@endforeach
						@endif

				</div>
			</div>
			
		</div>
		
	</div>
	
</div>
	
@stop