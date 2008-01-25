<?php

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
			$this->validation->set_rules($rules);
			$this->validation->set_error_delimiters('<div class="message error">', '</div>');
			if ($this->validation->run() == FALSE){
				$this->load->view('home');
			} else {
				redirect("view/".$this->pastes->createPaste($_POST));
			}
		}
	}
		
	function lists() {
		$this->load->model('pastes');
		$data = $this->pastes->getLists();
		$this->load->view('list', $data);
	}
	
	function view() {
		$this->load->model('pastes');
		$data = $this->pastes->getPaste(2);
		$this->load->view('view', $data);
	}
	
	function about() {
		$this->load->view("about");
	}
}
?>