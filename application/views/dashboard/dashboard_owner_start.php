<?php $this->load->helper('url'); ?>
  <div class = 'item_wrapper'>
  <h3 class = '<?php echo $class; ?>'><span data-id = <?php echo $list_id; ?>><img src = '<?php echo base_url(); ?>/public/img/arrow.png' /><?php echo $title; ?></span>
  	<?php $span = array('edit'=>'edit');?>
  	<?php $url = array('edit'=>'edit_owner');?>
  	<?php echo $this->load->view('dashboard/dashboard_add_edit_delete', array('span'=>$span, 'url'=>$url), true); ?>
  </h3>
  <div class = 'list'>