$(document).ready(function() {
  var body_width = $('#body').width();
  var body_height = $('#body').height();
  
  $('#wrapper').css('width', body_width);
  $('.post').css('width', 0.75 * body_width).css('resize', 'none');
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
  
  $('.delete').click(function() {
    if (confirm('Are you sure that you want to delete this post?')) {
      var id = $(this).parent().attr('id');
      var csrf = $('[name="csrf_token"]').val();
      var location = window.location.href;
      $.post(window.location.href, {
        csrf_token: csrf,
        deleteid: id
      }, function(data) {
        window.location.href = window.location.href;
      });
        
    }
  });

  
  });
  
$(window).resize(function() {
  var body_width = $('#body').width();
  var body_height = $('#body').height();
  
  $('#wrapper').css('width', body_width);
  $('.post').css('width', 0.75 * body_width).css('resize', 'none');
});