@extends('layouts.app')

@section('content')
	<a href="/clients" class="btn btn-back">Back</a>
	<div class="content">
		<img src="{{asset('storage/logos')}}/{!!$client->logo!!}">
		<h1>{{$client->title}}</h1>
		<div class="row">
			<div class="col-md-6">
				<div>
					Nickname: {!!$client->nickname!!}
				</div>
				<div>
					Telephone: {!!$client->telephone!!}
				</div>
				<div>
					E-mail: {!!$client->email!!}
				</div>
				<div>
					Country: {!!$countries[$client->country]!!}
				</div>
				<div>
					Notes: {!!$client->notes!!}
				</div>
				<div>
					Active: {!!$client->active ? 'Yes' : 'No'!!}
				</div>
			</div>
			<div class="col-md-6">
				<h3>Tax Info</h3>
				<div>
					Company Name: {!!$client->title!!}
				</div>
				<div>
					occupation: {!!$client->occupation!!}
				</div>
				<div>
					DOY: {!!$client->doy!!}
				</div>
				<div>
					AFM: {!!$client->afm!!}
				</div>
				<div>
					Address: {!!$client->address!!}
				</div>
				<div>
					TK: {!!$client->tk!!}
				</div>
				
			</div>
		</div>
	
		<small>Created on {{$client->created_at->format('d/m/Y')}} by {{$client->user->name}}</small>
		<hr>
		@if(!Auth::guest())
			@if(Auth::user()->id == $client->user_id)
				<a href="/clients/{{$client->id}}/edit" class="btn btn-default">Edit</a>
			@endif
		@endif
	</div>
@endsection
