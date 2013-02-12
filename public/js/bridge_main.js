$(document).ready(function() {
	var body_width = $('#body').width();
	var body_height = $('#body').height();
	
	$('#main').css('width', body_width);
	
	
});

$(window).resize(function() {
	var body_width = $('#body').width();
	var body_height = $('#body').height();
	
	$('#main').css('width', body_width);
});