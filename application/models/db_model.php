<?php
class Db_model extends CI_Model {

   function __construct()
    {
        parent::__construct();
    }
	
	function get_owner($name)
	{
	$query = $this->db->from('owner')
	 				->where ('first_name', $name);
	$query = $this->db->get()->row();
	if (!$query==null) :
	$data = array( 
		'owner_id' => $query->owner_id,
		'first_name' => $query->first_name,
		'last_name' => $query->last_name,
		'email' => $query->email
	 );
	 $newdata = array('owner_id'  => $data['owner_id'], 'owner_first_name' => $data['first_name'], 'owner_last_name' => $data['last_name']);

	$this->session->set_userdata($newdata);
	return $data;
	endif;
	}
	
	function print_menu()
	{
		$query = $this->db->from('menu')
	 				->where ('status_id', 1);
		$query = $this->db->get()->result();
		return $query;
	}
	
	function print_side_bar()
  	{
		$owner= $this->session->userdata('owner_id');
		$query = $this->db->query('SELECT title, content FROM side_bar where status_id = 1');
		foreach ($query->result_array() as $row) :
		$data = array (
				'title' => $row['title'],
				'content' => $row['content'],
				'id' => 'reg_side_bar'
				);
				
		if ($data['title'] == 'Quick List') {
			$this->html_model->load_quick_list($data);
		} else if ($data['title'] == 'New Features') {
			$data['id']= 'new_feat_side_bar';
			$this->load->view('side_bar', $data);
		} else {
			$data['id']= 'reg_side_bar';
			$this->load->view('side_bar', $data);
			}
		endforeach;
		$html = array ('html' => "</div><!--end side bar -->");
		$this->load->view('print_html', $html);	
	}
	
