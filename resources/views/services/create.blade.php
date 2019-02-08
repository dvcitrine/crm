@extends('layouts.app')

@section('content')
	<div class="content">
		<h1>Create new service</h1>	
		{!! Form::open(['action' => 'ServicesController@store', 'method' => 'POST']) !!}
			<div class="form-group">
				{{ Form::label('title', 'Title') }}
				{{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'title'] )}}
			</div>
			<div class="form-group">
				{{ Form::label('service_code', 'service code') }}
				{{ Form::text('service_code', '', ['class' => 'form-control', 'placeholder' => 'service code'] )}}
			</div>
			{{Form::submit('Submit', ['class' => 'btn btn-submit'])}}
		{!! Form::close() !!}
	</div>
@endsection
