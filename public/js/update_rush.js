$(document).ready(function() {
	var body_width = $('body').width();
	var body_height = $('body').height();
	var div_width = $('#top_banner').width();
	var div_left = (body_width - div_width)/2;
	var div_right = body_width - div_left;
	$('#publications_main').css('width', body_width * 0.73).css('height', body_width * 0.16).css('left', 0.133 * body_width);
	$('form').css('width', body_width * 0.66).css('left', 0.15 * body_width);
});
  
  $(window).resize(function() {
	var body_width = $('body').width();
	var body_height = $('body').height();
	var div_width = $('#top_banner').width();
	var div_left = (body_width - div_width)/2;
	var div_right = body_width - div_left;
	$('#publications_main').css('width', body_width * 0.73).css('height', body_width * 0.16).css('left', 0.133 * body_width);
	$('form').css('width', body_width * 0.66).css('left', 0.15 * body_width);
	
  });