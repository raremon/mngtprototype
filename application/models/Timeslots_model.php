<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Timeslots_model extends CI_Model
{
	// Constructor
	public function __construct()
	{
		parent::__construct();
	}

	private $table = "timeslots";
	private $query = "tslot_id, tslot_session, tslot_code, tslot_time, created_at";
	private $id = "tslot_id";

	public function getmorning()
	{
		$this->db->select($this->query);
		$this->db->from($this->table);
		$this->db->where('tslot_session', 'am');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function getafternoon()
	{
		$this->db->select($this->query);
		$this->db->from($this->table);
		$this->db->where('tslot_session', 'pm');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function getevening()
	{
		$this->db->select($this->query);
		$this->db->from($this->table);
		$this->db->where('tslot_session', 'eve');
		$query=$this->db->get();
		return $query->result_array();
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

// END OF TIMESLOTS MODEL