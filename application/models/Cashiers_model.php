<?php

class Cashiers_model extends CI_Model {
        // Constructor
	public function __construct()
	{
		parent::__construct();
	}
        
        // C R E A T E
	public function save_Cashier($data)
	{
		$this->db->insert('cashiers', $data);
		return TRUE;
	}
        
        // R E A D
	public function show_Cashiers()
	{
		$this->db->select("*");
		$this->db->from('cashiers');
		$query=$this->db->get();
		return $query->result_array();
	}
        
        // U P D A T E
	public function edit_Cashier_Data($cashier_id)
	{
		$this->db->select("*");
		$this->db->from('cashiers');
		$this->db->where('cashier_id', $cashier_id);
		$query = $this->db->get();
		return $query->row_array();
	}
        
        public function update_Cashier_Data($data)
	{
		$this->db->where(array('cashier_id'=>$data['cashier_id']));
		$this->db->update('cashiers', $data);
		return TRUE;
	}
        public function delete_Cashier_Data($data)
	{
		$this->db->where(array('fare_id'=>$data['fare_id']));
		$this->db->delete('fares');
		return TRUE;
	}
        
}
