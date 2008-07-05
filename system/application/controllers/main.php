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
	
	function _index_prep(){
		$this->load->model("languages");
		$this->load->helper("form");
		
		$data['languages'] = $this->languages->get_languages();		
		$data['scripts'] = array("jquery.js");
		
		if($this->db_session->flashdata("settings_changed")){
			$data['status_message'] = "Settings successfully changed";
		}
		
		if($this->db_session->userdata("remember") > 0){
			$data['name_set'] = $this->db_session->userdata("name");
			$data['lang_set'] = $this->db_session->userdata("lang");
			$data['expire_set'] = $this->db_session->userdata("expire");
			$data['acopy_set'] = $this->db_session->userdata("acopy");
			$data['private_set'] = $this->db_session->userdata("private");			
			$data['snipurl_set'] = $this->db_session->userdata("snipurl");
			$data['remember_set'] = $this->db_session->userdata("remember");
		} else {
			$data['name_set'] = "";
			$data['lang_set'] = "php";
			$data['expire_set'] = "0";
			$data['acopy_set'] = "0";
			$data['private_set'] = "0";
			$data['snipurl_set'] = "0";
			$data['remember_set'] = "0";
		}
				
		return $data;
	}
	
	function index() {		
		if(!isset($_POST['submit'])) {
			$data = $this->_index_prep();
			$this->load->view('home', $data);
		} else {
			$this->load->model('pastes');
			$this->load->library('validation');
		
			$rules['code'] = "required";
			$rules['lang'] = "min_length[1]|required|callback__valid_lang";

			$fields['code'] = "Main Paste";
			$fields['lang'] = "Language";
			
			$this->validation->set_rules($rules);
			$this->validation->set_fields($fields);
			$this->validation->set_message("min_length", "The %s field can not be empty");
			$this->validation->set_error_delimiters('<div class="message error">', '</div>');
			
			if ($this->validation->run() == FALSE){
				$data = $this->_index_prep();
				$this->load->view('home', $data);
			} else {
				if(isset($_POST['acopy']) and $_POST['acopy'] > 0){
					$this->db_session->set_flashdata('acopy', "true");
				}
				
				if(isset($_POST['remember'])){
					$user_data = array(
							'name' => $this->input->post('name'),
							'lang' => $this->input->post('lang'),
							'expire' => $this->input->post('expire'),
							'acopy' => $this->input->post('acopy'),
							'snipurl' => $this->input->post('snipurl'),
							'private' => $this->input->post('private'),
							'remember' => $this->input->post('remember')
						);
					$this->db_session->set_userdata($user_data);
				}
				
				if($this->input->post('remember') == false and $this->db_session->userdata("remember") == 1){
					$user_data = array(
							'name' => "",
							'lang' => "php",
							'expire' => "0",
							'acopy' => "0",
							'snipurl' => "0",
							'private' => "0",
							'remember' =>"0"
						);
					$this->db_session->unset_userdata($user_data);
				}
				
				redirect($this->pastes->createPaste($_POST));
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
			if($this->db_session->userdata("view_raw")){
				redirect("view/raw/".$this->uri->segment(2));
			}
			
			$data = $this->pastes->getPaste(2);
			$data['scripts'] = array("jquery.js");
			
			if($this->db_session->userdata("full_width")){
				$data['full_width'] = 1;
			} else {
				$data['full_width'] = false;
			}
			
			if($this->db_session->flashdata("acopy") == "true"){
				if($data['snipurl']){
					$url = $data['snipurl'];
				} else {
					$url = $data['url'];
				}
				
				$data['scripts'] = array("jquery.js", "jquery.clipboard.js");
				$data['insert'] = '
				<script type="text/javascript" charset="utf-8">
					$.clipboardReady(function(){
						$.clipboard("'.$url.'");
						return false;
					}, { swfpath: "'.base_url().'static/flash/jquery.clipboard.swf"} );
				</script>';
			}
		
			$this->load->view('view', $data);
		} else {
			show_404();
		}
	}
	
	function _view_options_prep(){	
		$this->load->helper("form");
		if($this->db_session->userdata("remember_view") > 0){
			$data['full_width_set'] = $this->db_session->userdata("full_width");
			$data['view_raw_set'] = $this->db_session->userdata("view_raw");
		} else {
			$data['full_width_set'] = false;
			$data['view_raw_set'] = false;
		}
		return $data;
	}
	
	function view_options(){		
		if(!isset($_POST['submit'])){
			$data = $this->_view_options_prep();
			$this->load->view("view_options", $data);
		} else {
			$this->load->library("validation");
			
			$rules['full_width'] = "max_length[1]";
			$rules['view_raw'] = "max_length[1]";
			
			$this->validation->set_rules($rules);
			
			if($this->validation->run() == false){
				exit("Ugh, stupid skiddie.");
			} else {
				$user_data = array(
					"full_width" => $this->input->post("full_width"),
					"view_raw" => $this->input->post("view_raw"),
					"remember_view" => true
					);
				$this->db_session->set_userdata($user_data);
				$this->db_session->set_flashdata("settings_changed", "true");
				redirect();
			}
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
	
	function _valid_lang($lang) {
		$this->load->model("languages");
		$this->validation->set_message("Please use a valid language");
		return $this->languages->valid_language($lang);
	}
}
?>