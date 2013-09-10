<div class = 'item' data-id = <?php echo $items->gift_id; ?>><?php echo $items->title; ?>
<?php  $span = array('delete'=>'delete','edit'=>'edit'); ?>
<?php $url = array('delete'=>'#', 'edit'=>'#', 'add'=>'#');?>
<?php echo $this->load->view('dashboard/dashboard_add_edit_delete', array('span'=>$span, 'url'=>$url), true); ?>
</div>