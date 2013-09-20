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
    url = 'http://' + window.location.hostname + '/giftlist/list.php/dash_add_form';
  	$.ajax({
	 	type: "POST",
     	dataType: "html",
	     url: url,
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

    $('h3.gift>.edit').click(function (e) {
    e.preventDefault();
    url = 'http://' + window.location.hostname + '/giftlist/list.php/dash_add_form';
    id = $(this).siblings('span').data('id');
    $.ajax({
    type: "POST",
      dataType: "html",
       url: url,
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
    url = 'http://' + window.location.hostname + '/giftlist/list.php/dash_add_form';
    gift_id = $(this).parent().data('id');
    id = $(this).parent().parent().siblings('h3').children('span').data('id');
    $.ajax({
    type: "POST",
      dataType: "html",
       url: url,
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
           $('.links .add').on('click', function (event) {
              addGiftLink($(this).parent().data('id'));
           });
           $('.links .edit').on('click', function (event) {
            event.preventDefault();
            var id = $(this).data('id');
            $('input[name=gift_title]').val($('.link_'+id).text());
            $('input[name=gift_url]').val($('.link_'+id).attr('href'));
            $('.add.icon-pencil.form').hide();
            $('.edit.icon-pencil.form').hide();
            $('.delete.icon-pencil.form').hide();
            $('input[name=gift_url]').after("<a class = 'edit icon-pencil form' href = '#'></a>");
            $('.edit.icon-pencil.form').click(function () {
                var giftid = $(this).parent().data('id');
                editGiftLink(id, giftid);
              });
           });
           $('.links .delete').on('click', function (event) {
              event.preventDefault();
              var id = $(this).data('id');
              $('input[name=gift_title]').val($('.link_'+id).text());
              $('input[name=gift_url]').val($('.link_'+id).attr('href'));
              $('.add.icon-pencil.form').hide();
              $('.edit.icon-pencil.form').hide();
              $('.delete.icon-pencil.form').hide();
              $('input[name=gift_url]').after("<a class = 'delete icon-pencil form' href = '#'></a>");
            $('.delete.icon-pencil.form').click(function () {
                var giftid = $(this).parent().data('id');
                deleteGiftLink(id, giftid);
              });
           });
           
          

     }
   });
  });

   $('.item>.delete').click(function (e) {
    e.preventDefault();
    url = 'http://' + window.location.hostname + '/giftlist/list.php/dash_add_form';
    gift_id = $(this).parent().data('id');
    id = $(this).parent().parent().siblings('h3').children('span').data('id');
   
    $.ajax({
    type: "POST",
      dataType: "html",
       url: url,
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

  $('h3.gift>.delete').click(function (e) {
    e.preventDefault();
    url = 'http://' + window.location.hostname + '/giftlist/list.php/dash_add_form';
    id = $(this).siblings('span').data('id');
    $.ajax({
    type: "POST",
      dataType: "html",
       url: url,
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
    e.preventDefault();
    id = $(this).data('id');
    url = 'http://' + window.location.hostname + '/giftlist/list.php/dash_add_form';
   // id = $(this).siblings('span').data('id');
    $.ajax({
    type: "POST",
      dataType: "html",
       url: url,
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
      url = 'http://' + window.location.hostname + '/giftlist/list.php/logmein';
      password = $('input[name=password]').val();
      $('.message').text('Connecting!');
      $.ajax({
        type: "POST",
        dataType: "JSON",
        url: url,
        data: {'user_name': $('input[name=user_name]').val(), 'password': CryptoJS.MD5(password).toString()},
        failure: function() {alert ('bad');},
        success: function(data) {
          $('.message').text('');
          var json = $.parseJSON(data);
          if (data.login == 'true') {
            $('.message').text(data.message);
            window.location.href = 'load_dashboard/' + $('input[name=user_name]').val();
          } else {
            $('.message').text(data.message);
          }
      }
      });
    });

 $('h3.owner>.edit').click(function (e) {
    e.preventDefault();
    url = 'http://' + window.location.hostname + '/giftlist/list.php/dash_add_form';
    id = $(this).siblings('span').data('id');
    $.ajax({
    type: "POST",
      dataType: "html",
       url: url,
       data: {'list_id': id, 'action': 'dash_edit_owner'},
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

 $('h3.owner>.delete').click(function (e) {
    e.preventDefault();
    url = 'http://' + window.location.hostname + '/giftlist/list.php/dash_add_form';
    id = $(this).siblings('span').data('id');
    $.ajax({
    type: "POST",
      dataType: "html",
       url: '../dash_add_form',
       data: {'list_id': id, 'action': 'dash_delete_owner'},
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


 $('h3.admin>.edit').click(function (e) {
    e.preventDefault();
    url = 'http://' + window.location.hostname + '/giftlist/list.php/dash_add_form';
    id = $(this).siblings('span').data('id');
    $.ajax({
    type: "POST",
      dataType: "html",
       url: url,
       data: {'list_id': id, 'action': 'dash_edit_admin'},
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


    $('input[name=user_name]').focus(function () {
       $('.message').text();
    });

function addGiftLink (id) {
  gift_title = $('input[name=gift_title]').val();
  gift_url = $('input[name=gift_url]').val()
  url = 'http://' + window.location.hostname + '/giftlist/list.php/addGiftLink';
   $.ajax({
        type: "POST",
        dataType: "JSON",
        url: url,
        data: {'title': gift_title, 'url': gift_url, 'id':id},
        failure: function() {alert ('bad');},
        success: function(data) {
          if (data > 0) {
            $('.links a:first').prepend("<a href = '" + gift_url + "'>" + gift_title + "</a><br />").fadeIn('slow');
          } 
        }
      });
}

function editGiftLink (id, giftid) {
  gift_title = $('input[name=gift_title]').val();
  gift_url = $('input[name=gift_url]').val();
  url = 'http://' + window.location.hostname + '/giftlist/list.php/editGiftLink';
   $.ajax({
        type: "POST",
        dataType: "JSON",
        url: url,
        data: {'title': gift_title, 'url': gift_url, 'id':id, 'giftid': giftid},
        failure: function() {alert ('bad');},
        success: function(data) {
          if (data > 0) {
            $('.link_'+id).attr('href', gift_url);
            $('.link_'+id).text(gift_title);
            $('.add.icon-pencil.form').hide();
            $('.edit.icon-pencil.form').hide();
            $('.delete.icon-pencil.form').hide();
            $('input[name=gift_url]').val('');
            $('input[name=gift_title]').val('');
            $('input[name=gift_url]').after("<a class = 'add icon-pencil form' href = '#'></a>");
           } 
        }
      });
}

function deleteGiftLink (id, giftid) {
  gift_title = $('input[name=gift_title]').val();
  gift_url = $('input[name=gift_url]').val();
  url = 'http://' + window.location.hostname + '/giftlist/list.php/deleteGiftLink';
   $.ajax({
        type: "POST",
        dataType: "JSON",
        url: url,
        data: {'id':id},
        failure: function() {alert ('bad');},
        success: function(data) {
          if (data > 0) {
             $('.link_'+id).hide();
            $('a[data-id='+id+']').hide();
            $('.add.icon-pencil.form').hide();
            $('.edit.icon-pencil.form').hide();
            $('.delete.icon-pencil.form').hide();
            $('input[name=gift_url]').val('');
            $('input[name=gift_title]').val('');
            $('input[name=gift_url]').after("<a class = 'add icon-pencil form' href = '#'></a>");
           } 
        }
      });
}
});

