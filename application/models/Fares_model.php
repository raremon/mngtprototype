<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fares_model extends CI_Model
{
	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	

	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////

	// C R E A T E
	public function save_Fare($data)
	{
		$this->db->insert('fares', $data);
		return TRUE;
	}

	// R E A D
	public function show_Fares()
	{
		$this->db->select("*");
		$this->db->from('fares');
		$query=$this->db->get();
		return $query->result_array();
	}
        
//        Get Fare based on route ID
        public function get_fare($route){
            $fare = $this->db->get_where('fares',array('route' => $route))->row_array();
            return $fare;
        }
        
        public function view_fare($fare_id){
            $fare = $this->db->get_where('fares',array('fare_id' => $fare_id))->row_array();
            return $fare;
        }
        
        // U P D A T E
	public function edit_Fare_Data($fare_id)
	{
		$this->db->select("*");
		$this->db->from('fares');
		$this->db->where('fare_id', $fare_id);
		$query = $this->db->get();
		return $query->row_array();
	}
        
        public function update_Fare_Data($data)
	{
		$this->db->where(array('fare_id'=>$data['fare_id']));
		$this->db->update('fares', $data);
		return TRUE;
	}
        
        public function delete_Fare_Data($data)
	{
		$this->db->where(array('fare_id'=>$data['fare_id']));
		$this->db->delete('fares');
		return TRUE;
	}


}

// END OF ROUTES MODEL