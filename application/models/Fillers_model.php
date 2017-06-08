<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fillers_model extends CI_Model{
	
	private $table = 'fillers';
		
	public function __construct(){
			parent::__construct();
	}

	public function count_Fillers(){
			$this->db->select('filler_id');
			$this->db->from($this->table);
			return $this->db->count_all_results();
	}

	public function getFillers($where=null,$orwhere=null){

		$this->db->select('filler_id,filler_title,filler_type,filler_file,filler_duration,created_at,updated,status')
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

	public function getMinFiller($where=null,$orwhere=null){

		$this->db->select('MIN(filler_duration) AS min_time')
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

	public function getTotalFillTime($where=null,$orwhere=null){

		// SELECT SUM(filler_duration) FROM `fillers` WHERE status=0
		$this->db->select('SUM(filler_duration) AS total_time')
			->from($this->table);			

		if( isset($where) )
			$this->db->where($where);

		if( isset($orwhere) )
			$this->db->or_where($orwhere);
				
		$query = $this->db->get();
			
		return $query->result_array();
		
	}	

	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////

	// C R E A T E
	public function save_Filler($data){
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	// R E A D
	public function show_Filler(){
		$this->db->select("filler_id, filler_title, filler_description, filler_type, filler_file, filler_duration, created_at");
		$this->db->from($this->table);
		$query=$this->db->get();
		return $query->result_array();
	}

	// U P D A T E
	public function edit_Filler($id)
	{
		$this->db->select("filler_id, filler_title, filler_file, filler_description");
		$this->db->from($this->table);
		$this->db->where('filler_id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function update_Filler($data){
		$this->db->where(array('filler_id'=>$data['filler_id']));
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}

	// D E L E T E
	public function delete_Filler($where){
		$this->db->where($where);
		$this->db->delete($this->table);
		return $this->db->affected_rows();
	}

	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////
		
}

// END OF FILLER MODEL