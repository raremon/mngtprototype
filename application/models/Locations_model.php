<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Locations_model extends CI_Model
{
	// Constructor
	public function __construct()
	{
		parent::__construct();
	}

	private $table = "locations";
	private $query = "location_id, city_id, location_name, latitude, longitude, created_at";
	private $id = "location_id";

	//Find if city exists in Location
	public function find_City($city_id)
	{
		$this->db->select("city_id");
		$this->db->from($this->table);
		$this->db->where('city_id', $city_id);
		$city=$this->db->get();
		if ($city->num_rows() > 0){
	        return true;
	    }
	    else{
	        return false;
	    }
	}

	//Get name by Location Id
	public function get_Name($id)
	{
		$this->db->select("location_name, latitude, longitude");
		$this->db->from($this->table);
		$this->db->where('location_id', $id);
		$query = $this->db->get();
		// $row = $query->row_array();
		return $query->row_array();
	}

	//Gets all locations according to a specific city
	public function get_by_city($city_id){
		$this->db->select("location_id, location_name, created_at");
		$this->db->from($this->table);
		$this->db->where('city_id', $city_id);
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

// END OF LOCATIONS MODEL