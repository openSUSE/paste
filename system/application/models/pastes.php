<?php

// 
//  pastes.php
//  stikked
//  
//  Created by Ben McRedmond on 2008-01-25.
//  Copyright 2008 HiPPstr. All rights reserved.
// 

class Pastes extends Model {

    function __construct() {
        parent::__construct();
    }

	function count(){
		$query = $this->db->get('pastes');
		return $query->num_rows();
	}

	function createPaste($post) {
		$this->load->library('process');
		
		$data['id'] = NULL;
		$data['pid'] = substr(md5(md5(rand())), 0, 8);
		$data['created'] = time();
		if(!empty($data['name'])){$data['name'] = htmlspecialchars($post['name']);} else {$data['name'] = $this->config->item("unknown_poster"); }
		if(!empty($data['title'])){$data['title'] = htmlspecialchars($post['title']);} else {$data['title'] = $this->config->item("unknown_title"); }
		$data['paste'] = $this->process->syntax($post['code'], $post['lang']);
		$data['raw'] = htmlspecialchars($post['code']);
		$data['lang'] = htmlspecialchars($post['lang']);
		
		if(isset($post['private'])) {
			$data['private'] = 1;
		} else {
			$data['private'] = 0;
		}
		
		$this->db->insert('pastes', $data);
		return $data['pid'];
	}
	
	function getPaste($seg=2) {
		if($this->uri->segment($seg) == "") {
			redirect('');
		} else {
			$pid = $this->uri->segment($seg);
			$data['script'] = "jquery.js"; 
		}
		
		$this->db->where('pid', $pid);
		$query = $this->db->get('pastes');
		
		foreach ($query->result() as $row)
		{
		    $data['title'] = $row->title;
			$data['name'] = $row->name;
			$data['lang'] = $row->lang;
			$data['paste'] = $row->paste;
			$data['created'] = $row->created;
			$data['url'] = base_url()."view/".$row->pid;
			$data['raw'] = $row->raw;
		}
				
		return $data;
	}
	
	function getLists($root="lists/", $seg=2) {
		$this->load->library('pagination');
		$amount = $this->config->item('per_page');
		
		if(! $this->uri->segment(2)) {
			$page = 0;
		} else {
			$page = $this->uri->segment(2);
		}
		
		$this->db->where('private', 0);
		$this->db->orderby("created", 'desc');
		$query = $this->db->get('pastes', $amount, $page);
		$pastes = $query->result_array();
		
		$config['base_url'] = base_url().$root;
		$config['total_rows'] = $this->count();
		$config['per_page'] = $amount; 
		$config['full_tag_open'] = '<div class="pages">';
		$config['full_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		$config['uri_segment'] = $seg;
		
		$this->pagination->initialize($config);
			
		$data['pages'] = $this->pagination->create_links();	
		
		$data['pastes'] = $pastes;
		
		return $data;
	}
}

?>