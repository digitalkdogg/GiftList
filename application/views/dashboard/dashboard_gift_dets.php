<div class = 'item'><?php echo $items->title; ?>
<?php  $span = array('delete'=>'delete','edit'=>'edit'); ?>
<?php echo $this->load->view('dashboard/dashboard_add_edit_delete', array('span'=>$span, 'url'=>'url'), true); ?>
</div>