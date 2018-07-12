
@extends('templates.default')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-12">
			<h3>Update Login Credentials</h3>
			<hr>
		</div>
	</div>
	<div class="row">	
		<div class="col-6">
			<form method="post" role="form" action="{{ route ('profile.edit_userinfo')}}">
		        <hr>
		      <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
		        <label for="email"><strong>Email address</strong></label>
		        <input type="text" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{ Request::old('email') ?: Auth::user()->email}}">


		        @if($errors->has('email'))
		          <span class="help-block">{{$errors->first('email')}}</span>
		        @endif

		      </div>

		      <div class="form-group{{ $errors->has('username') ? ' has-error' : ''}}">
		        <label for="username"><strong>Username</strong></label>
		        <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="{{ Request::old('username') ?: Auth::user()->username}}">


		        @if($errors->has('username'))
		          <span class="help-block">{{$errors->first('username')}}</span>
		        @endif


		      </div>

		          <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
		            <label for="password"><strong>Password</strong></label>
		            <input type="password" name="password" class="form-control" id="password" placeholder="Password">


		            @if($errors->has('password'))
		              <span class="help-block">{{$errors->first('password')}}</span>
		            @endif
		      	</div>
		        
		      <input type="hidden" name="_token" value="{{Session::token()}}">
		   		<hr>
		      <button type="submit" class="btn btn-primary float-right">Update Info</button>

    		</form>
			
		</div>
		<div class="col-6">
			
		</div>
	</div>

</div>

@stop