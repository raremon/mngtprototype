<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Schedules_model extends CI_Model
	{
		//Constructor
		public function __construct()
		{
			parent::__construct();
		}

		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////

		// // C R E A T E
		// public function save_Schedule($data)
		// {
		// 	$this->db->insert('schedules', $data);
		// 	return TRUE;
		// }

		// // R E A D
		// public function show_Schedule()
		// {
		// 	$this->db->select("*");
		// 	$this->db->from('schedules');
		// 	$query=$this->db->get();
		// 	return $query->result_array();
		// }

		// // U P D A T E
		// public function edit_Schedule_Data($ad_id)
		// {
		// 	$this->db->select("*");
		// 	$this->db->from('schedules');
		// 	$this->db->where('schedule_id', $schedule_id);
		// 	$query = $this->db->get();
		// 	return $query->row_array();
		// }

		// public function update_Schedule_Data($data)
		// {
		// 	$this->db->where(array('schedule_id'=>$data['schedule_id']));
		// 	$this->db->update('schedules', $data);
		// 	return TRUE;
		// }

		// // D E L E T E
		// public function delete_Schedule_Data($data)
		// {
		// 	$this->db->where(array('schedule_id'=>$data['schedule_id']));
		// 	$this->db->delete('schedules');
		// 	return TRUE;
		// }

		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////
		
	}

// END OF SCHEDULE MODEL