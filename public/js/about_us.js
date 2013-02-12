$(document).ready(function() {
  var body_width = $('#body').width();
  var body_height = $('#body').height();
  $('#contact_main').css('width', body_width - 30);  
  });
  
$(window).resize(function() {
  var body_width = $('#body').width();
  var body_height = $('#body').height();
  $('#contact_main').css('width', body_width - 30);    
  });