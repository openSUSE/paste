<?php

class Pastes extends Model {

    function __construct()
    {
        parent::Model();
    }

	function create($data) {
		$this->db->insert('pastes', $data);
	}
	
	function view($pid) {
		$this->db->where('pid', $pid);
		$query = $this->db->get('pastes');
		
		foreach ($query->result() as $row)
		{
		    $data['title'] = $row->title;
			$data['name'] = $row->name;
			$data['lang'] = $row->lang;
			$data['paste'] = $row->paste;
			$data['created'] = $row->created;
			$data['url'] = base_url()."index.php/view/".$row->pid;
			$data['raw'] = $row->raw;
		}
		
		return $data;
	}
	
	function getlist($start=0, $amount=10) {
		$this->db->where('private', 0);
		$this->db->orderby("created", 'desc');
		$query = $this->db->get('pastes', $amount, $start);
		$pastes = $query->result_array();
		return $pastes;
	}
}

?>