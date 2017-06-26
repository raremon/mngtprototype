<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Agencies_model extends CI_Model
{
	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	private $table = "agencies";
	private $query = "agency_id, agency_name, agency_address, agency_contact, agency_email, agency_website, agency_image, agency_description, billable, created_at";
	private $id = "agency_id";
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
		$this->db->select($this->query.",SUBSTRING_INDEX(agency_description,' ',15) AS info");
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
// END OF AGENCIES MODEL