<div class="media mt-2 mb-2">
	<a class="pull-left" href="{{ route('profile.index', ['username'=>$user->username])}}">
		<img class="media-object prof_image"  alt="{{ $user->getNameOrUsername() }}" src="/storage/prof_images/{{$user->avatar}}">

	</a>

	<div class="media-body ml-2">
		<h4 class="media-heading"><a href="{{ route('profile.index', ['username'=>$user->username])}}">{{ $user->getNameOrUsername() }}</a></h4>
		@if($user->getCivilStatus())
			<p>{{ $user->getCivilStatus() }}</p>
		@endif

		@if($user->getLocation())
			<p>Lives in {{ $user->getLocation() }}</p>
		@endif

	</div>
</div>
