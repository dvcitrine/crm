@extends('layouts.app')

@section('content')
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
		<tr>
			<td><a href="/users/{{$user->id}}">{{ $user->name }}</a></td>
			<td>{{ $user->email }}</td>
			<td>{{ $user->roles[0]->description}} </td>
			<td><a href="/users/{{$user->id}}/edit" class="btn btn-default">Edit</a></td>
			
		</tr>
        @endforeach
			</tbody>
		</table>
    </div>
@endsection