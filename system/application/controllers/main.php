<?php

// 
//  main.php
//  stikked
//  
//  Created by Ben McRedmond on 2008-03-19.
//  Copyright 2008 Stikked. Some rights reserved.
// 

class Main extends Controller {

	function __construct() {
		parent::__construct();
	}
	
	function index() {
		if(!isset($_POST['submit'])) {
			$this->load->view('home');
		} else {
			$this->load->model('pastes');
			$this->load->library('validation');
		
			$rules['code'] = "required";
			$rules['lang'] = "min_length[1]|required";

			$fields['code'] = "Main Paste";
			$fields['lang'] = "Language";
			
			$this->validation->set_rules($rules);
			$this->validation->set_fields($fields);
			$this->validation->set_message("min_length", "The %s field can not be empty");
			$this->validation->set_error_delimiters('<div class="message error">', '</div>');
			if ($this->validation->run() == FALSE){
				$this->load->view('home');
			} else {
				$opt = "";
			
				if(isset($_POST['acopy']) and $_POST['acopy'] == "1"){
					$opt = "/c";
				}
				
				redirect("view/".$this->pastes->createPaste($_POST).$opt);
			}
		}
	}
		
	function raw() {
		$this->load->model('pastes');
		$check = $this->pastes->checkPaste(3);
		if($check) {
			$data = $this->pastes->getPaste(3);
			$this->load->view('raw', $data);
		} else{
			show_404();
		}
	}	
	
	function lists() {
		$this->load->model('pastes');
		$data = $this->pastes->getLists();
		$this->load->view('list', $data);
	}
	
	function view() {
		$this->load->model('pastes');
		$check = $this->pastes->checkPaste(2);
		
		if($check){		
			$data = $this->pastes->getPaste(2);
		
			if($this->uri->segment(3) == "c"){
				$data['scripts'] = array("jquery.js", "jquery.clipboard.js");
				$data['insert'] = '
				<script type="text/javascript" charset="utf-8">
					$.clipboardReady(function(){
						$.clipboard("'.base_url().'view/'.$this->uri->segment(2).'");
						return false;
					}, { swfpath: "'.base_url().'static/flash/jquery.clipboard.swf"} );
				</script>';
			}
		
			$this->load->view('view', $data);
		} else {
			show_404();
		}
	}
	
	function cron() {
		$this->load->model('pastes');
		$key = $this->uri->segment(2);
		if($key != $this->config->item("cron_key")){
			show_404();
		} else {
			$this->pastes->cron(); 
			return 0;
		}
	}
		
	function about() {
		$this->load->view("about");
	}
}
?>