<?php
class Db_model extends CI_Model {

   function __construct()
    {
        parent::__construct();
    }

/*
	@purpose: get the owner information and save it to a session
	@params : name
	@return : array(owner_id, user_name, first_name, last_name, email)
*/	
	function get_owner($name)
	{
	$query = $this->db->from('owner')
	 				->where ('user_name', $name);
	$query = $this->db->get()->row();
	if (!$query==null) :
	$data = array( 
		'owner_id' => $query->owner_id,
		'user_name' => $query->user_name,
		'password' => $query->password,
		'first_name' => $query->first_name,
		'last_name' => $query->last_name,
		'email' => $query->email
	 );
	 $newdata = array('owner_id'  => $data['owner_id'], 
	 				  'owner_user_name' => $data['user_name'],
	 				  'owner_first_name' => $data['first_name'],
	 				  'owner_last_name' => $data['last_name'],
	 				  'onwer_email'=> $data['email']);

	$this->session->set_userdata($newdata);
	return $data;
	endif;
	}


	/*
	@pupose : gets all the list for that owner
	@param : owner_id
	@returns : array of lists for that owner
	*/
	function get_list_for_owner($owner_id)
	{
		$query = $this->db->select('list.*')
					->from('list')
					->where('list.owner_id', $owner_id)
					->where('list.status_id', '1')
					->join ('owner', 'owner.owner_id=list.owner_id');
		$query = $this->db->get()->result();
		return $query;		
	}

		/*
	@pupose : gets all the list and owner info for that list
	@param : list_id
	@returns : array of lists
	*/
	function get_list_owner_for_list($list_id)
	{
		$query = $this->db->from('list')
					->where('list.list_id', $list_id)
					->where('list.status_id', '1')
					->join ('owner', 'owner.owner_id=list.owner_id');
		$query = $this->db->get()->result();
		return $query;		
	}
	

	/*
	@pupose : gets one list for that list_id
	@param : list_id
	@returns : one list
	*/
	function get_list_for_listid($list_id)
	{
		$query = $this->db->from('list')
					->where('list.list_id', $list_id)
					->where('list.status_id', '1');
		$query = $this->db->get()->result();
		return $query;		
	}

	/*
	@purpose : gets all the menu items and returns it back to gift
	@param: none
	@return: resuts (select * from menu where status_id = 1)
	*/
	function print_menu()
	{
		$query = $this->db->from('menu')
	 				->where ('status_id', 1);
		$query = $this->db->get()->result();
		return $query;
	}

	/*
	@purpose: prints the sidebar in the gift list
	@param : none
	@return the series of quicklist in html output

	*/
	
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

/*
	@purpose: get the contents for the sidebar of a certain type
	@param : sidebar type
	@return the contents from the db for that side bar type

	*/
	
	function get_side_bar_type($type)
  	{
		$this->db->from('side_bar')
	 		->where ('type_id', 2)
	 		->where ('status_id', 1);
		$this->db->order_by("side_bar_id", "asc"); 
		$query = $this->db->get()->result_array();
		return $query;
	}

	
	/*
	purpose : gets the gift items and returns the html including the gift links
	param : none
	return : html of gift items

	*/

