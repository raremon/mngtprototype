<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class User extends CI_Model 
	{
		private $table = "users";
		private $_data = array();

		public function validate()
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$this->db->where("user_name", $username);
			$query = $this->db->get($this->table);

			if ($query->num_rows()) 
			{	
				$row = $query->row_array();

				// Checks the password
				if ($row['user_password'] == sha1($password)) 
				{
					// Unsets the password from the array
					unset($row['user_password']);
					$this->_data = $row;
					return ERR_NONE;
				}

				// Password not match
				return ERR_INVALID_PASSWORD;
			}
			else {
				// Password not found
				return ERR_INVALID_USERNAME;
			}
		}

		public function get_data()
		{
			return $this->_data;
		}

		public function logout()
		{

			// Get Current Time
			$lastlogin = new DateTime(null, new DateTimeZone('Asia/Hong_Kong'));

			// Find User in DB
			$user_id = $this->session->userdata("user_id");
			$this->db->where("user_id", $user_id);
			$data=array(
				'user_lastlogin'=>$lastlogin->format('Y-m-d H:i:s'),
			);

			// Update the Database
			$this->db->update( 'users' ,$data);
			return TRUE;
		}

	}

// END OF USER MODEL