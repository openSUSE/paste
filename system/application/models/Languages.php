<?php

class Languages extends Model {

	function __construct(){
		parent::__construct();
	}

	function valid_language($lang){
		$this->db->where("code", $lang);
		$query = $this->db->get("languages");
		
		if($query->num_rows() > 0){
			return true;
		} else {
			return false;
		}
	}
	
	function get_languages(){
		$query = $this->db->get("languages");
		
		foreach($query->result_array() as $row){
			$data[$row['code']] = $row['description'];
			if($row['code'] == "text"){
				$data["0"] = "-----------------";
			}
		}
		
		return $data;
	}

}

?>