<?php
class Html_model extends CI_Model {

   function __construct()
    {
        parent::__construct();
    }
	
	
	function load_html_begin($owner)
	{
	$this->load->view('html_begin');
	$this->load->view('css_jquery_files');
	$this->load->view('body_header', $owner);
	$html = array ( 'html' => "<div id = 'menu'><center>");
	$this->load->view('print_html', $html);
	$data = $this->db_model->print_menu();
	foreach ($data as $row) :
		$this->load->view('menu_bar', $row, $owner);
	endforeach;
	$html = array ('html' => "</center></div><div id ='side_bar'>");
	$this->load->view('print_html', $html);	
	$this->db_model->print_side_bar();
	$html = array ('html' => "</div> <!-- end sidebar -->");
	$this->load->view('print_html', $html);	
	}
	
	function load_html_close()
	{
	$html = array ('html' => "</div> <!--end content --></div> <!--end wrapper --></body></html>");
	$this->load->view('print_html', $html);
	}
	
	function load_quick_list($data)
	{
		
		$html= array('html' => "<div class = 'side_bar_wrapper'><div class = 'side_bar_header'>" . $data['title'] . "</div> <!-- end side_bar_header --><div class = 'side_bar_content'>");
		$this->load->view('print_html', $html);
		$data = $this->db_model->get_quick_list();
		foreach ($data as $row) :
		$gift_item['gift_id'] = $row->gift_id;
		$gift_item['title'] = $row->title;
		$gift_item['num'] = $row->num;
		$this->load->view('quick_list', $gift_item);
		endforeach;
		$html = array ('html' => "</div><!--end sidebar wrapper--></div> <!--end side_bar_content -->");
		$this->load->view('print_html', $html);
	}
	
}

?>