$(document).ready(function() {
	var body_width = $('body').width();
	var body_height = $('body').height();
	
	$('#new_profile, #submit').button();
	$('#profile_update').dialog({
		resizable: false,
		modal: true,
		height: 630,
		width: 500,
		title: 'Profile Upload',
		close: function(event, ui) {
			window.location.href="brothers";
		}
	});

	
	$('#new_profile').click(function() {
		$('#profile_update').dialog('open');
	});
	
	$('#picture_area').css('width', body_width * 0.75).css('left', body_width * 0.13).css('top', body_height * 0.23);
});

$(window).resize(function() {
	var body_width = $('body').width();
	var body_height = $('body').height();
	
	$('#picture_area').css('width', body_width * 0.75).css('left', body_width * 0.13).css('top', body_height * 0.23);
});