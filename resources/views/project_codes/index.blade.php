@extends('layouts.app')

@section('content')
	<div class="content">
	<h1>Project codes</h1>
		<div></div>
		@if(count($project_codes) > 0)
			@foreach($project_codes as $project_code)
			<div class="well">
				<h3><a href="/project-codes/{{$project_code->id}}">{{$project_code->title}}</a></h3>
				<small>{{$project_code->created_at}} by {{$project_code->client->user->name}}</small>
			</div>
			@endforeach
			{{$project_codes->links()}}
		@else
			<p>No Project codes found</p>
		@endif
		<a href="/project-codes/create" class="btn btn-lg btn-primary" type="submit">Add new Project Code</a>
	</div>
@endsection
