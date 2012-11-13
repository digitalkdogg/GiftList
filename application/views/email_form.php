	<?php 
	$html_data = '';
	$html_data .= "<form action='' method='post' accept-charset='utf-8'>";
	$html_data .= "<table border = '0'><tr><td width = '300px'>";
	$html_data.= form_label('Name :', 'name');
	$data = array('name' => 'name', 'id' => 'name', 'value' => '');
	$html_data.= form_input($data);
	$html_data .= '</td>';
	
	$html_data .= "<td>";
	$html_data.="<p style='display: none;' id = 'name_error' class='error' >Please enter in a valid name</p>";
	$html_data.= '</td></tr>';
	
	if ($email) {
	$html_data.= "<tr><td width = '300px'>";
	$html_data.= form_label('Email :', 'email');
	$data = array('name' => 'email', 'id' => 'email', 'value' => '');
	$html_data.= form_input($data);
	$html_data .= "<td>";
	$html_data.="<p style='display: none;' id = 'email_error'  class = 'error'>Please enter in a valid email</p>";
	$html_data.= '</td></tr>';
	}
	//$html_data.= "<tr><td width = '300px'>";
	//$html_data.= "Please take a moment and describe a little about the gift you got and where you found it :<br />"; 
	//$html_data.= form_label('Message : ', 'name');
	//$data = array('name' => 'message', 'id' => 'message', 'value' => '');
//	$html_data.= form_textarea($data);
//	$html_data.= "</td><td>";
//	$html_data.="<p style='display: none;' id = 'message_error' class = 'error'>Please enter a message</p>";
//	$html_data.="<input type='hidden' name='gift_id' value='" . $gift_id . "' id = 'gift_id' />";
//	$html_data.="<input type='hidden' name='first_name' value='" . $first_name . "' id = 'first_name' />";
	
	 
	
	//if ($email==2) {
	//$html_data.= "<tr><td width = '300px'>";
	//$html_data.= form_label('Email :', 'email');
	//$data = array('name' => 'email', 'id' => 'email', 'value' => '');
	//$html_data.= form_input($data);
	//$html_data .= "<td>";
	//$html_data.="<p style='display: none;' id = 'email_error'  class = 'error'>Please enter in a valid email</p>";
	//$html_data.= '</td></tr>';
	//}
	
	$html_data.= "<tr><td width = '300px'>";
	if ($email == 1) :
		$html_data.= "Please take a moment and describe a little about the gift you got and where you found it :<br />"; 
	endif;
	$html_data.= form_label('Message : ', 'name');
	$data = array('name' => 'message', 'id' => 'message', 'value' => '');
	$html_data.= form_textarea($data);
	$html_data.= "</td><td>";
	$html_data.="<p style='display: none;' id = 'message_error' class = 'error'>Please enter a message</p>";
	$html_data.="<input type='hidden' name='gift_id' value='" . $gift_id . "' id = 'gift_id' />";
	$html_data.="<input type='hidden' name='first_name' value='" . $first_name . "' id = 'first_name' />";
	
	$html_data.= '</td></tr>';
	$html_data .= "<tr><td with = '300px'>";
	if ($email == 1) {
	$data = array('name' => 'submit', 'id' => 'email_submit', 'value' => 'Mark as Taken!');
	$html_data.= form_submit($data);
	$html_data .= "</tr><tr><p style='display: none;' id = 'status' class = 'error'>Email Was Sent Successfully</p>";
	} else if ($email == 2) {	
	$data = array('name' => 'submit', 'id' => 'email_admin', 'value' => 'Email GiftList Admin!');
	$html_data.= form_submit($data);
	$html_data .= "</tr><tr><p style='display: none;' id = 'status' class = 'error'>Email Was Sent Successfully</p>";
	} else {
	$data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Add Comment!');
	$html_data.= form_submit($data);
	}
	$html_data.= "</td></tr></table>";
	
	$html_data.=  form_close();
	
	$html = array ('html' => $html_data);
	$this->load->view('print_html', $html);
	?>
