<?php $this->load->helper('url'); ?>
  <div class = 'item_wrapper'>
  <h3><img src = '<?php echo base_url(); ?>/public/img/arrow.png' /><?php echo $title; ?>
  	<?php echo $this->load->view('dashboard/dashboard_add_edit_delete', '', true); ?>
  </h3>
  <div class = 'list'>