@extends('admin.default')
@section('adminContent')


<div class="container-fluid">
	<hr>
	<div class="row mt-4">
		
		<div class="col-8">
			<div class="jumbotron bg-info ">
				<h1 class="text-center font-weight-bold text-light">WELCOME TO THE ADMIN PAGE.</h1>
			</div>
		</div>
		
		<div class="col-4">
			<div class="card">
				<div class="card-header bg-secondary">
					<h5 class="text-center text-light">FriendsHub POPULATION</h5>
				</div>
				<div class="card-body bg-info">
					<div class="counter">
						<h2 class="text-light  text-center font-weight-bold">{{ $users->count()}}&nbsp(<small>as of today</small>)</h2>					
					</div>
					<div>				
					</div>
				</div>
			</div>

		</div>
	</div>
	<hr>


	<div class="row">

		<div class="col-8">
			
		</div>
		
		<div class="col-4">
			
			</div>
		</div>
	</div>		


</div>

@endsection