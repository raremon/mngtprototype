<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Mediaboxes_model extends CI_Model 
	{
		private $table = "mediaboxes";

		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////
		// C R E A T E
		public function save_Mediabox($data)
		{
			$this->db->insert($this->table, $data);
			return TRUE;
		}

		// R E A D
		public function show_Mediabox()
		{
			$this->db->select("box_id, box_tag, created_at");
			$this->db->from($this->table);
			$query=$this->db->get();
			return $query->result_array();
		}

		public function find_Mediabox()
		{
			$this->db->select("box_id, box_tag");
			$this->db->from($this->table);
			$this->db->where('assigned_to', NULL);
			$query=$this->db->get();
			return $query->result_array();
		}

		// U P D A T E
		public function edit_Mediabox($box_id)
		{
			$this->db->select("box_id, box_tag");
			$this->db->from($this->table);
			$this->db->where('box_id', $box_id);
			$query = $this->db->get();
			return $query->row_array();
		}

		public function update_Mediabox($data)
		{
			$this->db->where(array('box_id'=>$data['box_id']));
			$this->db->update($this->table, $data);
			return TRUE;
		}

		public function assign_Media($media_id, $box_id)
		{
				$this->db->where(array('box_id'=>$box_id));
				$this->db->update($this->table, array('assigned_to'=>$media_id));
				return TRUE;
		}

		public function unassign_Media($media_id, $box_id)
		{
				$this->db->where(array('box_id'=>$box_id));
				$this->db->update($this->table, array('assigned_to'=>NULL));
				return TRUE;
		}

		// D E L E T E
		public function delete_Mediabox($data)
		{
			$this->db->where(array('box_id'=>$data['box_id']));
			$this->db->delete($this->table);
			return TRUE;
		}
		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////		

	}

// END OF MEDIABOX MODEL