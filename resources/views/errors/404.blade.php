@extends('templates.default')

@section('content')

<div class="jumbotron mt-3 mb-3 text-center">

	<h2 class="text-danger">Opps..that page cold not be found.</h2>
	<a class="text-center" href="{{ route('home' )}}">Go Home</a>

</div>
	
@stop