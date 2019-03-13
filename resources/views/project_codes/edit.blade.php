@extends('layouts.app')

@section('content')
	<div class="content">
		<h1>Edit Project {{ $project_code->title }}</h1>	
		{!! Form::open(['action' => ['ProjectCodesController@update', $project_code->id], 'method' => 'POST']) !!}
			<div class="form-group">
				Name
				<div class="input-group">
					<?php 
						$client_3dig_id = $project_code->client->id;
						$client_3dig_id = sprintf("%03d", $client_3dig_id);
						$project_2dig_month= $project_code->month;
						$project_2dig_month = sprintf("%02d", $project_2dig_month);
					?>			
					{{ Form::text('title-client', $project_code->client->country.$client_3dig_id.$project_code->client->nickname, ['class' => 'form-control', 'placeholder' => 'client', 'readonly' => 'true', 'id' => 'project_title_client'] )}}
					{{ Form::text('title-description', $project_code->description, ['class' => 'form-control', 'placeholder' => 'description', 'readonly' => 'true', 'id' => 'project_title_descritpion'] )}}
					{{ Form::text('title-month', $project_2dig_month, ['class' => 'form-control', 'placeholder' => 'month', 'readonly' => 'true', 'id' => 'project_title_month'] )}}
					{{ Form::text('title-year', $project_code->year, ['class' => 'form-control', 'placeholder' => 'year', 'readonly' => 'true', 'id' => 'project_title_year'] )}}
					{{ Form::text('title-service', $project_code->service->service_code, ['class' => 'form-control', 'placeholder' => 'service', 'readonly' => 'true', 'id' => 'project_title_service'] )}}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('client', 'client') }}
				<select id="project_client" name="client" class="form-control">
					@foreach($clients as $client)
						<option data-country="{{ $client->country }}" data-id="{{ $client->id }}" data-nickname="{{ $client->nickname }}" value="{{ $client->id }}" {{ $project_code->client_id==$client->id ? 'selected' : '' }} >{{ $client->title }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				{{ Form::label('service', 'Service') }}
				<select id="project_service" name="service" class="form-control">
					@foreach($services as $service)	
							<option data-code="{{ $service->service_code }}" value="{{ $service->id }}" {{ $project_code->service_id==$service->id ? 'selected' : '' }} >{{ $service->title }}</option>						
					@endforeach
				</select>
			</div>
			<div class="form-group">			
				{{ Form::label('manager', 'Manager') }}
				@if (auth()->user()->hasRole('admin'))
					<select id="manager" name="manager" class="form-control">
						@foreach($users as $user)
							@foreach($user->roles as $role)
								@if ($role->id!=3)
									<option value="{{ $user->id }}" {{ $project_code->user_id==$user->id ? 'selected' : '' }} >{{ $user->name }}</option>
								@endif
							@endforeach
						@endforeach
					</select>
				@else 
					<br>
					<input type="hidden" name="manager" value="{{auth()->user()->id}}">
					{{ $project_code->user->name}}
				@endif
			</div>
			<div class="form-group">
				{{ Form::label('month', 'month') }}
				<select id="project_month" name="month" class="form-control">
					<option disabled selected value> -- Select a month -- </option>
					<option value="01" {{ $project_code->month=='1' ? 'selected' : '' }}> 1 </option>
					<option value="02" {{ $project_code->month=='2' ? 'selected' : '' }}> 2 </option>
					<option value="03" {{ $project_code->month=='3' ? 'selected' : '' }}> 3 </option>
					<option value="04" {{ $project_code->month=='4' ? 'selected' : '' }}> 4 </option>
					<option value="05" {{ $project_code->month=='5' ? 'selected' : '' }}> 5 </option>
					<option value="06" {{ $project_code->month=='6' ? 'selected' : '' }}> 6 </option>
					<option value="07" {{ $project_code->month=='7' ? 'selected' : '' }}> 7 </option>
					<option value="08" {{ $project_code->month=='8' ? 'selected' : '' }}> 8 </option>
					<option value="09" {{ $project_code->month=='9' ? 'selected' : '' }}> 9 </option>
					<option value="10" {{ $project_code->month=='10' ? 'selected' : '' }}> 10 </option>
					<option value="11" {{ $project_code->month=='11' ? 'selected' : '' }}> 11 </option>
					<option value="12" {{ $project_code->month=='12' ? 'selected' : '' }}> 12 </option>
				</select>
			</div>
			<div class="form-group">
				{{ Form::label('year', 'Year') }}
				<select id="project_year" name="year" class="form-control">
					<option disabled selected value> -- Select a year -- </option>
					<option value="2019" {{ $project_code->year=='2019' ? 'selected' : '' }}> 2019 </option>
					<option value="2020" {{ $project_code->year=='2020' ? 'selected' : '' }}> 2020 </option>
					<option value="2021" {{ $project_code->year=='2021' ? 'selected' : '' }}> 2021 </option>
				</select>
			</div>
			<div class="form-group">
				{{ Form::label('description', 'Description') }}
				{{ Form::text('description', $project_code->description, ['class' => 'form-control', 'placeholder' => 'Description', 'id' => 'project_description'] )}}
			</div>
			<div class="form-group">
				{{ Form::label('body', 'Brief') }}
				{{ Form::textarea('body', $project_code->body, ['id'=> 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Brief description'] )}}
			</div>
			<div class="form-group">
				{{ Form::label('start-date', 'Start Date') }}
				{{ Form::text('start-date', date('d/m/Y',strtotime($project_code->start_date)), ['class' => 'form-control', 'placeholder' => 'Start Date', 'id' => 'project_startdate'] )}}
			</div>
			<div class="form-group">
				{{ Form::label('end-date', 'End Date') }}
				{{ Form::text('end-date', date('d/m/Y',strtotime($project_code->end_date)), ['class' => 'form-control', 'placeholder' => 'End Date', 'id' => 'project_enddate' ])}}
			</div>
			<div class="form-group">
				{{ Form::label('internal-link', 'Box link - Internal') }}
				{{ Form::text('internal-link', $project_code->internal_link, ['class' => 'form-control', 'placeholder' => 'Box link - Internal'])}}
			</div>
			<div class="form-group">
				{{ Form::label('client-link', 'Box link - Client') }}
				{{ Form::text('client-link', $project_code->client_link, ['class' => 'form-control', 'placeholder' => 'Box link - Client'])}}
			</div>
			<div class="form-group">
				<div>Assigned to users</div>
					@foreach($users as $user)
						<input type="checkbox" {{ $project_code->is_project_assigned_to_user($user->id) ? 'checked' : '' }} name="user_id[]" value="{{$user->id}}">
						{{ $user->name }}						
						<br>
					@endforeach
			</div>
			<div class="form-group">
				{{ Form::label('active', 'Active') }}
				<select name="active" class="form-control">
						<option value="1" {{ $project_code->active==1 ? 'selected' : '' }}>Yes</option>
						<option value="0" {{ $project_code->active==0 ? 'selected' : '' }}>No</option>
				</select>
			</div>
			{{Form::hidden('_method', 'PUT')}} <!-- This is because update requires PUT and we cant change the form method directly-->
			{{Form::submit('Update Project', ['class' => 'btn btn-submit'])}}
		{!! Form::close() !!}
	</div>
@endsection
