@extends('layouts.app')

@section('content')
	<a href="/projects" class="btn btn-primary mb-3">Back</a>
	<h1>Project {{$project_code->title}}</h1>
	<div class="content show-page">
		<div>
			<span class="meta-desc">Client:</span> {!!$client->title!!}
		</div>
		<div>
			<span class="meta-desc">Service:</span> {!!$service->title!!}
		</div>
		<div>
			<span class="meta-desc">Manager:</span> {!!$project_code->user->name!!}
		</div>
		<div>
			<span class="meta-desc">Date:</span> {!!$project_code->month!!}/{!!$project_code->year!!}
		</div>
		<div>
			<span class="meta-desc">Description:</span> {!!$project_code->description!!}
		</div>

		<div>
			<span class="meta-desc">Brief:</span> {!!$project_code->body!!}
		</div>
		<div>
			<span class="meta-desc">Start Date:</span> {!!date('d/m/Y',strtotime($project_code->start_date))!!}
		</div>
		<div>
			<span class="meta-desc">End Date:</span> {!!date('d/m/Y',strtotime($project_code->end_date))!!}
		</div>
		<div>
			<span class="meta-desc">Box link - Internal:</span> <a href="{!!$project_code->internal_link!!}" target="_blank">{!!$project_code->internal_link!!}</a>
		</div>
		<div>
			<span class="meta-desc">Box link - Client:</span> <a href="{!!$project_code->client_link!!}" target="_blank">{!!$project_code->client_link!!}</a>
		</div>
		<div><span class="meta-desc">Assigned to users:</span></div>
		<ul>
		@foreach($users as $user)
			<li>{{ $user->name }}</li>
		@endforeach
		</ul>
		<div>
			<span class="meta-desc">Active:</span> {!!$project_code->active==1 ? 'Yes' : 'No'!!}
		</div>

		<small><span class="meta-desc">Created on</span> {{$project_code->created_at->format('d/m/Y')}}</small>
		<hr>
		<!--<a href="/projects/{{$project_code->id}}/edit" class="btn btn-default">Edit</a>-->
		@if(!Auth::guest())
			@if(auth()->user()->hasRole('admin')||Auth::user()->id == $project_code->user_id)
				<a href="/projects/{{$project_code->id}}/edit" class="btn btn-default">Edit</a>
			@endif
		@endif
	</div>
@endsection
