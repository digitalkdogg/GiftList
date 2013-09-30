    $(document).ready(function(){
       	
    	$('.popmeup').click(function (e) {
    		e.preventDefault();
    		type = $(this).attr('id');
    		num = $(this).attr('name');
            href = $(this).attr('href');

            if (type == 'dets' || type=='share'){ //from home page
                url = '../../popup/'+href+'_content';
            } else if (type.indexOf('ets_')>0 ||  type.indexOf('hare_')>0) {
                url = '../../popup/'+href+'_content';
            } else { //from some other page
                url = '../../../popup/'+href+'_content';
            }

    		$.ajax({
  				type: "GET",
		    	dataType: "html",
			    url: url,
			    data: {'gift_id': num},
			    failure: function() {alert ('bad');},
		        success: function(return_data)  {
		        	if (return_data) { 
                        showPopup(return_data, num);
                    }
		        	$('.closeme').on('click', function (event) {
		        		closePopup();
		        	});
		    }
    		});
    	});

        $('.side_bar_header').append("<p class = 'show_more'>...</p>");
        $('.show_more').click(function(){
		    var div_id = $(this).closest('div').next('div').attr('id');
			$('.side_bar_content').toggle('slow');
			$('#'+div_id).slideToggle("slow");
		});
    });   

    function showPopup(data){
		$('#popup_wrapper').append(JSON.parse(data));
        divtop = ($(window).height() / 2) -(500 / 2);
	    $('.modal_window').css({'display':'block', 'position': 'fixed', 'top':divtop+'px', 'width': '80%', 'height': '10px'});
	    $('.modal_window').animate({'height':'300px'}, 700, function () {$(this).css('height', 'auto')});
        $('body').css('overflow', 'hidden');
        $('#wrapper').css('opacity', '.4');
	    $('#content').css('opacity', '.4');
    }

    function closePopup () {
    	$('.modal_window').css('display', 'none');
        $('body').css('overflow', 'visible');
		$('#popup_wrapper').html('');
		$('#wrapper').fadeTo('slow', 1);
        $('#content').fadeTo('slow', 1);
    }