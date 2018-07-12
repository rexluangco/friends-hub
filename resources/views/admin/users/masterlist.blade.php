@extends('admin.default')
@section('adminContent')

<div class="container-fluid">
	<hr>
	<h2 class="font-weight-bold">USERS' LIST</h2>
	<hr>

	@if(count($users)>0)	
			<div class="table-responsive">
					<table class=" table table-hover">
					<tr>
						<th>No</th>
						<th><i class="fa fa-user"></i>&nbspUsername</th>
						<th><i class="fa fa-user"></i>&nbspFirst Name</th>
						<th><i class="fa fa-user"></i>&nbspLast Name</th>
						<th><i class="fa fa-at"></i>&nbspEmail</th>
						<th><i class="fa fa-user"></i>&nbspMember Since</th>
						<th>View User</th>
						

					</tr>

			@foreach($users as $user)
					<tr>
						<td>{{$user->id}}</td>
						<td>{{ $user->username}}</td>
						<td>{{ $user->first_name}}</td>
						<td>{{ $user->last_name}}</td>
						<td>{{ $user->email}}</td>
						<td>{{ $user->created_at->diffForHumans()}}</td>
						<td>
							<a href="{{ route('admin.user_settings',['userId'=>$user->id]) }}"><i class="fa fa-eye"></i></a>
						</td>
						<td></td>
					</tr>

			@endforeach
					</table>
			</div>
	@else
		<p>No users found.</p>

	@endif

</div>
@endsection





