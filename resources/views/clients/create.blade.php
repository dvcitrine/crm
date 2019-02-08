@extends('layouts.app')

@section('content')
	<div class="content">
		<h1>Create new Client</h1>	
		{!! Form::open(['action' => 'ClientsController@store', 'method' => 'POST']) !!}
			<div class="form-group">
				{{ Form::label('title', 'Name') }}
				{{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Name'] )}}
			</div>
			<div class="form-group">
				{{ Form::label('body', 'Description') }}
				{{ Form::text('body', '', ['class' => 'form-control', 'placeholder' => 'Description'] )}}
			</div>
			{{Form::submit('Create', ['class' => 'btn btn-submit'])}}
		{!! Form::close() !!}
	</div>
@endsection
