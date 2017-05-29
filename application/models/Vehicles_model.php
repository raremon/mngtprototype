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

		// C R E A T E
		public function save_Vehicle($data)
		{
			$this->db->insert($this->table, $data);
			return TRUE;
		}

		// R E A D
		public function show_Vehicle()
		{
			$this->db->select("vehicle_id, vehicle_name, plate_number, vehicle_description, vehicle_type, created_at");
			$this->db->from($this->table);
			$query=$this->db->get();
			return $query->result_array();
		}

		public function find_Vehicle()
		{
			$this->db->select("vehicle_id, vehicle_name, vehicle_type");
			$this->db->from($this->table);
			$query=$this->db->get();
			return $query->result_array();
		}

		public function find_Type($type_id)
		{
			$this->db->select("vehicle_type");
			$this->db->from($this->table);
			$this->db->where('vehicle_type', $type_id);
			$query=$this->db->get();
			if ($query->num_rows() > 0){
		        return true;
		    }
		    else{
		        return false;
		    }
		}

		// U P D A T E
		public function edit_Vehicle($vehicle_id)
		{
			$this->db->select("vehicle_id, vehicle_name, plate_number, vehicle_description, vehicle_type");
			$this->db->from($this->table);
			$this->db->where('vehicle_id', $vehicle_id);
			$query = $this->db->get();
			return $query->row_array();
		}

		public function update_Vehicle($data)
		{
			$this->db->where(array('vehicle_id'=>$data['vehicle_id']));
			$this->db->update($this->table, $data);
			return TRUE;
		}

		public function assign_Media($media_id, $vehicle_id)
		{
				$this->db->where(array('vehicle_id'=>$vehicle_id));
				$this->db->update($this->table, array('assigned_to'=>$media_id));
				return TRUE;
		}

		public function unassign_Media($media_id, $vehicle_id)
		{
				$this->db->where(array('vehicle_id'=>$vehicle_id));
				$this->db->update($this->table, array('assigned_to'=>NULL));
				return TRUE;
		}

		// D E L E T E
		public function delete_Vehicle($data)
		{
			$this->db->where(array('vehicle_id'=>$data['vehicle_id']));
			$this->db->delete($this->table);
			return TRUE;
		}

		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////
		
	}

// END OF VEHICLE MODEL