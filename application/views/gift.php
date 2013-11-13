

<!--**************     Start a Gift  ******** -->
<?php
	if ($taken_id == 2) :
		echo "<div id = 'gift_item' class = 'gift" . $num . "' data-list = '". $list_id . "'>";
	else :
		echo "<div id = 'gift_item_disabled' class = 'gift" . $num . "' data-list = '" .$list_id. "'>";
	endif; ?>

    <div class = 'right_wrapper'>
	    <span class = "icons">
	    	<a class = 'popmeup' id = 'share<?php echo $reff; ?>' name = '<?php echo $num; ?>' href = 'share'><img src = '<?php echo base_url(); ?>/public/img/share_icon.png' alt = 'Share' /></a>
	    	<a href = '<?php echo base_url(); ?>list.php/taken/<?php echo $gift_id . "/" . $this->session->userdata('owner_user_name'); ?>'><img src = '<?php echo base_url(); ?>/public/img/purchased_icon.png' alt = 'buy' /></a>
	    	<a class = 'popmeup' id = 'dets<?php echo $reff; ?>' name = '<?php echo $num; ?>' href = 'dets'><img src = '<?php echo base_url(); ?>/public/img/details_icon.png' alt = 'Details' /></a>
	    	<a href = '<?php echo base_url(); ?>list.php/comment/<?php echo $gift_id; ?>'><img src = '<?php echo base_url(); ?>/public/img/comment_icon.png' alt = 'Comment' /></a>
	    </span>
	    <div class = "gift_status">
	    	<p><?php echo $taken_text; ?></p>
	    </div><!--end gif_status -->
	    <a alt = 'email' href = '<?php echo base_url(); ?>list.php/email_admin/<?php echo $gift_id . "/" . $this->session->userdata("owner_user_name"); ?>'>
	    	<div class = 'gift_button'>
	    	<span class = 'email'>
	    		<img src = '<?php echo base_url(); ?>/public/img/email_icon.png' alt = 'email' />
	    	</span>
	    	<span class = "btn_text">Email GiftList <br /> Admin</span>
	    	</div><!--end gift_button -->
	    </a>
	</div> <!--end right wrapper -->

	<div class = "gift_title">
		<a href = '<?php echo site_url(); ?>/one_item/<?php echo $gift_id. "/" . $this->session->userdata('owner_user_name'); ?>'>
			<img src = '<?php echo base_url(); ?>public/num/<?php echo $num;?>.png' alt='<?php echo $num; ?>' /><?php echo $title;?></a>
			<span class = 'likes'>
				<span class = 'like_text' id = 'like_<?php echo $num;?>'><?php echo $this->db_model->get_likes_by_giftid($gift_id); ?></span>
				<img src = '<?php echo base_url(); ?>public/img/like_button.png' />
				<input type = 'hidden' id = 'like_gift_<?php echo $num; ?>' value = '<?php echo $gift_id; ?>'>
			</span>

	</div><!-- end gift_title-->
	<div class = "desc_wrapper">
		<?php echo $description; ?>

	</div> <!--end desc_wrapper-->
	<div class = "link_wrapper_full">
		<span class = "link_preview"><?php echo "<img src= '" . base_url() . "/public/gift_img/" . $image . "' alt = '" . $image . "' />"; ?></span>
		<span class = "link_section">
    		<ul>

