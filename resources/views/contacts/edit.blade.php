@extends('layouts.app')

@section('content')
	<div class="content">
		<h1>Edit Client {{$contact->title}}</h1>	
		{!! Form::open(['action' => ['ContactsController@update', $contact->id], 'method' => 'POST', 'class'=>'long-form', 'enctype'=>'multipart/form-data']) !!}
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{{ Form::label('name', 'Νame') }}
					{{ Form::text('name', $contact->name, ['class' => 'form-control', 'placeholder' => 'name'] )}}
				</div>
				<div class="form-group">
					{{ Form::label('telephone', 'Telephone') }}
					{{ Form::text('telephone', $contact->telephone, ['class' => 'form-control', 'placeholder' => 'telephone'] )}}
				</div>
				<div class="form-group">
					{{ Form::label('email', 'E-mail') }}
					{{ Form::text('email', $contact->email, ['class' => 'form-control', 'placeholder' => 'email'] )}}
				</div>
				<div class="form-group">
					{{ Form::label('client', 'client') }}
					<select name="client" class="form-control">
						@foreach($clients as $client)
							<option value="{{ $client->id }}" {{ $contact->client_id==$client->id ? 'selected' : '' }}>{{ $client->nickname }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					{{ Form::label('notes', 'Notes') }}
					{{ Form::textarea('notes', $contact->notes, ['class' => 'form-control', 'placeholder' => 'Notes'] )}}
				</div>
				<div class="form-group">
					{{ Form::label('active', 'Active') }}
					<select name="active" class="form-control">
							<option value="1" {{ $contact->active==1 ? 'selected' : '' }}>Yes</option>
							<option value="0" {{ $contact->active==0 ? 'selected' : '' }}>No</option>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<h3>Tax Info</h3>			
				<div class="form-group">
					{{ Form::label('occupation', 'occupation') }}
					{{ Form::text('occupation', $contact->occupation, ['class' => 'form-control', 'placeholder' => 'occupation'] )}}
				</div>
				<div class="form-group">
					{{ Form::label('afm', 'afm') }}
					{{ Form::text('afm', $contact->afm, ['class' => 'form-control', 'placeholder' => 'afm'] )}}
				</div>
				<div class="form-group">
					{{ Form::label('address', 'address') }}
					{{ Form::text('address', $contact->address, ['class' => 'form-control', 'placeholder' => 'address'] )}}
				</div>
				<div class="form-group">
					{{ Form::label('tk', 'tk') }}
					{{ Form::text('tk', $contact->tk, ['class' => 'form-control', 'placeholder' => 'tk'] )}}
				</div>				
			</div>
		</div>
				
			{{Form::hidden('_method', 'PUT')}}
			{{Form::submit('Update', ['class' => 'btn btn-submit'])}}
		{!! Form::close() !!}
	</div>
@endsection
