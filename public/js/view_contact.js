$(document).ready(function() {
  var body_width = $('#body').width();
  var body_height = $('#body').height();

  $('#wrapper').css('width', body_width);
  $('.reply').click(function() {
    if(confirm('Are you sure that you have replied and that you want to delete this message?')) {
      var id = $(this).parent().attr('id');
      var csrf = $('[name="csrf_token"]').val();
      var location = window.location.href + "/delete";
      $.post(location, {
        csrf_token: csrf,
        id: id
      }, function(data) {
        window.location.href = "http://www.berkeleysep.com/view_contact";
      });
    }
  });
});

$(window).resize(function() {
  var body_width = $('#body').width();
  var body_height = $('#body').height();

  $('#wrapper').css('width', body_width);
});