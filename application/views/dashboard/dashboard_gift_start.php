<?php $this->load->helper('url'); ?>
  <div class = 'item_wrapper'>
  <h3><span data-id = <?php echo $list_id; ?>><img src = '<?php echo base_url(); ?>/public/img/arrow.png' /><?php echo $title; ?></span>
  	<?php $span = array('delete'=>'delete','edit'=>'edit','add'=>'add');?>
  	<?php $url = array('delete'=>'deleteurl', 'edit'=>'editurl', 'add'=>'addurl');?>
  	<?php echo $this->load->view('dashboard/dashboard_add_edit_delete', array('span'=>$span, 'url'=>$url), true); ?>
  </h3>
  <div class = 'list'>