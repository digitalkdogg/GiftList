<?php
class Search extends CI_Controller {

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
		
		$content = $this->load->view('dashboard/dashboard_home', '', true);
		$content .= $this->load->view('search', array('display'=>'false'), true);
		echo $content;
	}

	public function find_person() 
	{
		$content = $this->load->view('dashboard/dashboard_home', '', true);
		$data = explode(" ", $_POST['name']);
		$persons = $this->db_model->find_person($data);
		$content .= $this->load->view('search', array('result'=>$persons), true);

		echo $content;
	}
}