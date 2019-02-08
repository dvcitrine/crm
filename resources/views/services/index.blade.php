@extends('layouts.app')

@section('content')
	<div class="content">
	<h1>services</h1>
		@if(count($services) > 0)
			@foreach($services as $service)
			<div class="well">
				<h3><a href="/services/{{$service->id}}">{{$service->title}}</a></h3>
			</div>
			@endforeach
			{{$services->links()}}
		@else
			<p>No services found</p>
		@endif
		<a href="/services/create" class="btn btn-lg btn-primary" type="submit">Add new service</a>
	</div>
@endsection
