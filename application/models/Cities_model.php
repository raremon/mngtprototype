<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Cities_model extends CI_Model 
	{
		private $table = "cities";


		public function get_Name($city_id)
		{
			$this->db->select("city_name");
			$this->db->from($this->table);
			$this->db->where('city_id', $city_id);
			$query = $this->db->get();
			$row = $query->row_array();
			return $row['city_name'];
		}

		// Gets all cities according to a specific region
		public function get_by_region($region_id){
			$this->db->select("city_id, city_name, created_at");
			$this->db->from($this->table);
			$this->db->where('region_id', $region_id);
			$query=$this->db->get();
			if ($query->num_rows() > 0){
				return $query->result_array();
			}
			else{
				return -1;
			}
		}

		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////
		// C R E A T E
		public function save_City($data)
		{
			$this->db->insert($this->table, $data);
			return TRUE;
		}

		// R E A D
		public function show_City()
		{
			$this->db->select("city_id, region_id, city_name, created_at");
			$this->db->from($this->table);
			$query=$this->db->get();
			return $query->result_array();
		}

		public function find_Region($region_id)
		{
			$this->db->select("region_id");
			$this->db->from($this->table);
			$this->db->where('region_id', $region_id);
			$query=$this->db->get();
			if ($query->num_rows() > 0){
		        return true;
		    }
		    else{
		        return false;
		    }
		}


		// U P D A T E
		public function edit_City($city_id)
		{
			$this->db->select("city_id, region_id, city_name");
			$this->db->from($this->table);
			$this->db->where('city_id', $city_id);
			$query = $this->db->get();
			return $query->row_array();
		}

		public function update_City($data)
		{
			$this->db->where(array('city_id'=>$data['city_id']));
			$this->db->update($this->table, $data);
			return TRUE;
		}

		// D E L E T E
		public function delete_City($data)
		{
			$this->db->where(array('city_id'=>$data['city_id']));
			$this->db->delete($this->table);
			return TRUE;
		}
		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////		

	}

// END OF CITY MODEL