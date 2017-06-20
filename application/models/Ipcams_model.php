<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Ipcams_model extends CI_Model 
	{
		private $table = "ip_cameras";
		private $query = "ipcam_id, ipcam_serial, ipcam_description, ipcam_status, assigned_to, created_at";
		private $id = "ipcam_id";
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
			$this->db->select($this->query.",SUBSTRING_INDEX(ipcam_description,' ',15) AS info");
			$this->db->from($this->table);
			$query=$this->db->get();
			return $query->result_array();
		}
		public function find()
		{
			$this->db->select($this->query);
			$this->db->from($this->table);
			$this->db->where('assigned_to', NULL);
			$this->db->where('ipcam_status', true);
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
			$this->db->select('ipcam_status');
			$this->db->from($this->table);
			$this->db->where(array($this->id=>$data['ipcam_id']));
			$query = $this->db->get();
			$status = $query->row_array();
			if( $status['ipcam_status'] )
			{
				$this->db->where(array($this->id=>$data['ipcam_id']));
				$this->db->update($this->table, array('ipcam_status'=>false));
				return 'turned off';
			}
			else
			{
				$this->db->where(array($this->id=>$data['ipcam_id']));
				$this->db->update($this->table, array('ipcam_status'=>true));
				return 'turned on';
			}
		}
		public function update($data)
		{
			$this->db->where(array($this->id=>$data['ipcam_id']));
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
			$this->db->where(array($this->id=>$data['ipcam_id']));
			$this->db->delete($this->table);
			return TRUE;
		}
		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////		
	}
// END OF IP CAMERAS MODEL