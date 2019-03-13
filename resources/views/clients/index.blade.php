@extends('layouts.app')

@section('content')
	<div class="content">
		<h1>Clients</h1>
		<a href="/clients/create" class="btn btn-lg btn-primary btn-top" type="submit">Add new Client</a>
		@if(count($clients) > 0)
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="active_projects-tab" data-toggle="tab" href="#active_projects" role="tab" aria-controls="active_projects"
			  aria-selected="true">Active</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="archived_projects-tab" data-toggle="tab" href="#archived_projects" role="tab" aria-controls="archived_projects"
			  aria-selected="false">Archived</a>
			</li>
		</ul>
		
		<div class="tab-content">
			<div class="tab-pane fade show active" id="active_projects" role="tabpanel" aria-labelledby="home-tab">
				<div class="row">
					<input data-column="0" type="text" class="form-control filtertable col-2 mt-2 mr-3 ml-3" placeholder="Filter by Client">
					<input data-column="1" type="text" class="form-control filtertable col-2 mt-2" placeholder="Filter by Nickname">
				</div>
				<table class="table mt-4">
					<thead>
						<tr>
							<th scope="col">Client</th>
							<th scope="col">Nickname</th>
							<th scope="col">AFM</th>
							<th scope="col">e-mail</th>
							<th scope="col"></th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
					@foreach($clients as $client)
						@if ($client->active)
						<tr>
							<td><a href="/clients/{{$client->id}}">{{$client->title}}</a></td>
							<td>{{$client->nickname}}</td>
							<td>{{$client->afm}}</td>
							<td>{{$client->email}}</td>
							<td>
							@if ($client->logo)
								<img src="{{asset('storage/logos')}}/{!!$client->logo!!}">
							@endif
							</td>
							<td>
							@if (auth()->user()->hasRole('admin'))
								<a href="/clients/{{$client->id}}/edit" class="btn btn-default">Edit</a>
							@endif
							</td>
						</tr>
						@endif
					@endforeach
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade" id="archived_projects" role="tabpanel" aria-labelledby="home-tab">
				<div class="row">
					<input data-column="0" type="text" class="form-control filtertable col-2 mt-2 mr-3 ml-3" placeholder="Filter by Client">
					<input data-column="1" type="text" class="form-control filtertable col-2 mt-2" placeholder="Filter by Nickname">
				</div>
				<table class="table mt-4">
					<thead>
						<tr>
							<th scope="col">Client</th>
							<th scope="col">Nickname</th>
							<th scope="col">AFM</th>
							<th scope="col">e-mail</th>
							<th scope="col"></th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>			
					@foreach($clients as $client)
						@if (!$client->active)
						<tr>
							<td><a href="/clients/{{$client->id}}">{{$client->title}}</a></td>
							<td>{{$client->nickname}}</td>
							<td>{{$client->afm}}</td>
							<td>{{$client->email}}</td>
							<td>
							@if ($client->logo)
								<img src="{{asset('storage/logos')}}/{!!$client->logo!!}">
							@endif
							</td>
							<td>
							@if (auth()->user()->hasRole('admin'))
								<a href="/clients/{{$client->id}}/edit" class="btn btn-default">Edit</a>
							@endif
							</td>
						</tr>
						@endif
					@endforeach
					</tbody>
				</table>
			</div>			
			
			
			
		@else
			<p>No clients found</p>
		@endif
		<a href="/clients/create" class="btn btn-lg btn-primary" type="submit">Add new Client</a>
	</div>
@endsection
