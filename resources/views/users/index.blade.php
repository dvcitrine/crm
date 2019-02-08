@extends('layouts.app')

@section('content')
    <table>
        <thead>
        <th>Name</th>
        <th>E-Mail</th>
        <th>User</th>
        <th>Author</th>
        <th>Admin</th>
        <th></th>
        </thead>
        <tbody>
       @foreach($users as $user)
            <tr>
                <form action="{{ route('admin') }}" method="post">
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }} <input type="hidden" name="email" value="{{ $user->email }}"></td>
                    <td><input type="checkbox" {{ $user->hasRole('user') ? 'checked' : '' }} name="role_user"></td>
                    <td><input type="checkbox" {{ $user->hasRole('author') ? 'checked' : '' }} name="role_author"></td>
                    <td><input type="checkbox" {{ $user->hasRole('admin') ? 'checked' : '' }} name="role_admin"></td>

                    <td><button type="submit">Assign Roles</button></td>
                </form>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection