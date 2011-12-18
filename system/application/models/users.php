<?php
	class Users extends Model {
		function getAdminLevel($login) {
				$this->db->select('adminlevel');
				$this->db->where('login', $login);
				$query = $this->db->get('users');
				if ($query->num_rows() == 1)
				{
					foreach ($query->result() as $row) {
						return $row->adminlevel;
					}
				}
				else {
					return 0;
				}
		}
	}
?>
