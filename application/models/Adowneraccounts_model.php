<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Accounts of AdOwners for AndroidApp login

class Adowneraccounts_model extends CI_Model 
{
	private $table = "adowner_accounts";
	private $_data = array();

	public function validate(){
			
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			// Set status to online
			$is_online = true;

			$this->db->where("owner_uname ", $username);
			$query = $this->db->get($this->table);

			if ($query->num_rows()) 
			{	
				$row = $query->row_array();

				// Checks the password
				if ($row['owner_upass'] == sha1($password)) 
				{
					// Sets status to online after logging in
					$row['is_online']=$is_online;
					$this->db->where("owner_id", $row['owner_id']);
					$this->db->update($this->table, $row);
					// Unsets the password from the array
					unset($row['owner_upass']);
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

	public function validate_mobile($data){
			
		//retrieval of data from controller
		$username = $data["user"];
		$password = $data["pass"];
			
		// Set status to online
		$is_online = true;

		$this->db->where("owner_uname", $username);
		$query = $this->db->get($this->table);

		if ($query->num_rows()){
			
			$row = $query->row_array();

			// Checks the password
			if ($row['owner_upass'] == sha1($password)){
				
				// Sets status to online after logging in
				$row['is_online']=$is_online;
				$this->db->where("owner_id", $row['owner_id']);
				$this->db->update($this->table, $row);
				// Unsets the password from the array
				unset($row['owner_upass']);
				$this->_data = $row;
				return 1;
			}

			// Password not match
			return 0;
		}
		else {
			// Password not found
			return 0;
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
			$this->db->where("owner_id", $user_id);
			$data=array(
				'is_online'=>$is_online,
				'owner_lastlogin'=>$lastlogin->format('Y-m-d H:i:s'),
			);

			// Update the Database
			$this->db->update($this->table,$data);
			return TRUE;
		}

		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////

		// C R E A T E
		public function save_User($data)
		{
			$this->db->insert($this->table, $data);
			return TRUE;
		}

		// R E A D
		public function show_User()
		{
			$this->db->select("*");
			$this->db->from($this->table);
			$query=$this->db->get();
			return $query->result_array();
		}

		// U P D A T E
		public function edit_User($user_id)
		{
			$this->db->select("*");
			$this->db->from($this->table);
			$this->db->where('owner_id', $user_id);
			$query = $this->db->get();
			return $query->row_array();
		}

		public function update_User($data)
		{
			$this->db->where(array('owner_id'=>$data['user_id']));
			$this->db->update($this->table, $data);
			return TRUE;
		}

		// D E L E T E
		public function delete_User($data)
		{
			$this->db->where(array('owner_id'=>$data['user_id']));
			$this->db->delete($this->table);
			return TRUE;
		}

		// O N L I N E   T O G G L I N G
		public function onlineStatus($data)
		{
			$this->db->where(array('owner_id'=>$data['user_id']));
			$this->db->update($this->table, $data);
			return TRUE;
		}

		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////		

}

// END OF MODEL