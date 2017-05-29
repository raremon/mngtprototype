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
				
				// Unsets the password
				unset($row['owner_upass']);
				unset($password);
				
				return $row;
			}
			// Passwords do not match
			else{
				return -1;
			}
		}
		else {
			// Account not found
			return -1;
		}
	}
	
	public function request_resetpass($data){
		
		// Gets owner id from database
		$this->db->select("advertiser_id");
		$this->db->from($this->table);
		$this->db->where("owner_uname", $data['user']);
		$query = $this->db->get();
		
		// Returns the owner id of username
		$response = $query->row_array();
		return $response['advertiser_id'];
	}
	
	public function resetpass($data){
		
		//Gets owner account from database
		$this->db->from($this->table);
		$this->db->where("owner_uname", $data['user']);
		$query = $this->db->get();
		
		if ($query->num_rows()){
			
			$row = $query->row_array();
			
			// Updates owner password
			$row['owner_upass'] = sha1($data['newpass']);
			$this->db->where("owner_id", $row['owner_id']);
			$this->db->update($this->table, $row);
			return 1;
		}
		else {
			// Account not found
			return -1;
		}
	
	public function change_pass($data){
		
		//Gets owner account from database
		$this->db->where("owner_uname", $data['user']);
		$query = $this->db->get($this->table);
		
		if ($query->num_rows()){
			
			$row = $query->row_array();
			
			// Checks the password
			if ($row['owner_upass'] == sha1($data['pass'])){
				
				// Updates owner password
				$row['owner_upass'] = $data['newpass'];
				$this->db->where("owner_id", $row['owner_id']);
				$this->db->update($this->table, $row);
				
				// Unsets all data before returning
				unset($data);
				unset($row);
				return 1;
			}
			// Passwords do not match
			else{
				return -1;
			}
		}
		else {
			// Account not found
			return -1;
		}
	}
	
	public function logout_mobile($data){
		// Get Current Time
		$lastlogin = new DateTime(null, new DateTimeZone('Asia/Hong_Kong'));
		
		// Set ad owner status to offline
		$is_online = false;
			
		// Find User in DB
		$user_id = $data;
		$this->db->where("owner_id", $user_id);
		$data=array(
			'is_online'=>$is_online,
			'owner_lastlogin'=>$lastlogin->format('Y-m-d H:i:s'),
		);
		
		// Update the Database then return a value
		$this->db->update($this->table,$data);
		return 1;
	}
}
// END OF MODEL