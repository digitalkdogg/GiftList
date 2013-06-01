    $(document).ready(function(){
       	
    	$('.popmeup').click(function (e) {
    		e.preventDefault();
    		type = $(this).attr('id');
    		num = $(this).attr('name');
            href = $(this).attr('href');

            if (type == 'dets' || type=='share'){ //from home page
                url = '../popup/'+href+'_content';
            } else { //from some other page
                url = '../../popup/'+href+'_content';
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

    	
	
		  //$('.side_bar_content').append("<a style = 'display: none;' href = '#' id = 'close_more'>close</a>");
        $('.side_bar_header').append("<p class = 'show_more'>...</p>");
		// $('.side_bar_content').css('height', '-10px');
		// var isdown = false;
         $('.show_more').click(function(){
		   var div_id = $(this).closest('div').next('div').attr('id');
		 
		 
			$('.side_bar_content').toggle('slow');
			$('#'+div_id).slideToggle("slow");
		
			
		});
		
	
    });   

    function showPopup(data, num){
		$('#popup_wrapper').append(JSON.parse(data));
         divtop = window.pageYOffset+50;
	     $('.modal_window').css({'display':'block', 'position': 'fix', 'top':divtop+'px', 'width': '80%', 'height': '10px'});
	     $('.modal_window').animate({'height':'300px'}, 700, function () {$(this).css('height', 'auto')});
        // $('.modal_window').css('height', 'auto').animate('slow');
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
		//$('#content').css('opacity', 1);
    }