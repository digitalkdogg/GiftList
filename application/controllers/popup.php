<?php
class Popup extends CI_Controller {

function __construct()
    {
        parent::__construct();
        $this->load->model('db_model');
        $this->load->library('session');
    }

public function dets_content() {
	
	$username= $this->session->userdata('owner_user_name');
	$link_content = null;
	$gift_id = $_GET['gift_id'];
	$data = $this->db_model->get_gift_by_username_num($username, $gift_id);
	$gift_links = $this->db_model->get_gift_links($data->gift_id);
	$content = $this->load->view('gift_is_popup', $data, true);
	foreach ($gift_links as $link) :
   		$link_content .= $this->load->view('gift_link', $link, true);
  	endforeach;
	echo json_encode($content . $link_content);
	}

public function share_content () {
	$username= $this->session->userdata('owner_user_name');
	$gift_id = $_GET['gift_id'];
	$data = $this->db_model->get_gift_by_username_num($username, $gift_id);
	$content = $this->load->view('share_gift', $data, true);
	echo json_encode($content);
}


 }