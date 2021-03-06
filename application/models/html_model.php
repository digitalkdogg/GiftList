<?php
class Html_model extends CI_Model {

   function __construct()
    {
        parent::__construct();
    }
	
	
	function load_html_begin($owner, $list_id=null)
	{
	$this->load->view('html_begin');
	$this->load->view('css_jquery_files');
	$list = $this->db_model->get_list_owner_for_list($list_id);
	$title = null;
	foreach ($list as $personlist) {
		$title = $personlist->title . ' list';
	}
	
	$this->load->view('body_header', array('first_name'=>$owner['first_name'],
									 'last_name'=>$owner['last_name'],
									 'user_name'=> $owner['user_name'],
									  'header_title'=>$title));
	
	$html = array ( 'html' => "    <div id = 'menu'><center>");
	$this->load->view('print_html', $html);
	if ($list_id != null){
	$data = $this->db_model->print_menu();
	foreach ($data as $row) :
		$view_data = array('id'=>$row->menu_id,
					'name'=>$row->name,
					'url'=>$row->url,
					'alt'=>$row->alt,
					'owner'=>$owner,
					'list_id'=>$list_id);
		$this->load->view('menu_bar', $view_data);
	endforeach;
	
			$html = array ('html' => "</center></div><div id ='side_bar'>");
			$this->load->view('print_html', $html);	
			$this->db_model->print_side_bar($list_id);
			$html = array ('html' => "</div> <!-- end sidebar -->");
			$this->load->view('print_html', $html);	
		} else {
			$data = $this->db_model->print_menu(2);
			foreach ($data as $row) :
				$view_data = array('id'=>$row->menu_id,
					'name'=>$row->name,
					'url'=>$row->url,
					'alt'=>$row->alt,
					'owner'=>$owner,
					'list_id'=>$list_id);
				$this->load->view('menu_bar', $view_data);
			endforeach;
			// $view_data = array(array('name'=>'Home',
			// 						'url'=>'gift',
			// 						'alt'=>'Home',
			// 						'list_id'=>''),
			// 					array('name'=>'Search',
			// 						  'url'=>'adsflkd',
			// 						  'alt'=>'search',
			// 						  'list_id'=>''));
			// foreach ($view_data as $menu) {
			// 	$this->load->view('menu_bar', $menu);
			// }
			
			$html= array('html'=>"</center></div>");
			$this->load->view('print_html', $html);
		}
	}
	
	function load_html_close($dashboard=null)
	{
	$html = array ('html' => "</div><div id = 'popup_wrapper'></div> <!--end content --></div> <!--end wrapper --></body></html>");
	if ($dashboard=='true') :
		$content = $this->load->view('print_html', $html, true);
		return $content;
	else :
		$this->load->view('print_html', $html);
	endif;
	}
	
	function load_quick_list($data, $list_id)
	{
		
		$html= array('html' => "<div class = 'side_bar_wrapper'><div class = 'side_bar_header'>" . $data['title'] . "</div> <!-- end side_bar_header --><div class = 'side_bar_content' id = 'quick_list'>");
		$this->load->view('print_html', $html);
		$data = $this->db_model->get_quick_list($list_id);
		foreach ($data as $row) :
		$gift_item['gift_id'] = $row->gift_id;
		$gift_item['title'] = $row->title;
		$gift_item['num'] = $row->num;
		$this->load->view('quick_list', $gift_item);
		endforeach;
		$html = array ('html' => "</div><!--end sidebar wrapper--></div> <!--end side_bar_content -->");
		$this->load->view('print_html', $html);
	}
	
	public function load_menu() {
		$content = "<div id = 'menu'><center>";
			
	 	$data = $this->db_model->print_menu(2);
		 	foreach ($data as $row) :
		 		$view_data = array('id'=>$row->menu_id,
		 			'name'=>$row->name,
		 			'url'=>$row->url,
	 				'alt'=>$row->alt,
		 			'owner'=>null,
		 			'list_id'=>null);
		$content .= $this->load->view('menu_bar', $view_data, true);
		endforeach;
		$content .= "</center></div>";
		return $content;
	}
}

?>