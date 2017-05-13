<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Vehicle_Types_model extends CI_Model
	{
		private $table = "vehicle_types";

		//Constructor
		public function __construct()
		{
			parent::__construct();
		}
		
		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////

		// C R E A T E
		public function save_Vehicle_Type($data)
		{
			$this->db->insert($this->table, $data);
			return TRUE;
		}

		// R E A D
		public function show_Vehicle_Type()
		{
			$this->db->select("vehicle_type_id, vehicle_type_name, created_at");
			$this->db->from($this->table);
			$query=$this->db->get();
			return $query->result_array();
		}

		public function find_Type($vehicle_type_id)
		{
			$this->db->select("vehicle_type_name");
			$this->db->from($this->table);
			$this->db->where('vehicle_type_id', $vehicle_type_id);
			$query=$this->db->get();
			return $query->row_array();
		}

		// U P D A T E
		public function edit_Vehicle_Type($vehicle_type_id)
		{
			$this->db->select("vehicle_type_id, vehicle_type_name");
			$this->db->from($this->table);
			$this->db->where('vehicle_type_id', $vehicle_type_id);
			$query = $this->db->get();
			return $query->row_array();
		}

		public function update_Vehicle_Type($data)
		{
			$this->db->where(array('vehicle_type_id'=>$data['vehicle_type_id']));
			$this->db->update($this->table, $data);
			return TRUE;
		}

		// D E L E T E
		public function delete_Vehicle_Type($data)
		{
			$this->db->where(array('vehicle_type_id'=>$data['vehicle_type_id']));
			$this->db->delete($this->table);
			return TRUE;
		}

		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////
		
	}

// END OF VEHICLE TYPE MODEL