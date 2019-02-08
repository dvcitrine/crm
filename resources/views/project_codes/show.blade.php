@extends('layouts.app')

@section('content')
	<a href="/project-codes" class="btn btn-primary">Back</a>
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
	<small>Written on {{$project_code->created_at}} by {{$project_code->client->name}}</small>
	<hr>
	<a href="/project-codes/{{$project_code->id}}/edit" class="btn btn-default">Edit</a>
	@if(!Auth::guest())
		@if(Auth::user()->id == $project_code->user_id)
			<a href="/project-codes/{{$project_code->id}}/edit" class="btn btn-default">Edit</a>
			{!! Form::open(['action' => ['ProjectCodesController@destroy',$project_code->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
				{{Form::hidden('_method', 'DELETE')}}
				{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
			{!! Form::close() !!}
		@endif
	@endif
	</div>
@endsection
