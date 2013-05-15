    $(document).ready(function(){

		
		  //$('.side_bar_content').append("<a style = 'display: none;' href = '#' id = 'close_more'>close</a>");
         $('.side_bar_header').append("<p class = 'show_more'>...</p>");
		// $('.side_bar_content').css('height', '-10px');
		// var isdown = false;
         $('.show_more').click(function(){
		  var div_id = $(this).closest('div').next('div').attr('id');
		 
		 
		//	$('.side_bar_content').toggle('slow');
			$('#'+div_id).slideToggle("slow");
		
			//if (isdown == true) {
			//$(this).slideUp(2000, function(){
			//$('.side_bar_header').append("<p class = 'show_more'>...</p>");
			//$('.side_bar_content').css('overflow', 'scroll');
			//$('.side_bar_content').css('max-height', '68px');
			
		//	isdown = false;
		//	});
	//		}
			
		//	if (isdown == false) {
			
		//	$(this).slideDown(2000, function(){
		//	$('.side_bar_content').css('max-height', '100%');
		//	isdown = true;	 
		//	});
		//	} 
			
			//$('.side_bar_content').slideUp(1000, function(){
			//$('.side_bar_content').css('max-height', '68px');
			//isdown = false;	
			//});
			
			
			//$('.side_bar_content').css('height', '100%');
			//$('.side_bar_content').css('max-height', '100%');
            //$('.close_more').css('display', 'block');
			//$('.side_bar_content').css('display', 'block');
			//$('.side_bar_content').append("<a href = '#' id = 'close_more'>close</a>");
		});
		
		$('#close_more').click(function() {
			//alert('hi');
		});
	

        $('.activate_modal').click(function(e){  
			 e.preventDefault();
      		 close_modal();
              //get the id of the modal window stored in the name of the activating element  
              var modal_id = $(this).attr('name'); 
              //use the function to show it  
              show_modal(modal_id);  
        });
      
        $('.close_modal').click(function(){  
            //use the function to close it  
            close_modal();  
        });  
    });   
      
    function close_modal(){  
        //hide the mask  
        $('#mask').fadeOut(500);  
        //hide modal window(s)  
        $('.modal_window').fadeOut(500);  
    }  
    function show_modal(modal_id){  
		//var lastChar = modal_id.substr(modal_id.length - 1);
		//var gift_top = 20;
		//var gift_top = $('.gift'+lastChar).position().top - 30;
		//alert(gift_top);
		var gift_height = $('#'+modal_id).height();
		//if ($('#'+modal_id).height() < 400) {
		//	gift_top = gift_top - 150;
		//}
		
		var screenWidth = $(document).width();
		var screenHeight = $(document).height();
		var windowWidth = $('#'+modal_id).width();
		var windowHeight = $('#'+modal_id).height();
		
		
        $('#mask').css({ 'display' : 'block', opacity : .5}); 
		$('#mask').css({ 'position': 'fixed', 'top' : 1, 'height': '2000px'});
        //fade in the mask to opacity 0.8  
        $('#mask').fadeTo(500,0.8);  
         //show the modal window  
        $('#'+modal_id).fadeIn(0);

      if (screenHeight < 1000){
         gift_top = (screenHeight/2 - windowHeight) + $(document).scrollTop() - 20;
      }  else {
		gift_top = (screenHeight/6 - windowHeight) + $(document).scrollTop() - 20;
      }
      
		$('#'+modal_id).css({'height': '10%'});
		$('#'+modal_id).animate({height: gift_height}, 600);
		$('#'+modal_id).css({ 'position': 'absolute', 'top' :gift_top, 'width' :'95%'});
		
    }  
