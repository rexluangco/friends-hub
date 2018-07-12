@extends('admin.default')
@section('adminContent')


<div class="container">
	<h4>Admin Settings:</h4>
	<hr>

	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header bg-dark">
					<h4 class="font-weight-bold text-light">Admin Info</h4>

				</div>
				<div class="card-body">
					
						<p><span class="font-weight-bold">EMAIL ADD:</span> &nbsp{{ Auth::user()->email}}</p>
						<p><span class="font-weight-bold">NAME:</span> &nbsp{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</p>
						
						<hr>
												
						<div class="input-group mb-3">
						  
						  <div class="input-group-prepend">
							    <label class="input-group-text" for="adminPassword">Username</label>
						  </div>
						 	
							<input class="form-control form-control-lg" type="text" name="adminPassword" id="adminPassword" value="{{Auth::user()->username}}">
							<span><small class="text-danger">**Cannot change admin username.</small></span>
						</div>



						<div class="input-group">
						  
						  <div class="input-group-prepend">
							    <label class="input-group-text" for="adminPassword">Password</label>
						  </div>
						 	
							<input class="form-control form-control-lg" type="password" name="adminPassword" id="adminPassword" placeholder="Change Password">

						   
						 
						  <div class="input-group-append">
						  	
						  		
							    <button type="submit" class="btn btn-warning"  >Submit</button>
							    <input type="hidden" name="_token" value="{{ Session::token()}}">
						    
						  </div>
						  
						</div>

						
				</div>
			</div>
		</div>
	</div>

</div>

@endsection