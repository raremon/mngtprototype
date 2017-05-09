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
				return $row['owner_id'];
			}
			// Password not match
			return -1;
		}
		else {
			// Password not found
			return -1;
		}
	}
	public function get_info_mobile($data){
		
		//Gets data from controller
		$user_id = $data;
		
		//Queries the table for owner data
		$this->db->where("owner_id", $user_id);
		$query = $this->db->get($this->table);
		
		//Puts data into $row and returns it to controller
		$row = $query->row_array();
		return $row;
	}
	
	public function logout_mobile($data)
	{
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
// END OF AD OWNER MODEL