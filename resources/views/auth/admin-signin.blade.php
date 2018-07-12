@extends('templates.default')

@section('content')
<div class="bgsignin container-fluid">
    
    <div class="row mt-auto pt-4">
  <div class="col-8">
    
  </div>
  <div class="col-4">
    <div class="card border-primary">
      <div class="card-header bg-primary">
        <h3 class="font-weight-bold text-light"><i class="fa fa-user-lock"></i>Admin Sign In</h3>
      </div>
      <div class="card-body">

        <form method="post" role="form" action="{{route('admin.login.submit')}}">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
              <hr>
              <label for="email"><strong>Email address</strong></label>
              <input type="text" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{ Request::old('email') ?: ''}}">

              @if($errors->has('email'))
                  <span class="help-block">{{ $errors->first('email')}}</span>
              @endif
              

            </div>


             <div class="form-group{{ $errors->has('username') ? ' has-error' : ''}}">

              <label for="username"><strong>Username:</strong></label>
              <input type="text" name="username" class="form-control" id="username" aria-describedby="username" placeholder="Enter username" value="{{ Request::old('username') ?: ''}}">

              @if($errors->has('username'))
                  <span class="help-block">{{ $errors->first('username')}}</span>
              @endif
              

            </div>


            <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
              <label for="password"><strong>Password</strong></label>
              <input type="password" name="password" class="form-control" id="password" placeholder="Password">

            @if($errors->has('password'))
                  <span class="help-block">{{ $errors->first('password')}}</span>
              @endif

            </div>

            <div class="checkbox">
              <label>
                <input type="checkbox" name="remember"> Remember me
              </label>
            </div>
                     
            <input type="hidden" name="_token" value="{{ Session::token() }}">
            <hr>
            <button type="submit" class="btn btn-primary pull-right">Sign In</button>

          </form>
        
      </div>
    </div>
  </div>
</div>

</div>

@stop