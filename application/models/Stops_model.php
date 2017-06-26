<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stops_model extends CI_Model
{
	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	

	// C R E A T E
	public function save_Stop($data)
	{
		$this->db->insert('stops', $data);
		return TRUE;
	}

	// R E A D
	public function show_Stops($route)
	{
		$this->db->select("stop_id, stop_name, stop_description, location, created_at,km_fromLoc1");
		$this->db->from('stops');
		$this->db->where('route='.$route);
                $this->db->order_by('km_fromLoc1','asc');
		$query=$this->db->get();
		return $query->result_array();
	}
        
         // U P D A T E
	public function edit_Stop_Data($stop_id)
	{
		$this->db->select("*");
		$this->db->from('stops');
		$this->db->where('stop_id', $stop_id);
		$query = $this->db->get();
		return $query->row_array();
	}
        public function update_Stop_Data($data)
	{
		$this->db->where(array('stop_id'=>$data['stop_id']));
		$this->db->update('stops', $data);
		return TRUE;
	}
        
        public function delete_Stop_Data($data)
	{
		$this->db->where(array('stop_id'=>$data['stop_id']));
		$this->db->delete('stops');
		return TRUE;
	}
        // Delete stops by route
        public function delete_Stops($route)
	{
		$this->db->where(array('route'=>$route));
		$this->db->delete('stops');
		return TRUE;
	}


}

// END OF ROUTES MODEL