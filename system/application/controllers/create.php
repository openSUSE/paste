<?php

class Create extends Controller {

	function __construct()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->model('pastes');
		$this->load->helper('date');
		$data['id'] = NULL;
		$data['pid'] = substr(md5(md5(rand())), 0, 8);
		$data['created'] = time();
		$data['name'] = htmlentities($_POST['name']);
		$data['title'] = htmlentities($_POST['title']);
		$data['paste'] = $this->process->syntax($_POST['code'], $_POST['lang']);
		$data['raw'] = htmlentities($_POST['code']);
		$data['lang'] = htmlentities($_POST['lang']);
		
		if(isset($_POST['private'])) {
			$data['private'] = 1;
		} else {
			$data['private'] = 0;
		}
		
		$this->pastes->create($data);
		
		redirect("view/".$data['pid']);
	}
}
?>