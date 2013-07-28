<?php
class Gift extends CI_Controller {

function __construct()
    {
    	//construct: load the necessary models and libraries that are not auto loaded
        parent::__construct();
		$this->load->model('db_model');	
		$this->load->model('html_model');
		$this->load->model('gift_model');
		$this->load->library('session');
    }

	public function index()
	{
		
		//$this->display_gift('kevin');
	}
	
	/*
	@ Purpose : Display gift.  This is the main function when you come to someone's list
	@ Returns : either to the base_url or someones list
	@ 6/15/2013
	*/
	public function display_gift($name)
	{

		if (isset($name)):
			$owner = $this->db_model->get_owner($name);
			if (!$owner==null) :
				$this->html_model->load_html_begin($owner);
				$this->gift_model->load_content_begin();
				$this->db_model->print_gift_item();
				$this->html_model->load_html_close();
			else: 
				redirect(base_url() , 'refresh');
			endif;
	
		endif;
	}

	/*
	@purpose: Display one gift item off of someones list
	@parms : Gift_id, $owner_name
	@Returns : one gift item displayed in someone list
	*/
	
	public function display_gift_one_item($gift_id, $owner_name)
	{
		if($owner_name == $this->session->userdata('owner_first_name')):
			$owner = array ('onwer_id' => $this->session->userdata('owner_id'), 
							'first_name' => $this->session->userdata('owner_first_name'), 
							'last_name' => $this->session->userdata('owner_last_name'), 
							'user_name' => $this->session->userdata('owner_user_name'));
		else:
			$owner=$this->db_model->get_owner($owner_name);
		endif;
		$this->html_model->load_html_begin($owner);
		$html = array ('html' => "<div id = 'content'>");
		$this->load->view('print_html', $html);	
	    $gift_item = $this->db_model->get_gift_by_giftid($gift_id, $this->session->userdata('owner_id') );
	    $gift_item->reff = '_one';
		$this->load->view('gift', $gift_item);
		$gift_links = $this->db_model->get_gift_links($gift_item->gift_id);
		 	foreach ($gift_links as $link) :
		 		$this->load->view('gift_link', $link);
		 	endforeach;
		$this->load->view('link_wrapper_end');
		// $html=array('html' => "");
		// $this->load->view('print_html', $html);	
		$html = array ('html' => "</div>");
		$this->load->view('print_html', $html);	
		$this->db_model->print_comments($gift_item->gift_id, 100);
		// $this->db_model->print_gift_popup();
		// $this->db_model->print_share_popup();
		$this->html_model->load_html_close();
	}
	

	/*
	@Purpose: loads the comment form when click on new comment
	@params : gift_id
	@returns : the comment form so someone can make a comment.
	*/

	public function comment_form($gift_id)
	{
		$owner = array ('first_name' => $this->session->userdata('owner_first_name'), 'last_name' => $this->session->userdata('owner_last_name'), 'user_name'=>$this->session->userdata('owner_user_name'));
		$this->html_model->load_html_begin($owner);
		$html = array ('html' => "<p id = 'status' style = 'display: none;'>Staus goes here</p>");
		$this->load->view('print_html', $html);	
		$this->email_form($gift_id, '');
		$limit = 100;
		$gift_item['gift_id'] = $gift_id;
		$this->db_model->print_comments($gift_item['gift_id'], $limit);	
		$this->html_model->load_html_close();
	}
	
	/*
	@Purpose: Adds a comment to a gift item 
	@param : gift_id, post[message], post[name]
	@returns : Json true or null
	*/

	public function add_comment ($gift_id)
	{
		$this->load->helper('date');
		$date_time = date("Y-m-d g:i:s");
		$this->input->post(NULL, TRUE);
		$message=$_POST['message'];
		$name=$_POST['name'];
		if ($message && $name) 
		{		
			if (strlen($message < 400))
			{
				$data = array('name' => $name ,'message' => $message, 'gift_id' => $gift_id, 'date_time' => $date_time);
				$this->db->insert('comment', $data); 
				$response = array();
				$response[] = "true";
				echo json_encode($response);	
				
			} 
		}
	}
	
	/*
	@Purpose: Sends a email to the list owner when a new comment is made on their list
	@params : gift_id
	@return : ture
	*/

