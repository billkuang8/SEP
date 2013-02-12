$(document).ready(function() {
  var body_width = $('#body').width();
  var body_height = $('#body').height();
  var div_width = $('#top_banner').width();
  var div_left = (body_width - div_width)/2;
  var div_right = body_width - div_left;

  $('#companies').css('width', body_width - 30).css('top', 280);
});

$(window).resize(function() {
  var body_width = $('#body').width();
  var body_height = $('#body').height();
  var div_width = $('#top_banner').width();
  var div_left = (body_width - div_width)/2;
  var div_right = body_width - div_left;
  $('#companies').css('width', body_width - 30).css('top', 280);
});