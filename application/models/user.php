<?php 
class User extends CI_Model
{
	function authenticate($username, $password)
	{
		$this->db->select('id, firstname, lastname, privilege');
		$query = $this->db->get_where('users', array('username' => $username, 'password' => $password));
		if($query->row() != null)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}

	/*
	 * @returns TRUE if pw is correct
	 */
	function check_pw($current, $session_id) {
		
		if (!empty($current)) {
			$query = "SELECT `id` FROM `users` WHERE `id`='"
				.mysql_real_escape_string($session_id)."' 
				AND `password`='"
				.md5(mysql_real_escape_string($current))."'";
			
			$result = mysql_query($query);
			
			if (mysql_num_rows($result) == 1) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
		
	}
	
	function change_pw($password, $session_id) {
		if (!empty($password)) {
			$query = "UPDATE `sep_main`.`users` SET `password` = '".md5(mysql_real_escape_string($password))."' WHERE `users`.`id` = ".$session_id.";";
			if (mysql_query($query)) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

}


?>