@section('content')
@extends('templates.default')
<div class="bgsignup container-fluid ">
  
<div class="row mt-auto pt-4">
  <div class="col-8">
    
  </div>
  
  <div class="col-4">
    <div class="card border-primary">
      <div class="card-header bg-primary">
         <h3 class="font-weight-bold text-light"><i class="fa fa-user-edit"></i> Sign Up</h3>
      </div>

      <div class="card-body">
        <form method="post" role="form" action="{{route('auth.signup')}}">
     
        <hr>
      <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
        <label for="email"><strong>Email address</strong></label>
        <input type="text" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{ Request::old('email') ?: ''}}">

        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>

        @if($errors->has('email'))
          <span class="help-block">{{$errors->first('email')}}</span>
        @endif

      </div>

      <div class="form-group{{ $errors->has('username') ? ' has-error' : ''}}">
        <label for="username"><strong>Username</strong></label>
        <input type="username" name="username" class="form-control" id="username" placeholder="Username" value="{{ Request::old('username') ?: ''}}">


        @if($errors->has('username'))
          <span class="help-block">{{$errors->first('username')}}</span>
        @endif


      </div>

      <div class="row">
        <div class="col-6">
          <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
            <label for="password"><strong>Password</strong></label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">


            @if($errors->has('password'))
              <span class="help-block">{{$errors->first('password')}}</span>
            @endif
      </div>
        
      </div>
      <div class="col-6">
              <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
        <label for="password_confirmation"><strong>Confirm Password</strong></label>
        <input type="password" name="password_confirmation" class="form-control" id="password" placeholder="Confirm Password">

        @if($errors->has('password'))
          <span class="help-block">{{$errors->first('password')}}</span>
        @endif


      </div>
      </div>
        
      </div>

      <input type="hidden" name="_token" value="{{Session::token()}}">
      <a href="{{route('auth.signin')}}"><small >Click here to Sign-in.</small></a>
      <hr>

      <button type="submit" class="btn btn-primary float-right">Signup</button>

    </form>
        
      </div>
    </div>

        
    

  </div>
  
</div>
</div>



@stop
