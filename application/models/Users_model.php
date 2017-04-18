<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Users_model extends CI_Model 
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

		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////

		// C R E A T E
		public function save_User($data)
		{
			$this->db->insert('users', $data);
			return TRUE;
		}

		// R E A D
		public function show_User()
		{
			$this->db->select("*");
			$this->db->from('users');
			$query=$this->db->get();
			return $query->result_array();
		}

		// U P D A T E
		public function edit_User($user_id)
		{
			$this->db->select("*");
			$this->db->from('users');
			$this->db->where('user_id', $user_id);
			$query = $this->db->get();
			return $query->row_array();
		}

		public function update_User($data)
		{
			$this->db->where(array('user_id'=>$data['user_id']));
			$this->db->update('users', $data);
			return TRUE;
		}

		// D E L E T E
		public function delete_User($data)
		{
			$this->db->where(array('user_id'=>$data['user_id']));
			$this->db->delete('users');
			return TRUE;
		}

		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////		

	}

// END OF USER MODEL