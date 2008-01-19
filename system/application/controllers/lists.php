<?php

class Lists extends Controller {

	function __construct()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->model('pastes');
		$this->load->library('pagination');
		$this->load->helper('date');
		
		
		if(! $this->uri->segment(2)) {
			$page = 0;
		} else {
			$page = $this->uri->segment(2);
		}

		$config['base_url'] = base_url()."lists/";
		$config['total_rows'] = $this->pastes->count();
		$config['per_page'] = '10'; 
		$config['full_tag_open'] = '<div class="pages">';
		$config['full_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		$config['uri_segment'] = 2;
		
		$this->pagination->initialize($config);
			
		$data['pages'] = $this->pagination->create_links();	
		
		$data['pastes'] = $this->pastes->getList($page);
		
		$this->load->view('list', $data);
	}
}
?>