@extends('layouts.app')

@section('content')
	<div class="content">
		<h1>Create new Contact</h1>	
		{!! Form::open(['action' => 'ContactsController@store', 'method' => 'POST', 'class'=>'long-form', 'enctype'=>'multipart/form-data']) !!}
		<div class="row">
			<div class="col-md-6">
				
				<div class="form-group">
					{{ Form::label('name', 'Name') }}
					{{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'] )}}
				</div>

				<div class="form-group">
					{{ Form::label('telephone', 'Telephone') }}
					{{ Form::text('telephone', '', ['class' => 'form-control', 'placeholder' => 'telephone'] )}}
				</div>
				<div class="form-group">
					{{ Form::label('email', 'E-mail') }}
					{{ Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'email'] )}}
				</div>
				<div class="form-group">
					{{ Form::label('occupation', 'Occupation') }}
					{{ Form::text('occupation', '', ['class' => 'form-control', 'placeholder' => 'occupation'] )}}
				</div>
				<div class="form-group">
					{{ Form::label('client', 'Client') }}
					<select name="client" class="form-control">
						@foreach($clients as $client)
							<option value="{{ $client->id }}">{{ $client->nickname }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					{{ Form::label('notes', 'Notes') }}
					{{ Form::textarea('notes', '', ['class' => 'form-control', 'placeholder' => 'Notes'] )}}
				</div>
				<div class="form-group">
					{{ Form::label('active', 'Active') }}
					<select name="active" class="form-control">
							<option value="1">Yes</option>
							<option value="0">No</option>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{{ Form::label('afm', 'AFM') }}
					{{ Form::text('afm', '', ['class' => 'form-control', 'placeholder' => 'afm'] )}}
				</div>
				<div class="form-group">
					{{ Form::label('address', 'Address') }}
					{{ Form::text('address', '', ['class' => 'form-control', 'placeholder' => 'address'] )}}
				</div>
				<div class="form-group">
					{{ Form::label('tk', 'TK') }}
					{{ Form::text('tk', '', ['class' => 'form-control', 'placeholder' => 'tk'] )}}
				</div>				
			</div>

		</div>
		{{Form::submit('Create', ['class' => 'btn btn-submit'])}}
		{!! Form::close() !!}
	</div>
@endsection
