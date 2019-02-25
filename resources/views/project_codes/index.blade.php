@extends('layouts.app')

@section('content')
	<div class="content">
		<h1>Projects</h1>
		@if(count($project_codes) > 0)
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Project</th>
					<th scope="col">Start Date</th>
					<th scope="col">End Date</th>
					<th scope="col">Created</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
			@foreach($project_codes as $project_code)
			<tr>
				<td><a href="/projects/{{$project_code->id}}">{{$project_code->title}}</a></td>
				<td>{{date("d/m/Y", strtotime($project_code->start_date))}}</td>
				<td>{{date("d/m/Y", strtotime($project_code->end_date))}}
				@if ((strtotime($project_code->end_date))<(strtotime('today')))
					<span class="alert alert-danger ml-2">Overdue</span>
				@endif
				</td>
				<td><small>{{$project_code->created_at->format('d/m/Y')}} by {{$project_code->client->user->name}}</small></td>				
				<td>
				@if (auth()->user()->hasRole('admin')||Auth::user()->id == $project_code->user_id)
					<a href="/projects/{{$project_code->id}}/edit" class="btn btn-default">Edit</a>
				@endif
				</td>
				
			</tr>

			@endforeach
			</tbody>
		</table>
			{{$project_codes->links()}}
		@else
			<p>No Project codes found</p>
		@endif
		<a href="/projects/create" class="btn btn-lg btn-primary" type="submit">Add new Project</a>
	</div>
@endsection
