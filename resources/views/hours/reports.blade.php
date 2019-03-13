@extends('layouts.app')

@section('content')
	<div class="content">
		<h1>Reports</h1>
		
		<div id="time_buttons" class="btn-group btn-navigation-tray">					
			<button id="prev_month_button" class="btn btn-sm btn-default">						
				<span class="glyphicon glyphicon-chevron-left"></span>					
			</button>					
			<button id="next_month_button" class="btn btn-sm btn-default">						
				<span class="glyphicon glyphicon-chevron-right"></span>					
			</button>					
			<button id="select_range_button" class="btn btn-sm btn-default" date-range-picker="" name="date">					
				<i class="glyphicon glyphicon-calendar"></i>					
			</button>						
		<?php //var_dump($project_codes);?>			
		</div>
		<span class="hours-date">{{$today}}</span>
		<input id="start_timestamp" type="hidden" name="timestamp" value="{{$first_day}}">
		<input type="hidden" id="end_timestamp" value="{{$today_timestamp}}">
		<h5>Filter</h5>
		<div class="form-group">
			<div class="row">
				<div class="col-2">
					<select id="filter_clients" name="clients" class="form-control">
						<option value="all">all clients</option>
						@foreach($clients as $k=>$value)
							<option value="{{ $k }}">{{ $value }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-2">
					<select id="filter_projects" name="clients" class="form-control">
						<option value="all">all projects</option>
						@foreach($project_codes as $project_code)	
							@if($project_code->include_project==1)
								<option value="{{ $project_code->id }}">{{ $project_code->title }}</option>
							@endif						
						@endforeach	
					</select>
				</div>
			</div>
		</div>		
		<h3>Activity</h3>
		<div class="row">
			<div class="col-md-12" id="task_container"> 
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Project</th>
							<th scope="col">Client</th>
							<th scope="col">Total Hours</th>
						</tr>
					</thead>				
					<tbody id="report_task_list">
					@foreach($project_codes as $project_code)	
						@if($project_code->include_project==1)
							<tr id="task_{{$project_code->id}}" class="">
								<td>{{$project_code->title}}</td>
								<td>{{$project_code->client->nickname}}</td>
								<td class="listed-hours">{{$project_code->time_hours}}:{{$project_code->time_minutes}}</td>
							</tr>
						@endif						
					@endforeach		
					</tbody>      
				</table>
			</div>
		</div>		
		
	</div>
@endsection
