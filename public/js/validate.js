	function validateMe(field, validator) {
		$('.err_msg').html('');
		var errors = 0;
		switch (validator) {
             case ('required'):
              	field.each(function () {
					if ($(this).val()=='') {
						$(this).parent().parent().append('<span class = "err_msg">This field is required</span>');
						errors = errors + 1;
					}
              	});
              	return errors;
              	break;
             case ('email'):
             	return 0;
             	break;
             case ('password'):
             	return 1;
             	break;
         }
	}
	