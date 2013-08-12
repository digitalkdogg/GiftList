<div class = 'login'>
	<div class = 'login_title'></div>
<?php 
$this->load->helper('url');
$attributes = array('class' => 'login_form', 'id' => 'myform');
	echo form_open(base_url() . 'list.php/logmein', $attributes);
	echo '<div class= "left">';
	echo form_label('User Name : ', 'name'). '<br />';
	echo form_label('password : ', 'password');
	echo '</div><div class = "right">';
	echo form_input('user_name', '') . '<br />';
	echo form_password('password', '');
	echo '</div><div>';

	echo form_submit('submit', 'Login');
	echo form_submit('cancel', 'Cancel');
	echo '</div>';
	echo form_close();
?>
</div>