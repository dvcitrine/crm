@extends('layouts.app')

@section('content')
	<div class="content">
		<h1>Edit User</h1>	
		{!! Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'POST']) !!}
			<div class="form-group">
				{{ Form::label('name', 'Name') }}
				{{ Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'name'] )}}
			</div>
			<div class="form-group">
				{{ Form::label('email', 'email') }}
				{{ Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => 'email'] )}}
			</div>
			<div class="form-group">
				{{ Form::label('role', 'role') }}
				<select name="service" class="form-control">
					@foreach($roles as $role)
						<option value="{{ $role->id }}" {{ ($user->roles[0]->id==$role->id) ? 'selected' : '' }} >{{ $role->description }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				{{ Form::label('active', 'Active') }}
				<select name="active" class="form-control">
						<option value="1" {{ $user->active==1 ? 'selected' : '' }}>Yes</option>
						<option value="0" {{ $user->active==0 ? 'selected' : '' }}>No</option>
				</select>
			</div>
			{{Form::hidden('_method', 'PUT')}} <!-- This is because update requires PUT and we cant change the form method directly-->
			{{Form::submit('Update User', ['class' => 'btn btn-submit'])}}
		{!! Form::close() !!}
	</div>
@endsection
