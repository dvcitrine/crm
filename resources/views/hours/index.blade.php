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
			<button id="select_day_button" class="btn btn-sm btn-default" date-range-picker="" name="date" ng-model="selectedDate" options="datePickerOptions" data-toggle="tooltip" tooltip="jump to specific date" tooltip-placement="auto" tooltip-append-to-body="true">						
				<i class="glyphicon glyphicon-calendar"></i>					
			</button>					
			<button id="goto_today_button" class="btn btn-sm btn-default" ng-click="today()" data-toggle="tooltip" tooltip="today" tooltip-placement="auto" tooltip-append-to-body="true">						
			<span class="glyphicon glyphicon-home"></span>					
			</button>	
<?php //var_dump($client_ids);?>			
		</div>
		<span class="hours-date">{{$today}}</span>
		<input type="hidden" value="{{$today_timestamp}}">
		<h3>TASKS YOU'RE WORKING ON</h3>
		<div class="col-md-1 vertical-toolbar"> 
			<button id="timeStep2" class="btn btn-block btn-default" data-toggle="modal" data-target="#time_modal">        
			<span class="glyphicon glyphicon-plus glyphicon glyphicon-large"></span>        
			<br>Add      
			</button>
		</div>
		<div class="col-md-11" id="task container"> 
		<table class="table table-hover">        
		<tbody>          <!-- NEW LOG -->   
		@foreach($hours as $hour)	
			<?php 
			$time_hours=floor(($hour->minutes)/60);
			$time_minutes=(($hour->minutes)%60);
			$time_minutes = sprintf("%02d", $time_minutes);
			?>		
			<tr class="">
				<td class="col-md-8">{{$hour->project_code->title}}</td>
				<td class="col-md-2 listed-hours">{{$time_hours}}:{{$time_minutes}}</td>
				<td class="col-md-2 text-right table-cell-actions">             
					<div class="btn-group ng-scope">                
						<button id="" class="btn btn-default">                  
							<span class="glyphicon glyphicon-pencil"></span>                
						</button>                
						<button id="" class="btn btn-default">                  
							<span class="glyphicon glyphicon-remove"></span>                
						</button>                             
					</div>         
				</td>
			</tr>    
		@endforeach		
		</tbody>      
		</table>
		</div>


		<div class="modal2 fade2" id="time_modal" tabindex="-1" role="dialog" >
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">  
						<h3 class="modal-title">Time log for <span class="hours-date">{{$today}}</span></h3>
						<button type="button" class="close" data-dismiss="modal" >    
							<span>×</span>  
						</button> 					

					</div>
					<div class="modal-body">    
						<form action="{{action('HoursController@store')}}" method='POST' class="form-horizontal">    
						@csrf
						<input id="chosed_date" type="text" name="timestamp" value="{{$today_timestamp}}">
							<div class="form-group row">      
								<label class="col-md-2 control-label">Project</label>      
								<div class="col-md-8">        
									<div id="projectLookupFullEdit" class="">    
										<div class="input-group">        
											<div id="projectLookup" class="" style="height: 34px;"><input type="hidden" value="">
												<div class="dx-lookup-field-wrapper">
													<div class="dx-lookup-field" tabindex="0" role="combobox" aria-expanded="false">
														<select name="project_code_id" class="form-control custom-select2">
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
											<div class="popup ">
												<div class="" aria-hidden="true" tabindex="0" style="width: 400px; height: auto;">
												<div class="dx-popup-content">
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
										<input class="col-md-4" id="hours-input" name="hours" type="text" >
										<span style="margin:2px 10px 0">:</span>
										<input class="col-md-4" id="minutes-input" name="minutes" type="text" >
									</div>   
								</div>       
							</div>     
							<div class="form-group row">      
								<label class="col-md-2 control-label">Description</label>      
								<div class="col-md-8 col-offset-md-2">        
								<textarea class="form-control" name="description" >
								</textarea>      
								</div>    
							</div> 
							<div class="modal-footer">  
								<input type="submit" class="btn btn-primary" value="Save">  
								<button class="btn btn-default" data-dismiss="modal">Cancel</button>
							</div>  							
						</form>
					</div> 
					
				</div>
			</div>
		</div>
		
		
	</div>
@endsection
