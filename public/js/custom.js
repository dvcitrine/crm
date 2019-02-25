$(document).ready(function( $ ) {

	var currentTimestamp, chosenDate, newTime;
	var dayToTimestamp = 24*3600;
	
	//select
    $('.custom-select').select2();	
	
	//Create Project - Set up Project Title
	$("#project_body").on("input", function() {
		$("#project_title_body").val(this.value);
	});	
	$("#project_client").on("change", function() {
		var projectClient=$(this).find(':selected').data('country')+(('00'+($(this).find(':selected').data('id'))).slice(-3))+$(this).find(':selected').data('nickname');
		$("#project_title_client").val(projectClient);
	});
	$("#project_service").on("change", function() {
		var projectService=$(this).find(':selected').data('code');
		$("#project_title_service").val(projectService);
	});
	$("#project_month").on("change", function() {
		var projectMonth=$(this).find(':selected').val();
		$("#project_title_month").val(projectMonth);
	});
	$("#project_year").on("change", function() {
		var projectYear=$(this).find(':selected').val();
		$("#project_title_year").val(projectYear);
	});

	$('#project_startdate').daterangepicker({
		singleDatePicker: true,
		 "locale": {
			"format": "DD/MM/YYYY",
		}
	}, function(start, end, label) {
		currentTimestamp = moment(start).unix();
		console.log(currentTimestamp);
	});	
		$('#project_enddate').daterangepicker({
		singleDatePicker: true,
		 "locale": {
			"format": "DD/MM/YYYY",
		}
	}, function(start, end, label) {
		currentTimestamp = moment(start).unix();
		console.log(currentTimestamp);
	});
	
	//Go to previous day
	$('#prev_day_button').on('click',function(){	
		chosenDate = parseInt($('#chosen_date').val());
		$('#chosen_date').val(chosenDate - dayToTimestamp);
		currentTimestamp = $('#chosen_date').val();
		console.log(currentTimestamp);
		//var currentDate = currentTimestamp;
		newTime = timeConverter(currentTimestamp);
		$('.hours-date').html(newTime);
		loadHours(currentTimestamp);
	});
	
	//Go to next day
	$('#next_day_button').on('click',function(){
		chosenDate = parseInt($('#chosen_date').val());
		$('#chosen_date').val(chosenDate + dayToTimestamp);
		currentTimestamp = $('#chosen_date').val();
		newTime = timeConverter(currentTimestamp);
		$('.hours-date').html(newTime);
		loadHours(currentTimestamp);
	});
	
	//Go to today
	$('#goto_today_button').on('click',function(){
		currentTimestamp = $('#today_timestamp').val();
		$('#chosen_date').val(currentTimestamp);
		newTime = timeConverter(currentTimestamp);
		$('.hours-date').html(newTime);
		loadHours(currentTimestamp);
	});
	
	//$('#select_day_button').daterangepicker();
	$('#select_day_button').daterangepicker({
	singleDatePicker: true
	}, function(start, end, label) {
		currentTimestamp = moment(start).unix();
		console.log(currentTimestamp);
		$('#chosen_date').val(currentTimestamp);
		newTime = timeConverter(currentTimestamp);
		$('.hours-date').html(newTime);
		loadHours(currentTimestamp);
	});
	
	//Get time from datepicker
	$('#select_day_button').on('click',function(){
		
		//currentTimestamp = $('#today_timestamp').val();
		//$('#chosen_date').val(currentTimestamp);
		//newTime = timeConverter(currentTimestamp);
		//$('.hours-date').html(newTime);
		//loadHours(currentTimestamp);
	});
	
	//Save new hour
	$('#hours_submit').click(function(e){
		e.preventDefault();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: "/",
			method: 'post',
			data: {				
				project_code_id: $('#project_code_id').val(),
				description: $('#description').val(),
				timestamp: $('#chosen_date').val(),
				hours: $('#hours_input').val(),
				minutes: $('#minutes_input').val(),
			},
			success: function(result){
				console.log(result);
				var timeHours = Math.floor(result.minutes/60);
				var timeMinutes = result.minutes%60;
				timeMinutes = ('0'+timeMinutes).slice(-2);
				var task = '<tr id="task_' + result.id + '" class="d-flex"><td class="col-md-3">' + result.project.title +'</td><td class="col-md-6">' + result.description + '</td><td class="col-md-1 listed-hours">' + timeHours + ':' + timeMinutes + '</td>';
				task += '<td class="col-md-2 text-right table-cell-actions"><div class="btn-group"><button class="btn btn-default btn-xs btn-detail open-edit-modal" data-id="' + result.id + '"><span class="glyphicon glyphicon-pencil"></span></button>';
				task += '<button class="btn btn-default btn-xs btn-delete delete-task" data-id="' + result.id + '"><span class="glyphicon glyphicon-remove"></span></button></div></td></tr>';
				
				$('#task_list').append(task);

				resetHoursForm();
				$('#time_modal').modal('hide');
			},
			error:function(jqXHR, exception){
				var msg = '';
				if (jqXHR.status === 0) {
					msg = 'Not connected.\n Verify Network.';
				} else if (jqXHR.status == 404) {
					msg = 'Requested page not found. [404]';
				} else if (jqXHR.status == 500) {
					msg = 'Internal Server Error [500].';
				} else if (exception === 'parsererror') {
					msg = 'Requested JSON parse failed....';
				} else if (exception === 'timeout') {
					msg = 'Time out error.';
				} else if (exception === 'abort') {
					msg = 'Ajax request aborted.';
				} else {
					msg = 'Uncaught Error.\n' + jqXHR.responseText;
				}
				console.log(msg);
			}
		});
	}); //End of save new hour
	
	// Show hour modal
	$('#task_list').on('click','.open-edit-modal', function(e){
		var projectId = $(this).attr('data-id');
		console.log(projectId);
		resetHoursForm();
		$('#modal_hour_id').val(projectId);
		$('#hours_submit').hide();
		$('#hours_update').show();
		$('#time_modal').modal('show');
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: "/edithour",
			method: 'post',
			data: {				
				id: projectId
			},
			success: function(result){
				console.log(result);
				var timeSaved = result.minutes;
				var timeHours = Math.floor((result.minutes)/60);
				var timeMinutes = (result.minutes)%60;
				var project = result.project_code_id;
				timeMinutes = ('0'+timeMinutes).slice(-2);
				$('#hours_input').val(timeHours);
				$('#minutes_input').val(timeMinutes);
				$('#description').val(result.description);
				$('#project_code_id option[value='+project+']').prop('selected', true);
				
			},
			error:function(jqXHR, exception){
				var msg = '';
				if (jqXHR.status === 0) {
					msg = 'Not connected.\n Verify Network.';
				} else if (jqXHR.status == 404) {
					msg = 'Requested page not found. [404]';
				} else if (jqXHR.status == 500) {
					msg = 'Internal Server Error [500].';
				} else if (exception === 'parsererror') {
					msg = 'Requested JSON parse failed....';
				} else if (exception === 'timeout') {
					msg = 'Time out error.';
				} else if (exception === 'abort') {
					msg = 'Ajax request aborted.';
				} else {
					msg = 'Uncaught Error.\n' + jqXHR.responseText;
				}
				console.log(msg);
			}
		});
	
	});//End of hour modal
	
	//Update hour
	$('#hours_update').click(function(e){
		e.preventDefault();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: "/update",
			method: 'PUT',
			data: {	
				id:	$('#modal_hour_id').val(),	
				project_code_id: $('#project_code_id').val(),
				description: $('#description').val(),
				timestamp: $('#chosen_date').val(),
				hours: $('#hours_input').val(),
				minutes: $('#minutes_input').val(),
			},
			success: function(result){
				console.log(result);
				var timeHours = Math.floor(result.minutes/60);
				var timeMinutes = result.minutes%60;
				timeMinutes = ('0'+timeMinutes).slice(-2);
				var task = '<td class="col-md-3">' + result.project.title +'</td><td class="col-md-6">' + result.description + '</td><td class="col-md-1 listed-hours">' + timeHours + ':' + timeMinutes + '</td>';
				task += '<td class="col-md-2 text-right table-cell-actions"><div class="btn-group"><button class="btn btn-default btn-xs btn-detail open-edit-modal" data-id="' + result.id + '"><span class="glyphicon glyphicon-pencil"></span></button>';
				task += '<button class="btn btn-default btn-xs btn-delete delete-task" data-id="' + result.id + '"><span class="glyphicon glyphicon-remove"></span></button></div></td>';
				
				//$('#task_list').append(task);
				$('#task_' + result.id).html(task);

				resetHoursForm();
				$('#time_modal').modal('hide');
			},
			error:function(jqXHR, exception){
				var msg = '';
				if (jqXHR.status === 0) {
					msg = 'Not connected.\n Verify Network.';
				} else if (jqXHR.status == 404) {
					msg = 'Requested page not found. [404]';
				} else if (jqXHR.status == 500) {
					msg = 'Internal Server Error [500].';
				} else if (exception === 'parsererror') {
					msg = 'Requested JSON parse failed....';
				} else if (exception === 'timeout') {
					msg = 'Time out error.';
				} else if (exception === 'abort') {
					msg = 'Ajax request aborted.';
				} else {
					msg = 'Uncaught Error.\n' + jqXHR.responseText;
				}
				console.log(msg);
			}
		});
	}); //End of update hour

	//Delete hour
	$('#task_list').on('click','.delete-task', function(e){
		e.preventDefault();
		var that = this;
		//$(this).closest('tr').remove();
		console.log('delete');
		var projectId = $(this).attr('data-id');
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: "/destroy_hour",
			method: 'GET',
			data: {	
				id:	projectId
			},
			success: function(result){
				console.log(result);
				$(that).closest('tr').remove();
				resetHoursForm();
				$('#time_modal').modal('hide');
			},
			error:function(jqXHR, exception){
				var msg = '';
				if (jqXHR.status === 0) {
					msg = 'Not connected.\n Verify Network.';
				} else if (jqXHR.status == 404) {
					msg = 'Requested page not found. [404]';
				} else if (jqXHR.status == 500) {
					msg = 'Internal Server Error [500].';
				} else if (exception === 'parsererror') {
					msg = 'Requested JSON parse failed....';
				} else if (exception === 'timeout') {
					msg = 'Time out error.';
				} else if (exception === 'abort') {
					msg = 'Ajax request aborted.';
				} else {
					msg = 'Uncaught Error.\n' + jqXHR.responseText;
				}
				console.log(msg);
			}
		});
	}); //End of delete hour

	
	$('#add_time_button').on('click',function(){
		resetHoursForm();		
		$('#hours_update').hide();
		$('#hours_submit').show();
	});
	
	
	//get hours from DB when changing date
	function loadHours(time) {
	console.log('loadHours ' + time);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: "/loadmorehours",
			method: 'post',
			dataType: "html",
			data: {				
				current_date: time
			},
			success: function(result){
				console.log(result);
				console.log('result');
				$('#task_list').html('');
				$('#task_list').append(result);
			},
			error:function(jqXHR, exception){
				var msg = '';
				if (jqXHR.status === 0) {
					msg = 'Not connected.\n Verify Network.';
				} else if (jqXHR.status == 404) {
					msg = 'Requested page not found. [404]';
				} else if (jqXHR.status == 500) {
					msg = 'Internal Server Error [500].';
				} else if (exception === 'parsererror') {
					msg = 'Requested JSON parse failed....';
				} else if (exception === 'timeout') {
					msg = 'Time out error.';
				} else if (exception === 'abort') {
					msg = 'Ajax request aborted.';
				} else {
					msg = 'Uncaught Error.\n' + jqXHR.responseText;
				}
				console.log(msg);
			}
		});
		
	}
	
	function timeConverter(UNIX_timestamp){
		var a = new Date(UNIX_timestamp * 1000);
		console.log(UNIX_timestamp + ' UNIX_timestamp');
		//var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
		var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
		var year = a.getFullYear();
		
		var month = (a.getMonth()+1);
		var date = a.getDate();
		//var day = a.getDay();
		var day = days[a.getDay()];
		var time = day + ', ' + date + ' /' + month + ' /' + year;
		return time;
	}
	
	//reset form but maintain current timestamp
	function resetHoursForm() {
		var saveDate = parseInt($('#chosen_date').val());
		$('#hours_form').trigger("reset");
		$('#chosen_date').val(saveDate);
	}
	
	
});