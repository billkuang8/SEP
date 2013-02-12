$(document).ready(function() {
	var body_width = $('#body').width();
	var body_height = $('#body').height();
	$('#contact_information').css('left', 0.65 * body_width);
	$("#message").css('width', 0.55 * body_width).css('resize', 'none');
	
	$('#email').css('color', 'gray');
	$('#email').focus(function() {
		var text = $(this).val();
		if (text == 'Please enter your email address here...') {
			$(this).attr('value', '');
			$(this).css('color', 'black');
		}
	}).blur(function() {
		var text = $(this).val();
		if (jQuery.trim(text) == '') {
			$(this).attr('value', 'Please enter your email address here...');
			$(this).css('color', 'gray');
		}
	});
	
	
  });
  
$(window).resize(function() {
	var body_width = $('#body').width();
	var body_height = $('#body').height();
	$('#contact_information').css('left', 0.65 * body_width);
	$("#message").css('width', 0.55 * body_width).css('resize', 'none');
	
	$('#email').css('color', 'gray');
	$('#email').focus(function() {
		var text = $(this).val();
		if (text == 'Please enter your email address here...') {
			$(this).attr('value', '');
			$(this).css('color', 'black');
		}
	}).blur(function() {
		var text = $(this).val();
		if (jQuery.trim(text) == '') {
			$(this).attr('value', 'Please enter your email address here...');
			$(this).css('color', 'gray');
		}
	});
	
	
  });