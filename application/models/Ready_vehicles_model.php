<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Ready_vehicles_model extends CI_Model 
	{
		private $table = "ready_vehicles";

		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////
		// C R E A T E
		public function save_Media($data)
		{
			$this->db->insert($this->table, $data);
			return $this->db->insert_id();
		}

		// R E A D
		public function show_Media()
		{
			$this->db->select("ready_vehicle_id, vehicle_id, box_id, tv_id, gps_id, card_id, created_at");
			$this->db->from($this->table);
			$query=$this->db->get();
			return $query->result_array();
		}

		// GET INFO
		public function get_Info($vehicle_id)
		{
			$this->db->select("ready_vehicle_id, vehicle_id, box_id, tv_id, gps_id, card_id");
			$this->db->from($this->table);
			$this->db->where('vehicle_id', $vehicle_id);
			$query = $this->db->get();
			return $query->row_array();
		}

		// FIND IF GPS | CARD | BOX | TV | VEHICLE
		//      CURRENTLY ASSIGNED ON MEDIA
		public function find_Gps($gps_id)
		{
			$this->db->select("gps_id");
			$this->db->from($this->table);
			$this->db->where('gps_id', $gps_id);
			$query=$this->db->get();
			if ($query->num_rows() > 0){
		        return true;
		    }
		    else{
		        return false;
		    }
		}

		public function find_Card($card_id)
		{
			$this->db->select("card_id");
			$this->db->from($this->table);
			$this->db->where('card_id', $card_id);
			$query=$this->db->get();
			if ($query->num_rows() > 0){
		        return true;
		    }
		    else{
		        return false;
		    }
		}

		public function find_Box($box_id)
		{
			$this->db->select("box_id");
			$this->db->from($this->table);
			$this->db->where('box_id', $box_id);
			$query=$this->db->get();
			if ($query->num_rows() > 0){
		        return true;
		    }
		    else{
		        return false;
		    }
		}

		public function find_Tv($tv_id)
		{
			$this->db->select("tv_id");
			$this->db->from($this->table);
			$this->db->where('tv_id', $tv_id);
			$query=$this->db->get();
			if ($query->num_rows() > 0){
		        return true;
		    }
		    else{
		        return false;
		    }
		}

		public function find_Vehicle($vehicle_id)
		{
			$this->db->select("vehicle_id");
			$this->db->from($this->table);
			$this->db->where('vehicle_id', $vehicle_id);
			$query=$this->db->get();
			if ($query->num_rows() > 0){
		        return true;
		    }
		    else{
		        return false;
		    }
		}

		// U P D A T E
		public function edit_Media($media_id)
		{
			$this->db->select("ready_vehicle_id, vehicle_id, box_id, tv_id, gps_id, card_id");
			$this->db->from($this->table);
			$this->db->where('ready_vehicle_id', $media_id);
			$query = $this->db->get();
			return $query->row_array();
		}

		// UNASSIGN GPS | CARD | BOX | TV
		//       CURRENTLY ON MEDIA
		public function unassign_Gps($data)
		{
				$this->db->where(array('gps_id'=>$data['gps_id']));
				$this->db->update($this->table, array('gps_id'=>null));
				return TRUE;
		}

		public function unassign_Card($data)
		{
				$this->db->where(array('card_id'=>$data['card_id']));
				$this->db->update($this->table, array('card_id'=>null));
				return TRUE;
		}

		public function unassign_Box($data)
		{
				$this->db->where(array('box_id'=>$data['box_id']));
				$this->db->update($this->table, array('box_id'=>null));
				return TRUE;
		}

		public function unassign_Tv($data)
		{
				$this->db->where(array('tv_id'=>$data['tv_id']));
				$this->db->update($this->table, array('tv_id'=>null));
				return TRUE;
		}

		public function update_Media($data)
		{
			$this->db->where(array('ready_vehicle_id'=>$data['ready_vehicle_id']));
			$this->db->update($this->table, $data);
			return TRUE;
		}

		// D E L E T E
		public function delete_Media($data)
		{
			$this->db->where(array('ready_vehicle_id'=>$data['ready_vehicle_id']));
			$this->db->delete($this->table);
			return TRUE;
		}
		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////		

	}

// END OF CITY MODEL