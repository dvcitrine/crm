@extends('layouts.app')

@section('content')
	<div class="content">
		<h1>Hours</h1>
		
		<div id="time_buttons" class="btn-group btn-navigation-tray">					
			<button id="prev_day_button" class="btn btn-sm btn-default">						
				<span class="glyphicon glyphicon-chevron-left"></span>					
			</button>					
			<button id="next_day_button" class="btn btn-sm btn-default">						
				<span class="glyphicon glyphicon-chevron-right"></span>					
			</button>					
			<button id="select_day_button" class="btn btn-sm btn-default" date-range-picker="" name="date" ng-model="selectedDate">					
				<i class="glyphicon glyphicon-calendar"></i>					
			</button>					
			<button id="goto_today_button" class="btn btn-sm btn-default">						
			<span class="glyphicon glyphicon-home"></span>					
			</button>	
<?php //var_dump($client_ids);?>			
		</div>
		<span class="hours-date">{{$today}}</span>
		<input type="hidden" id="today_timestamp" value="{{$today_timestamp}}">
		<h3>TASKS YOU'RE WORKING ON</h3>
		<div class="row">
			<div class="col-md-1 vertical-toolbar"> 
				<button id="add_time_button" class="btn btn-block btn-default" data-toggle="modal" data-target="#time_modal">        
					<span class="glyphicon glyphicon-plus glyphicon glyphicon-large"></span>        
					<br>Add      
				</button>
			</div>
			<div class="col-md-11" id="task container"> 
				<table class="table table-hover">        
					<tbody id="task_list">
					@foreach($hours as $hour)	
						<?php 
						$time_hours=floor(($hour->minutes)/60);
						$time_minutes=(($hour->minutes)%60);
						$time_minutes = sprintf("%02d", $time_minutes);
						?>		
						<tr id="task_{{$hour->id}}" class="d-flex">
							<td class="col-md-3">{{$hour->project_code->title}}</td>
							<td class="col-md-6">{{$hour->description}}</td>
							<td class="col-md-1 listed-hours">{{$time_hours}}:{{$time_minutes}}</td>
							<td class="col-md-2 text-right table-cell-actions">
								<div class="btn-group">
									<button class="btn btn-default open-edit-modal" data-id="{{$hour->id}}">                  
										<span class="glyphicon glyphicon-pencil"></span>                
									</button>                
									<button class="btn btn-default delete-task" data-id="{{$hour->id}}">                  
										<span class="glyphicon glyphicon-remove"></span>                
									</button>                             
								</div>         
							</td>
						</tr>    
					@endforeach		
					</tbody>      
				</table>
			</div>
		</div>


		<div class="modal fade" id="time_modal" tabindex="-1" role="dialog" >
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">  
						<h3 class="modal-title">Time log for <span class="hours-date">{{$today}}</span></h3>
						<button type="button" class="close" data-dismiss="modal" >    
							<span>×</span>  
						</button> 					

					</div>
					<div class="modal-body">    
						<form id="hours_form" action="{{action('HoursController@store')}}" method='POST' class="form-horizontal">    
						@csrf
						<input id="chosen_date" type="text" name="timestamp" value="{{$today_timestamp}}">
						<input id="modal_hour_id" type="text" name="modal_hour_id" value="">
							<div class="form-group row">      
								<label class="col-md-2 control-label">Project</label>      
								<div class="col-md-8">        
									<div id="projectLookupFullEdit" class="">    
										<div class="input-group">        
											<div id="projectLookup" class="" style="height: 34px;"><input type="hidden" value="">
												<div class="dx-lookup-field-wrapper">
													<div class="dx-lookup-field" tabindex="0" role="combobox" aria-expanded="false">
														<select id="project_code_id" name="project_code_id" class="form-control custom-select2">
															@foreach($clients as $client)
																<optgroup data-id="{{ $client->id }}" label="{{ $client->title }}">
																@foreach($project_codes as $project)
																	@if($project->client_id==$client->id)
																		<option value="{{ $project->id }}">{{ $project->title }}</option>
																	@endif
																@endforeach
																</optgroup>
															@endforeach
														</select>
													</div>
												</div>
											</div>           
										</div>    
										<div>        
											<div class="popup">
												<div class="" aria-hidden="true" tabindex="0" style="width: 400px; height: auto;">
												<div class="ctr-popup-content">
												</div>
												</div>
											</div>    
										</div>
									</div>      
								</div>
							</div>    
							<div class="form-group row" >      
								<label class="control-label col-md-2">Duration</label>      
								<div class="col-md-4">        
									<div class="input-group" id="hours" >	
										<input class="col-md-4" id="hours_input" name="hours" type="text" >
										<span style="margin:2px 10px 0">:</span>
										<input class="col-md-4" id="minutes_input" name="minutes" type="text" >
									</div>   
								</div>       
							</div>     
							<div class="form-group row">      
								<label class="col-md-2 control-label">Description</label>      
								<div class="col-md-8 col-offset-md-2">        
								<textarea class="form-control" id="description" name="description" >
								</textarea>      
								</div>    
							</div> 
							<div class="modal-footer">  
								<button id="hours_update" class="btn btn-primary" >Update</button>
								<input id="hours_submit" type="submit" class="btn btn-primary" value="Save">  
								<button class="btn btn-default" data-dismiss="modal">Cancel</button>
							</div>  							
						</form>
					</div> 
					
				</div>
			</div>
		</div>
		
		
	</div>
@endsection
