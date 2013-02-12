/* 
* To change this template, choose Tools | Templates
* and open the template in the editor.
*/

$(document).ready(function() {
	$('input').css('margin-bottom', 10);
	var footer_width = $('body').width() + 30;
	var body_width = $('#body').width();
	var body_height = $('#body').height();
	var document_width = $('body').width();
	$('#body').css('left', (document_width - body_width)/2);

	$('#top_banner').css('width', body_width);
	var div_width = $('#top_banner').width();
	var div_left = (body_width - div_width)/2;
	var div_right = div_left + div_width;

	$(window).load(function() {
		var uri = window.location.href.toLowerCase();
		var search_start = uri.indexOf('com') + 4;
		var document_height = $(document).height();
		var scroll_height = $('#body').prop('scrollHeight');
		var height = Math.max(document_height, scroll_height);

		if (uri.substring(search_start) == 'brothers' ||  uri.substring(search_start) == 's3p_renamed_index.php/brothers') {
			$('#bottom_banner').css('top', 600);
		} else if (uri.substring(search_start) == 'home' || uri.substring(search_start) == '' || uri.substring(search_start) == 's3p_renamed_index.php' || uri.substring(search_start) == 's3p_renamed_index.php/home') {
			$('#bottom_banner').css('top', 900);
		} else {
			$('#bottom_banner').css('top', height + 100);
		}
		$('#bottom_banner_div').css('left', '10%');
		$('#bottom_banner').removeClass('hide');
		$('#bottom_banner').css('width', footer_width).css('left', -(document_width - body_width)/2);
	});

	$('.sub, #internal > .top_link').mouseover(function() {
		var parent_id = $(this).parent().attr('id');
		$('#' + parent_id + ' > .top_link').css('background-color', '#44ac49').css('color', 'white');
	}).mouseout(function() {
		var parent_id = $(this).parent().attr('id');
		$('#' + parent_id + ' > .top_link').css('background-color', 'transparent').css('color', 'black');
	});

	$('.mid > a').mouseover(function() {
		$(this).css('background-color', '#44ac49').css('color', 'white');
	}).mouseout(function() {
		$(this).css('background-color', 'transparent').css('color', 'black');
	});
});

$(window).resize(function() {
	var footer_width = $('body').width() + 30;
	var body_width = $('#body').width();
	var body_height = $('#body').height();
	var document_width = $('body').width();
	$('#body').css('left', (document_width - body_width)/2);
	$('#bottom_banner').css('width', footer_width).css('left', -(document_width - body_width)/2);

	$('#top_banner').css('width', body_width);
	var div_width = $('#top_banner').width();
	var div_left = (body_width - div_width)/2;
	var div_right = div_left + div_width;

	$('#top_banner').css('width', body_width);
	var div_width = $('.main_banner').width();
	var div_left = (body_width - div_width)/2;
	var div_right = div_left + div_width;
	$('.top_slit').css('width', body_width);
});