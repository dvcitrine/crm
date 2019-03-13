@extends('layouts.app')

@section('content')
	<div class="content">
		<h1>Contacts</h1>
		<a href="/contacts/create" class="btn btn-lg btn-primary btn-top" type="submit">Add new Contact</a>
		@if(count($contacts) > 0)
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
					<input data-column="0" type="text" class="form-control filtertable col-2 mt-2 mr-3 ml-3" placeholder="Filter by Name">
					<input data-column="2" type="text" class="form-control filtertable col-2 mt-2" placeholder="Filter by Client">
				</div>
				<table class="table mt-4">
					<thead>
						<tr>
							<th scope="col">Name</th>							
							<th scope="col">e-mail</th>
							<th scope="col">Client</th>
							<th scope="col">AFM</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
					@foreach($contacts as $contact)
						@if ($contact->active)
						<tr>
							<td><a href="/contacts/{{$contact->id}}">{{$contact->name}}</a></td>
							<td>{{$contact->email}}</td>
							<td>{{$contact->client->nickname}}</td>
							<td>{{$contact->afm}}</td>
							
							<td>
							@if (auth()->user()->hasRole('admin')||Auth::user()->id == $contact->user_id)
								<a href="/contacts/{{$contact->id}}/edit" class="btn btn-default">Edit</a>
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
					<input data-column="0" type="text" class="form-control filtertable col-2 mt-2 mr-3 ml-3" placeholder="Filter by Name">
					<input data-column="2" type="text" class="form-control filtertable col-2 mt-2" placeholder="Filter by Client">
				</div>
				<table class="table mt-4">
					<thead>
						<tr>							
							<th scope="col">Name</th>							
							<th scope="col">e-mail</th>
							<th scope="col">Client</th>
							<th scope="col">AFM</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>			
					@foreach($contacts as $contact)
						@if (!$contact->active)
						<tr>
							<td><a href="/contacts/{{$contact->id}}">{{$contact->title}}</a></td>
							<td>{{$contact->name}}</td>
							<td>{{$contact->afm}}</td>
							<td>{{$contact->email}}</td>
							<td>
							@if (auth()->user()->hasRole('admin')||Auth::user()->id == $contact->user_id)
								<a href="/contacts/{{$contact->id}}/edit" class="btn btn-default">Edit</a>
							@endif
							</td>
						</tr>
						@endif
					@endforeach
					</tbody>
				</table>
			</div>			
			
			
			
		@else
			<p>No contacts found</p>
		@endif
		<a href="/contacts/create" class="btn btn-lg btn-primary" type="submit">Add new Contact</a>
	</div>
@endsection
