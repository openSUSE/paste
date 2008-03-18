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
				if(isset($_POST['acopy']) and $_POST['acopy'] == "1"){
					redirect("view/".$this->pastes->createPaste($_POST)."/c");
				} else {						      	  
					redirect("view/".$this->pastes->createPaste($_POST));	
		 		}
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
		$check = $this->pastes->checkPaste(2);
		
		if($check){		
			$data = $this->pastes->getPaste(2);
		
			if($this->uri->segment(3) == "c"){
				$data['scripts'] = array("jquery.clipboard.js");
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
	
	function about() {
		$this->load->view("about");
	}
}
?>