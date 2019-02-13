jQuery(document).ready(function( $ ) {
	//select
    $('.custom-select').select2();
	
	$dayToTimestamp = 24*3600;
	//Go to previous day
	$('#prev_day_button').on('click',function(){
		$chosedDate = parseInt($('#chosed_date').val());
		$('#chosed_date').val($chosedDate - $dayToTimestamp);
	});
	
	//Go to next day
	$('#next_day_button').on('click',function(){
		$chosedDate = parseInt($('#chosed_date').val());
		$('#chosed_date').val($chosedDate + $dayToTimestamp);
	});
	
	
	
	
});