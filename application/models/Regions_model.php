<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Regions_model extends CI_Model 
	{
		private $table = "regions";

		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////
		// C R E A T E
		public function save_Region($data)
		{
			$this->db->insert($this->table, $data);
			return TRUE;
		}

		// R E A D
		public function show_Region()
		{
			$this->db->select("region_id, region_name, region_abbr, created_at");
			$this->db->from($this->table);
			$query=$this->db->get();
			return $query->result_array();
		}

		public function get_Region_Name($region_id)
		{
			$this->db->select("region_abbr, region_name");
			$this->db->from($this->table);
			$this->db->where('region_id', $region_id);
			$query = $this->db->get();
			return $query->row_array();
		}

		// U P D A T E
		public function edit_Region($region_id)
		{
			$this->db->select("region_id, region_name, region_abbr");
			$this->db->from($this->table);
			$this->db->where('region_id', $region_id);
			$query = $this->db->get();
			return $query->row_array();
		}

		public function update_Region($data)
		{
			$this->db->where(array('region_id'=>$data['region_id']));
			$this->db->update($this->table, $data);
			return TRUE;
		}

		// D E L E T E
		public function delete_Region($data)
		{
			$this->db->where(array('region_id'=>$data['region_id']));
			$this->db->delete($this->table);
			return TRUE;
		}
		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////		

	}

// END OF REGION MODEL