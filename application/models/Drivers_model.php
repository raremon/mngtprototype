<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Drivers_model extends CI_Model 
	{
		private $table = "drivers";

		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////
		// C R E A T E
		public function save_Driver($data)
		{
			$this->db->insert($this->table, $data);
			return TRUE;
		}

		// R E A D
		public function show_Driver()
		{
			$this->db->select("driver_id, driver_fname, driver_mname, driver_lname, driver_contact, driver_address, created_at");
			$this->db->from($this->table);
			$query=$this->db->get();
			return $query->result_array();
		}

		// U P D A T E
		public function edit_Driver($driver_id)
		{
			$this->db->select("driver_id, driver_fname, driver_mname, driver_lname, driver_contact, driver_address");
			$this->db->from($this->table);
			$this->db->where('driver_id', $driver_id);
			$query = $this->db->get();
			return $query->row_array();
		}

		public function update_Driver($data)
		{
			$this->db->where(array('driver_id'=>$data['driver_id']));
			$this->db->update($this->table, $data);
			return TRUE;
		}

		// D E L E T E
		public function delete_Driver($data)
		{
			$this->db->where(array('driver_id'=>$data['driver_id']));
			$this->db->delete($this->table);
			return TRUE;
		}
		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////		

	}

// END OF DRIVER MODEL