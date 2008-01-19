<?php

class View extends Controller {
	function __construct() {
		parent::Controller();
	}
	
	function index() {
		$this->load->model('pastes');
		$this->load->helper('date');
		
		if($this->uri->segment(2) == "") {
			redirect('');
		} else {
			$pid = $this->uri->segment(2);
		
			$data = $this->pastes->view($pid);
			$data['script'] = "jquery.js"; 
			$this->load->view('view', $data);
		}
	}
}

?>