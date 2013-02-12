$(document).ready(function() {
	var body_width = $('#body').width();
	var body_height = $('#body').height();
	var slideshow_height = body_width * 0.35;
	var news_height = $('#news').height();
	$('#message').css('left', 0.41 * body_width).css('width', 0.58 * body_width).css('top', slideshow_height + 350);
	$('#news').css('width', 0.32 * body_width).css('top', slideshow_height + 350).css('height', 300);
	$('#bottom').css('width', body_width).css('top', slideshow_height + 700);
	
});

$(window).resize(function() {
	var body_width = $('#body').width();
	var body_height = $('#body').height();
	var slideshow_height = body_width * 0.35;
	var news_height = $('#news').height();
	$('#message').css('left', 0.41 * body_width).css('width', 0.58 * body_width).css('top', slideshow_height + 350);
	$('#news').css('width', 0.32 * body_width).css('top', slideshow_height + 350).css('height', 300);
	$('#bottom').css('width', body_width).css('top', slideshow_height + 700);
	
});