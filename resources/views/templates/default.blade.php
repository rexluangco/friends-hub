<!DOCTYPE html>
<html>
<head>

	<title>Friends Hub</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/myStyles.css') }}">


	

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

	<!-- slick js -->

	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

	<!-- Font Style -->
	<link href="https://fonts.googleapis.com/css?family=Baloo|Faster+One|Inconsolata|Pompiere|Prata|Slabo+27px|Allura|Kaushan+Script" rel="stylesheet">

	<!-- google map API -->
	 


</head>
<body>
	<!-- <img class="bg" src="/storage/images/bg1.jpg"> -->
	@include('templates.partials.navigation')

	@include('templates.partials.alerts')

	@yield('content')

	@include('templates.partials.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{URL::asset('js/app.js')}}"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA94cD0ktU5tL3ozpMFCwL6jSTmFnmhgTc&libraries=places&callback=initMap"
        async defer></script>


<script src="{{URL::asset('js/customJS.js')}}"></script>
</script>



</body>
</html>