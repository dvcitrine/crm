@extends('layouts.app')

@section('content')
	<div class="content">
		<h1>Users</h1>
		@if (auth()->user()->hasRole('admin'))
		<a href="{{ route('register') }}" class="btn btn-lg btn-primary btn-top" type="submit">Add new User</a>
		@if(count($users) > 0)
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="active_users-tab" data-toggle="tab" href="#active_users" role="tab" aria-controls="active_users"
				  aria-selected="true">Active</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="archived_users-tab" data-toggle="tab" href="#archived_users" role="tab" aria-controls="archived_users"
				  aria-selected="false">Archived</a>
				</li>
			</ul>
		@endif
			<div class="tab-content">
				<div class="tab-pane fade show active" id="active_users" role="tabpanel" aria-labelledby="home-tab">
					<div class="row">
						<input data-column="0" type="text" class="form-control filtertable col-2 mt-2 mr-3 ml-3" placeholder="Filter by Name">
						<input data-column="2" type="text" class="form-control filtertable col-2 mt-2" placeholder="Filter by Role">
					</div>
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Name</th>
								<th scope="col">E-mail</th>
								<th scope="col">Role</th>
								<th scope="col"></th>
							</tr>
						</thead>
						<tbody>
						@foreach($users as $user)
							@if ($user->active)
							<tr>
								<td><a href="/users/{{$user->id}}">{{ $user->name }}</a></td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->roles[0]->description}}</td>
								<td><a href="/users/{{$user->id}}/edit" class="btn btn-default">Edit</a></td>
								
							</tr>
							@endif
						@endforeach
						</tbody>
					</table>
				</div>
				<div class="tab-pane fade" id="archived_users" role="tabpanel" aria-labelledby="home-tab">
					<div class="row">
						<input data-column="0" type="text" class="form-control filtertable col-2 mt-2 mr-3 ml-3" placeholder="Filter by Name">
						<input data-column="2" type="text" class="form-control filtertable col-2 mt-2" placeholder="Filter by Role">
					</div>
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Name</th>
								<th scope="col">E-mail</th>
								<th scope="col">Role</th>
								<th scope="col"></th>
							</tr>
						</thead>
						<tbody>
						@foreach($users as $user)
							@if (!$user->active)
							<tr>
								<td><a href="/users/{{$user->id}}">{{ $user->name }}</a></td>
								<td>{{ $user->email }}</td>
								<td>
								@foreach($user->roles as $role)
									{{ $role->description}}
								@endforeach
								</td>
								<td><a href="/users/{{$user->id}}/edit" class="btn btn-default">Edit</a></td>	
							</tr>
							@endif
						@endforeach
						</tbody>
					</table>
				</div>



						
			</div>
		@else
			<p>No Users found</p>
		@endif
		@if (auth()->user()->hasRole('admin'))
			<a href="{{ route('register') }}" class="btn btn-lg btn-primary btn-top" type="submit">Add new User</a>
		@endif			
	</div>
@endsection