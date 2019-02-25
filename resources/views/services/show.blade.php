@extends('layouts.app')

@section('content')
	<a href="/services" class="btn btn-primary">Back</a>
	<div class="content">
		<h1>{{$service->title}}</h1>
		Service Code: 
		<div>
		{!!$service->service_code!!}
		</div>
		<hr>
		@if(!Auth::guest())
				<a href="/services/{{$service->id}}/edit" class="btn btn-default">Edit</a>
		@endif
	</div>
@endsection