	public function send_comment_email($gift_id)
	{
	$owner = $this->db_model->get_owner_by_giftid($gift_id);
	$gift = $this->db_model->get_gift_item($gift_id);
	$message = "This is to inform you that you have a new comment on your gift_list item <a href = '" . site_url() . "/one_item/" . $gift_id . '/' . $owner->user_name . "'>" . $gift->title . "</a>";
	$send_to_owner=$this->send_mail_msg($message,
										'New GiftList Comment', 
	 									'giftlistadmin@techyconnection',
										 $owner->email);
	}

	/*
	@purpose : not sure
	@params : name
	@return: 
	*/
	public function gift_list_admin($name)
	{
		$owner = $this->db_model->get_owner($name);
		if ($this->session->userdata('owner_id')) :
			$owner_id = $this->session->userdata('owner_id');
			$owner = array ('first_name' => $this->session->userdata('owner_first_name'), 
							'last_name' => $this->session->userdata('owner_last_name'), 
							'user_name' => $this->session->userdata('owner_user_name'));
			$this->html_model->load_html_begin($owner);
			$admin = $this->db_model->get_giftlist_admin($owner_id);
			$this->load->view('gift_list_admin', $admin);
			$this->html_model->load_html_close();
		endif;
	}
	
	/*
	@purpose: Display the taken form so that someone can mark an item as taken
	@params: Gift_id, Owner_name
	@return: taken view
	*/
	public function item_taken($gift_id, $ownwer_name)
	{
		if ($this->session->userdata('owner_id')) :
			$owner = array ('first_name' => $this->session->userdata('owner_first_name'), 
							'last_name' => $this->session->userdata('owner_last_name'),
							 'owner_id'=> $this->session->userdata('owner_id'),
							 'user_name'=>$this->session->userdata('owner_user_name'));
			$owner_id = $this->session->userdata('owner_id');
		else : 
			$owner = $this->db_model->get_owner_by_giftid($gift_id);
			$owner_id = $owner['owner_id'];
		endif;
		$this->html_model->load_html_begin($owner);
		
		$gift = $this->db_model->get_gift_by_giftid($gift_id,  $owner_id);
		
		$gift_title = array ('gift_title' => $gift->title, 'reff'=>'taken');
		$gift->reff = 'taken';
		$this->load->view('taken', $gift_title);
		$this->email_form($gift_id, 1);
		$this->html_model->load_html_close();
	}
	
	/*
	@purpose: display the email form
	@params : gift_id, email address
	@return : true
	*/
	function email_form($gift_id, $email)
	{
		$html = array ('html' => "<div id = 'content'>");
		$this->load->view('print_html', $html);	
		$this->load->view('email_form', array('gift_id'=>$gift_id, 'email' => $email));
	}
	
	/*
	@purpose: update the taken status when someone marks an item as taken
	@params : gift_id
	return : true	
	*/
	function update_taken_status($gift_id)
	{
		$data = array(
               'taken_id' => 1);
		$this->db->where('gift_id', $gift_id);
		$this->db->update('gift', $data); 
	
	}
	/*
	@purpose:update like count for a gift Id
	@params : gift_id
	@return : true
	*/
	
	function update_likes($gift_id)
	{
		$cookie_ip = null;
		$cookie_gift = null;
		
		setcookie("like_ip", $this->input->ip_address(), time()+366000);
		setcookie("like_gift" . $gift_id, $gift_id, time()+366000);
		
		if (isset($_COOKIE['like_ip'])):
			$cookie_ip = $_COOKIE['like_ip'];
		endif;
		if (isset($_COOKIE['like_gift' . $gift_id])):
			$cookie_gift = $_COOKIE['like_gift' . $gift_id];
		endif;
		if ($cookie_ip == $this->input->ip_address()  && $cookie_gift == $gift_id):
			$response = array('update' => 'no');
			echo json_encode($response);
		else:
		$current_likes = $this->db_model->get_likes_by_giftid($gift_id);
		$new_likes = $current_likes +1;
		if ($current_likes > 0): 
		$data= array('like_count' => $new_likes);
		$this->db->where('gift_id', $gift_id);
		if($this->db->update('likes', $data)):
			$response = array('update' => 'yes', 'likes' => $new_likes);
			echo json_encode($response);
		endif;
		else:
		$data= array('gift_id' => $gift_id, 'like_count' => $new_likes);
		if($this->db->insert('likes', $data)):
			$response = array('update' => 'yes', 'likes' => $new_likes);
			echo json_encode($response);
		endif;
		endif;
		endif;
	}
	
