@extends('layouts.app')

@section('content')
    <div class="tablelike">
        <div>
			<div>Name</div>
			<div>E-Mail</div>
			<div>User</div>
			<div>Manager</div>
			<div>Admin</div>
			<div></div>
        </div>

		@foreach($users as $user)
		<form action="{{ route('admin') }}" method="post">
			<div>{{ $user->name }}</div>
			<div>{{ $user->email }} <input type="hidden" name="email" value="{{ $user->email }}"></div>
			<div><input type="radio" {{ $user->hasRole('user') ? 'checked' : '' }} name="role_user"></div>
			<div><input type="radio" {{ $user->hasRole('manager') ? 'checked' : '' }} name="role_user"></div>
			<div><input type="radio" {{ $user->hasRole('admin') ? 'checked' : '' }} name="role_user"></div>
			<div><button class="btn" type="submit">Assign Role</button></div>
		</form>
        @endforeach

    </div>
@endsection