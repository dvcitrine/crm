@extends('layouts.app')

@section('content')
	<a href="/users" class="btn btn-primary">Back</a>
	<div class="content">
	<h1>User: {{$user->name}}</h1>

	<div>
		E-mail: {!!$user->email!!}
	</div>

	<hr>
	<!--<a href="/users/{{$user->id}}/edit" class="btn btn-default">Edit</a>-->
	@if(!Auth::guest())
		@if(auth()->user()->hasRole('admin')||Auth::user()->id == $user->user_id)
			<a href="/users/{{$user->id}}/edit" class="btn btn-default">Edit</a>
		@endif
	@endif
	</div>
@endsection
