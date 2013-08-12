<?php

class Dashboard extends CI_Controller {



	function __construct()

    {

       	parent::__construct();

       	$this->load->model('db_model');	

		$this->load->model('html_model');

		$this->load->model('gift_model');

		$this->load->library('session');

    }



	public function index ($name = null) 

	{
		if ($name==null) {
			 redirect('/', 'refresh');
		}
		
		$session_data = ($this->session->all_userdata());
	
		$owner = $this->db_model->get_owner($name);

		

		    $content = $this->load->view('html_begin', '', true);

			$content .= $this->load->view('css_jquery_files', array('dashboard'=>true), true);

		 	$content .= $this->load->view('body_header', $owner, true);

		 	$content .= "<div id = 'content'>";

			if (isset($session_data['login'])):

		 	$list_items = $this->db_model->get_list_for_owner($owner['owner_id']);

		 	if ($list_items) :

		 		$content .= "<div id = 'gifts' class = 'items'>";

		 		$content .= "<div class = 'dash_title'>Lists<button class='gift' data-id = ". $owner['owner_id'] .">New Gift List</button></div>";

		 		foreach ($list_items as $list) :

		 			$items = $this->db_model->get_giftitems_list($list->list_id);

		 			$content .= $this->load->view('dashboard/dashboard_gift_start', array('title' => $list->title, 'list_id'=>$list->list_id), true);

		 			foreach ($items as $item) :

		 				$content .= $this->load->view('dashboard/dashboard_gift_dets', array('items' => $item), true);

		 			endforeach;

		 			$content .="</div><!--end item --></div><!--end item wrapper> -->";

		 		endforeach;

		 		$content .= "</div><!--end class items -->";

		 	endif;

		 

		 	if ($owner):

		 		$content .= "<div id = 'owner' class = 'items'>";

		 		$content .= "<div class = 'dash_title'>Owner Info</div>";

		 		$content .= $this->load->view('dashboard/dashboard_gift_start', array('title' => $owner['user_name']), true);

		 		$content .= $this->load->view('dashboard/dashboard_owner_dets', array('owner'=>$owner), true);

		 		$content .="</div><!--end item --></div><!--end item wrapper> -->";

		 		$content .= "</div><!--end class items -->";	

		 	endif;



		 	$admin = $this->db_model->get_giftlist_admin($owner['owner_id']);

			if($admin) :

				$content .= "<div id = 'admin' class = 'items'>";

		 		$content .= "<div class = 'dash_title'>Gift List Admin</div>";

		 		$content .= $this->load->view('dashboard/dashboard_gift_start', array('title' => $admin->first_name.' '. $admin->last_name), true);

		 		$content .= $this->load->view('dashboard/dashboard_admin_dets', array('admin'=>$admin), true);

		 		$content .="</div><!--end item --></div><!--end item wrapper> -->";

		 		$content .= "</div><!--end class items -->";	

		 	endif; 

			else:
				$content .= $this->load->view('dashboard/login_form', '', true);
			endif;

		 	$content .= $this->html_model->load_html_close('true');

		    $html = array ('html' => $content);

			$this->load->view('print_html', $html);

			//echo $content;
$this->session->unset_userdata('login');
	
	}

	public function logmein()
	{

		$owner = $this->db_model->get_owner($_POST['user_name']);
		$post_password = md5($_POST['password']);
		if ($owner['password']==$post_password) {
		$newdata = array(
                   'login'  => 'true',
                   'login_user' => $_POST['user_name']
               );

		$this->session->set_userdata($newdata);
	    redirect('/dashboard/' . $newdata['login_user'], 'refresh');
	} else {
		$this->session->unset_userdata('login');
		return json_encode(array('login', 'true'));
	}

	}


	public function get_dashboard_add_form() 
	{
		$id = $_POST['list_id']; 
		$action = $_POST['action'];
		$owner = $this->db_model->get_owner_by_listid ($id);
		switch ($action) {
			case 'dash_add_gift' :
				$list_num = $this->db_model->get_next_num_for_list($id);
				for ($i = $list_num[0]->num; $i <= 20; $i++) {
					$options[$i] = $i;
				}

				$inputs = array('1'=>array('name'=>'title', 'type'=>'text', 'value'=>'Title :', 'options'=>null, 'text_value'=>''), 
						'2'=>array('name'=>'desc', 'type'=>'text', 'value'=>'Description :', 'text_value'=>''),
						'3'=>array('name'=>'num', 'type'=>'dropdown', 'value'=>'List Number :', 'options' => $options, 'text_value'=>''),
						'4'=>array('name'=>'image', 'type'=>'image', 'value'=>'Image :', 'options'=>null, 'text_value'=>'')
						);
				$form_title = 'Add New Gift Item';
				$btn = "Add Gift Item!";
				break;

			case 'dash_edit_gift' :
				$list = $this->db_model->get_list_for_listid($id);
				$inputs = array('1'=>array('name'=>'title', 'type'=>'text', 'value'=>'Title :', 'options'=>null, 'text_value'=>$list[0]->title), 
						'2'=>array('name'=>'date', 'type'=>'text', 'value'=>'Create Date :', 'text_value'=>$list[0]->creation_date)
						);
				
				$form_title = 'Edit Gift List';
				$btn = "Edit List!";
				break;

			case 'dash_delete_gift' :
				$list = $this->db_model->get_list_for_listid($id);
				$inputs = array('1'=>array('name'=>'title', 'type'=>'text', 'value'=>'Title :', 'options'=>null, 'text_value'=>$list[0]->title), 
						'2'=>array('name'=>'date', 'type'=>'text', 'value'=>'Create Date :', 'text_value'=>$list[0]->creation_date)
						);
				$form_title = 'Remove Gift List';
				$btn = "Remove List!";

				break;
			case 'dash_add_list' :
				
				$inputs = array('1'=>array('name'=>'title', 'type'=>'text', 'value'=>'Title :', 'options'=>null, 'text_value'=>''));
				$form_title = 'Add New List';
				$btn = 'Add List!';
				break;
		}
		
		$data = array('id' => $id, 'owner'=>$owner, 
					 	'inputs'=>$inputs, 
						'form_title'=> $form_title,
						'action' => $action . '/' . $id,
						'btn' => $btn);
		$content =$this->load->view('dashboard/add_form', $data, true);
		echo json_encode($content);
	}

	public function add_list($id) 
	{
		$data = $this->input->post();
		$list = $this->db_model->insert_list ($id, $data);
		$owner = $this->db_model->get_owner_by_listid ($id);
		redirect(site_url() . '/dashboard/' . $owner[0]->user_name , 'refresh');
	}


	public function add_gift($id) 
	{
		$data = $this->input->post();
		$this->db_model->get_list_by_listid ($id, $data);
		$owner = $this->db_model->get_owner_by_listid ($id);
		redirect(site_url() . '/dashboard/' . $owner[0]->user_name , 'refresh');
	}

	public function edit_gift($id) 
	{
		$data = $this->input->post();
		$result = $this->db_model->update_list_by_listid ($id, $data);
		$owner = $this->db_model->get_owner_by_listid ($id);
		redirect(site_url() . '/dashboard/' . $owner[0]->user_name , 'refresh');
	}

	public function delete_gift($id) 
	{
		$data = $this->input->post();
		$result = $this->db_model->remove_list_by_listid ($id);
		$owner = $this->db_model->get_owner_by_listid ($id);
		redirect(site_url() . '/dashboard/' . $owner[0]->user_name , 'refresh');
	}




 }//end dashboard class