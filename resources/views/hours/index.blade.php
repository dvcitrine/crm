@extends('layouts.app')

@section('content')
	<div class="content">
		<h1>Hours</h1>
		
		<div id="time_buttons" class="btn-group btn-navigation-tray">					
			<button id="prevDayTrackButton" class="btn btn-sm btn-default" ng-click="prevDay()" data-toggle="tooltip" tooltip="previous day" tooltip-placement="auto" tooltip-append-to-body="true">						
				<span class="glyphicon glyphicon-chevron-left"></span>					
			</button>					
			<button id="nextDayTrackButton" class="btn btn-sm btn-default" ng-click="nextDay()" data-toggle="tooltip" tooltip="next day" tooltip-placement="auto" tooltip-append-to-body="true">						
				<span class="glyphicon glyphicon-chevron-right"></span>					
			</button>					
			<button id="selectDayTrackButton" class="btn btn-sm btn-default" date-range-picker="" name="date" ng-model="selectedDate" options="datePickerOptions" data-toggle="tooltip" tooltip="jump to specific date" tooltip-placement="auto" tooltip-append-to-body="true">						
				<i class="glyphicon glyphicon-calendar"></i>					
			</button>					
			<button id="todayTrackButton" class="btn btn-sm btn-default" ng-click="today()" data-toggle="tooltip" tooltip="today" tooltip-placement="auto" tooltip-append-to-body="true">						
			<span class="glyphicon glyphicon-home"></span>					
			</button>	
<?php //var_dump($client_ids);?>			
		</div>
		<span class="hours-date">{{$today}}</span>
		<h3>Project</h3>
		<div class="form-group">
			{{ Form::label('project', 'project') }}
			<select name="project" class="form-control">
				@foreach($project_codes as $project)
					<option value="{{ $project->id }}">{{ $project->title }}</option>
				@endforeach
			</select>
		</div>
		@foreach($clients as $client)
			<div value="{{ $client->id }}">{{ $client->title }}</div>
			@foreach($project_codes as $project)
				@if($project->client_id==$client->id)
					<option value="{{ $project->id }}">{{ $project->title }}</option>
				@endif
			@endforeach
			
		@endforeach
		<h3>TASKS YOU'RE WORKING ON</h3>

	</div>
@endsection
