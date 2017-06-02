<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gps_model extends CI_Model
{
	// Constructor
	public function __construct()
	{
		parent::__construct();
	}

	private $table = "gps";
	private $query = "gps_id, gps_serial, gps_description, assigned_to, created_at";
	private $id = "gps_id";

	public function find_Gps()
	{
		$this->db->select("gps_id, gps_serial");
		$this->db->from($this->table);
		$this->db->where('assigned_to', NULL);
		$query=$this->db->get();
		return $query->result_array();
	}
	public function assign_Media($media_id, $id)
	{
		$this->db->where(array($this->id=>$id));
		$this->db->update($this->table, array('assigned_to'=>$media_id));
		return TRUE;
	}
	public function unassign_Media($media_id, $id)
	{
		$this->db->where(array($this->id=>$id));
		$this->db->update($this->table, array('assigned_to'=>NULL));
		return TRUE;
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
		$this->db->where(array($this->id=>$data[$this->id]));
		$this->db->update($this->table, $data);
		return TRUE;
	}
	public function delete($data)
	{
		$this->db->where(array($this->id=>$data[$this->id]));
		$this->db->delete($this->table);
		return TRUE;
	}
	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////
}

// END OF GPS MODEL