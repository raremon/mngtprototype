<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Vehicle_Types_model extends CI_Model
	{
		private $table = "vehicle_types";
		private $query = "vehicle_type_id, vehicle_type_name, created_at";
		private $id = "vehicle_type_id";
		//Constructor
		public function __construct()
		{
			parent::__construct();
		}
		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////
		public function create($data)
		{
			$this->db->insert($this->table, $data);
			return TRUE;
		}
		public function read()
		{
			$this->db->select($this->query);
			$this->db->from($this->table);
			$query=$this->db->get();
			return $query->result_array();
		}
		public function find_Type($id)
		{
			$this->db->select("vehicle_type_name");
			$this->db->from($this->table);
			$this->db->where($this->id, $id);
			$query=$this->db->get();
			$row = $query->row_array();
			return $row['vehicle_type_name'];
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
			$this->db->where(array($this->id=>$data['vehicle_type_id']));
			$this->db->update($this->table, $data);
			return TRUE;
		}
		public function delete($data)
		{
			$this->db->where(array($this->id=>$data['vehicle_type_id']));
			$this->db->delete($this->table);
			return TRUE;
		}
		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////
	}
// END OF VEHICLE TYPE MODEL