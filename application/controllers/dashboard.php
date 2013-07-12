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

	public function index ($name) 
	{
		$owner = $this->db_model->get_owner($name);
		if (!$owner==null) :
		    $content = $this->load->view('html_begin', '', true);
			$content .= $this->load->view('css_jquery_files', array('dashboard'=>true), true);
		 	$content .= $this->load->view('body_header', $owner, true);
		 	$content .= "<div id = 'content'>";
		
		 	$list_items = $this->db_model->get_list_for_owner($owner['owner_id']);
		 	if ($list_items) :
		 		$content .= "<div id = 'gifts' class = 'items'>";
		 		$content .= "<div class = 'dash_title'>Gifts</div>";
		 		foreach ($list_items as $list) :
		 			$items = $this->db_model->get_giftitems_list($list->list_id);

		 			$content .= $this->load->view('dashboard/dashboard_gift_start', array('title' => $list->title), true);
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

		 	$content .= $this->html_model->load_html_close('true');
		    $html = array ('html' => $content);
			$this->load->view('print_html', $html);
			//echo $content;
		else:
			redirect(base_url(), 'refresh');
		endif;
	}


 }//end dashboard class