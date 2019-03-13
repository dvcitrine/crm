$(document).ready(function( $ ) {

	var currentTimestamp, chosenDate, newTime, startDate, endDate, startTimestamp, endTimestamp ;
	var dayToTimestamp = 24*3600;
	//var monthToTimestamp = moment().subtract(1, 'months').tz("Europe/Athens").unix();
	
	//select
    $('.custom-select').select2();	
	
	//Create Project - Set up Project Title
	$("#project_description").on("input", function() {
		$("#project_title_descritpion").val(this.value);
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
		//currentTimestamp = moment(start).unix();
		currentTimestamp = moment(start).tz("Europe/Athens").unix();
		console.log(currentTimestamp);
	});	
	
	$('#project_enddate').daterangepicker({
		singleDatePicker: true,
		 "locale": {
			"format": "DD/MM/YYYY",
		}
	}, function(start, end, label) {
		//currentTimestamp = moment(start).unix();
		currentTimestamp = moment(start).tz("Europe/Athens").unix();
		console.log(currentTimestamp);
	});
	

	
	//Go to previous month
	$('#prev_month_button').on('click',function(){	
		startDate = parseInt($('#start_timestamp').val());
		startDate = moment.unix(startDate).format("YYYY-MM-DD");
		var startMonth = moment(startDate).subtract(1, 'months').tz("Europe/Athens").unix();
		console.log(moment(startDate) + " startMonth start");
		$('#start_timestamp').val(startMonth);
		currentTimestamp = $('#start_timestamp').val();
		console.log(currentTimestamp);
		//var currentDate = currentTimestamp;
		newTime = monthConverter(currentTimestamp);
		$('.hours-date').html(newTime);
		loadHoursInReport(currentTimestamp);
	});
	
	//Go to next month
	$('#next_month_button').on('click',function(){
		startDate = parseInt($('#start_timestamp').val());
		startDate = moment.unix(startDate).format("YYYY-MM-DD");
		var startMonth = moment(startDate).add(1, 'months').tz("Europe/Athens").unix();
		//$('#start_timestamp').val(startDate + startMonth);
		$('#start_timestamp').val(startMonth);
		currentTimestamp = $('#start_timestamp').val();
		newTime = monthConverter(currentTimestamp);
		$('.hours-date').html(newTime);
		loadHoursInReport(currentTimestamp);
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
		//currentTimestamp = moment(start).unix();
		//currentTimestamp = moment(start).tz("Europe/Athens").format('YYYY-MM-DD');
		//currentTimestamp = moment(start).tz("Europe/Berlin").format('YYYY-MM-DD  HH:mm:00');
		currentTimestamp = moment(start).tz("Europe/Athens").unix();
		console.log(currentTimestamp);
		$('#chosen_date').val(currentTimestamp);
		newTime = timeConverter(currentTimestamp);
		$('.hours-date').html(newTime);
		loadHours(currentTimestamp);
	});
	
	
	
	//Date ranges for Reports
	$('#select_range_button').daterangepicker({
		 "locale": {
			"format": "DD/MM/YYYY",
		}
	}, function(start, end, label) {
		//currentTimestamp = moment(start).unix();
		startTimestamp = moment(start).tz("Europe/Athens").unix();
		endTimestamp = moment(end).tz("Europe/Athens").unix();
		console.log(startTimestamp +"  " +endTimestamp);
		newStartTime = timeConverter(startTimestamp);
		newEndTime = timeConverter(endTimestamp);
		$('.hours-date').html(newStartTime + " - " + newEndTime);
		loadRangeInReport(startTimestamp, endTimestamp);
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
	
	function monthConverter(UNIX_timestamp){
		var a = new Date(UNIX_timestamp * 1000);
		console.log(UNIX_timestamp + ' UNIX_timestamp');
		var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
		//var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
		var year = a.getFullYear();
		
		var month = months[a.getMonth()];
		var date = a.getDate();
		//var day = a.getDay();
		//var day = days[a.getDay()];
		var time = month + ' ' + year;
		return time;
	}
	
	
	//get hours from DB when changing month - Reports.
	function loadHoursInReport(time) {
	console.log('loadHours ' + time);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: "/loadhoursinreport",
			method: 'post',
			dataType: "html",
			data: {				
				start_date: time
			},
			success: function(result){
				console.log(result);
				console.log('result');
				$('#report_task_list').html('');
				$('#report_task_list').append(result);
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
	
	//get hours from DB when picking date range - Reports.
	function loadRangeInReport(start, end) {
	console.log('loadHours ' + start +", " + end);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: "/loadhoursinreport",
			method: 'post',
			//dataType: "html",
			dataType: "json",
			data: {				
				start_date: start,
				end_date: end
			},
			success: function(result){
				console.log(result);
				console.log('result');
				$('#report_task_list').html('');
				$('#report_task_list').append(result.view_1);
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
	
	//reset form but maintain current timestamp
	function resetHoursForm() {
		var saveDate = parseInt($('#chosen_date').val());
		$('#hours_form').trigger("reset");
		$('#chosen_date').val(saveDate);
	}
	
	//Copy to clipboard
	$('.copy-to-clipboard').on('click',function(){	
		var copyText = $(this).siblings('.clipboard-text');
		copyText.select();
		document.execCommand("copy");
	});
	
	// Filter table for names
	$('.filtertable').on('keyup',function(){
		var input, filter, table, tr, td, i, txtValue, columnNumber;
		//input = document.getElementById("searchfornames");
		input = $(this)[0];
		filter = input.value.toUpperCase();
		//table = document.getElementById("table_active");
		table = $(this).closest('.row').siblings('table')[0];
		tr = table.getElementsByTagName("tr");
		columnNumber = $(this).attr('data-column');
		// Loop through all table rows, and hide those who don't match the search query
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[columnNumber];
			if (td) {
				txtValue = td.textContent || td.innerText;
				if (txtValue.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				} else {
					tr[i].style.display = "none";
				}
			} 
		}
	});
	
});