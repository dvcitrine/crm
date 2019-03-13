@extends('layouts.app')

@section('content')
	<div class="content">
	<h1>Services</h1>
		@if (auth()->user()->hasRole('admin'))
			<a href="/services/create" class="btn btn-lg btn-primary btn-top" type="submit">Add new service</a>
		@endif
		@if(count($services) > 0)
			<div class="row">
				<input data-column="0" type="text" class="form-control filtertable col-2 mt-2 mr-3 ml-3" placeholder="Filter by Service">
				<input data-column="1" type="text" class="form-control filtertable col-2 mt-2" placeholder="Filter by Code">
			</div>
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
		@if (auth()->user()->hasRole('admin'))
			<a href="/services/create" class="btn btn-lg btn-primary" type="submit">Add new service</a>
		@endif
	</div>
@endsection
