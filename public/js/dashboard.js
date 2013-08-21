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
  });

    $('h3>.edit').click(function (e) {
    e.preventDefault();
    id = $(this).siblings('span').data('id');
    $.ajax({
    type: "POST",
      dataType: "html",
       url: '../dash_add_form',
       data: {'list_id': id, 'action': 'dash_edit_gift'},
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
  });

  $('.item>.edit').click(function (e) {
    e.preventDefault();
    gift_id = $(this).parent().data('id');
    id = $(this).parent().parent().siblings('h3').children('span').data('id');
   
    $.ajax({
    type: "POST",
      dataType: "html",
       url: '../dash_add_form',
       data: {'list_id': id, 'gift_id':gift_id, 'action': 'dash_edit_gift_item'},
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
  });

   $('.item>.delete').click(function (e) {
    e.preventDefault();
    gift_id = $(this).parent().data('id');
    id = $(this).parent().parent().siblings('h3').children('span').data('id');
   
    $.ajax({
    type: "POST",
      dataType: "html",
       url: '../dash_add_form',
       data: {'list_id': id, 'gift_id':gift_id, 'action': 'dash_delete_gift_item'},
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
  });

  $('.delete').click(function (e) {
    e.preventDefault();
    id = $(this).siblings('span').data('id');
    $.ajax({
    type: "POST",
      dataType: "html",
       url: '../dash_add_form',
       data: {'list_id': id, 'action': 'dash_delete_gift'},
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
  });

    $('button.gift').click(function (e) {
      alert('hi');
    e.preventDefault();
    id = $(this).data('id');
   // id = $(this).siblings('span').data('id');
    $.ajax({
    type: "POST",
      dataType: "html",
       url: '../dash_add_form',
       data: {'list_id': id, 'action': 'dash_add_list'},
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
  });

    $('#login_submit').click(function (e) {
      e.preventDefault();
      password = $('input[name=password]').val();
      //alert(CryptoJS.MD5($('input[name=password]').val()));
      $.ajax({
        type: "POST",
        dataType: "JSON",
        url: '../logmein',
        data: {'user_name': $('input[name=user_name]').val(), 'password': CryptoJS.MD5(password).toString()},
        failure: function() {alert ('bad');},
        success: function(data) {
          var json = $.parseJSON(data);
          if (data.login == 'true') {
            $('.message').text(data.message);
            window.location.href = window.location.pathname;
          } else {
            $('.message').text(data.message);
          }
      }
      });
    });

    $('input[name=user_name]').focus(function () {
       $('.message').text();
    });

  });