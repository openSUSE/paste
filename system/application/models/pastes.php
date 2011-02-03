<?php

/** 
* Main model for stikked
* 
* @author Ben McRedmond <hello@benmcredmond.com>
* @copyright Ben McRedmond
* @package Stikked
*
*/

/** 
* Main model class for pastes table/stikked.
*
* @author Ben McRedmond <hello@benmcredmond.com>
* @version 0.5.1
* @access public
* @copyright Ben McRedmond
* @package Stikked
* @subpackage Models
*
*/

class Pastes extends Model 
{

    function __construct()
    {
        parent::__construct();
    }


	/** 
	* Counts pastes in the database to be used when generating pagination
	*
	* @return int
	* @access public
	* @see getLists()
	*/

	function countPastes()
	{
		$this->db->where('private', 0);
		$query = $this->db->get('pastes');
		return $query->num_rows();
	}


	/** 
	* Creates a paste in the database. This doesn't take any arguments as it's easier to use the input class.
	*
	* @return String
	* @access public
	*/
	
	function createPaste()
	{
		$this->load->library('process');
		
		$data['id'] = NULL;
		$data['created'] = time();
		$data['raw'] = htmlspecialchars($this->input->post('code'));
		$data['lang'] = htmlspecialchars($this->input->post('lang'));
		$data['replyto'] = $this->input->post('reply');

		if($this->input->post('name'))
		{
			$data['name'] = htmlspecialchars($this->input->post('name'));
		}
		else
		{
			$data['name'] = $this->config->item('unknown_poster');
			if($data['name'] == 'random')
			{
				$nouns = $this->config->item('nouns');
				$adjectives = $this->config->item('adjectives');
				
				$data['name'] = $adjectives[array_rand($adjectives)]." ".$nouns[array_rand($nouns)];
			}  
		}
		
		if($this->input->post('title'))
		{
			$data['title'] = htmlspecialchars($this->input->post('title'));
		}
		else
		{
			$data['title'] = $this->config->item('unknown_title'); 
		}

		$data['private'] = $this->input->post('private');
		
		do {
		
			if($this->input->post('private'))
			{
				$data['pid'] = substr(md5(md5(rand())), 0, 8);
			}
			else
			{
				$data['pid'] = rand(10000,99999999);
			}
				
				$this->db->select('id');
				$this->db->where('pid', $data['pid']);
				$query = $this->db->get('pastes');
				if($query->num_rows > 0 or $data['pid'] == 'download')
				{
					$n = 0;
					break;
				}
				else
				{
					$n = 1;
					break;
				}
		
		} while($n == 0);
		
		if($data['lang']=='image') {
			$path                    = '/images/';
			$config['upload_path']   = '.' . $path;
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']      = '512';
			if($this->input->post('expire')>10)
			$config['max_size']	 = '5120';
			if($this->input->post('expire')>1440)
			$config['max_size']	 = '2048';
			if($this->input->post('expire')>10080)
			$config['max_size']	 = '1024';
			if( ($this->input->post('expire')>604800) || ($this->input->post('expire')==0) )
			$config['max_size']	 = '512';
			$path_part               = pathinfo($_FILES['file']['name']);
			$config['file_name']     = $data['pid'] . '.' . $path_part['extension'];
			$data['raw']             = $path . $config['file_name'];
		
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload("file")) {
				show_error("Uploading failed!!!</br>Only " . $config['allowed_types'] . " files smaller then " . $config['max_size'] . "k are allowed for this time interval. Allowed file size depends on expiration time.");
			}
			$filedata = $this->upload->data();
			$data['paste']           = $path_part['basename'];
			if($filedata['file_name'] != $data['pid'] . '.' . $path_part['extension']) {
				rename('.' . $path .$filedata['file_name'],
				       '.' . $data['raw']);
			}
		} else {
			if($_FILES['file']) {
				unlink($_FILES['file']['tmp_name']);
			}
		}

