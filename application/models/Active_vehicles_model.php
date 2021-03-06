<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Active_vehicles_model extends CI_Model 
	{
		private $table = "active_vehicles";

		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////
		// // C R E A T E
		// public function save_Media($data)
		// {
		// 	$this->db->insert($this->table, $data);
		// 	return TRUE;
		// }

		// // R E A D
		// public function show_Media()
		// {
		// 	$this->db->select("ready_vehicle_id, vehicle_id, box_id, tv_id, created_at");
		// 	$this->db->from($this->table);
		// 	$query=$this->db->get();
		// 	return $query->result_array();
		// }

		public function find_Driver($driver_id)
		{
			$this->db->select("driver_id");
			$this->db->from($this->table);
			$this->db->where('driver_id', $driver_id);
			$query=$this->db->get();
			if ($query->num_rows() > 0){
		        return true;
		    }
		    else{
		        return false;
		    }
		}

		public function find_Media($ready_vehicle_id)
		{
			$this->db->select("ready_vehicle_id");
			$this->db->from($this->table);
			$this->db->where('ready_vehicle_id', $ready_vehicle_id);
			$query=$this->db->get();
			if ($query->num_rows() > 0){
		        return true;
		    }
		    else{
		        return false;
		    }
		}

		// // U P D A T E
		// public function edit_Media($media_id)
		// {
		// 	$this->db->select("ready_vehicle_id, vehicle_id, box_id, tv_id");
		// 	$this->db->from($this->table);
		// 	$this->db->where('ready_vehicle_id', $media_id);
		// 	$query = $this->db->get();
		// 	return $query->row_array();
		// }

		public function unassign_Driver($data)
		{
				$this->db->where(array('driver_id'=>$data['driver_id']));
				$this->db->update($this->table, array('driver_id'=>null));
				return TRUE;
		}

		// public function update_Media($data)
		// {
		// 	$this->db->where(array('ready_vehicle_id'=>$data['ready_vehicle_id']));
		// 	$this->db->update($this->table, $data);
		// 	return TRUE;
		// }

		// // D E L E T E
		// public function delete_Media($data)
		// {
		// 	$this->db->where(array('ready_vehicle_id'=>$data['ready_vehicle_id']));
		// 	$this->db->delete($this->table);
		// 	return TRUE;
		// }
		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////		

	}

// END OF CITY MODEL