	/*
	@purpose: prepare email to be sent on share gift
	@params : gift_id
	@return : json response

	*/
	function send_share_email($gift_id)
	{
			$this->load->helper('email');
			$to_email = $_POST['email'];
			$name = $_POST['name'];
			if (!valid_email($to_email)) {
				$to_email = null;
			}
			$owner = $this->db_model->get_owner_by_giftid($gift_id);
			$subject = $owner->first_name . ' ' . $owner->last_name . ' share request';
			$message= $name . " would like to share this with you";
			$email= 'giftlistadmin@presentsr4.me';
			$gift_item = $this->db_model->get_gift_item($gift_id);
			$gift_links = $this->db_model->get_gift_links($gift_id);
			
			$message .= "<div style='background:#f9f9f9; margin:10px; padding: 10px; border: 3px dashed green;'><div style='background:#f9f9f9;'>";
			$message .= "<a href = '" . site_url() . '/one_item/' . $gift_id . '/' . $owner->user_name . "'>";
			$message .="<div style='border-bottom:1px solid black;'><span style='font-size:21px; color:red; font-weight:bold;'>" . $gift_item->num . " -  </span>";
			$message .="<span style='font-size: 18px; color:red; font-weight:bold;'>" . $gift_item->title. "</span></div><div style=border-bottom:solid 1px black;>";
			$message .= "<span style='font-size: 14px; color: #333; padding-top:20px; margin-bottom: 20px;'><br />". $gift_item->description . "<br /><br /></span>";
			$message .= "<span style='background: #555; width: 150px; height: 80px; float: right; color: #e9e9e9;'>" . $gift_item->taken_text . "</span></div></a>";
			$message .= "<div style='font-size: 16; font-weight:bold; color: #390;'>Options : <br /><br /></div>";
			foreach ($gift_links as $link) :
				$message .= "<div style='background: #f9f9f9; text-size: 14px; color: #390; text-decoration: none; margin-left:5px;'><a href = '" . $link->url . "'>". $link->title . "</div>";
			endforeach;
			$message .= "</div></div>";
			if ($name && $message && $to_email):
				$this->send_mail_msg($message, $subject, $to_email, $to_email);
			else :
				$response = array('sent' => 'no');
				echo json_encode($response);
			endif;
	}
	/*
	@purpose : send an email to gift list admin
	@params : gift_id, post['email'], post['message'], post['name']
	@return : true or json response
	*/
	function send_email($gift_id)
	{
		$this->load->helper('email');
		$email= $_POST['email'];	
		$user_message = $_POST['message'];
		$name = $_POST['name'];
	    $owner = $this->db_model->get_owner_by_giftid($gift_id);
		$owner_name = $owner->first_name . ' ' . $owner->last_name;
		$gift = $this->db_model->get_gift_by_giftid($gift_id, $owner->owner_id);
		$gift_title = $gift->title;
		
		if (!valid_email($email)) {
			$email = null;
		}
		
		if ($user_message):
			$message = "This email is to inform you that " . $name . " has purchased the item " . $gift_title . " for the giftlist of " . $owner_name . "<br />";
			$message .= "<br /> Name : " . $name;
			$message .= "<br /> Person Email : " . $email;
			$message .= "<br /> Gift Item : " . $gift_title;
			$message .= "<br /> Message: " . $user_message;
		endif;
		$subject = 'GiftList item taken for ' . $gift_title;
		$giftlist_admin = $this->db_model->get_giftlist_admin($owner->owner_id);
		$to_email = $giftlist_admin->email;
		if ($name && $message && $email):
			$this->send_mail_msg($message, $subject, $email, $to_email);
			$this->update_taken_status($gift_id);
		else :
			$response = array('sent' => 'no');
			echo json_encode($response);
		endif;
	} 
	
