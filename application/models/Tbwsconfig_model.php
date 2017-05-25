<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tbwsconfig_model extends CI_Model{
	
	private $table = 'tbwsconfig';
		
	public function __construct(){
			parent::__construct();
	}

	public function get_Data($where=null,$orwhere=null){

		$this->db->select('*')
			->from($this->table);			

		if( isset($where) )
			$this->db->where($where);

		if( isset($orwhere) )
			$this->db->or_where($orwhere);
				
		$query = $this->db->get();
			
		// echo $this->db->last_query();
		// exit;
			
		return $query->result_array();
		
	}

	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////

	// C R E A T E
	public function save_Data($data){
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	// R E A D
	public function show_Data(){
		$this->db->select("*");
		$this->db->from($this->table);
		$query=$this->db->get();
		return $query->result_array();
	}

	// U P D A T E
	public function update_Data($where,$data){
		$this->db->where($where);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}

	// D E L E T E
	public function delete_Data($where){
		$this->db->where($where);
		$this->db->delete($this->table);
		return $this->db->affected_rows();
	}

	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////
		
}

// END OF MODEL