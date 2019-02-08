@extends('layouts.app')

@section('content')
	<a href="/posts" class="btn btn-primary">Back</a>
	<div class="content">
	<h1>{{$client->title}}</h1>
		<div>Single Client page</div>
	
	<div>
	{!!$client->body!!}
	</div>
	<small>Written on {{$client->created_at}} by {{$client->user->name}}</small>
	<hr>
	@if(!Auth::guest())
		@if(Auth::user()->id == $client->user_id)
			<a href="/posts/{{$client->id}}/edit" class="btn btn-default">Edit</a>
			{!! Form::open(['action' => ['PostsController@destroy',$client->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
				{{Form::hidden('_method', 'DELETE')}}
				{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
			{!! Form::close() !!}
		@endif
	@endif
	</div>
@endsection
