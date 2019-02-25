@extends('layouts.app')

@section('content')
	<div class="content">
		<h1>Create new Client</h1>	
		{!! Form::open(['action' => 'ClientsController@store', 'method' => 'POST', 'class'=>'long-form', 'enctype'=>'multipart/form-data']) !!}
		<div class="row">
			<div class="col-md-6">
				
				<div class="form-group">
					{{ Form::label('nickname', 'Nickname') }}
					{{ Form::text('nickname', '', ['class' => 'form-control', 'placeholder' => 'Nickname'] )}}
				</div>
				<div class="form-group">
					{{ Form::label('logo', 'Logo') }}<br>
					{{ Form::file('logo',['class' => 'form-control-file'])}}
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
					{{ Form::label('country', 'Country') }}
					<select name="country" class="form-control">
						@foreach($countries as $c_initial=>$c_name)
							<option value="{{ $c_initial }}">{{ $c_name }}</option>
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
				<h3>Tax Info</h3>
				<div class="form-group">
					{{ Form::label('title', 'Company Name') }}
					{{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Company Name'] )}}
				</div>				
				<div class="form-group">
					{{ Form::label('occupation', 'Occupation') }}
					{{ Form::text('occupation', '', ['class' => 'form-control', 'placeholder' => 'occupation'] )}}
				</div>
				<div class="form-group">
					{{ Form::label('doy', 'DOY') }}
					{{ Form::text('doy', '', ['class' => 'form-control', 'placeholder' => 'doy'] )}}
				</div>
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
