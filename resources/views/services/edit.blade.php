@extends('layouts.app')

@section('content')
	<div class="content">
		<h1>Edit service</h1>	
		{!! Form::open(['action' => ['ServicesController@update', $service->id], 'method' => 'POST']) !!}
			<div class="form-group">
				{{ Form::label('title', 'Title') }}
				{{ Form::text('title', $service->title, ['class' => 'form-control', 'placeholder' => 'title'] )}}
			</div>
			<div class="form-group">
				{{ Form::label('service_code', 'service code') }}
				{{ Form::text('service_code', $service->service_code, ['class' => 'formservice code'] )}}
			</div>
			{{Form::hidden('_method', 'PUT')}} <!-- This is because upadte requires PUT and we cant change the form method directly-->
			{{Form::submit('Save', ['class' => 'btn btn-submit'])}}
		{!! Form::close() !!}
	</div>
@endsection
