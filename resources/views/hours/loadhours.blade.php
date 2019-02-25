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
		

