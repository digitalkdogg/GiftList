<?php 
	if ($taken_id == 2) :
		echo "<div id = 'gift_item' class = 'gift" . $num . "'>";
	else :
		echo "<div id = 'gift_item_disabled' class = 'gift" . $num . "'>";
	endif; ?>
	
<div class = 'right_wrapper'>
	<span class = "icons">
		 
			<?php echo "<a class = 'activate_modal' name = 'share_" . $num . "' href = '#'><img src='" . base_url() . "/public/img/share_icon.png' /></a>"; ?>
			<?php echo "<a href = '" . base_url() . "list.php/taken/" . $gift_id . "'><img src='" . base_url() . "/public/img/purchased_icon.png' /></a>"; ?>
			<?php echo "<a class = 'activate_modal' name = 'dets_" . $num . "' href = '#'><img src='" . base_url() . "/public/img/details_icon.png' /></a>"; ?>        
			<?php echo "<a href = '" . base_url() . "list.php/comment/" . $gift_id . "'><img src='" . base_url() . "/public/img//comment_icon.png' /></a>"; ?>
        </span> 
            	<div class = "gift_status">
                 <p><?php echo $taken_text; ?></p>           		
				</div><!--end gif_status -->   
        		<?php
				echo "<a href = '" . base_url() . "/list.php/email_admin/" .$gift_id . "/" . $this->session->userdata('owner_first_name'). "'><div class = 'gift_button'>"; 
				echo "<span class = 'email'><img src='" . base_url() . "/public/img/email_icon.png' /></span>"; ?>				
					<span class = "btn_text">Email GiftList <br /> Admin</span>
				</div><!--end gift_button --></a>
			</div> <!--end right wrapper -->
      
	<div class = "gift_title">		
		<?php
		echo "<a href = '" . site_url() . "/one_item/" . $gift_id . "/" . $this->session->userdata('owner_first_name') . "'>";
		 echo "<img src = '" . base_url() . "public/num/" . $num. ".png'>" . $title . "</a>" ;      
		 echo "<span class = 'likes'><span class = 'like_text' id = 'like_" . $num . "'>" . $this->db_model->get_likes_by_giftid($gift_id) . "</span>";
		   echo "<img src = '" . base_url() . "public/img/like_button.png' />"; 
    		 echo "<input type = 'hidden' id = 'like_gift_" . $num . "' value = '" . $gift_id . "'></span>"; 	
		?>
    </div><!-- end gift_title-->
	<div class = "desc_wrapper">
		<?php echo $description; ?>
	</div> <!--end desc_wrapper-->   
	<div class = "link_wrapper_full">
		<span class = "link_preview">
			<?php echo "<img src= '" . base_url() . "/public/gift_img/" . $image . "' />"; ?>
		</span>		
		<span class = "link_section">
    <ul>

