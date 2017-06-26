<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Accounts of AdOwners for AndroidApp login
class Adowneraccounts_model extends CI_Model 
{
	private $table = "adowner_accounts";
	private $id = "owner_id";
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
	
	public function login_mobile($data)
	{
		$lastlogin = new DateTime(null, new DateTimeZone('Asia/Hong_Kong'));
		
		$this->db->where("owner_uname", $data["user"]);
		$this->db->where("owner_upass", sha1($data["pass"]));
		$query = $this->db->get($this->table);
		if ($query->num_rows())
		{
			$row = $query->row_array();
			
			// Sets status to online after logging in
			$row['is_online'] = true;
			$row['owner_lastlogin'] = $lastlogin->format('Y-m-d H:i:s');
			$this->db->where($this->id, $row[$this->id]);
			$this->db->update($this->table, $row);
				
			// Unsets the password
			unset($row['owner_upass']);
			return $row;
		}
		else {
			// Account not found
			return -1;
		}
	}
	
	public function validate_mobile($data)
	{
		$lastlogin = new DateTime(null, new DateTimeZone('Asia/Hong_Kong'));
		
		$this->db->where("owner_uname", $data["user"]);
		$this->db->where("owner_upass", sha1($data["pass"]));
		$query = $this->db->get($this->table);
		if ($query->num_rows())
		{
			$row = $query->row_array();
			
			// Unsets the password
			unset($row['owner_upass']);
			return $row;
		}
		else {
			// Account not found
			return -1;
		}
	}
	
	public function request_reset_pass($data){
		
		// Gets owner id from database
		$this->db->select("advertiser_id");
		$this->db->from($this->table);
		$this->db->where("owner_uname", $data['user']);
		$query = $this->db->get();
		
		// Returns the owner id of username
		$response = $query->row_array();
		return $response['advertiser_id'];
	}
	
	public function reset_pass($data){
		
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
				$row['owner_upass'] = sha1($data['newpass']);
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
	
	public function logout_mobile($data)
	{
		$data['owner_upass'] = sha1($data['owner_upass']);
		//Find Ad owner in DB
		$this->db->where("owner_id", $data['owner_id']);
		$this->db->where("owner_uname", $data['owner_uname']);
		$this->db->where("owner_upass", $data['owner_upass']);
		$data['is_online']   = false;
		
		// Update the Database then return a value
		$this->db->update($this->table,$data);
		if($this->db->affected_rows() > 0)
		{
			unset($data['owner_upass']);
			return 1;
		}
		else
		{
			unset($data['owner_upass']);
			return -1; 
		}
	}
	
	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////
	// C R E A T E
	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	// R E A D
	public function show()
	{
		$this->db->select("*");
		$this->db->from($this->table);
		$query=$this->db->get();
		return $query->result_array();
	}

	// U P D A T E
	public function edit($owner_id)
	{
		$this->db->select("*");
		$this->db->from($this->table);
		$this->db->where($this->id, $owner_id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function update($data)
	{
		$this->db->where($this-id,$data[$this->id]);
		$this->db->update($this->table, $data);
		return TRUE;
	}

	// D E L E T E
	public function delete($data)
	{
		$this->db->where($this-id,$data[$this->id]);
		$this->db->delete($this->table);
		return TRUE;
	}
}
// END OF ADOWNER ACCOUNTS MODEL