<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Tvs_model extends CI_Model 
	{
		private $table = "tvs";
		private $query = "tv_id, tv_serial, tv_description, tv_status, assigned_to, created_at";
		private $id = "tv_id";
		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////
		public function create($data)
		{
			$this->db->insert($this->table, $data);
			return $this->db->insert_id();
		}
		public function read()
		{
			$this->db->select($this->query.",SUBSTRING_INDEX(tv_description,' ',15) AS info");
			$this->db->from($this->table);
			$query=$this->db->get();
			return $query->result_array();
		}
		public function find()
		{
			$this->db->select($this->query);
			$this->db->from($this->table);
			$this->db->where('assigned_to', NULL);
			$this->db->where('tv_status', true);
			$query=$this->db->get();
			return $query->result_array();
		}
		public function edit($id)
		{
			$this->db->select($this->query);
			$this->db->from($this->table);
			$this->db->where($this->id, $id);
			$query = $this->db->get();
			return $query->row_array();
		}
		public function toggle_Status($data)
		{
			$this->db->select('tv_status');
			$this->db->from($this->table);
			$this->db->where(array($this->id=>$data['tv_id']));
			$query = $this->db->get();
			$status = $query->row_array();
			if( $status['tv_status'] )
			{
				$this->db->where(array($this->id=>$data['tv_id']));
				$this->db->update($this->table, array('tv_status'=>false));
				return 'turned off';
			}
			else
			{
				$this->db->where(array($this->id=>$data['tv_id']));
				$this->db->update($this->table, array('tv_status'=>true));
				return 'turned on';
			}
		}
		public function update($data)
		{
			$this->db->where(array($this->id=>$data['tv_id']));
			$this->db->update($this->table, $data);
			return TRUE;
		}
		public function assign($media_id, $id)
		{
			$this->db->where(array($this->id=>$id));
			$this->db->update($this->table, array('assigned_to'=>$media_id));
			return TRUE;
		}
		public function unassign($media_id, $id)
		{
			$this->db->where(array($this->id=>$id));
			$this->db->update($this->table, array('assigned_to'=>NULL));
			return TRUE;
		}
		public function delete($data)
		{
			$this->db->where(array($this->id=>$data['tv_id']));
			$this->db->delete($this->table);
			return TRUE;
		}
		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////		
	}
// END OF TVS MODEL