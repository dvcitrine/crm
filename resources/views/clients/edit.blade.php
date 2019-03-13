@extends('layouts.app')

@section('content')
	<div class="content">
		<h1>Edit Client {{$client->title}}</h1>	
		{!! Form::open(['action' => ['ClientsController@update', $client->id], 'method' => 'POST', 'class'=>'long-form', 'enctype'=>'multipart/form-data']) !!}
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{{ Form::label('nickname', 'Nickname') }}
					{{ Form::text('nickname', $client->nickname, ['class' => 'form-control', 'placeholder' => 'nickname'] )}}
				</div>
				<div class="form-group">
					@if ($client->logo)
						<img src="{{asset('storage/logos')}}/{!!$client->logo!!}">
					@endif
					{{ Form::label('logo', 'Logo') }}<br>
					{{ Form::file('logo',['class' => ''])}}
				</div>
				<div class="form-group">
					{{ Form::label('telephone', 'Telephone') }}
					{{ Form::text('telephone', $client->telephone, ['class' => 'form-control', 'placeholder' => 'telephone'] )}}
				</div>
				<div class="form-group">
					{{ Form::label('email', 'E-mail') }}
					{{ Form::text('email', $client->email, ['class' => 'form-control', 'placeholder' => 'email'] )}}
				</div>
				<div class="form-group">
					{{ Form::label('country', 'Country') }}
					<select name="country" class="form-control">
						@foreach($countries as $c_initial=>$c_name)
							<option value="{{ $c_initial }}" {{ $client->country==$c_initial ? 'selected' : '' }}>{{ $c_name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					{{ Form::label('notes', 'Notes') }}
					{{ Form::textarea('notes', $client->notes, ['class' => 'form-control', 'placeholder' => 'Notes'] )}}
				</div>
				<div class="form-group">
					{{ Form::label('active', 'Active') }}
					<select name="active" class="form-control">
							<option value="1" {{ $client->active==1 ? 'selected' : '' }}>Yes</option>
							<option value="0" {{ $client->active==0 ? 'selected' : '' }}>No</option>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<h3>Tax Info</h3>
				<div class="form-group">
					{{ Form::label('title', 'Company Name') }}
					{{ Form::text('title', $client->title, ['class' => 'form-control', 'placeholder' => 'Company Name'] )}}
				</div>				
				<div class="form-group">
					{{ Form::label('occupation', 'occupation') }}
					{{ Form::text('occupation', $client->occupation, ['class' => 'form-control', 'placeholder' => 'occupation'] )}}
				</div>
				<div class="form-group">
					{{ Form::label('doy', 'DOY') }}
					{{ Form::text('doy', $client->doy, ['class' => 'form-control', 'placeholder' => 'doy'] )}}
				</div>
				<div class="form-group">
					{{ Form::label('afm', 'afm') }}
					{{ Form::text('afm', $client->afm, ['class' => 'form-control', 'placeholder' => 'afm'] )}}
				</div>
				<div class="form-group">
					{{ Form::label('address', 'address') }}
					{{ Form::text('address', $client->address, ['class' => 'form-control', 'placeholder' => 'address'] )}}
				</div>
				<div class="form-group">
					{{ Form::label('tk', 'tk') }}
					{{ Form::text('tk', $client->tk, ['class' => 'form-control', 'placeholder' => 'tk'] )}}
				</div>				
			</div>
		</div>
				
			{{Form::hidden('_method', 'PUT')}}
			{{Form::submit('Update', ['class' => 'btn btn-submit'])}}
		{!! Form::close() !!}
	</div>
@endsection
