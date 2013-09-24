<?php $this->load->helper('url'); ?>
  <div class = 'item_wrapper'>
  <h3 class = '<?php echo $class; ?>'><span data-id = <?php echo $list_id; ?>><img src = '<?php echo base_url(); ?>/public/img/arrow.png' />
  <?php echo $title; ?></span>
  <?php echo "<a href = '../gift/". $owner . "/" . $list_id . "' target='_blank'> ". "&#8734;" . "</a>"; ?>
  	<?php $span = array('delete'=>'delete','edit'=>'edit','add'=>'add');?>
  	<?php $url = array('delete'=>'#', 'edit'=>'#', 'add'=>'#');?>
  	<?php echo $this->load->view('dashboard/dashboard_add_edit_delete', array('span'=>$span, 'url'=>$url), true); ?>
  </h3>
  <div class = 'list'>