$(document).ready(function() {
	$('#registration_dialog').dialog({
		modal: true,
		title: "Please Fill In All Fields",
		width: 500,
		height: 330,
		resizable: false,
		close: function(event, ui) {
			window.location.href = 'index.php';
		}
	});
});