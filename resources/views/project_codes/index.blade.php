@extends('layouts.app')

@section('content')
	<div class="content">
		<h1>Projects</h1>
		<a href="/projects/create" class="btn btn-lg btn-primary btn-top" type="submit">Add new Project</a>
		@if(count($project_codes) > 0)
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="active_projects-tab" data-toggle="tab" href="#active_projects" role="tab" aria-controls="active_projects"
			  aria-selected="true">Active</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="archived_projects-tab" data-toggle="tab" href="#archived_projects" role="tab" aria-controls="archived_projects"
			  aria-selected="false">Archived</a>
			</li>
		</ul>
		
		<div class="tab-content">
			<div class="tab-pane fade show active" id="active_projects" role="tabpanel" aria-labelledby="home-tab">
				<div class="row">
					<input data-column="0" type="text" class="form-control filtertable col-2 mt-2 mr-3 ml-3" placeholder="Filter by Project">
					<input data-column="4" type="text" class="form-control filtertable col-2 mt-2" placeholder="Filter by Manager">
				</div>
				<table class="table mt-4">
					<thead>
						<tr>
							<th scope="col">Project</th>
							<th scope="col">Start Date</th>
							<th scope="col">End Date</th>
							<th scope="col">Total Hours</th>
							<th scope="col">Manager</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
					@foreach($project_codes as $project_code)
						@if ($project_code->active)
						<tr>
							<td>
								<a href="/projects/{{$project_code->id}}">{{$project_code->title}}</a>
								<input class="clipboard-text" type="text" style="display:none" value="{{$project_code->title}}">
								<span class="copy-to-clipboard glyphicon glyphicon-plus glyphicon glyphicon-record"></span>
							</td>
							<td>{{date("d/m/Y", strtotime($project_code->start_date))}}</td>
							<td>{{date("d/m/Y", strtotime($project_code->end_date))}}
							@if ((strtotime($project_code->end_date))<(strtotime('today')))
								<span class="alert alert-danger ml-2">Overdue</span>
							@endif
							</td>
							<td>
							@if ($project_code->hours)
								<?php $time = 0;?>
								@foreach($project_code->hours as $hour)
								<?php
									$time += $hour->minutes;
								?>
								@endforeach
								<?php
									$time_hours=floor(($time)/60);
									$time_minutes=(($time)%60);
									$time_minutes = sprintf("%02d", $time_minutes);
								?>
								{{$time_hours}}:{{$time_minutes}}
							@endif
							</td>
							<td>{{$project_code->client->user->name}}</td>				
							<td>
							@if (auth()->user()->hasRole('admin')||Auth::user()->id == $project_code->user_id)
								<a href="/projects/{{$project_code->id}}/edit" class="btn btn-default">Edit</a>
							@endif
							</td>
							
						</tr>
						@endif
					@endforeach
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade" id="archived_projects" role="tabpanel" aria-labelledby="home-tab">
				<div class="row">
					<input data-column="0" type="text" class="form-control filtertable col-2 mt-2 mr-3 ml-3" placeholder="Filter by Project">
					<input data-column="4" type="text" class="form-control filtertable col-2 mt-2" placeholder="Filter by Manager">
				</div>
				<table class="table mt-4">
					<thead>
						<tr>
							<th scope="col">Project</th>
							<th scope="col">Start Date</th>
							<th scope="col">End Date</th>
							<th scope="col">Total Hours</th>
							<th scope="col">Manager</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
					@foreach($project_codes as $project_code)
						@if (!$project_code->active)
						<tr>
							<td><a href="/projects/{{$project_code->id}}">{{$project_code->title}}</a></td>
							<td>{{date("d/m/Y", strtotime($project_code->start_date))}}</td>
							<td>{{date("d/m/Y", strtotime($project_code->end_date))}}
							@if ((strtotime($project_code->end_date))<(strtotime('today')))
								<span class="alert alert-danger ml-2">Overdue</span>
							@endif
							</td>
							<td>
							@if ($project_code->hours)
								<?php $time = 0;?>
								@foreach($project_code->hours as $hour)
								<?php
									$time += $hour->minutes;
								?>
								@endforeach
								<?php
									$time_hours=floor(($time)/60);
									$time_minutes=(($time)%60);
									$time_minutes = sprintf("%02d", $time_minutes);
								?>
								{{$time_hours}}:{{$time_minutes}}
							@endif
							</td>
							<td>{{$project_code->client->user->name}}</td>				
							<td>
							@if (auth()->user()->hasRole('admin')||Auth::user()->id == $project_code->user_id)
								<a href="/projects/{{$project_code->id}}/edit" class="btn btn-default">Edit</a>
							@endif
							</td>
							
						</tr>
						@endif
					@endforeach
					</tbody>
				</table>
			</div>
			
			
		</div>
		
		
		@else
			<p>No Project codes found</p>
		@endif
		<a href="/projects/create" class="btn btn-lg btn-primary" type="submit">Add new Project</a>
	</div>
@endsection
