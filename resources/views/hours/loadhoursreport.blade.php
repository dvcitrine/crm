@foreach($project_codes as $project_code)	
	@if($project_code->include_project==1)
		<tr id="task_{{$project_code->id}}" class="">
			<td>{{$project_code->title}}</td>
			<td>{{$project_code->client->nickname}}</td>
			<td class="listed-hours">{{$project_code->time_hours}}:{{$project_code->time_minutes}}</td>
		</tr>
	@endif						
@endforeach
ηηηη
