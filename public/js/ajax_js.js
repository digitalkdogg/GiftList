$(document).ready(function() {

	$('#submit').click(function () {
		var name = $("#name").val(); 
		var message = $('#message').val();
		var gift_id = $('#gift_id').val();
		date_time = make_date_time();
		var email_url = '../send_comment/' + gift_id;
		var url = '../add_comment/' + gift_id;
		if ($("#name").val() && $("#message").val()) {
		$('.comments_new').val('');
			$.ajax({  
  				type: "POST",
				dataType: "json",
  				url: url,  
  				data: {message: message, name: name},  
 				success: function(data) {
				var json = $.parseJSON(data);
	   			if (data == 'true') {
 					if ($(".comments_new")){
                		$('.comments_new').hide();
               		}
					$('#message').val('');
					$('#name').val('');
   					$('.comments:first').before("<div class='comments'>" + name + " - " + date_time + " - " + message + "</div>"); 
					$('.comments:first').css('opacity' , '.2');
					$('.comments:first').animate({opacity : 1.0}, 1000);
				       $.ajax({
  				      type: "POST",
				     dataType: "json",
  				      url: email_url,
  				      data: {},
  			         success: function(data)  {
				     }
		 	     });
				} else {
					$('#status').css('display', 'block');
					$('#status').html('There was an issue submiting your comment.  Please check the form and try again');
				}
				} 
		 	});
		} 		
		return false;
	 });
	
	$('#email_admin').click(function() {
	  $('#status').html("");
		var name = $('#name').val();
		var gift_id = $('#gift_id').val();
		var email = $('#email').val();
		var message = $('#message').val();
		var dataString = name + gift_id + email + message;
		
		var url = '../../send_email_admin/' + gift_id;
		alert(url);
      
		$.ajax({  
  				type: "POST",  
				dataType: "json",
  				url: url,  
				data: {email: email, message: message, name: name}, 
  			    success: function(data) {
					var json = $.parseJSON(data);
					if (data.sent == 'yes') {
						$('#name').val('');
						$('#message').val('');
						$('#email').val('');
						$('#status').css('display', 'inline-block');
						$('#status').css('opacity' , '.2');
						$('#status').animate({opacity : 1.0}, 1000);
                  $('#status').html("The email was sent successfully");
					}  else {
                  $('#status').css('display', 'inline-block');
						$('#status').css('opacity' , '.2');
						$('#status').animate({opacity : 1.0}, 1000);
						$('#status').html("There was an issue submiting your email");

					}
				} 
		 	});
		return false;
	});
	
	$('#email_submit').click(function () {
      $('#status').html("");
		var name = $('#name').val();
		var gift_id = $('#gift_id').val();
		var email = $('#email').val();
		var message = $('#message').val();
		//var dataString = name + gift_id + email + message;
		
		var url = '../send_email/' + gift_id;
      
		$.ajax({  
  				type: "POST",  
				dataType: "json",
  				url: url,  
  				data: {email: email, message: message, name: name},
  			    success: function(data) {
					var json = $.parseJSON(data);
					if (data.sent == 'yes') {
						$('#name').val('');
						$('#message').val('');
						$('#email').val('');
						$('#status').css('display', 'inline-block');
						$('#status').css('opacity' , '.2');
						$('#status').animate({opacity : 1.0}, 1000);
                  $('#status').html("The email was sent successfully");
					}  else {
                  $('#status').css('display', 'inline-block');
						$('#status').css('opacity' , '.2');
						$('#status').animate({opacity : 1.0}, 1000);
						$('#status').html("There was an issue submiting your email");

					}
				} 
		 	});
		return false;
 });

 $('.share_submit').click(function () {
	$('span#status').val();
    var div_id = this.parentNode.parentNode.id;
    var gift_id = $('#'+div_id+ ' #gift_id').val();
	var email = $('#'+div_id+' #email').val();
	var name = $('#'+div_id+' #name').val();
	var url = '../send_share_email/' + gift_id;
	$.ajax({  
  		type: "POST",  
		dataType: "json",
  		url: url,  
  		data: {email: email, name: name},
		success: function(data) {
        var json = $.parseJSON(data);
			if (data.sent == 'yes') {
			   $('#name').val('');
				$('#email').val('');
				$('span#status').css('display', 'inline-block');
				$('span#status').css('opacity' , '.2');
	     		$('span#status').animate({opacity : 1.0}, 1000);
           		$('span#status').html("The email was sent successfully");
			} else {
				$('span#status').css('display', 'inline-block');
				$('span#status').css('opacity' , '.2');
	     		$('span#status').animate({opacity : 1.0}, 1000);
            	$('span#status').html("There was an issue sending the email, please check your work");
				}
		}
	});
	return false;
 });
 
$('.likes').click(function (e) {
	//var like_id = $(this).('.like_text').attr("id");
	like_id =($(this).children().attr("id"));
	var num = like_id.substring(like_id.length,like_id.length-1);
	var like_gift_id = $('#like_gift_'+num).val();
	var url = '../likes/' + like_gift_id;
   e.preventDefault();
   $.ajax({  
  		type: "POST",  
		dataType: "json",
  		url: url,  
  		data: '',
		success: function(data) {
			var json = $.parseJSON(data);
   			$('#'+like_id).html(data.likes);
			
		}
		});
   return false;
});

$('#find_list').click(function () {
	
	var name = $('#search_name').val();	
	url = 'find_list.php';
	$('#search_name').val('');
	$('#results').html('');
	$.ajax({  
  		type: "POST",  
		dataType: "json",
  		url: url,  
  		data: {name : name},
		success: function(data) {
			if (data.found == 'yes'){
				$('#results').html();
				$.each(data, function (index, value) {
					if ($.isNumeric(index)){
					$('#results').append(data[index].html + '<br />');
					}
				});
			} else {
				$('#results').append('No one was found by that name');
			}
		}
		});

	
	return false;
 });
 
 $('#name').focus(function () {
	$('p#status').html('');							
});
 
});

function make_date_time()
{
	var d = new Date();
	var curr_date = d.getDate();
	var curr_month = d.getMonth();
	var curr_year = d.getFullYear();
	var hours = d.getHours()
	var minutes = d.getMinutes()
	var date_time = '';
	date_time = (curr_month + "/" + curr_date + "/" + curr_year + " " + hours + ":" + minutes);
		
	return date_time;
}