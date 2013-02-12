// JavaScript Document

$(document).ready(function() {
  var body_width = $('#body').width();
  var body_height = $('#body').height();
  var div_width = $('#top_banner').width();
  var div_left = (body_width - div_width)/2;
  var div_right = body_width - div_left;
  
  
  $('#slideshow_main').css('width', body_width).css('height', body_width * 0.45);
  
  $('.slideshow_amination').cycle({
    fx: 'fade',
    random: true,
    timeout: 4000,
    prevNextEvent: 'click.cycle',
    prev: '#prev',
    next: '#next'
  });
  
  $('#about').button();
  /*$('#about').click(function() {
    $('#index_dialog').dialog({
      modal: true,
      title: "About Us",
      height: 300,
      width: 800,
      buttons: [
        {
          text: "Exit",
          click: function() {
            $(this).dialog('close');
          }
        }
      ]
    });
  });*/
});

$(window).resize(function() {
  var body_width = $('#body').width();
  var body_height = $('#body').height();
  var div_width = $('.main_banner').width();
  var div_left = (body_width - div_width)/2;
  var div_right = body_width - div_left;
  $('#slideshow_main').css('width', body_width).css('height', body_width * 0.45);
});

