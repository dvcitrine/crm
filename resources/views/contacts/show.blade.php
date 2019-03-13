@extends('layouts.app')

@section('content')
	<a href="/contacts" class="btn btn-back">Back</a>
	<div class="content">
		@if ($contact->logo)
			<img src="{{asset('storage/logos')}}/{!!$contact->logo!!}">
		@endif
		<h1>{{$contact->title}}</h1>
		<div class="row">
			<div class="col-md-6">
				<div>
					Name: {!!$contact->name!!}
				</div>
				<div>
					Telephone: {!!$contact->telephone!!}
				</div>
				<div>
					E-mail: {!!$contact->email!!}
				</div>
				<div>
					Client: {!!$contact->client->nickname!!}
				</div>
				<div>
					Notes: {!!$contact->notes!!}
				</div>
				<div>
					Active: {!!$contact->active ? 'Yes' : 'No'!!}
				</div>
			</div>
			<div class="col-md-6">
				<div>
					Οccupation: {!!$contact->occupation!!}
				</div>
				<div>
					AFM: {!!$contact->afm!!}
				</div>
				<div>
					Address: {!!$contact->address!!}
				</div>
				<div>
					TK: {!!$contact->tk!!}
				</div>
				
			</div>
		</div>
	
		<small>Created on {{$contact->created_at->format('d/m/Y')}} by {{$contact->user->name}}</small>
		<hr>
		@if(!Auth::guest())
			@if(Auth::user()->id == $contact->user_id)
				<a href="/contacts/{{$contact->id}}/edit" class="btn btn-default">Edit</a>
			@endif
		@endif
	</div>
@endsection
