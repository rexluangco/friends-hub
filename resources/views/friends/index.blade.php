@extends('templates.default')

@section('content')

<div class="container">
	<hr>
	<div class="row mt-4 mb-4">
		<div class="col-9">
			<!-- user information -->
			<div class="card">
				<div class="card-header">
					<h3 class="font-weight-bold">Your Friends</h3>
				</div>
				<div class="card-body">
					@if(!$friends->count())
						<p >You have no friends.</p>

					@else
						
							@foreach($friends as $user)
								<div class="row">
									<div class="col-6">
										<div class="thumbnail">
										@include('user/partials/userblock')
									</div>
									</div>
								</div>
								<hr>
							@endforeach
						
					@endif
				</div>
			</div>
			
		</div>
	
		<div class="col-3 ">
			<!-- friends and frnd requests -->
			<div class="card">
				<div class="card-header">
					<h4 class="font-weight-bold">Friend Requests</h4>
				</div>
			</div>
			<div class="card-body">
				@if(!$requests->count())
					<p>You have no friend requests.</p>
				@else

				@foreach($requests as $user)
					@include('user.partials.userblock')
				@endforeach

				@endif
			</div>

		</div>

	</div>
	
</div>




@stop