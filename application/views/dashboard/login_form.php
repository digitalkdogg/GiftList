<div class = 'login'>
	<div class = 'login_title'></div>
<?php 
$this->load->helper('url');
$attributes = array('class' => 'login_form', 'id' => 'myform');
	echo form_open(base_url() . '', $attributes);
	echo '<div class= "left">';
	echo form_label('User Name : ', 'name'). '<br />';
	echo form_label('password : ', 'password');
	echo '</div><div class = "right">';
	echo form_input('user_name', '') . '<br />';
	echo form_password('password', '');
	echo '</div><div>';

	$sub_attr = array('type' => 'submit', 'value'=>'Submit!', 'id' => 'login_submit');
	echo form_submit ($sub_attr);
	//echo form_cancel('cancel', 'Cancel');
	echo '</div>';
	echo '<div class = "message"></div>';
	echo form_close();
?>
</div>