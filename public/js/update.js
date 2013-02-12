$(document).ready(function() {
  var body_width = $('#body').width();
  var body_height = $('#body').height();
  
  $('#update_form').css('left', 0 * body_width);
  $('#live_update').css('left', 0.65 * body_width).css('width', 0.32 * body_width).css('height', 0.4 * body_width);

  //$('#update_dialog').dialog();
  $('#date').datepicker({
  });
  $("#news_update_message").css('width', 0.55 * body_width).css('height', 0.3 * body_width).css('resize', 'none');
  
  $('.new_post').focus(function() {
    var text = $(this).val();
    if (text == 'Insert new topic here...') {
      $(this).attr('value', '');
      $(this).css('color', 'black');
    }
  }).blur(function() {
    var text = $(this).val();
    if (jQuery.trim(text) == '') {
      $(this).attr('value', 'Insert new topic here...');
      $(this).css('color', 'gray');
    }
  });
  
});

$(window).resize(function() {
 var body_width = $('#body').width();
  var body_height = $('#body').height();
  
  $('#update_form').css('left', 0 * body_width);
  $('#live_update').css('left', 0.65 * body_width).css('width', 0.32 * body_width).css('height', 0.4 * body_width);

  //$('#update_dialog').dialog();
  $('#date').datepicker({
  });
  $("#news_update_message").css('width', 0.55 * body_width).css('height', 0.3 * body_width).css('resize', 'none');
  
  $('.new_post').focus(function() {
    var text = $(this).val();
    if (text == 'Insert new topic here...') {
      $(this).attr('value', '');
      $(this).css('color', 'black');
    }
  }).blur(function() {
    var text = $(this).val();
    if (jQuery.trim(text) == '') {
      $(this).attr('value', 'Insert new topic here...');
      $(this).css('color', 'gray');
    }
  });
});