<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Tvs_model extends CI_Model 
	{
		private $table = "tvs";

		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////
		// C R E A T E
		public function save_Tv($data)
		{
			$this->db->insert($this->table, $data);
			return TRUE;
		}

		// R E A D
		public function show_Tv()
		{
			$this->db->select("tv_id, tv_serial, tv_description, created_at");
			$this->db->from($this->table);
			$query=$this->db->get();
			return $query->result_array();
		}
		
		public function find_Tv()
		{
			$this->db->select("tv_id, tv_serial");
			$this->db->from($this->table);
			$this->db->where('assigned_to', NULL);
			$query=$this->db->get();
			return $query->result_array();
		}

		// U P D A T E
		public function edit_Tv($tv_id)
		{
			$this->db->select("tv_id, tv_serial, tv_description");
			$this->db->from($this->table);
			$this->db->where('tv_id', $tv_id);
			$query = $this->db->get();
			return $query->row_array();
		}

		public function update_Tv($data)
		{
			$this->db->where(array('tv_id'=>$data['tv_id']));
			$this->db->update($this->table, $data);
			return TRUE;
		}

		public function assign_Media($media_id, $tv_id)
		{
				$this->db->where(array('tv_id'=>$tv_id));
				$this->db->update($this->table, array('assigned_to'=>$media_id));
				return TRUE;
		}

		public function unassign_Media($media_id, $tv_id)
		{
				$this->db->where(array('tv_id'=>$tv_id));
				$this->db->update($this->table, array('assigned_to'=>NULL));
				return TRUE;
		}

		// D E L E T E
		public function delete_Tv($data)
		{
			$this->db->where(array('tv_id'=>$data['tv_id']));
			$this->db->delete($this->table);
			return TRUE;
		}
		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////		

	}

// END OF TV MODEL