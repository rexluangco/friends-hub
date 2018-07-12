@extends('templates.default')


@section('content')

<div class="container">

	<h3>Your search for "{{ Request::input('query')}}"</h3>
		<div class="row">

			@if(!$users->count())

				<p>No results found.Sorry</p>

			@else
				<div class="col-md-12">

					@foreach($users as $user)

							@include('user/partials/userblock')

					@endforeach
					
				</div>
				
			@endif

		</div>

</div>

		

@stop