$(document).ready(function () {
  $('.list').hide();
  var url = null;
  var config = null;
  if (navigator.userAgent.indexOf('Firefox')) {
    if (window.location.href.indexOf('load_dashboard') > 0 ) {
      config = '../config';
    } else {
      config = 'config';
    }
  } else {
    config= '/config';
  }


  $.ajax({
    type: "GET",
    dataType: "html",
    url: config,
    data: {},
    failure: function() {alert ('bad');},
    success: function(data)  {
      if (data) {
        var json = $.parseJSON(data);
        url = 'http://' + json.server + '/' + json.path + 'list.php/';
      }
    }
   });

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
	     url: url + 'dash_add_form',
	     data: {'list_id': id, 'action': 'dash_add_gift'},
	     failure: function() {alert ('bad');},
         success: function(return_data)  {
         	if (return_data) {

               showPopup(return_data);
               $('#wrapper').css('opacity', '1');
             }

          $('input[name=image]').on('change', function (event) {
              $('input[name=img]').val($('input[name=image]').val().replace(/C:\\fakepath\\/i, ''));
           });
         	 $('.closeme').on('click', function (event) {
         	 	closePopup();
         	 });
     }
	 });
  });

    $('h3.gift>.edit').click(function (e) {
    e.preventDefault();
    id = $(this).siblings('span').data('id');
    $.ajax({
    type: "POST",
      dataType: "html",
       url: url + 'dash_add_form',
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
       url: url + 'dash_add_form',
       data: {'list_id': id, 'gift_id':gift_id, 'action': 'dash_edit_gift_item'},
       failure: function() {alert ('bad');},
         success: function(return_data)  {
          if (return_data) {
               showPopup(return_data);
               $('#wrapper').css('opacity', '1');
             }
           $('input[name=image]').on('change', function (event) {
              $('input[name=img]').val($('input[name=image]').val().replace(/C:\\fakepath\\/i, ''));
           });
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
    gift_id = $(this).parent().data('id');
    id = $(this).parent().parent().siblings('h3').children('span').data('id');

    $.ajax({
    type: "POST",
      dataType: "html",
       url: url + 'dash_add_form',
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
    id = $(this).siblings('span').data('id');
    $.ajax({
    type: "POST",
      dataType: "html",
       url: url + 'dash_add_form',
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
    $.ajax({
    type: "POST",
      dataType: "html",
       url: url + 'dash_add_form',
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
      $('.message').text('Connecting!');
      $.ajax({
        type: "POST",
        dataType: "JSON",
        url: 'logmein',
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
    id = $(this).siblings('span').data('id');
    $.ajax({
    type: "POST",
      dataType: "html",
       url: url + 'dash_add_form',
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

 $('h3.admin>.edit').click(function (e) {
    e.preventDefault();
    id = $(this).siblings('span').data('id');
    $.ajax({
    type: "POST",
      dataType: "html",
       url: url + 'dash_add_form',
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

 $('.next_btn').click(function (e) {
  e.preventDefault();
  $('.err').text('');
  var userForm = window.FormValidator($("#step1 input"));
  userForm.addValidation("first_name", {
    required: true
  });
   userForm.addValidation("last_name", {
    required: true
  });
  userForm.addValidation("username", {
    min_length: 6,
    required: true
  });
   userForm.addValidation("email", {
    required: true,
    email: true
  });
  userForm.addValidation("password1", {
     required: true//,
     //matches: $('#password2').val()
  });
  userForm.addValidation("password2", {
     required: true,
     matches: $('#password1').val()
  });
var userForm2 = window.FormValidator($("#step2 input"));
userForm2.addValidation("list_title", {
  required: true
});
var userForm3 = window.FormValidator($("#step3 input"));
userForm3.addValidation("gift_admin_name", {
  required: true
});
userForm3.addValidation("gift_admin_email", {
  required: true,
  email: true
});

if ($('#step1').css('visibility')=='visible') {
  var validationResult = userForm.runValidations();
  if(validationResult.valid) {
      flip_div($('#step1'), $('#step2'));
  } else {
    var errors = validationResult;
    for (i = 0;i<validationResult.messages.length;i++) {
      for (var item in validationResult.fields) {
        if (validationResult.messages[i].indexOf(item)>0) {
          $('#'+item).after('<span class = "err">-' +validationResult.messages[i]+ '</span>');
        } else if (validationResult.messages[i] == 'passwords must match each other') {
               if (item=='password1' || item=='password2') {
                  if ($('.err').text()=='') {
                    $('#password1').after('<span class = "err">passwords must match</span>');
                    $('#password2').after('<span class = "err">passwords must match</span>');
                  } //end if err
              }//end if password=item
          }//end messages[i]='password'
      }//end for item in
    }//end for i<validationresult.message.len
  }//end validation valid
} else if ($('#step2').css('visibility')=='visible') {
  var validationResult = userForm2.runValidations();
  if(validationResult.valid) {
      flip_div($('#step2'), $('#step3'));
  } else {
    var errors = validationResult;
    for (i = 0;i<validationResult.messages.length;i++) {
      for (var item in validationResult.fields) {
        if (validationResult.messages[i].indexOf(item)>0) {
          $('#'+item).after('<span class = "err">' +validationResult.messages[i]+'</span>');
        }
      }
    }
  }
} else if ($('#step3').css('visibility')=='visible') {
    var validationResult = userForm3.runValidations();
    if (validationResult.valid) {
       flip_div($('#step3'), $('#step4'));
       popuplate();
    } else {
      var errors = validationResult;
      for (i = 0;i<validationResult.messages.length;i++) {
        for (var item in validationResult.fields) {
          if (validationResult.messages[i].indexOf(item)>0) {
            $('#'+item).after('<span class = "err">' +validationResult.messages[i]+'</span>');
          }
        }
      }
    }

}
});


$('.prev_btn').click(function (e) {
  e.preventDefault();
  if ($('#step2').css('visibility')=='visible') {
      flip_div($('#step2'), $('#step1'));
  } else if ($('#step3').css('visibility')=='visible') {
     flip_div($('#step3'), $('#step2'));
  } else if ($('#step4').css('visibility')=='visible') {
     flip_div($('#step4'), $('#step3'));
  }
});

$('.conf_submit').click(function(e) {
  e.preventDefault();
  data = {};
  data['first_name'] = $('#conf_first_name').text();
  data['last_name'] = $('#conf_last_name').text();
  data['user_name'] = $('#conf_username').text();
  data['email'] = $('#conf_email').text();
  data['password'] = CryptoJS.MD5($('#password1').val()).toString();
  data['list_title'] = $('#conf_list_title').text();
  data['gift_admin_name'] = $('#gift_admin_name').val();
  data['gift_admin_email'] = $('#gift_admin_email').val();;
  doAjax("POST", "JSON", 'dashboard/submit_new_account', data, '');
});

    $('input[name=user_name]').focus(function () {
       $('.message').text();
    });

 });

function doAjax (type, dataType, ajaxurl, ajaxdata, success){
  $.ajax({
        type: type,
        dataType: dataType,
        url: 'http://localhost/giftlist/list.php/' + ajaxurl,
        data: {'data': ajaxdata},
        failure: function() {alert ('bad');},
        success: function(return_data) {

        }
      });
}

function addGiftLink (id) {
  gift_title = $('input[name=gift_title]').val();
  gift_url = $('input[name=gift_url]').val();
   $.ajax({
        type: "POST",
        dataType: "JSON",
        url: url + 'addGiftLink',
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
   $.ajax({
        type: "POST",
        dataType: "JSON",
        url: url + 'editGiftLink',
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
   $.ajax({
        type: "POST",
        dataType: "JSON",
        url: url + 'deleteGiftLink',
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

function flip_div(olddiv, newdiv) {
  $(olddiv).removeClass('rotate_right_90');
  $(olddiv).removeClass('rotate_right_0');
  setTimeout(function () {
    $(olddiv).addClass('rotate_right_90');
      },100);
      setTimeout(function () {
        $(olddiv).css('visibility', 'hidden');
      },1000);
      setTimeout(function () {
         $(newdiv).css('visibility', 'visible');
      }, 1000);
      setTimeout(function () {
         $(newdiv).addClass('rotate_right_0');
       },1000);
}

function popuplate() {
  var thispage = $('#step4>#signup>.inner_signup field');
  var fields = $('#form input[type=text]:not([readonly])');
  fields.each(function() {
      console.log('this: ' + $(this).attr('name'));
      var field = $(this).attr('name');
      $('#conf_'+field).text($(this).val());
  });
}