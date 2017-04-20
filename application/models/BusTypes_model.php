<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class BusTypes_model extends CI_Model
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
		public function save_Bus_Type($data)
		{
			$this->db->insert('bus_type', $data);
			return TRUE;
		}

		// R E A D
		public function show_Bus_Type()
		{
			$this->db->select("*");
			$this->db->from('bus_type');
			$query=$this->db->get();
			return $query->result_array();
		}

		// U P D A T E
		public function edit_Bus_Type_Data($bus_type_id)
		{
			$this->db->select("*");
			$this->db->from('bus_type');
			$this->db->where('bus_type_id', $bus_type_id);
			$query = $this->db->get();
			return $query->row_array();
		}

		public function update_Bus_Type_Data($data)
		{
			$this->db->where(array('bus_type_id'=>$data['bus_type_id']));
			$this->db->update('bus_type', $data);
			return TRUE;
		}

		// D E L E T E
		public function delete_Bus_Type_Data($data)
		{
			$this->db->where(array('bus_type_id'=>$data['bus_type_id']));
			$this->db->delete('bus_type');
			return TRUE;
		}

		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////
		
	}

// END OF BUS_TYPE MODEL