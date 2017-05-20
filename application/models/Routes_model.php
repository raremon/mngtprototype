<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Routes_model extends CI_Model
{
	// Constructor
	public function __construct()
	{
		parent::__construct();
	}

	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////

	// C R E A T E
	public function save_Route($data)
	{
		$this->db->insert('routes', $data);
		return TRUE;
	}

	// R E A D
	public function show_Route()
	{
		$this->db->select("route_id, route_name, route_description, location_from, location_to, created_at");
		$this->db->from('routes');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function find_Location($location_id)
	{
		$this->db->select("location_from");
		$this->db->from('routes');
		$this->db->where('location_from', $location_id);
		$location_from=$this->db->get();

		$this->db->select("location_to");
		$this->db->from('routes');
		$this->db->where('location_to', $location_id);
		$location_to=$this->db->get();

		if ($location_from->num_rows() > 0 || $location_to->num_rows() > 0){
	        return true;
	    }
	    else{
	        return false;
	    }
	}

	// U P D A T E
	public function edit_Route_Data($route_id)
	{
		$this->db->select("route_id, route_name, route_description, location_from, location_to");
		$this->db->from('routes');
		$this->db->where('route_id', $route_id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function update_Route_Data($data)
	{
		$this->db->where(array('route_id'=>$data['route_id']));
		$this->db->update('routes', $data);
		return TRUE;
	}

	// D E L E T E
	public function delete_Route_Data($data)
	{
		$this->db->where(array('route_id'=>$data['route_id']));
		$this->db->delete('routes');
		return TRUE;
	}

	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////

}

// END OF ROUTES MODEL