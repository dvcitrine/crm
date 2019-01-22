@extends('layouts.app')
@section('content')

	<div class="content">
	<h1>{{$title}}</h1>
	@if(count($services) > 0)
		<ul class="list-group">
		@foreach($services as $service)
			<li>{{$service}}</li>
		@endforeach
		</ul>
	@endif
	</div>
@endsection