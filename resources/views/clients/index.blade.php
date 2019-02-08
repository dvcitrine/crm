@extends('layouts.app')

@section('content')
	<div class="content">
		<h1>Clients</h1>
		@if(count($clients) > 0)
			@foreach($clients as $client)
			<div class="well">
				<h3><a href="/clients/{{$client->id}}">{{$client->title}}</a></h3>
				<small>{{$client->created_at}} by {{$client->user->name}}</small>
			</div>
			@endforeach
			{{$clients->links()}}
		@else
			<p>No clients found</p>
		@endif
		<a href="/clients/create" class="btn btn-lg btn-primary" type="submit">Add new Client</a>
	</div>
@endsection