	/*
	@purpose: display gift list base on status
	@params: status 1 or 2, owner_name
	@return : list of items 
	*/
	function menu_taken($status, $owner_name)
	{
		if ($this->session->userdata('owner_user_name') == $owner_name) {
			$owner = array ('first_name' => $this->session->userdata('owner_first_name'), 
							'last_name' => $this->session->userdata('owner_last_name'),
							'owner_id' => $this->session->userdata('owner_id'),
							'user_name' => $this->session->userdata('owner_user_name'));
		} else {
			$owner=$this->db_model->get_owner($owner_name);
		}
			$this->html_model->load_html_begin($owner);
			$html = array ('html' => "<div id = 'content'>");
			$this->load->view('print_html', $html);	
			$this->db_model->get_gift_menu($status);		
		
	}
	/*
	purpose: prepare to send to gift list admin
	params: gift_id, owner_name
	return: view admin email
	*/

	function email_admin($gift_id, $owner_name)
	{
		if ($this->session->userdata('owner_user_name')==$owner_name):
			$owner = array ('owner_id' => $this->session->userdata('owner_id'), 
							'first_name' => $this->session->userdata('owner_first_name'), 
							'last_name' => $this->session->userdata('owner_last_name'),
							'user_name'=> $this->session->userdata('owner_user_name'));
			$owner_name = $this->session->userdata('owner_first_name');
		else:
			$owner=$this->db_model->get_owner($owner_name);
		endif;
		$this->html_model->load_html_begin($owner);
		if ($gift = $this->db_model->get_gift_by_giftid($gift_id, $owner['owner_id'])):
			$gift_title = array ('gift_title' => $gift->title);
		endif;
		$this->load->view('admin_email', $gift_title);
		$this->email_form($gift_id, '2');
	}
	
	/*
	purpose: send the email to gift list admin
	params: gift_id, post[email], post[message], post[name]
	return: true or json response
	*/
	function send_email_admin($gift_id)
	{
		$this->load->helper('email');
		$email= $_POST['email'];
		$user_message = $_POST['message'];
		$name = $_POST['name'];
		$owner = $this->db_model->get_owner_by_giftid($gift_id);
		$owner_name = $owner->first_name . ' ' . $owner->last_name;	
	    $gift = $this->db_model->get_gift_by_giftid($gift_id, $owner->owner_id);
		$gift_title = $gift->title;
		
		if (!valid_email($email)) {
			$email = null;
		}
		
		if ($user_message):
			$message = "This email is to inform you that " . $name . " has a question on " . $gift_title . " for " . $owner_name . ".  " . "Below is their question : <br /> ";
			$message .= "<br /> Name : " . $name;
			$message .= "<br /> Person Email : " . $email;
			$message .= "<br /> Gift Item : " . $gift_title;
			$message .= "<br /> Message: " . $user_message;
		endif;
		$subject = 'GiftList Inquiry On ' . $gift_title;
		$giftlist_admin = $this->db_model->get_giftlist_admin($owner->owner_id);
		$to_email = $giftlist_admin->email;
		if ($name && $message && $email):
			$this->send_mail_msg($message, $subject, $email, $to_email);
		else :
			$response = array('sent' => 'no');
			echo json_encode($response);
		endif;
	}

	/*
	@purpose: sends off the actually email
	@params: message, subject, email, to-email
	return: json repsonse
	*/

	function send_mail_msg($message, $subject, $email, $to_email)
	{
	$config = array(
    		'protocol' => 'sendmail',
			'mailpath' => '/usr/sbin/sendmail',
    		'mailtype' => 'html',
   		 	'newline' => "\r\n",
    		'crlf' => "\n",
			'charset' => 'iso-8859-1',
			'wordwrap' => true
		);

		$this->load->library('email', $config);
		$this->load->library('email');
    	$this->load->helper('email');
	    $this->email->from($email, 'GiftList Manager');
		$this->email->to($to_email);
		$this->email->subject($subject);
		$this->email->message($message);
		
		if ($this->email->send()):
			$response = array('sent' => 'yes', 'email' => $to_email);	
		else :
			$response = array('sent' => 'no');
			echo $this->email->print_debugger();
		endif;
		echo json_encode($response);	
	}
}
?>