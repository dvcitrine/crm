@extends('layouts.app')

@section('content')



	<div class="content">
		<h1>Create new Project</h1>	
		{!! Form::open(['action' => 'ProjectCodesController@store', 'method' => 'POST']) !!}
			<div class="form-group">
				Name
				<div class="input-group">					
					{{ Form::text('title-client', '', ['class' => 'form-control', 'placeholder' => 'client', 'readonly' => 'true', 'id' => 'project_title_client'] )}}
					{{ Form::text('title-description', '', ['class' => 'form-control', 'placeholder' => 'description', 'readonly' => 'true', 'id' => 'project_title_descritpion'] )}}
					{{ Form::text('title-month', '', ['class' => 'form-control', 'placeholder' => 'month', 'readonly' => 'true', 'id' => 'project_title_month'] )}}
					{{ Form::text('title-year', '', ['class' => 'form-control', 'placeholder' => 'year', 'readonly' => 'true', 'id' => 'project_title_year'] )}}
					{{ Form::text('title-service', '', ['class' => 'form-control', 'placeholder' => 'service', 'readonly' => 'true', 'id' => 'project_title_service'] )}}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('client', 'Client') }}
				<select id="project_client" name="client" class="form-control">
					<option disabled selected value> -- Select a client -- </option>
					@foreach($clients as $client)
						<option data-country="{{ $client->country }}" data-id="{{ $client->id }}" data-nickname="{{ $client->nickname }}" value="{{ $client->id }}">{{ $client->title }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				{{ Form::label('service', 'Service') }}
				<select id="project_service" name="service" class="form-control">
					<option disabled selected value> -- Select a service -- </option>
					@foreach($services as $service)
						<option data-code="{{ $service->service_code }}" value="{{ $service->id }}">{{ $service->title }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				{{ Form::label('month', 'month') }}
				<select id="project_month" name="month" class="form-control">
					<option disabled selected value> -- Select a month -- </option>
					<option value="01"> 1 </option>
					<option value="02"> 2 </option>
					<option value="03"> 3 </option>
					<option value="04"> 4 </option>
					<option value="05"> 5 </option>
					<option value="06"> 6 </option>
					<option value="07"> 7 </option>
					<option value="08"> 8 </option>
					<option value="09"> 9 </option>
					<option value="10"> 10 </option>
					<option value="11"> 11 </option>
					<option value="12"> 12 </option>
				</select>
			</div>
			<div class="form-group">
				{{ Form::label('year', 'Year') }}
				<select id="project_year" name="year" class="form-control">
					<option disabled selected value> -- Select a year -- </option>
					<option value="2019"> 2019 </option>
					<option value="2020"> 2020 </option>
					<option value="2021"> 2021 </option>
				</select>
			</div>
			<div class="form-group">
				{{ Form::label('description', 'Description') }}
				{{ Form::text('description', '', ['class' => 'form-control', 'placeholder' => 'Description', 'id' => 'project_description'] )}}
			</div>
			<div class="form-group">
				{{ Form::label('body', 'Brief') }}
				{{ Form::textarea('body', '', ['id'=> 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Brief description'] )}}
			</div>
			<div class="form-group">
				{{ Form::label('start-date', 'Start Date') }}
				{{ Form::text('start-date', '', ['class' => 'form-control', 'placeholder' => 'Start Date', 'id' => 'project_startdate'] )}}
			</div>
			<div class="form-group">
				{{ Form::label('end-date', 'End Date') }}
				{{ Form::text('end-date', '', ['class' => 'form-control', 'placeholder' => 'End Date', 'id' => 'project_enddate' ])}}
			</div>
			<div class="form-group">
				{{ Form::label('internal-link', 'Box link - Internal') }}
				{{ Form::text('internal-link', '', ['class' => 'form-control', 'placeholder' => 'Box link - Internal'])}}
			</div>
			<div class="form-group">
				{{ Form::label('client-link', 'Box link - Client') }}
				{{ Form::text('client-link', '', ['class' => 'form-control', 'placeholder' => 'Box link - Client'])}}
			</div>			
			<div class="form-group">
				<div>Assign to users</div>
					@foreach($users as $user)

						{{ Form::checkbox('user_id[]', $user->id) }}
						{{ $user->name }}						
						<br>
					@endforeach
			</div>
			<div class="form-group">
				{{ Form::label('active', 'Active') }}
				<select name="active" class="form-control">
						<option value="1">Yes</option>
						<option value="0">No</option>
				</select>
			</div>

			{{Form::submit('Create', ['class' => 'btn btn-submit'])}}
		{!! Form::close() !!}
	</div>
@endsection
