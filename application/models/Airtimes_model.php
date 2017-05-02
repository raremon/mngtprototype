<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Airtimes_model extends CI_Model
	{
		//Constructor
		public function __construct()
		{
			parent::__construct();
		}

		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////

		// C R E A T E
		public function save_Airtime($time_start, $schedule_id)
		{
			$data = array(
				'time_start'=>$time_start,
				'schedule_id'=>$schedule_id,
			);
			$this->db->insert('airtimes', $data);
			return TRUE;
		}

		public function save_Airtime_Block($data)
		{
			$this->db->insert('airtimes', $data);
			return TRUE;
		}

		public function get_Airtime($schedule_id)
		{
			$this->db->select("*");
			$this->db->from('airtimes');
			$this->db->where('schedule_id', $schedule_id);
			$query=$this->db->get();
			return $query->result_array();
		}

		// // R E A D
		// public function show_Airtime()
		// {
		// 	$this->db->select("*");
		// 	$this->db->from('airtimes');
		// 	$query=$this->db->get();
		// 	return $query->result_array();
		// }

		// // U P D A T E
		// public function edit_Airtime_Data($ad_id)
		// {
		// 	$this->db->select("*");
		// 	$this->db->from('airtimes');
		// 	$this->db->where('airtime_id', $airtime_id);
		// 	$query = $this->db->get();
		// 	return $query->row_array();
		// }

		// public function update_Airtime_Data($data)
		// {
		// 	$this->db->where(array('airtime_id'=>$data['airtime_id']));
		// 	$this->db->update('airtimes', $data);
		// 	return TRUE;
		// }

		// // D E L E T E
		// public function delete_Airtime_Data($data)
		// {
		// 	$this->db->where(array('airtime_id'=>$data['airtime_id']));
		// 	$this->db->delete('airtimes');
		// 	return TRUE;
		// }

		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////
		
	}

// END OF AIRTIME MODEL