<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stops_model extends CI_Model
{
	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	
	//Gets routes from database based on a location
	// public function get_by_location($location_id)
	// {
	// 	$this->db->select("route_id, route_name, route_description, created_at");
	// 	$this->db->from('routes');
	// 	$this->db->where('location_from', $location_id);
	// 	$this->db->or_where('location_to', $location_id);
	// 	$location=$this->db->get();
	//     return $location->result_array();
	// }

	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////

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

	// // Get route based on route ID
	// public function get_route_data($id)
	// {
	// 	$route = $this->db->get_where('routes',array('route_id' => $id))->row_array();
 //        return $route;
	// }


	// public function find_Location($location_id)
	// {
	// 	$this->db->select("location_from");
	// 	$this->db->from('routes');
	// 	$this->db->where('location_from', $location_id);
	// 	$location_from=$this->db->get();

	// 	$this->db->select("location_to");
	// 	$this->db->from('routes');
	// 	$this->db->where('location_to', $location_id);
	// 	$location_to=$this->db->get();

	// 	if ($location_from->num_rows() > 0 || $location_to->num_rows() > 0){
	//         return true;
	//     }
	//     else{
	//         return false;
	//     }
	// }

	// // U P D A T E
	// public function edit_Route_Data($route_id)
	// {
	// 	$this->db->select("route_id, route_name, route_description, location_from, location_to");
	// 	$this->db->from('routes');
	// 	$this->db->where('route_id', $route_id);
	// 	$query = $this->db->get();
	// 	return $query->row_array();
	// }

	// public function update_Route_Data($data)
	// {
	// 	$this->db->where(array('route_id'=>$data['route_id']));
	// 	$this->db->update('routes', $data);
	// 	return TRUE;
	// }

	// // D E L E T E
	// public function delete_Route_Data($data)
	// {
	// 	$this->db->where(array('route_id'=>$data['route_id']));
	// 	$this->db->delete('routes');
	// 	return TRUE;
	// }

	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////

}

// END OF ROUTES MODEL