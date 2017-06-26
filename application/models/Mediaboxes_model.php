<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Mediaboxes_model extends CI_Model 
	{
		private $table = "mediaboxes";
		private $query = "box_id, box_tag, box_description, box_status, assigned_to, created_at";
		private $id = "box_id";
		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////
		// C R E A T E
		public function save_Mediabox($data)
		{
			$this->db->insert($this->table, $data);
			return $this->db->insert_id();
		}
		// R E A D
		public function show_Mediabox()
		{
			$this->db->select($this->query.",SUBSTRING_INDEX(box_description,' ',15) AS info");
			$this->db->from($this->table);
			$query=$this->db->get();
			return $query->result_array();
		}
		public function find_Mediabox()
		{
			$this->db->select($this->query);
			$this->db->from($this->table);
			$this->db->where('assigned_to', NULL);
			$this->db->where('box_status', true);
			$query=$this->db->get();
			return $query->result_array();
		}
		// U P D A T E
		public function edit_Mediabox($box_id)
		{
			$this->db->select($this->query);
			$this->db->from($this->table);
			$this->db->where($this->id, $box_id);
			$query = $this->db->get();
			return $query->row_array();
		}
		public function toggle_Status($data)
		{
			$this->db->select('box_status');
			$this->db->from($this->table);
			$this->db->where(array($this->id=>$data['box_id']));
			$query = $this->db->get();
			$status = $query->row_array();
			if( $status['box_status'] )
			{
				$this->db->where(array($this->id=>$data['box_id']));
				$this->db->update($this->table, array('box_status'=>false));
				return 'turned off';
			}
			else
			{
				$this->db->where(array($this->id=>$data['box_id']));
				$this->db->update($this->table, array('box_status'=>true));
				return 'turned on';
			}
		}
		public function update_Mediabox($data)
		{
			$this->db->where(array($this->id=>$data['box_id']));
			$this->db->update($this->table, $data);
			return TRUE;
		}
		public function assign_Media($media_id, $box_id)
		{
			$this->db->where(array($this->id=>$box_id));
			$this->db->update($this->table, array('assigned_to'=>$media_id));
			return TRUE;
		}
		public function unassign_Media($media_id, $box_id)
		{
			$this->db->where(array($this->id=>$box_id));
			$this->db->update($this->table, array('assigned_to'=>NULL));
			return TRUE;
		}
		// D E L E T E
		public function delete_Mediabox($data)
		{
			$this->db->where(array($this->id=>$data['box_id']));
			$this->db->delete($this->table);
			return TRUE;
		}
		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////		
	}
// END OF MEDIABOX MODEL