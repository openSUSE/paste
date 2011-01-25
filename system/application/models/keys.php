<?php 

class Keys extends Model {
   function add_me() {
      $data = array();
      $data['login']  = $this->session->userdata('login');
      $data['key']    = 'SESS:' . $this->session->userdata('session_id');
      $data['expire'] = now()+$this->config->item('sess_expiration');
      $this->db->where('key',$data['key']);
		$this->db->delete('keys');
      $this->db->insert('keys', $data);
   }

   function rand_str($length = 32, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890')
   {
    // Length of character list
    $chars_length = (strlen($chars) - 1);

    // Start our string
    $string = $chars{rand(0, $chars_length)};
   
    // Generate random string
    for ($i = 1; $i < $length; $i = strlen($string))
    {
        // Grab a random character from our list
        $r = $chars{rand(0, $chars_length)};
    }
   
    // Return the string
    return $string;
   }
   function verify($login=NULL, $key=NULL) {
      if($login == NULL) {
         $login = $this->session->userdata('login');
      }
      if($key == NULL) {
         $key = 'SESS:' . $this->session->userdata('session_id');
      }
      $this->db->where('login',$login);
      $this->db->where('key',$key);
      $query = $this->db->get('keys');
      if($query->num_rows() > 0)
         return true;
      $this->session->sess_destroy();
      return false;
   }
   function gen_key($ttl) {
      if(verify()) {
         $data = array();
         $data['login'] = $login = $this->session->userdata('login');
         do {
            $data['key'] = 'KEY:' . rand_str();
            $this->db->where('key',$data['key']);
            $query = $this->db->get('keys');
         } while($query->num_rows() > 0);
         $data['expire'] = now() + $ttl;
         $this->db->insert('keys', $data);
      } else {
         return false;
      }
   }
   function get_keys() {
      if(verify()) {
         $this->db->where('login',$login);
         $query = $this->db->get('keys');
         return $query->result_array();
      } else {
         return false;
      }
   }
   function cron() {
		$now = now();

		$query = $this->db->get('keys');
		
		foreach($query->result_array() as $row)
		{
			$stamp = $row['expire'];
			if($now > $stamp)
			{
				$this->db->where('key', $row['key']);
				$this->db->delete('keys');
			}
		}

		return;
   }
}
?>
