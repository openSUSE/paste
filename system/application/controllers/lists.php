<?php

class Lists extends Controller {

	function __construct()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->model('pastes');
		$data['pastes'] = $this->pastes->getlist();
		$this->load->view('list', $data);
	}
}
?>