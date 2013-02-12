$(document).ready(function() {
	$('#change_pw_dialog').dialog({
		modal: true,
		title: "Please Fill In All Fields",
		width: 450,
		height: 200,
		resizable: false,
		close: function(event, ui) {
			window.location.href = 'home';
		}
	});
});