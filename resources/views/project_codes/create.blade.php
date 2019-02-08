@extends('layouts.app')

@section('content')



	<div class="content">
		<h1>Create new Project code</h1>	
		{!! Form::open(['action' => 'ProjectCodesController@store', 'method' => 'POST']) !!}
			<div class="form-group">
				{{ Form::label('title', 'Name') }}
				{{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Name'] )}}
			</div>
			<div class="form-group">
				{{ Form::label('service', 'Service') }}
				<select name="service" class="form-control">
					@foreach($services as $service)
						<option value="{{ $service->id }}">{{ $service->title }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				{{ Form::label('client', 'Client') }}
				<select name="client" class="form-control">
					@foreach($clients as $client)
						<option value="{{ $client->id }}">{{ $client->title }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				{{ Form::label('body', 'Description') }}
				{{ Form::text('body', '', ['class' => 'form-control', 'placeholder' => 'Description'] )}}
			</div>
			<div class="form-group">
				<div>Assign to users</div>
					@foreach($users as $user)

						{{ Form::checkbox('user_id[]', $user->id) }}
						{{ $user->name }}						
						<br>
					@endforeach
			</div>
			

			{{Form::submit('Create', ['class' => 'btn btn-submit'])}}
		{!! Form::close() !!}
	</div>
@endsection
