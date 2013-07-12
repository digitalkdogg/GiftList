$(document).ready(function () {
  $('.list').hide();
 
  $('h3').click(function () {
    var gift = ($(this).next('div'));
    $(gift).toggle(1000, function () {
      var arrow = ($(this).parent().children('h3').children('img'));
    $(arrow).toggleClass('down', 'slow');
    });
  });

  });