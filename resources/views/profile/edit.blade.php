@extends('templates.default')

@section('content')

<hr>
<div class="container">
<form class="form-vertical" role="form" method="post" action ="{{route('profile.edit')}}" enctype="multipart/form-data" >
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header bg-info">
					<h3 class="text-light font-weight-bold"><i class="fa fa-user-edit"></i>&nbspUpdate Profile</h3>
				</div>
			</div>
		</div>
		
	</div>
	<hr>
	<div class="row">
		<div class="col-6">
			<div class="card">
					<div class="card-header bg-dark">
						<h5 class="font-weight-bold text-light"><i class="fa fa-images"></i>&nbspUpdate Avatar</h5>
					</div>
					<div class="card-body bg-info">
					        <div class="form-group">
					        	<div class="row">
					        		<div class="col-8">

						        		<label for="avatar" class="font-weight-bold text-light">Change Profile Image:</label>
							             <input class="btn btn-sm btn-outline-warning" type="file" name="avatar" id="avatar" value="{{Request::old('avatar') ?: Auth::user()->avatar}}" />
							           
							        </div>
							        <div class="col-4">					
							        </div>
					        	</div>
						    </div>

						   <hr>
							<div class="form-group{{ $errors->has('intro') ? ' has-error': ''}}">
								<label for="last_name" class="control-label text-light font-weight-bold">Intro:</label>

								<textarea name="intro" class="form-control" id="intro">{{Request::old('intro') ?: Auth::user()->intro}}</textarea>

							@if($errors->has('intro'))
								<span class="help-block">{{$errors->first('intro')}}</span>
							@endif

							</div>

					</div>
				</div>
		</div>
		<div class="col-6">
			<div class="card">
				<div class="card-header bg-dark">
					<h5 class="text-light font-weight-bold"><i class="fa fa-user-edit"></i>&nbspPersonal Information</h5>
				</div>
			</div>
			<div class="card-body bg-info">
				
					<div class="row">
						<div class="col-lg-12">

							<div class="form-group{{ $errors->has('first_name') ? ' has-error': ''}}">
								<label for="first_name" class="control-label text-light font-weight-bold">First Name:</label>
								<input type="text" name="first_name" class="form-control" id="first_name" value="{{Request::old('first_name')  ?: Auth::user()->first_name }}">

							@if($errors->has('first_name'))
								<span class="help-block">{{$errors->first('first_name')}}</span>
							@endif
							</div>


						</div>

						<div class="col-lg-12">
							<div class="form-group{{ $errors->has('last_name') ? ' has-error': ''}}">
								<label for="last_name" class="control-label text-light font-weight-bold">Last Name:</label>
								<input type="text" name="last_name" class="form-control" id="last_name" value="{{Request::old('last_name') ?: Auth::user()->last_name}}">


							@if($errors->has('last_name'))
								<span class="help-block">{{$errors->first('last_name')}}</span>
							@endif


							</div>

						</div>

						<div class="col-lg-12">
							<div class="form-group{{ $errors->has('civil_status') ? ' has-error': ''}}">
								<label for="civil_status" class="control-label text-light font-weight-bold">Civil Status:</label>
								<select class="form-control" name="civil_status" id="civil_status">

									<option value="{{Request::old('civil_status') ?: Auth::user()->civil_status}}">{{Request::old('civil_status') ?: Auth::user()->civil_status}}</option>

									<option value="Single">Single</option>
									<option value="In a Relationship">In a relationship</option>
									<option value="Engaged">Engaged</option>
									<option value="Married">Married</option>
									<option value="In a Civil Union">In a civil union</option>
									<option value="Partners">In a domestic partnership</option>
									<option value="In an Open Relationship">In an open relationship</option>
									<option value="Complicated">Complicated</option>
									<option value="Separated">Separated</option>
									<option value="Divorced">Divorced</option>
									<option value="Widowed">Widowed</option>
								</select>								

							
							@if($errors->has('civil_status'))
								<span class="help-block">{{$errors->first('civil_status')}}</span>
							@endif
							</div>

						</div>



						<div class="col-lg-12">
							<div class="form-group{{ $errors->has('location') ? ' has-error': ''}}">
								<label for="location" class="control-label text-light font-weight-bold">Location</label>
								<input type="text" name="location" class="form-control" id="location" value="{{Request::old('location') ?: Auth::user()->location}}">

							@if($errors->has('location'))
								<span class="help-block">{{$errors->first('location')}}</span>
							@endif

							</div>

						</div>





						<div class="col-lg-12">
							<hr>

							<div class="form-group">
								<button type="submit" class="btn btn-default float-right">Update</button>

								<input type="hidden" name="_token" value="{{Session:: token()}}">
							</div>

						</div>

					</div>

				
				
			</div>	
		</div>

	</div>
	</form>
</div>

@stop

