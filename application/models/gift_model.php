<?php
class Gift_model extends CI_Model {

   function __construct()
    {
        parent::__construct();
    }
	
	function load_gift_item($owner)
	{
	$html = array ('html' => "<div id = 'content'>");
	$this->load->view('print_html', $html);	
	$this->db_model->print_gift_item();
	}
	
	function load_gift_not_found()
	{
	$html = array ('html' => "<div id = 'content'>");
	$this->load->view('print_html', $html);	
	$html = array ('html' => "<h2 style='color: red; text-align = center'><center>No Gifts Found for this person</center></h2>");
	$this->load->view('print_html', $html);	
	}
	
}

?>