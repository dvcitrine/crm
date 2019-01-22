@extends('layouts.app')

@section('content')
	<div class="content">
		<h1>Create Posts page</h1>	
		{!! Form::open(['action' => 'PostsController@store', 'method' => 'POST']) !!}
			<div class="form-group">
				{{ Form::label('title', 'Title') }}
				{{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'title'] )}}
			</div>
			<div class="form-group">
				{{ Form::label('body', 'Body') }}
				{{ Form::textarea('body', '', ['id'=> 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Body Text'] )}}
			</div>
			{{Form::submit('Submit', ['class' => 'btn btn-submit'])}}
		{!! Form::close() !!}
	</div>
@endsection
