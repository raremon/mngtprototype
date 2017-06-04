<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Users_model extends CI_Model 
	{
		private $table = "users";
		private $_data = array();

		public function validate()
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			// Set status to online
			$is_online = true;
			$this->db->where("user_name", $username);
			$query = $this->db->get($this->table);
			if ($query->num_rows()) 
			{	
				$row = $query->row_array();
				// Checks the password
				if ($row['user_password'] == sha1($password)) 
				{
					// Sets status to online after logging in
					$row['is_online']=$is_online;
					$this->db->where("user_id", $row['user_id']);
					$this->db->update( 'users' , $row);
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

		public function validate_mobile($data)
		{
			//retrieval of data from controller
			$username = $data["user"];
			$password = $data["pass"];
			$lastlogin = new DateTime(null, new DateTimeZone('Asia/Hong_Kong'));
			
			$this->db->where("user_name", $username);
			$query = $this->db->get($this->table);
			if ($query->num_rows()) 
			{	
				$row = $query->row_array();
				// Checks the password
				if ($row['user_password'] == sha1($password)) 
				{
					// Sets status to online after logging in
					$row['is_online'] = true;
					$row['user_lastlogin'] = $lastlogin->format('Y-m-d H:i:s');
					$this->db->where("user_id", $row['user_id']);
					$this->db->update( $this->table , $row);
					
					// Unsets the password from the array
					unset($row['user_password']);
					unset($password);
					return $row;
				}
				else
				{
					// Passwords do not match
					return -1;
				}
			}
			else {
				// Account not found
				return -1;
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
			// Set status to offline
			$is_online = false;
			// Find User in DB
			$user_id = $this->session->userdata("user_id");
			$this->db->where("user_id", $user_id);
			$data=array(
				'is_online'=>$is_online,
				'user_lastlogin'=>$lastlogin->format('Y-m-d H:i:s'),
			);
			// Update the Database
			$this->db->update( 'users' ,$data);
			return TRUE;
		}
		
		public function logout_mobile($data)
		{
			// Get Current Time
			$lastlogin = new DateTime(null, new DateTimeZone('Asia/Hong_Kong'));
			
			// Find User in DB
			$this->db->where("user_id", $data['user_id']);
			$this->db->where("user_name", $data['user_name']);
			$this->db->where("user_password", sha1($data['user_password']));
			$this->db->where("user_role", 2);
			$data=array('is_online'=>false,
			'user_lastlogin'=>$lastlogin->format('Y-m-d H:i:s'),);
			
			// Update the Database then return a value
			$this->db->update($this->table,$data);
			if($this->db->affected_rows() > 0)
			{
				return 1;
			}
			else
			{
				return -1; 
			}
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

		// O N L I N E   T O G G L I N G
		public function onlineStatus($data)
		{
			$this->db->where(array('user_id'=>$data['user_id']));
			$this->db->update('users', $data);
			return TRUE;
		}
		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////		

	}

// END OF USER MODEL