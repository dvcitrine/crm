@extends('layouts.app')

@section('content')
	<div class="content">
	<h1>Services</h1>
		@if(count($services) > 0)
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Service</th>
					<th scope="col">Code</th>
				</tr>
			</thead>
			<tbody>
			@foreach($services as $service)
			<tr>
				<td>
				<a href="/services/{{$service->id}}">{{$service->title}}</a>
				</td>
				<td>
				{{$service->service_code}}
				</td>
			</tr>
			@endforeach
			</tbody>
		</table>
			{{$services->links()}}
		@else
			<p>No services found</p>
		@endif
		<a href="/services/create" class="btn btn-lg btn-primary" type="submit">Add new service</a>
	</div>
@endsection
