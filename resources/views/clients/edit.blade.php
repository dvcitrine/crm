@extends('layouts.app')

@section('content')
	<div class="content">
		<h1>Edit Client</h1>	
		{!! Form::open(['action' => ['ClientsController@update', $client->id], 'method' => 'POST']) !!}
			<div class="form-group">
				{{ Form::label('title', 'Title') }}
				{{ Form::text('title', $client->title, ['class' => 'form-control', 'placeholder' => 'title'] )}}
			</div>
			<div class="form-group">
				{{ Form::label('body', 'Body') }}
				{{ Form::textarea('body', $client->body, ['id'=> 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Body Text'] )}}
			</div>
			{{Form::hidden('_method', 'PUT')}} <!-- This is because upadte requires PUT and we cant change the form method directly-->
			{{Form::submit('Save', ['class' => 'btn btn-submit'])}}
		{!! Form::close() !!}
	</div>
@endsection
