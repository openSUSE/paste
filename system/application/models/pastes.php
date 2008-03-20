<?php

// 
//  pastes.php
//  stikked
//  
//  Created by Ben McRedmond on 2008-01-25.
//  Copyright 2008 Stikked. Some rights reserved.
// 

class Pastes extends Model {

    function __construct() {
        parent::__construct();
    }

	function count(){
		$this->db->where("private", 0);
		$query = $this->db->get('pastes');
		return $query->num_rows();
	}

	function createPaste($post) {
		$this->load->library('process');
		
		$data['id'] = NULL;
		$data['created'] = time();
		$data['raw'] = htmlspecialchars($post['code']);
		$data['lang'] = htmlspecialchars($post['lang']);

		do {	
			$data['pid'] = substr(md5(md5(rand())), 0, 8);
			$this->db->where("pid", $data['pid']);
			$query = $this->db->get("pastes");
			if($query->num_rows > 0) {
				$n = 0;
				break;
			} else {
				$n = 1;
				break;
 			}
		} while($n == 0);
		
		if(!empty($post['name'])){
			$data['name'] = htmlspecialchars($post['name']);
		} else {
			$data['name'] = $this->config->item("unknown_poster");
			if($data['name'] == "random"){
				$nouns = $this->config->item("nouns");
				$adjectives = $this->config->item("adjectives");
				
				$data['name'] = $adjectives[array_rand($adjectives)]." ".$nouns[array_rand($nouns)];
			}  
		}
		
		if(!empty($post['title'])){
			$data['title'] = htmlspecialchars($post['title']);
		} else {
			$data['title'] = $this->config->item("unknown_title"); 
		}
				
		if(isset($post['private']) and $post['private'] > 0) {
			$data['private'] = 1;
		} else {
			$data['private'] = 0;
		}
		
		if($post['expire'] == 0){
			$data['expire'] = "0000-00-00 00:00:00";
		} else {
			$format = "Y-m-d H:i:s";
			$data['toexpire'] = 1;
			switch($post['expire']){
				case "30":
					$data['expire'] = mktime(date("H"),(date("i")+30), date("s"), date("m"), date("d"), date("Y"));
				case "60":
					$data['expire'] = mktime((date("H") + 1), date("i"), date("s"), date("m"), date("d"), date("Y"));
				case "360":
					$data['expire'] = mktime((date("H") + 6), date("i"), date("s"), date("m"), date("d"), date("Y"));
				case "720":
					$data['expire'] = mktime((date("H") + 12), date("i"), date("s"), date("m"), date("d"), date("Y"));
				case "1440":
					$data['expire'] = mktime((date("H") + 24), date("i"), date("s"), date("m"), date("d"), date("Y"));
				case "10080":
					$data['expire'] = mktime(date("H"), date("i"), date("s"), date("m"), (date("d")+7), date("Y"));
				case "40320":
					$data['expire'] = mktime(date("H"), date("i"), date("s"), date("m"), (date("d")+24), date("Y"));
			}
		}
		
		$data['paste'] = $this->process->syntax($post['code'], $data['lang']);
		$this->db->insert('pastes', $data);
				
		return $data['pid'];
	}
	
	function checkPaste($seg=2) {
		if($this->uri->segment($seg) == ""){
			return FALSE;
		} else {
			$this->db->where("pid", $this->uri->segment($seg));
			$query = $this->db->get("pastes");

			if($query->num_rows() > 0) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
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
			$data['pid'] = $row->pid;
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
		$config['uri_segment'] = $seg;
		
		$this->pagination->initialize($config);
			
		$data['pages'] = $this->pagination->create_links();	
		
		$data['pastes'] = $pastes;
		
		return $data;
	}
	
	function cron(){
		$now = now();

		$this->db->where("toexpire", "1");
		$query = $this->db->get("pastes");
		
		foreach($query->result_array() as $row){
			$stamp = $row['expire'];
			if($now > $stamp){
				$this->db->where('id', $row['id']);
				$this->db->delete('pastes');
			}
		}
	}
}

?>