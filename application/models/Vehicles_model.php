<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Vehicles_model extends CI_Model
	{
		private $table = "vehicles";

		//Constructor
		public function __construct()
		{
			parent::__construct();
		}

		public function count_Vehicle()
		{
			$this->db->select('vehicle_id');
			$this->db->from($this->table);
			return $this->db->count_all_results();
		}
		
		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////

		// // C R E A T E
		// public function save_Vehicle($data)
		// {
		// 	$this->db->insert($this->table, $data);
		// 	return TRUE;
		// }

		// // R E A D
		// public function show_Vehicle()
		// {
		// 	$this->db->select("*");
		// 	$this->db->from($this->table);
		// 	$query=$this->db->get();
		// 	return $query->result_array();
		// }

		// // U P D A T E
		// public function edit_Vehicle($vehicle_id)
		// {
		// 	$this->db->select("*");
		// 	$this->db->from($this->table);
		// 	$this->db->where('vehicle_id', $vehicle_id);
		// 	$query = $this->db->get();
		// 	return $query->row_array();
		// }

		// public function update_Vehicle($data)
		// {
		// 	$this->db->where(array('vehicle_id'=>$data['vehicle_id']));
		// 	$this->db->update($this->table, $data);
		// 	return TRUE;
		// }

		// // D E L E T E
		// public function delete_Vehicle($data)
		// {
		// 	$this->db->where(array('vehicle_id'=>$data['vehicle_id']));
		// 	$this->db->delete($this->table);
		// 	return TRUE;
		// }

		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////
		
	}

// END OF VEHICLE MODEL