		$format = 'Y-m-d H:i:s';
		if(($this->input->post('expire')==0)) {
			$data['toexpire'] = 0;
		} else {
			$data['toexpire'] = 1;
		}
		switch($this->input->post('expire'))
		{
			case '60':
				$data['expire'] = mktime((date("H") + 1), date("i"), date("s"), date("m"), date("d"), date("Y"));
				break;
			case '360':
				$data['expire'] = mktime((date("H") + 6), date("i"), date("s"), date("m"), date("d"), date("Y"));
				break;
			case '720':
				$data['expire'] = mktime((date("H") + 12), date("i"), date("s"), date("m"), date("d"), date("Y"));
				break;
			case '1440':
				$data['expire'] = mktime((date("H") + 24), date("i"), date("s"), date("m"), date("d"), date("Y"));
				break;
			case '10080':
				$data['expire'] = mktime(date("H"), date("i"), date("s"), date("m"), (date("d")+7), date("Y"));
				break;
			case '40320':
				$data['expire'] = mktime(date("H"), date("i"), date("s"), (date("m")+1), date("d"), date("Y"));
				break;
			case '151200':
				$data['expire'] = mktime(date("H"), date("i"), date("s"), (date("m")+3), date("d"), date("Y"));
				break;
			case '604800':
				$data['expire'] = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), (date("Y")+1));
				break;
			case '1209600':
				$data['expire'] = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), (date("Y")+2));
				break;
			case '1814400':
				$data['expire'] = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), (date("Y")+3));
				break;
			default:
				$data['expire'] = mktime(date("H"), date("i"), date("s"), date("m"), (date("d")+7), date("Y"));
				break;
		}
		if($data['lang'] != 'image') {
			$data['paste'] = $this->process->syntax($this->input->post('code'), $this->input->post('lang'));
		}
		$data['ip'] = $_SERVER["REMOTE_ADDR"];
		$this->keys->verify();
		$data['login'] = $this->session->userdata('login');
		if($data['login'] == FALSE) {
			$data['login'] = 0;
		}
		$this->db->insert('pastes', $data);

		return $data['pid'];
	}
	
	
	/** 
	* Checks if a paste exists
	*
	* @param int $seg URL Segment which the paste id is in
	* @return boolean
	* @access public
	*/
	
	function checkPaste($seg=2)
	{
		if($this->uri->segment($seg) == "")
		{
			return false;
		}
		else
		{
			$this->db->where('pid', $this->uri->segment($seg));
			$query = $this->db->get('pastes');

			if($query->num_rows() > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	
	/** 
	* Gets a specific paste from the database and all its related meta-data
	*
	* @param int $seg URL Segment which the paste id is in
	* @param bool|string $replies False if you don't want to retrieve replies from the database. Paste ID if you do want to retrieve replies from database. Mostly here for legacy support, eg. iPhone views.
	* @return array
	* @access public
	*/

	function getPaste($seg=2, $replies=false)
	{	
		if($this->uri->segment($seg) == '')
		{
			redirect('');
		}
		else
		{
			$pid = $this->uri->segment($seg);
			$data['script'] = 'jquery.js'; 
		}
			
		$this->db->where('pid', $pid);
		$query = $this->db->get('pastes');
		
		foreach ($query->result_array() as $row)
		{
			$data['title'] = $row['title'];
			$data['pid'] = $row['pid'];
			$data['name'] = $row['name'];
			$data['lang_code'] = $row['lang'];
			$data['lang'] = $this->languages->code_to_description($row['lang']);
			$data['paste'] = $row['paste'];
			$data['owner'] = $row['login'];
			$data['expire'] = $row['expire'];
			$data['toexpire'] = $row['toexpire'];
			$data['created'] = $row['created'];
			$data['url'] = site_url('view/'.$row['pid']);
			$data['raw'] = $row['raw'];
			$inreply = $row['replyto'];
		}
		
		if($inreply)
		{
			$this->db->select('name, title');
			$this->db->where('pid', $inreply);
			$query = $this->db->get('pastes');
			
			if($query->num_rows() > 0)
			{
				foreach($query->result_array() as $row)
				{
					$data['inreply']['title'] = $row['title'];
					$data['inreply']['name'] = $row['name'];
					$data['inreply']['url'] = site_url('view/'.$inreply);
				}
			}
			else
			{
				$data['inreply'] = false;
			}
		}

		$data['scripts'] = array('jquery.js');

		if($replies)
		{
			$this->db->select('title, name, created, pid');
			$this->db->where('replyto', $data['pid']);
			$this->db->order_by('id', 'desc');
			$this->db->limit(10);
			
			$query = $this->db->get('pastes');

			if($query->num_rows() > 0)
			{
				$n = 0;
				foreach($query->result_array() as $row)
				{
					$data['replies'][$n]['title'] = $row['title'];
					$data['replies'][$n]['name'] = $row['name'];
					$data['replies'][$n]['created'] = $row['created'];
					$data['replies'][$n]['pid'] = $row['pid'];
					$n++;
				}
			}
			else
			{
				$replies = false;
			}			
		}
		
		return $data;
	}

	/** 
	* Gets a list of users x most recent pastes according to the amount set in the stikked config file.
	*
	* @param string $root Url root needed for pagination
	* @param int $seg Segment which determines the page we're on for pagination.
	* @return array
	* @access public
	*/

	function getMyLists($root='lists/', $seg=2) {
		if((!($this->keys->verify())) ||
		   (($login=$this->session->userdata('login'))==FALSE))
			return $this->getLists($root, $seg);
		$this->load->library('pagination');
		$amount = $this->config->item('per_page');
		
		if(! $this->uri->segment(2))
		{
			$page = 0;
		}
		else
		{
			$page = $this->uri->segment(2);
		}
		
		$this->db->where('login', $login);
		$this->db->orderby('created', 'desc');
		$query = $this->db->get('pastes');
		$num = $query->num_rows();
		$this->db->where('login', $login);
		$this->db->orderby('created', 'desc');
		$query = $this->db->get('pastes', $amount, $page);
		$data['pastes'] = $query->result_array();
		
		$config['base_url'] = site_url($root);
		$config['total_rows'] = $num;
		$config['per_page'] = $amount; 
		$config['full_tag_open'] = '<div class="pages">';
		$config['full_tag_close'] = '</div>';
		$config['uri_segment'] = $seg;
		
		$this->pagination->initialize($config);
			
		$data['pages'] = $this->pagination->create_links();	
		
		return $data;

	}
	
	/** 
	* Gets a list of x most recent pastes according to the amount set in the stikked config file.
	*
	* @param string $root Url root needed for pagination
	* @param int $seg Segment which determines the page we're on for pagination.
	* @return array
	* @access public
	*/
	
	function getLists($root='lists/', $seg=2)
	{
		$this->load->library('pagination');
		$amount = $this->config->item('per_page');
		
		if(! $this->uri->segment(2))
		{
			$page = 0;
		}
		else
		{
			$page = $this->uri->segment(2);
		}
		
		$this->db->where('private', 0);
		$this->db->orderby('created', 'desc');
		$query = $this->db->get('pastes', $amount, $page);
		$data['pastes'] = $query->result_array();
		
		$config['base_url'] = site_url($root);
		$config['total_rows'] = $this->countPastes();
		$config['per_page'] = $amount; 
		$config['full_tag_open'] = '<div class="pages">';
		$config['full_tag_close'] = '</div>';
		$config['uri_segment'] = $seg;
		
		$this->pagination->initialize($config);
			
		$data['pages'] = $this->pagination->create_links();	
		
		return $data;
	}
	
	
	/** 
	* Finds paste that need to be deleted and deletes them.
	*
	* @return void
	* @access public
	*/
	
	function cron()
	{
		$now = now();

		$this->db->where('toexpire', '1');
		$query = $this->db->get('pastes');
		
		foreach($query->result_array() as $row)
		{
			$stamp = $row['expire'];
			if($now > $stamp)
			{
				if($row['lang']=='image') {
					unlink('.' . $row['raw']);
				}
				$this->db->where('id', $row['id']);
				$this->db->delete('pastes');
			}
		}

		return;
	}

	function deletePaste($id = 0) {
		if(!$this->keys->verify())
			show_error("You have to be logged in to delete something!");
		$this->db->where('pid', $id);
		$query = $this->db->get('pastes');
		if($query->num_rows() != 1)
			show_error("No paste with ID " . $id . " !");
		foreach($query->result_array() as $row)
		{
			if($row['login']!=$this->session->userdata('login'))
				show_error("This paste doesn't belong to you!");
			if($row['lang']=='image') {
				unlink('.' . $row['raw']);
			}
			$this->db->where('id', $row['id']);
			$this->db->delete('pastes');
		}
		return true;
	}
	
}

?>
