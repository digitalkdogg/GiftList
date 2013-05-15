
<?php
echo "<div id = 'share_" . $num . "' class='modal_window' style='background: white;'>";
echo "<h2> Share " . $title . "</h2>" ;
echo "<span style = 'color: red; display: none;' id = 'status'>Please enter both the name and email</span>";
echo "<form action='' method='post' accept-charset='utf-8'>";
	echo form_label('Enter Your Name :', 'name');
	$data = array('name' => 'name', 'id' => 'name', 'value' => '', 'size' => '20');
	echo form_input($data);
	
	echo "<br />";

	echo form_label('Enter Email :', 'email');
	$data = array('name' => 'email', 'id' => 'email', 'value' => '', 'size' => '40');
	echo form_input($data);
	echo "<input type='hidden' name='gift_id' value='" . $gift_id . "' id = 'gift_id' /><br />";
	
	$data = array('name' => 'share_submit', 'class' => 'share_submit', 'value' => 'Share This Gift!');
	echo form_submit($data);
	echo form_close();
	echo "<br /><br /><br /><br />";

?>
<div id='mask' class='close_modal'></div>
</div>