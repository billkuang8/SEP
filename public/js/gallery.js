$(document).ready(function() {
	var body_width = $('#body').width();
	var body_height = $('#body').height();
	
	$('#new_profile, #submit').button();
	$('#profile_update').dialog({
		autoOpen: false,
		resizable: false,
		modal: true,
		height: 400,
		width: 380,
		title: 'Profile Upload'
	});
	
	$('#new_profile').click(function() {
		$('#profile_update').dialog('open');
	});
	$('.picture_area').css('width', body_width).tabs();
	
	$('.delete').click(function() {
		var id = $(this).parent().attr('id');
		var filename = $(this).parent().attr('filename');
		var occupation = $(this).parent().attr('occupation');
		var csrf = $('[name="csrf_token"]').val();
		if (confirm('Are you sure that you want to delete this picture?')) {
			$.post('brothers/delete', {
				csrf_token: csrf,
				id: id,
				filename: filename,
				occupation: occupation
			}, function(data) {
				window.location.href = 'brothers';
			});
		}
		
	});
	
	$('.description_dialog').click(function() {
		var info = $(this).attr('info');
		if ((info.indexOf('src') != -1) || (info.indexOf('href') != -1) || (info.indexOf('<iframe') != -1) || (info.indexOf('<script') != -1)) {
			$('.description').text(info);
		} else {
			$('.description').html(info);
		}
		$('.description').dialog({
			resizable: false,
			title: "Personal Profile",
			show: "fade",
			hide: "fade",
			height: 350,
			width: 500,
			modal: true
		});
	});
	
});

$(window).resize(function() {
	var body_width = $('body').width();
	var body_height = $('body').height();
	
	$('#picture_area').css('width', body_width);
});