	function print_gift_item($gifts)
	{			
		$owner_id = $this->session->userdata('owner_id');
		foreach ($gifts as $gift):
			$gift_item = $this->get_gift_item($gift->gift_id);
			$gift_links = $this->get_gift_links($gift->gift_id);
			$gift_item->reff = '';
			$this->load->view('gift', $gift_item);
			foreach ($gift_links as $link) :
				$this->load->view('gift_link', $link);
			endforeach;
			$this->load->view('link_wrapper_end');
			$this->load->view('gift_end', array('div' => 1));
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

	/*
	purpose : gets the gift info by giftId
	params : gift_id, owner_id
	return : row of gift
	*/
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

	/*
	purpose : returns one gift by the username and num....used in popup
	params : username and number
	return : row of gift

	*/
	function get_gift_by_username_num($username, $num)
	//
	{
		$query = $this->db->from('gift')
					->where('num', $num)
					->where('user_name', $username)
					->where('status_id', '1')
					->join ('owner', 'gift.owner_id=owner.owner_id')
					->join ('taken', 'taken.taken_id=gift.taken_id');
		$query = $this->db->get()->row();
		return $query;		
	}

	/*
	@purpose: get gift items by the owner_id
	@params: owner_id
	@return: results of gift_items for the owner
	*/

	public function get_giftitems_all($owner_id)
	{
		//$this->db->select('gift_id');
				$this->db->from('gift')
	 				->where ('status_id', 1)
					->where ('owner_id', $owner_id);
				$this->db->order_by("num", "asc"); 
		$query = $this->db->get()->result();
		return $query;
	}
	
	/*
	@purpos: get gifts that are taken for that owner
	@params: owner_id and teken
	@reutrn : results of taken gifts
	*/
	public function get_giftid_taken($owner_id, $taken, $list_id)
	{	
				$this->db->select('gift.gift_id');
				$this->db->from('gift')
	 				->where ('status_id', 1)
					->where ('owner_id', $owner_id)
					->where ('taken_id', $taken)
					->where ('list_id', $list_id);
				$this->db->join('gift_list', 'gift_list.gift_id=gift.gift_id');
           $this->db->order_by("num", "asc");
		$query = $this->db->get()->result();
		return $query;
	}
	
	/*
	@purpose: get gift item 
	@params: gift_id
	@return: row of the gift
	*/
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
	
	/*
	@purpose : get likes for that gift
	@params : gift_id
	@return : query of like count
	*/
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
	
	/*
	purpose: get the gift links for that gift
	params : gift_id
	return : results fo gift Links
	*/

	public function get_gift_links($gift_id) 
	{
		$this->db->select('*');
		$this->db->from('gift_link')
			->where ('gift_id', $gift_id);
		$query = $this->db->get()->result();
		return $query;
	}
	
	/*
	@purpose: get the owner info by the gift Id
	@params : gift_id
	@return: row of owner info
	*/
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
	
	/*
	@purpose: get the data for the quick list
	@paramas : none
	@return: results order by num of gift items for owner
	*/

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
	
	/*
	@purpose : 

	*/

	public function get_gift_menu($status, $list_id)
	{
		$owner_id = $this->session->userdata('owner_id');
		$gift_id = $this->get_giftid_taken($owner_id, $status, $list_id);
		foreach ($gift_id as $gift):
			$gift_item = $this->get_gift_item($gift->gift_id);
			$gift_links = $this->get_gift_links($gift->gift_id);
			$gift_item->reff = $status;
			$gift_item->like_count = 0;
			$this->load->view('gift', $gift_item);
			foreach ($gift_links as $link) :
				$this->load->view('gift_link', $link);
			endforeach;
			$this->load->view('link_wrapper_end');
			$this->load->view('gift_end', array('div' => 1));
		endforeach;
		$this->html_model->load_html_close();
	}

	/*
	@purpose: get giftlist admin for that owner
	@params: owner_id
	@return: row of the giftlist admin
	*/
	
	public function get_giftlist_admin($owner_id)
	{			
		$query = $this->db->from('admin')
					->where ('owner_id', $owner_id);
		$query = $this->db->get()->row();
		return $query;
	}
	
	/*
	@purpose : get the gift items for that list
	@params : list_id
	@return : results of list items
	*/
	public function get_giftitems_list($list_id)
	{
		$query = $this->db->select('gift.*')
				->from('gift')
				->join('gift_list', 'gift_list.gift_id = gift.gift_id')
				->join('list', 'list.list_id = gift_list.list_id')
				->where ('list.list_id', $list_id)
				->where ('gift.status_id', 1);
		return $this->db->get()->result();
	}


	/*
	@purpose : insert a list into the list table
	@params : owner_id, data
	@return :return true or false
	*/
	public function insert_list ($id, $data)
	{
		$list = array (
				 'list_id' => null,
				'title' => $data['title'],
				'status_id' => '1',
				'owner_id' => $id,
				'creation_date' => date('Y-m-d H:i:s'),
				'last_updated_date' => date('Y-m-d H:i:s')
			);
		$this->db->insert('list', $list);
		return $this->db->affected_rows();
	}

	/*
	@purpose : insert a giftlink into the giftlink table
	@params : data, giftlinkid
	@return :return true or false
	*/
	public function insert_gift_link ($id, $data)
	{
		$list = array (
				 'link_id' => null,
				'alt' => $data['alt'],
				'title' => $data['title'],
				'url' => $data['url'],
				'gift_id' => $data['gift_id']
			);
		$this->db->insert('gift_link', $list);
		return $this->db->affected_rows();
	}

	/*
	@purpose : update a giftlink in the giftlink table
	@params : data, giftlinkid
	@return :return true or false
	*/
	public function update_gift_link ($id, $data)
	{
		$list = array (
				 'link_id' => $id,
				'alt' => $data['alt'],
				'title' => $data['title'],
				'url' => $data['url'],
				'gift_id' => $data['gift_id']
			);
		$this->db->where('link_id', $id);
		$this->db->update('gift_link', $list);
		return $this->db->affected_rows();
	}

		/*
	@purpose : delete a giftlink from the giftlink table
	@params : giftlinkid
	@return :return true or false
	*/
	public function delete_gift_link ($id)
	{
		$this->db->delete('gift_link', array('link_id' => $id)); 
		return $this->db->affected_rows();
	}

	/*
	@purpose : get the list info for a list id
	@params : list_id
	@return :return one list
	*/
	public function get_list_by_listid ($id, $data)
	{
		//$gift_id = $this->db->get()->result();
		$list = array (
				 'gift_id' => null,
				'list_id' => $id
			);
		$this->db->insert('gift_list', $list);
		$gift_id = $this->db->insert_id();

		$gift = array(
			'gift_id' => $gift_id ,
   			'title' => $data['title'] ,
   			'description' => $data['desc'] ,
   			'num' => $data['num'],
   			'image' => $data['img'],
   			'owner_id' => $data['owner'],
   			'status_id' => 1,
   			'taken_id' => 2
		);
		$this->db->insert('gift', $gift); 
	}

	/*
	@purpose : update the list for that liist_id
	@params : list_id
	@return :true or false
	*/
	public function update_list_by_listid ($id, $data)
	{
		$this->db->from('list')
				->where('list_id', $id);
	$object = array(
               'title' => $data['title'],
               'creation_date' => $data['date'],
               'last_updated_date' => date('Y-m-d H:i:s')
            );
		$this->db->update('list', $object); 
		return $this->db->affected_rows();
	}

		/*
	@purpose : remove the list for that liist_id
	@params : list_id
	@return :true or false
	*/
	public function remove_list_by_listid ($id)
	{
	$this->db->from('list')
				->where('list_id', $id);
	$object = array(
               'status_id' => 2,
               'last_updated_date' => date('Y-m-d H:i:s')
            );
	$this->db->update('list', $object); 
	return $this->db->affected_rows();

	}


	/*
	@purpose : update the giftitem for that gift_id
	@params : gift_id
	@return :true or false
	*/
	public function update_gift_by_giftid ($id, $data)
	{
		$this->db->from('gift')
				->where('gift_id', $id);
		
	 $object = array(
               'title' => $data['title'],
               'description' => $data['description'],
               'num' => $data['num'],
               'image' => $data['image']
            );
	 	$this->db->update('gift', $object); 
		return $this->db->affected_rows();
	}

	/*
	@purpose : update the owner
	@params : data
	@return :true or false
	*/
	public function update_owner_info ($data)
	{
		$this->db->from('owner')
				->where('owner_id', $data['owner_id']);
		
	 $object = array(
               'first_name' => $data['first_name'],
               'last_name' => $data['last_name'],
               'email' => $data['email']
            );
	 	$this->db->update('owner', $object); 
		return $this->db->affected_rows();
	}

	/*
	@purpose : update the admin info
	@params : data
	@return :true or false
	*/
	public function update_admin_info ($data)
	{
		$this->db->from('admin')
				->where('admin_id', $data['admin_id']);
		
	 $object = array(
               'first_name' => $data['first_name'],
               'last_name' => $data['last_name'],
               'email' => $data['email']
            );
	 	$this->db->update('admin', $object); 
		return $this->db->affected_rows();
	}


			/*
	@purpose : remove the giftitem for that gift_id
	@params : gift_id
	@return :true or false
	*/
	public function remove_gift_by_giftid ($id)
	{
	$this->db->from('gift')
				->where('gift_id', $id);
	$object = array(
               'status_id' => 2
            );
	$this->db->update('gift', $object); 
	return $this->db->affected_rows();

	}


	/*
	@purpose : get the owner info from a list id
	@params : list_id
	@return :return one owner
	*/
	public function get_owner_by_listid ($id)
	{
		//$query = // $this->db->select('owner.owner_id, owner.user_name')
		$query = $this->db->from('owner')
				->join('list', 'list.owner_id = owner.owner_id')
				->where ('list.list_id', $id);
		return $this->db->get()->result();
	}

		/*
	@purpose : get the next number from the gift table for a list
	@params : list_id
	@return :return one num
	*/
	public function get_next_num_for_list ($id)
	{
		$query = $this->db->select('max(gift.num)+1 as num')
				->from('gift')
				->join('gift_list', 'gift_list.gift_id = gift.gift_id')
				->where ('gift_list.list_id', $id)
				->where('gift.status_id', '1');
		return $this->db->get()->result();
	}

} // end db_model class
?>