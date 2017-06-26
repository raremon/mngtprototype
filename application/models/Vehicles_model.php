<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Vehicles_model extends CI_Model
	{
		private $table = "vehicles";
		private $query = "vehicle_id, vehicle_name, plate_number, chassi_number, sim_number, vehicle_description, vehicle_type, vehicle_status, assigned_to, created_at";
		private $id = "vehicle_id";

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
		
		public function getType($id)
		{
			$this->db->select($this->query.",SUBSTRING_INDEX(vehicle_description,' ',15) AS info");
			$this->db->from($this->table);
			$this->db->where('vehicle_type', $id);
			$query=$this->db->get();
			return $query->result_array();
		}
		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////
		// C R E A T E
		public function save($data)
		{
			$this->db->insert($this->table, $data);
			return TRUE;
		}
		// R E A D
		public function read()
		{
			$this->db->select($this->query);
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
		public function edit($id)
		{
			$this->db->select($this->query);
			$this->db->from($this->table);
			$this->db->where($this->id, $id);
			$query = $this->db->get();
			return $query->row_array();
		}
		public function update($data)
		{
			$this->db->where(array($this->id=>$data['vehicle_id']));
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
		public function delete($data)
		{
			$this->db->where(array($this->id=>$data['vehicle_id']));
			$this->db->delete($this->table);
			return TRUE;
		}

		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////
		
	}

// END OF VEHICLE MODEL