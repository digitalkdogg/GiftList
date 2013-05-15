<?php switch ($div) {
case 1 : ?>
<div class = "right_wrapper">

  <span class = "icons">
       <?php echo "<img src='" . base_url() . "/public/img/share_icon.png' />"; ?>
       <?php echo "<a href = '" . base_url() . "index.php/gift/item_taken/" . $gift_id . "'><img src='" . base_url() . "/public/img/purchased_icon.png' /></a>"; ?>
       <?php echo "<a class = 'activate_modal' name = 'dets_" . $num . "' href = '#'><img src='" . base_url() . "/public/img/details_icon.png' /></a>"; ?>        
       <?php echo "<a href = '" . base_url() . "index.php/gift/comment_form/" . $gift_id . "'><img src='" . base_url() . "/public/img//comment_icon.png' /></a>"; ?>
  </span> 
  
  <div class = "gift_status">
       <?php echo "<p>" . $taken_text . "</p>";    ?>   
  </div><!--end gif_status -->
  <div class = "gift_button">
	<?php echo "<span class = 'email'><img src='" . base_url() . "/public/img/email_icon.png' /></span>"; ?>
    <span class = "btn_text">Email GiftList <br /> Admin</span>
  </div><!--end gift_button -->
</div> <!--end right wrapper -->
<?php break;
case 2 : ?>
<div class = 'right_wrapper'>  
            	<div class = "gift_status">
           			<?php echo "<p>" . $taken_text . "</p>";    ?>
           		</div><!--end gif_status -->   
        		<div class = "gift_button">
					<?php echo "<span class = 'email'><img src='" . base_url() . "/public/img/email_icon.png' /></span>"; ?>
					<span class = "btn_text">Email GiftList <br /> Admin</span>
				</div><!--end gift_button -->
			</div> <!--end right wrapper -->
            
     <?php break;
	 }
	 ?>