	function print_gift_item()
	{			
		$owner_id = $this->session->userdata('owner_id');
		$gift_id = $this->get_giftid_all($owner_id);
		foreach ($gift_id as $gift):
			$gift_item = $this->get_gift_item($gift->gift_id);
			$gift_links = $this->get_gift_links($gift->gift_id);
			$this->load->view('gift', $gift_item);
			foreach ($gift_links as $link) :
				$this->load->view('gift_link', $link);
			endforeach;
			$this->load->view('link_wrapper_end');
			$this->load->view('gift_end', array('div' => 1));
		endforeach;
	}
	
	
	function print_gift_popup()
	{	
		$owner_id = $this->session->userdata('owner_id');
		$gift_id = $this->get_giftid_all($owner_id);
		
		foreach ($gift_id as $gift):
			$gift_item = $this->get_gift_item($gift->gift_id);
			$gift_links = $this->get_gift_links($gift->gift_id);
			$this->load->view('gift_is_popup', $gift_item, array('div' => 1));
			foreach ($gift_links as $link) :
				$this->load->view('gift_link', $link);
			endforeach;
			$this->load->view('link_wrapper_end');
			$this->print_comments($gift->gift_id, 3);
			$html= array('html'=>"<div class = 'gift_popup_area'><ul><li>
							<a href = '"  .site_url() . "/comment/" . $gift->gift_id . "'>Comment On This Gift</a>  </li>
           					<li><a class = ''>Share This Gift</a></li>
							<li><a href = '" . site_url() . "/taken/" . $gift->gift_id . "'>Mark This Gift As Taken</a></li>
            				</ul></div>");
			$this->load->view('print_html', $html);	
			$this->load->view('gift_end', array('div' => 1));			
		endforeach;
	}
	
function print_share_popup()
	{
		$owner_id = $this->session->userdata('owner_id');
		$gift_id = $this->get_giftid_all($owner_id);
		
		foreach ($gift_id as $gift):
		$gift_item = $this->get_gift_item($gift->gift_id);
			$this->load->view('share_gift', $gift_item);
		endforeach;
	}

	
	function print_comments($gift, $limit)
	{
		$query = $this->db->query("select *  from comment where gift_id = " .  $gift . " order by date_time desc limit " . $limit);
		if ($query->num_rows() > 0) :	
			$gift_item = $this->get_gift_by_giftid($gift, $this->session->userdata('owner_id'));
			$this->load->view('comment_begin', $gift_item);
			foreach ($query->result_array() as $row) :
				$comment['name']= $row['name'];
				$comment['date_time'] = $row['date_time'];
				$comment['message']= $row['message'];
				$this->load->view('comment_dets', $comment);
			endforeach;
			$this->load->view('comment_end');
		else:
			$html = array ('html' => "<div id = 'comment_wrapper'>");
			$this->load->view('print_html', $html);	
			$html = array ('html' => "<div class = 'comments'><div class = 'comments_new'>There are no comments at this time</div></div>");
			$this->load->view('print_html', $html);	
			$html = array ('html' => "</div>");
			$this->load->view('print_html', $html);	
		endif;
	}

	function get_gift_by_giftid($gift_id, $owner_id)
	{
	$query = $this->db->from('gift')
					->where ('gift_id', $gift_id)
					->where ('owner_id', $owner_id)
					->join ('taken', 'gift.taken_id=taken.taken_id');
					
	$query = $this->db->get()->row();
	if ($query) :
		return $query;
	else:
		return false;
	endif;
	}

	public function get_giftid_all($owner_id)
	{	
				$this->db->select('gift_id');
				$this->db->from('gift')
	 				->where ('status_id', 1)
					->where ('owner_id', $owner_id);
				$this->db->order_by("num", "asc"); 
		$query = $this->db->get()->result();
		return $query;
	}
	
	public function get_giftid_taken($owner_id, $taken)
	{	
				$this->db->select('gift_id');
				$this->db->from('gift')
	 				->where ('status_id', 1)
					->where ('owner_id', $owner_id)
					->where ('taken_id', $taken);
		$query = $this->db->get()->result();
		return $query;
	}
	
	public function get_gift_item($gift_id)
	{
		$this->db->select('*');
		$this->db->from('gift')
	 		->where ('status_id', 1)
			->where ('gift_id', $gift_id);
		$this->db->join('taken', 'gift.taken_id = taken.taken_id');
		$query = $this->db->get()->row();
		return $query;
	}
	
	public function get_likes_by_giftid($gift_id)
	{
	$this->db->select('*');
	$this->db->from('likes')
	 		->where ('gift_id', $gift_id);
	$query = $this->db->get()->row();
	if(!$query) :
	return 0;
	else:
	return $query->like_count;
	endif;
	}
	
	public function get_gift_links($gift_id) 
	{
		$this->db->select('*');
		$this->db->from('gift_link')
			->where ('gift_id', $gift_id);
		$query = $this->db->get()->result();
		return $query;
	}
	
	public function get_owner_by_giftid($gift_id)
	{
	$query = $this->db->from('gift')
	 				->where ('status_id', 1)
					->where ('gift_id', $gift_id);
	$query = $this->db->get()->row();
	$owner_id = $query->owner_id;
	$query = $this->db->from('owner')
					->where ('owner_id', $owner_id);
	$query = $this->db->get()->row();
	return $query;
	
	}
	
	public function get_quick_list()
	{
		$owner_id = $this->session->userdata('owner_id');
		$query = $this->db->from('gift')
	 				->where ('status_id', 1)
					->where ('owner_id', $owner_id);
		$this->db->order_by("num", "asc"); 
		$query = $this->db->get()->result();
		return $query;
	}
	
	public function get_gift_menu($status)
	{
		$owner_id = $this->session->userdata('owner_id');
		$gift_id = $this->get_giftid_taken($owner_id, $status);
		foreach ($gift_id as $gift):
			$gift_item = $this->get_gift_item($gift->gift_id);
			$gift_links = $this->get_gift_links($gift->gift_id);
			$this->load->view('gift', $gift_item, array('like_count' => 0));
			foreach ($gift_links as $link) :
				$this->load->view('gift_link', $link);
			endforeach;
			$this->load->view('link_wrapper_end');
			$this->load->view('gift_end', array('div' => 1));
		endforeach;
	}
	
	public function get_giftlist_admin($owner_id)
	{			
		$query = $this->db->from('admin')
					->where ('owner_id', $owner_id);
		$query = $this->db->get()->row();
		return $query;
	}
	

} // end db_model class
?>