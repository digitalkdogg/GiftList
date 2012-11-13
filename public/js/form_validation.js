// JavaScript Document
$(document).ready(function() {
	$('#name').blur(function () {
		if (!$(this).val()) {
			$('p#name_error').css('display', 'inline');
			$("#submit").attr("enabled", "enabled");
		}
		else {
			$('#submit').removeAttr("disabled");
			$('p#name_error').css('display', 'none');
		}	
	});
	
		$('#message').blur(function () {
		if (!$(this).val()) {
			$('p#message_error').css('display', 'inline');
			$("#submit").attr("enabled", "enabled");
		}
		else {
			$('#submit').removeAttr("disabled");
			$('p#message_error').css('display', 'none');
		}	
		
		});
		$('#email').blur(function () {
		if (!$(this).val()) {
			$('p#email_error').css('display', 'inline');
			$("#submit").attr("enabled", "enabled");
		}
		else {
			$('#submit').removeAttr("disabled");
			$('p#email_error').css('display', 'none');
		}	
	});
		
		$('#submit').click(function() {
			if ($("#name").val() && $("#message").val()) {
				return true;
			} else {
				return false;
			}				
							
		});
		
		$('#email_submit').click(function () {
			if ($("#name").val() && $("#message").val() && $("#email").val() ) {
				return true;
			} else {
				return false;
			}
	});
});