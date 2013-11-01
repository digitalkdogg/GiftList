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



	public function index ()
	{
		$content = $this->load->view('dashboard/dashboard_home', '', true);
		$content .= $this->html_model->load_menu();
		$content .= $this->load->view('dashboard/login_form', '', true);
		echo $content;
//$this->session->unset_userdata('login');

	}

	public function load_dashboard($name) {
		 $session_data = ($this->session->all_userdata());
		 $owner = $this->db_model->get_owner($name);
	     $content = $this->load->view('dashboard/dashboard_home', array('owner'=>$owner), true);
       	 $content .= $this->html_model->load_menu();
       	 $side_bar = $this->db_model->get_side_bar_type(2);
       	 $content .= "<div id = 'side_bar'>";
        	foreach ($side_bar as $result):
       			$side_bar = array('id'=>$result['side_bar_id'], 'title'=>$result['title'], 'content'=>$result['content']);
	  			$content .= $this->load->view('side_bar', $side_bar, true);
			endforeach;
		 	$content .= "</div>";
	  		$content .= "<div id = 'content'>";
		 	if ($session_data['login_user']==$name):
		  		$list_items = $this->db_model->get_list_for_owner($owner['owner_id']);
		  		if ($list_items) :
		  			$content .= "<div id = 'gifts' class = 'items'>";
		  			$content .= "<div class = 'dash_title'>Lists<button class='gift' data-id = ". $owner['owner_id'] .">New Gift List</button></div>";
		  			foreach ($list_items as $list) :
		  				$items = $this->db_model->get_giftitems_list($list->list_id);
		  				$content .= $this->load->view('dashboard/dashboard_gift_start', array('title' => $list->title, 'list_id'=>$list->list_id, 'owner'=>$name, 'class'=>'gift'), true);
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
		 			$content .= $this->load->view('dashboard/dashboard_owner_start', array('title' => $owner['user_name'], 'class'=>'owner'), true);
		 			$content .= $this->load->view('dashboard/dashboard_owner_dets', array('owner'=>$owner), true);
		 			$content .="</div><!--end item --></div><!--end item wrapper> -->";
		 			$content .= "</div><!--end class items -->";
		 		endif;

		  		$admin = $this->db_model->get_giftlist_admin($owner['owner_id']);
				if($admin) :
					$content .= "<div id = 'admin' class = 'items'>";
		 			$content .= "<div class = 'dash_title'>Gift List Admin</div>";
		 			$content .= $this->load->view('dashboard/dashboard_admin_start', array('title' => $admin->first_name.' '. $admin->last_name, 'class'=>'admin'), true);
		 			$content .= $this->load->view('dashboard/dashboard_admin_dets', array('admin'=>$admin), true);
		 			$content .="</div><!--end item --></div><!--end item wrapper> -->";
		 			$content .= "</div><!--end class items -->";
		 		endif;
		 	else:
		 		redirect('dashboard', 'refresh');
		 endif;
		 $content .= $this->html_model->load_html_close('true');
		 $html = array ('html' => $content);
		 $this->load->view('print_html', $html);
	}


	public function logmein()
	{
		$owner = $this->db_model->get_owner($_POST['user_name']);
		if ($owner) {
			$post_password = $_POST['password'];
			if ($owner['password']==$post_password) {
				$newdata = array(
	                   'login'  => 'true',
	                   'login_user' => $_POST['user_name']
	               );
				$this->session->set_userdata($newdata);
		    	echo json_encode(array('login' => 'true', 'message'=>'Login Success....Redirecting!'));
			} else {
				$this->session->unset_userdata('login');
				echo json_encode(array('message'=>'The Password is incorrect'));
			}
		} else {
			echo json_encode(array('message'=>'User does not exsist'));
		}
	}


	public function get_dashboard_add_form()
	{
		$session_data = ($this->session->all_userdata());
		$links = null;
		$id = null;
		if (isset($session_data['login'])):
			$action = $_POST['action'];
			switch ($action) {
				case 'dash_add_gift' :
					$id = $_POST['list_id'];
					$actionurl = $action . '/' . $id;
					$owner = $this->db_model->get_owner_by_listid ($id);
					$list_num = $this->db_model->get_next_num_for_list($id);
					for ($i = $list_num[0]->num; $i <= 20; $i++) {
						$options[$i] = $i;
					}

					$inputs = array('1'=>array('name'=>'title', 'type'=>'text', 'label_value'=>'Title :', 'options'=>null, 'value'=>''),
							'2'=>array('name'=>'desc', 'type'=>'textarea', 'label_value'=>'Description :', 'value'=>'', 'cols'=>'80', 'rows'=>'5'),
							'3'=>array('name'=>'num', 'type'=>'dropdown', 'label_value'=>'List Number :', 'options' => $options, 'value'=>'', 'selected'=>$list_num),
							'4'=>array('name'=>'image', 'type'=>'image', 'label_value'=>'Image :', 'options'=>null, 'value'=>''),
							'5'=>array('name'=>'img', 'type'=>'hidden', 'label_value'=>'', 'value'=>'')
							);
					$form_title = 'Add New Gift Item';
					$btn = "Add Gift Item!";
					break;

				case 'dash_edit_gift' :
					$id = $_POST['list_id'];
					$actionurl = $action . '/' . $id;
					$owner = $this->db_model->get_owner_by_listid ($id);
					$list = $this->db_model->get_list_for_listid($id);
					$inputs = array('1'=>array('name'=>'title', 'type'=>'text', 'label_value'=>'Title :', 'options'=>null, 'value'=>$list[0]->title),
							'2'=>array('name'=>'date', 'type'=>'text', 'label_value'=>'Create Date :', 'text_value'=>$list[0]->creation_date)
							);

					$form_title = 'Edit Gift List';
					$btn = "Edit List!";
					break;

				case 'dash_delete_gift' :
					$id = $_POST['list_id'];
					$actionurl = $action . '/' . $id;
					$owner = $this->db_model->get_owner_by_listid ($id);
					$list = $this->db_model->get_list_for_listid($id);
					$inputs = array('1'=>array('name'=>'title', 'type'=>'text', 'label_value'=>'Title :', 'options'=>null, 'value'=>$list[0]->title),
							'2'=>array('name'=>'date', 'type'=>'text', 'label_value'=>'Create Date :', 'text_value'=>$list[0]->creation_date)
							);
					$form_title = 'Remove Gift List';
					$btn = "Remove List!";

					break;
				case 'dash_add_list' :
					$id = $_POST['list_id'];
					$actionurl = $action . '/' . $id;
					$owner = $this->db_model->get_owner_by_listid ($id);
					$inputs = array('1'=>array('name'=>'title', 'type'=>'text', 'label_value'=>'Title :', 'options'=>null, 'value'=>''));
					$form_title = 'Add New List';
					$btn = 'Add List!';
					break;
				case 'dash_edit_gift_item' :
					$id = $_POST['gift_id'];
					$actionurl = $action . '/' . $id;
					$list_id = $_POST['list_id'];
					$owner = $this->db_model->get_owner_by_listid ($list_id);

					for ($i = 1; $i <= 20; $i++) {
						$options[$i] = $i;
					}

					$gift_id = $_POST['gift_id'];
					$list = $this->db_model->get_gift_by_giftid($gift_id, $owner[0]->owner_id);
					$inputs = array('1'=>array('name'=>'title', 'type'=>'text', 'label_value'=>'Title :', 'options'=>null, 'value'=>$list->title),
							'2'=>array('name'=>'description', 'type'=>'textarea', 'label_value'=>'Description :', 'value'=>$list->description , 'cols'=>'80', 'rows'=>'5'),
							'3'=>array('name'=>'image', 'type'=>'image', 'label_value'=>'Image :', 'value'=>$list->image),
							'4'=>array('name'=>'num', 'type'=>'dropdown', 'label_value'=>'Number :', 'value'=>$list->num, 'options' => $options, 'selected'=>$list->num),
							'5'=>array('name'=>'img', 'type'=>'hidden', 'label_value'=>'', 'value'=>'')
							);

					$form_title = 'Edit Gift Item';
					$btn = "Edit Gift Item!";
					$links = $this->db_model->get_gift_links($id);

					break;

				case 'dash_delete_gift_item' :
					$id = $_POST['gift_id'];
					$actionurl = $action . '/' . $id;
					$list_id = $_POST['list_id'];
					$owner = $this->db_model->get_owner_by_listid ($list_id);

					$gift_id = $_POST['gift_id'];
					$list = $this->db_model->get_gift_by_giftid($gift_id, $owner[0]->owner_id);
					$inputs = array('1'=>array('name'=>'title', 'type'=>'text', 'label_value'=>'Title :', 'options'=>null, 'value'=>$list->title),
							'2'=>array('name'=>'description', 'type'=>'textarea', 'label_value'=>'Description :', 'value'=>$list->description, 'cols'=>'80', 'rows'=>'5'),
							'3'=>array('name'=>'image', 'type'=>'image', 'label_value'=>'Image :', 'value'=>$list->image),
							'4'=>array('name'=>'num', 'type'=>'text', 'label_value'=>'Number :', 'value'=>$list->num)
							);

					$form_title = 'Remove Gift Item';
					$btn = "Remove This Gift Item!";
					break;

				case 'dash_edit_owner':
					$actionurl = $action;
					$id = $_POST['list_id'];
					$list_id = $_POST['list_id'];
					$owner = $this->db_model->get_owner_by_listid ($list_id);
					$inputs = array('1'=>array('name'=>'first_name', 'type'=>'text', 'label_value'=>'First Name :', 'value'=>$owner[0]->first_name),
						'2'=>array('name'=>'last_name', 'type'=>'text', 'label_value'=>'Last Name :', 'value'=>$owner[0]->last_name),
						'3'=>array('name'=>'email', 'type'=>'text', 'label_value'=>'Email :', 'value'=>$owner[0]->email, 'size'=>'40'),
						'4'=>array('name'=>'password', 'type'=>'text', 'label_value'=>'password :', 'value'=>'*************', 'size'=>'40'),
						);
					$form_title = 'Edit Owner Information';
					$btn = 'Update Owner';
					break;

				case 'dash_edit_admin':
					$actionurl = $action;
					$id = $_POST['list_id'];
					$list_id = $_POST['list_id'];
					$owner = $this->db_model->get_owner_by_listid ($list_id);
					$admin = $this->db_model->get_giftlist_admin($owner[0]->owner_id);
					$inputs = array('1'=>array('name'=>'id', 'type'=>'text', 'label_value'=>'Id :', 'value'=>$admin->admin_id, 'size'=>'5'),
						'2'=>array('name'=>'first_name', 'type'=>'text', 'label_value'=>'First Name :', 'value'=>$admin->first_name),
						'3'=>array('name'=>'last_name', 'type'=>'text', 'label_value'=>'Last Name :', 'value'=>$admin->last_name),
						'4'=>array('name'=>'email', 'type'=>'text', 'label_value'=>'Email :', 'value'=>$admin->email, 'size'=>'40')
						);
					$form_title = 'Edit Owner Information';
					$btn = 'Update Owner';
					break;
			}

			$data = array('id' => $id, 'owner'=>$owner,
						 	'inputs'=>$inputs,
							'form_title'=> $form_title,
							'action' => $actionurl,
							'btn' => $btn,
							'link'=> $links);
			$content =$this->load->view('dashboard/add_form', $data, true);
			echo json_encode($content);
		endif;
	}

	public function add_list($id)
	{
		$session_data = ($this->session->all_userdata());
		if (isset($session_data['login'])):
			$data = $this->input->post();
			$list = $this->db_model->insert_list ($id, $data);
			$owner = $this->db_model->get_owner_by_listid ($id);
			redirect(site_url() . '/load_dashboard/' . $session_data['login_user'] , 'refresh');
		endif;
	}


	public function add_gift($id)
	{
		$session_data = ($this->session->all_userdata());
		if (isset($session_data['login'])):
			$data = $this->input->post();
			$this->db_model->get_list_by_listid ($id, $data);
			$owner = $this->db_model->get_owner_by_listid ($id);
			redirect(site_url() . '/load_dashboard/' . $session_data['login_user'] , 'refresh');
		endif;
	}

	public function edit_gift($id)
	{
		$session_data = ($this->session->all_userdata());
		if (isset($session_data['login'])):
			$data = $this->input->post();
			$result = $this->db_model->update_list_by_listid ($id, $data);
			$owner = $this->db_model->get_owner_by_listid ($id);
			redirect(site_url() . '/load_dashboard/' . $session_data['login_user'] , 'refresh');
		endif;
	}

	public function edit_gift_item($id)
	{
		$session_data = ($this->session->all_userdata());
		if (isset($session_data['login'])):
			$data = $this->input->post();
			$result = $this->db_model->update_gift_by_giftid ($id, $data);
			$owner = $this->db_model->get_owner_by_giftid($id);
			redirect(site_url() . '/load_dashboard/' . $session_data['login_user'] , 'refresh');
		 endif;
	}


	public function delete_gift($id)
	{
		$session_data = ($this->session->all_userdata());
		if (isset($session_data['login'])):
			$data = $this->input->post();
			$result = $this->db_model->remove_list_by_listid ($id);
			$owner = $this->db_model->get_owner_by_listid ($id);
			redirect(site_url() . '/load_dashboard/' . $session_data['login_user'] , 'refresh');
		endif;
	}

	public function delete_gift_item($id)
	{
		$session_data = ($this->session->all_userdata());
		if (isset($session_data['login'])):
			$data = $this->input->post();
			$owner = $this->db_model->get_owner_by_giftid($id);
			$result = $this->db_model->remove_gift_by_giftid ($id);
			redirect(site_url() . '/load_dashboard/' . $session_data['login_user'] , 'refresh');
		 endif;
	}

	public function addGiftlink()
	{
		$data['gift_id']=$_POST['id'];
		$data['alt']=$_POST['title'];
		$data['title']=$_POST['title'];
		$data['url']=$_POST['url'];
		$rows = $this->db_model->insert_gift_link ($data['gift_id'], $data);
		echo json_encode($rows);
	}

	public function editGiftlink()
	{
		$data['id']=$_POST['id'];
		$data['alt']=$_POST['title'];
		$data['title']=$_POST['title'];
		$data['url']=$_POST['url'];
		$data['gift_id']=$_POST['giftid'];
		$rows = $this->db_model->update_gift_link ($data['id'], $data);
		echo json_encode($rows);
	}

	public function edit_owner()
	 {
	 	$session_data = ($this->session->all_userdata());
	 	$data['owner_id']=$_POST['owner'];
	 	$data['first_name']=$_POST['first_name'];
	 	$data['last_name']=$_POST['last_name'];
	 	$data['email']=$_POST['email'];
	 	$rows = $this->db_model->update_owner_info($data);
		//echo json_encode($rows);
		redirect(site_url() . '/load_dashboard/' . $session_data['login_user'] , 'refresh');
	}

	public function edit_admin()
	 {
	 	$session_data = ($this->session->all_userdata());
	 	$data['admin_id']=$_POST['id'];
	 	$data['first_name']=$_POST['first_name'];
	 	$data['last_name']=$_POST['last_name'];
	 	$data['email']=$_POST['email'];
		$rows = $this->db_model->update_admin_info($data);
		//echo json_encode($rows);
		redirect(site_url() . '/load_dashboard/' . $session_data['login_user'] , 'refresh');
	}

	public function deleteGiftlink()
	{
		$data['id']=$_POST['id'];
		$rows = $this->db_model->delete_gift_link ($data['id']);
		echo json_encode($rows);
	}

	public function get_config()
	{
		$response = array('server' => $this->config->item('server'),
						 'path'=> $this->config->item('path'));
		echo json_encode($response);
	}

	public function logout()
	{
		$this->session->unset_userdata('login');
		$this->session->unset_userdata('login_user');
		$this->load->helper('url');
		 redirect('/dashboard/', 'refresh');

	}

	public function signup ()
	{
		$content = $this->load->view('dashboard/dashboard_home', '', true);
		$content .= $this->html_model->load_menu();
		$content .= $this->load->view('dashboard/signup_form', '', true);
		echo $content;
	}

	public function submit_new_account()
	{
		$data =array('first_name' => $_POST['data']['first_name'],
					'last_name' => $_POST['data']['last_name'],
					'username' => $_POST['data']['user_name'],
					'email'=> $_POST['data']['email'],
					'password'=> $_POST['data']['password'],
					'list_title'=> $_POST['data']['list_title'],
					'gift_admin_name' => $_POST['data']['gift_admin_name'],
					'gift_admin_email' => $_POST['data']['gift_admin_email']
					);
		$owner = $this->db_model->save_new_user($data);
		$this->db_model->add_new_admin($data, $owner);
		$this->db_model->insert_list ($owner, array('title'=>$_POST['data']['list_title']));
	}

	public function check_user_name() {
		$data = $_POST['user_name'];
		$rtn = $this->db_model->check_user_name($data);
		echo json_encode($rtn);
	}

 }//end dashboard class