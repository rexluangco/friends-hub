@extends('admin.default')
@section('adminContent')

<div class="container">
	<hr>
	<div class="card">
		<div class="card-header">
			<h4 class="text-muted">REPORTED POSTS:</h4>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-1"></div>
				<div class="col-10">
					<form class="input-group" method="post" action="{{ route('admin.bannable_details')}}">
						<div class="input-group">
						  <div class="input-group-prepend">
							    <label class="input-group-text" for="userQuery">FILTER BY USER</label>
						  </div>
						 	
							  
						   <select class="custom-select" id="userQuery" name="userQuery">
							  		@if(count($bannables) < 1)
							    		<option>No record found.</option>
									@else					
										@foreach($users as $user)

											<option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
										@endforeach
									@endif
						</select>
						 
						  <div class="input-group-append">
						  	
						  		
							    <button type="submit" class="btn btn-primary"  >Submit</button>
							    <input type="hidden" name="_token" value="{{ Session::token()}}">
						    
						  </div>
						  
						</div>
					</form>					
				</div>
				<div class="col-1"></div>
			</div>
		</div>
		<div class="card-body">
			@if(count($bannables) > 0)	
			<div class="table-responsive">
					<table class=" table table-hover">
					<tr>
						
						<th>Reported Status ID</th>
						<th>Reported For</th>
						<th>Reported By</th>
						<th>Time Reported</th>
						

					</tr>

			@foreach($bannables as $bannable)
					<tr>
						
						<td>{{$bannable->bannable_id}}</td>
						<td>{{$bannable->reportedFor}}</td>
						<td>{{$bannable->reportedBy}}</td>
						<td>{{$bannable->updated_at}}</td>

					</tr>

			@endforeach
					</table>
			</div>
			@else
				<p>No users found.</p>

			@endif
		</div>

	</div>

	
</div>

@endsection