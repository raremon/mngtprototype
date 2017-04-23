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
		$this->db->select("*");
		$this->db->from('routes');
		$query=$this->db->get();
		return $query->result_array();
	}

	// U P D A T E
	public function edit_Route_Data($route_id)
	{
		$this->db->select("*");
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

// END OF TERMINAL MODEL