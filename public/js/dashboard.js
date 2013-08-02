$(document).ready(function () {
  $('.list').hide();
 
  $('h3>span').click(function () {
    var gift = ($(this).parent().next('div'));

    $(gift).toggle(1000, function () {
      var arrow = ($(this).parent().children('h3').children('img'));
    $(arrow).toggleClass('down', 'slow');
    });
  });

  $('.add').click(function (e) {
  	e.preventDefault();
  	id = $(this).siblings('span').data('id');
  	$.ajax({
	 	type: "POST",
     	dataType: "html",
	     url: '../dash_add_form',
	     data: {'list_id': id, 'action': 'dash_add_gift'},
	     failure: function() {alert ('bad');},
         success: function(return_data)  {
         	if (return_data) {
          
               showPopup(return_data);
               $('#wrapper').css('opacity', '1');
             }
         	 $('.closeme').on('click', function (event) {
         	 	closePopup();
         	 });
     }
	 });
 //  	showPopup('data', '2');
  });

  });