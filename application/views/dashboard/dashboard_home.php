<?php 
$content = $this->load->view('html_begin', '', true);
$content .= $this->load->view('css_jquery_files', array('dashboard'=>true), true);
if (isset($owner)):
$content .= $this->load->view('body_header', array('first_name'=>$owner['first_name'],
	'last_name'=>$owner['last_name'],
	'user_name'=> $owner['user_name'],
	'header_title'=>'Dashboard'), true);
else :
$content .= $this->load->view('body_header', array('first_name'=>'',
	'last_name'=>'',
	'user_name'=> '',
	'header_title'=>'Dashboard'), true);
endif;
echo $content;
return $content;