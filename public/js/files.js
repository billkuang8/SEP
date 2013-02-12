$(document).ready(function() {
	var body_width = $('#body').width();
	var body_height = $('#body').height();
	
	$('table').css('width', body_width);
	$('#upload_form').css('left', 0 * body_width).css('width', body_width);
	
	//$('hr').css('width', '100%');
	var tableHeight = $('table').height();
	var tableTop = $('table').position().top;
	$('#upload_form').css('top', tableHeight + tableTop + 200);
	
	$('.remove').click(function() {
		var uploaded_by = $(this).attr('uploaded_by');
		var id = $(this).attr('id');
		var type = $(this).attr('link_type');
		var filename = $(this).attr('filename');
		var csrf = $('[name="csrf_token"]').val();
		var location = window.location.href;
		if (location.indexOf('active_files') != -1) {
			location = location.replace('active_files', 'active_files/delete_file_folder');
		} else {
			location = location.replace('pledge_files', 'pledge_files/delete_file_folder');
		}
		
		if (logged_in_as == uploaded_by || privilege == 1) {
			if (confirm('Are you sure that you want to remove this file/folder?')) {
				$.post(location, {
					csrf_token: csrf,
					id: id,
					filename: filename,
					location: window.location.href,
					type: type
				}, function(data) {
					window.location.href = location;
				});
			}
		} else {
			alert('You cannot remove files uploaded by other people.');
		}
	});
});

$(window).resize(function() {
	var body_width = $('#body').width();
	var body_height = $('#body').height();
	
	$('table').css('width', body_width);
	$('#upload_form').css('left', 0 * body_width).css('width', body_width);
});