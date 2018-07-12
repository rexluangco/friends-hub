@extends('admin.default')
@section('adminContent')


<div class="container">
	<div class="jumbotron">
		<h3>Results for: "{{ Request::input('searchForBannableUsers')}}"</h3>
	</div>
	<div class="row">
		<div class="col-6">
			@if(!$bannableUsers->count())
				<h5>Sorry.No record found.</h5>
			@else
				@foreach($bannableUsers as $bannableUser)

					<div class="media mt-2 mb-2">
						
							<img class="media-object prof_image"  alt="{{ $bannableUser->getNameOrUsername() }}" src="/storage/prof_images/{{$bannableUser->avatar}}">

						<div class="media-body ml-2">
							<h4 class="media-heading"><a href="{{ route('admin.bannable_details',['userId'=> $bannableUser->id])}}">{{ $bannableUser->getNameOrUsername() }}</a></h4>
							@if($bannableUser->getCivilStatus())
								<p>{{ $bannableUser->getCivilStatus() }}</p>
							@endif

							@if($bannableUser->getLocation())
								<p>Lives in {{ $bannableUser->getLocation() }}</p>
							@endif

						</div>
					</div>

				@endforeach
			@endif
		</div>
	</div>
	

</div>

@endsection