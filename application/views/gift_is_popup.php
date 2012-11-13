<?php 
		echo "<div id = 'dets_" . $num . "' class = 'modal_window'>";
	
?>

<div class = 'right_wrapper'>
		
            	<div class = "gift_status">
           			<p><?php echo $taken_text; ?></p>           		
				</div><!--end gif_status -->   
        		<div class = "gift_button">
					<?php echo "<span class = 'email'><img src='" . base_url() . "public/img/email_icon.png' /></span>";?>				
					<span class = "btn_text">Email GiftList <br /> Admin</span>
				</div><!--end gift_button -->
			</div> <!--end right wrapper -->
            
     <div class = "gift_title">		
		<?php echo "<img src = '" . base_url() . "public/num/" . $num . ".png'>" . $title; ?>      
	</div> <!-- end gift_title-->
	<div class = "desc_wrapper">
		<?php echo $description; ?>
	</div> <!--end desc_wrapper-->   
	<div class = "link_wrapper_full">
			<span class = "link_preview">
			<?php echo "<img src= '" . base_url() . "/public/gift_img/" . $image . "' />"; ?>
		</span>		
		<span class = "link_section">
    <ul>
