$(document).ready(function() {

	var body_width = $('#body').width();
	var body_height = $('#body').height();

	$('#calendar').css('left', 0 * body_width);
	$('#pledge_forum').css('left', 0.25 * body_width);
	$('#pledge_files').css('left', 0.5 * body_width);
	$('#forum').css('left', 0.25 * body_width);
	$('#files').css('left', 0.5 * body_width);
	$('#messages').css('left', 0.75 * body_width);
	$('#news_update_button').css('left', 0 * body_width);
	$('#rush_update_button').css('left', 0.75 * body_width);
	
	/*$('#internal_accordion').accordion({
		collapsible: true,
		active: false
	});
	
	$('#internal_accordion').css('display', 'none');
	
	$('.button').button();
	$('#internal_display').attr('src', 'calendar.php');
	
	$('#calendar').click(function() {
		$('#internal_display').fadeOut(300);
		$('#internal_display').attr('src', 'calendar.php');
		$('#internal_display').fadeIn(300);
	});
	$('#files').click(function() {
		$('#internal_display').fadeOut(300);
		$('#internal_display').attr('src', 'files.php');
		$('#internal_display').fadeIn(300);
	});
	$('#discussion').click(function() {
		$('#internal_display').fadeOut(300);
		$('#internal_display').attr('src', 'thread_main.php');
		$('#internal_display').fadeIn(300);
	});
	
	$('#toggle_view').toggle(function() {
		$('#internal_buttons').fadeOut('fast');
		$('#internal_accordion').fadeIn('fast');	
	}, function() {
		$('#internal_accordion').fadeOut('fast');
		$('#internal_buttons').fadeIn('fast');
	});*/
	
	
	var calendarLeft = $('#calendar').position().left;
	var calendarTop = $('#calendar').position().top;
	
	var forumLeft = $('#forum').position().left;
	var forumTop = $('#forum').position().top;
	
	var filesLeft = $('#files').position().left;
	var filesTop = $('#files').position().top;
	
	var pledge_forumLeft = $('#pledge_forum').position().left;
	var pledge_forumTop = $('#pledge_forum').position().top;
	
	var pledge_filesLeft = $('#pledge_files').position().left;
	var pledge_filesTop = $('#pledge_files').position().top;
	
	var messagesLeft = $('#messages').position().left;
	var messagesTop = $('#messages').position().top;
	
	var newsLeft = $('#news_update_button').position().left;
	var newsTop = $('#news_update_button').position().top;
	
	var rushLeft = $('#rush_update_button').position().left;
	var rushTop = $('#rush_update_button').position().top;
	
	$('#calendar').mouseenter(function() {
		$(this).css('left', calendarLeft - 3).css('top', calendarTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	}).mouseleave(function() {
		$(this).css('left', calendarLeft).css('top', calendarTop);
		$(this).css('box-shadow', 'none');
	}).mousedown(function() {
		$(this).css('left', calendarLeft).css('top', calendarTop);
		$(this).css('box-shadow', 'none');
	}).mouseup(function() {
		$(this).css('left', calendarLeft - 3).css('top', calendarTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	});
	
	$('#forum').mouseenter(function() {
		$(this).css('left', forumLeft - 3).css('top', forumTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	}).mouseleave(function() {
		$(this).css('left', forumLeft).css('top', forumTop);
		$(this).css('box-shadow', 'none');
	}).mousedown(function() {
		$(this).css('left', forumLeft).css('top', forumTop);
		$(this).css('box-shadow', 'none');
	}).mouseup(function() {
		$(this).css('left', forumLeft - 3).css('top', forumTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	});
	
	$('#files').mouseenter(function() {
		$(this).css('left', filesLeft - 3).css('top', filesTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	}).mouseleave(function() {
		$(this).css('left', filesLeft).css('top', filesTop);
		$(this).css('box-shadow', 'none');
	}).mousedown(function() {
		$(this).css('left', filesLeft).css('top', filesTop);
		$(this).css('box-shadow', 'none');
	}).mouseup(function() {
		$(this).css('left', filesLeft - 3).css('top', filesTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	});
	
	
	$('#messages').mouseenter(function() {
		$(this).css('left', messagesLeft - 3).css('top', messagesTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	}).mouseleave(function() {
		$(this).css('left', messagesLeft).css('top', messagesTop);
		$(this).css('box-shadow', 'none');
	}).mousedown(function() {
		$(this).css('left', messagesLeft).css('top', messagesTop);
		$(this).css('box-shadow', 'none');
	}).mouseup(function() {
		$(this).css('left', messagesLeft - 3).css('top', messagesTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	});
	
	$('#news_update_button').mouseenter(function() {
		$(this).css('left', newsLeft - 3).css('top', newsTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	}).mouseleave(function() {
		$(this).css('left', newsLeft).css('top', newsTop);
		$(this).css('box-shadow', 'none');
	}).mousedown(function() {
		$(this).css('left', newsLeft).css('top', newsTop);
		$(this).css('box-shadow', 'none');
	}).mouseup(function() {
		$(this).css('left', newsLeft - 3).css('top', newsTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	});
	
	$('#rush_update_button').mouseenter(function() {
		$(this).css('left', rushLeft - 3).css('top', rushTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	}).mouseleave(function() {
		$(this).css('left', rushLeft).css('top', rushTop);
		$(this).css('box-shadow', 'none');
	}).mousedown(function() {
		$(this).css('left', rushLeft).css('top', rushTop);
		$(this).css('box-shadow', 'none');
	}).mouseup(function() {
		$(this).css('left', rushLeft - 3).css('top', rushTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	});
	
	$('#pledge_forum').mouseenter(function() {
		$(this).css('left', pledge_forumLeft - 3).css('top', pledge_forumTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	}).mouseleave(function() {
		$(this).css('left', pledge_forumLeft).css('top', pledge_forumTop);
		$(this).css('box-shadow', 'none');
	}).mousedown(function() {
		$(this).css('left', pledge_forumLeft).css('top', pledge_forumTop);
		$(this).css('box-shadow', 'none');
	}).mouseup(function() {
		$(this).css('left', pledge_forumLeft - 3).css('top', pledge_forumTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	});
	
	$('#pledge_files').mouseenter(function() {
		$(this).css('left', pledge_filesLeft - 3).css('top', pledge_filesTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	}).mouseleave(function() {
		$(this).css('left', pledge_filesLeft).css('top', pledge_filesTop);
		$(this).css('box-shadow', 'none');
	}).mousedown(function() {
		$(this).css('left', pledge_filesLeft).css('top', pledge_filesTop);
		$(this).css('box-shadow', 'none');
	}).mouseup(function() {
		$(this).css('left', pledge_filesLeft - 3).css('top', pledge_filesTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	});
	
	
	$('span').css('top', 300 * 0.86);
	$('#calendar > span').css('left', (245 - 84)*0.5);
	$('#forum > span').css('left', (245 - 190)*0.5);
	$('#files > span').css('left', (245 - 107)*0.5);
	$('#pledge_forum > span').css('left', 10);
	$('#pledge_files > span').css('left', 40);
	$('#messages > span').css('left', (245 - 92)*0.5);
	$('#rush_update_button > span').css('left',55);
	$('#news_update_button > span').css('left', 27);

});

$(window).resize(function() {
	var body_width = $('#body').width();
	var body_height = $('#body').height();

	$('#calendar').css('left', 0 * body_width);
	$('#pledge_forum').css('left', 0.25 * body_width);
	$('#pledge_files').css('left', 0.5 * body_width);
	$('#forum').css('left', 0.25 * body_width);
	$('#files').css('left', 0.5 * body_width);
	$('#messages').css('left', 0.75 * body_width);
	$('#news_update_button').css('left', 0 * body_width);
	$('#rush_update_button').css('left', 0.75 * body_width);
	
	var calendarLeft = $('#calendar').position().left;
	var calendarTop = $('#calendar').position().top;
	
	var forumLeft = $('#forum').position().left;
	var forumTop = $('#forum').position().top;
	
	var filesLeft = $('#files').position().left;
	var filesTop = $('#files').position().top;
	
	var pledge_forumLeft = $('#pledge_forum').position().left;
	var pledge_forumTop = $('#pledge_forum').position().top;
	
	var pledge_filesLeft = $('#pledge_files').position().left;
	var pledge_filesTop = $('#pledge_files').position().top;
	
	var messagesLeft = $('#messages').position().left;
	var messagesTop = $('#messages').position().top;
	
	var newsLeft = $('#news_update_button').position().left;
	var newsTop = $('#news_update_button').position().top;
	
	var rushLeft = $('#rush_update_button').position().left;
	var rushTop = $('#rush_update_button').position().top;
	
	$('#calendar').mouseenter(function() {
		$(this).css('left', calendarLeft - 3).css('top', calendarTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	}).mouseleave(function() {
		$(this).css('left', calendarLeft).css('top', calendarTop);
		$(this).css('box-shadow', 'none');
	}).mousedown(function() {
		$(this).css('left', calendarLeft).css('top', calendarTop);
		$(this).css('box-shadow', 'none');
	}).mouseup(function() {
		$(this).css('left', calendarLeft - 3).css('top', calendarTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	});
	
	$('#forum').mouseenter(function() {
		$(this).css('left', forumLeft - 3).css('top', forumTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	}).mouseleave(function() {
		$(this).css('left', forumLeft).css('top', forumTop);
		$(this).css('box-shadow', 'none');
	}).mousedown(function() {
		$(this).css('left', forumLeft).css('top', forumTop);
		$(this).css('box-shadow', 'none');
	}).mouseup(function() {
		$(this).css('left', forumLeft - 3).css('top', forumTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	});
	
	$('#files').mouseenter(function() {
		$(this).css('left', filesLeft - 3).css('top', filesTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	}).mouseleave(function() {
		$(this).css('left', filesLeft).css('top', filesTop);
		$(this).css('box-shadow', 'none');
	}).mousedown(function() {
		$(this).css('left', filesLeft).css('top', filesTop);
		$(this).css('box-shadow', 'none');
	}).mouseup(function() {
		$(this).css('left', filesLeft - 3).css('top', filesTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	});
	
	
	$('#messages').mouseenter(function() {
		$(this).css('left', messagesLeft - 3).css('top', messagesTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	}).mouseleave(function() {
		$(this).css('left', messagesLeft).css('top', messagesTop);
		$(this).css('box-shadow', 'none');
	}).mousedown(function() {
		$(this).css('left', messagesLeft).css('top', messagesTop);
		$(this).css('box-shadow', 'none');
	}).mouseup(function() {
		$(this).css('left', messagesLeft - 3).css('top', messagesTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	});
	
	$('#news_update_button').mouseenter(function() {
		$(this).css('left', newsLeft - 3).css('top', newsTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	}).mouseleave(function() {
		$(this).css('left', newsLeft).css('top', newsTop);
		$(this).css('box-shadow', 'none');
	}).mousedown(function() {
		$(this).css('left', newsLeft).css('top', newsTop);
		$(this).css('box-shadow', 'none');
	}).mouseup(function() {
		$(this).css('left', newsLeft - 3).css('top', newsTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	});
	
	$('#rush_update_button').mouseenter(function() {
		$(this).css('left', rushLeft - 3).css('top', rushTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	}).mouseleave(function() {
		$(this).css('left', rushLeft).css('top', rushTop);
		$(this).css('box-shadow', 'none');
	}).mousedown(function() {
		$(this).css('left', rushLeft).css('top', rushTop);
		$(this).css('box-shadow', 'none');
	}).mouseup(function() {
		$(this).css('left', rushLeft - 3).css('top', rushTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	});
	
	$('#pledge_forum').mouseenter(function() {
		$(this).css('left', pledge_forumLeft - 3).css('top', pledge_forumTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	}).mouseleave(function() {
		$(this).css('left', pledge_forumLeft).css('top', pledge_forumTop);
		$(this).css('box-shadow', 'none');
	}).mousedown(function() {
		$(this).css('left', pledge_forumLeft).css('top', pledge_forumTop);
		$(this).css('box-shadow', 'none');
	}).mouseup(function() {
		$(this).css('left', pledge_forumLeft - 3).css('top', pledge_forumTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	});
	
	$('#pledge_files').mouseenter(function() {
		$(this).css('left', pledge_filesLeft - 3).css('top', pledge_filesTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	}).mouseleave(function() {
		$(this).css('left', pledge_filesLeft).css('top', pledge_filesTop);
		$(this).css('box-shadow', 'none');
	}).mousedown(function() {
		$(this).css('left', pledge_filesLeft).css('top', pledge_filesTop);
		$(this).css('box-shadow', 'none');
	}).mouseup(function() {
		$(this).css('left', pledge_filesLeft - 3).css('top', pledge_filesTop - 3);
		$(this).css('box-shadow', '3px 3px 3px gray');
	});
});