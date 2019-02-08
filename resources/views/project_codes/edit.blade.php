@extends('layouts.app')

@section('content')
	<div class="content">
		<h1>Edit Project code</h1>	
		{!! Form::open(['action' => ['ProjectCodesController@update', $project_code->id], 'method' => 'POST']) !!}
			<div class="form-group">
				{{ Form::label('title', 'Title') }}
				{{ Form::text('title', $project_code->title, ['class' => 'form-control', 'placeholder' => 'title'] )}}
			</div>
			<div class="form-group">
				{{ Form::label('body', 'Description') }}
				{{ Form::text('body', $project_code->body, ['class' => 'form-control', 'placeholder' => 'Description'] )}}
			</div>
			<div class="form-group">
				{{ Form::label('service', 'Service') }}
				<select name="service" class="form-control">
					@foreach($services as $service)
						<option value="{{ $service->id }}" {{ $project_code->service_id==$service->id ? 'selected' : '' }} >{{ $service->title }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				{{ Form::label('client', 'client') }}
				<select name="client" class="form-control">
					@foreach($clients as $client)
						<option value="{{ $client->id }}" {{ $project_code->client_id==$client->id ? 'selected' : '' }} >{{ $client->title }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<div>Assigned to users</div>
					@foreach($users as $user)
						<input type="checkbox" {{ $project_code->is_project_assigned_to_user($user->id) ? 'checked' : '' }} name="user_id[]" value="{{$user->id}}">
						{{ $user->name }}						
						<br>
					@endforeach
			</div>
			{{Form::hidden('_method', 'PUT')}} <!-- This is because update requires PUT and we cant change the form method directly-->
			{{Form::submit('Update Project Code', ['class' => 'btn btn-submit'])}}
		{!! Form::close() !!}
	</div>
@endsection
