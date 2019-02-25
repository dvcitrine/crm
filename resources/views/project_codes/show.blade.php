@extends('layouts.app')

@section('content')
	<a href="/projects" class="btn btn-primary">Back</a>
	<div class="content">
	<h1>ProjectCode: {{$project_code->title}}</h1>
		<div>Assigned to users</div>
		<ul>
		@foreach($users as $user)
			<li>{{ $user->name }}</li>
		@endforeach
		</ul>
	<div>
		Description: {!!$project_code->body!!}
	</div>
	<div>
		Client: {!!$client->title!!}
	</div>
	<div>
		Service: {!!$service->title!!}
	</div>
	<small>Created on {{$project_code->created_at->format('d/m/Y')}} by {{$project_code->user_id}}</small>
	<hr>
	<!--<a href="/projects/{{$project_code->id}}/edit" class="btn btn-default">Edit</a>-->
	@if(!Auth::guest())
		@if(auth()->user()->hasRole('admin')||Auth::user()->id == $project_code->user_id)
			<a href="/projects/{{$project_code->id}}/edit" class="btn btn-default">Edit</a>
		@endif
	@endif
	</div>
@endsection
