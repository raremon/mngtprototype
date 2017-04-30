<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Ad_schedules_model extends CI_Model
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
		public function save_Ad_Schedule($ad_id, $schedule_id)
		{
			$data = array(
				'ad_id'=>$ad_id,
				'schedule_id'=>$schedule_id,
			);
			$this->db->insert('ad_schedules', $data);
			return TRUE;
		}

		// // R E A D
		// public function show_Ad_Schedule()
		// {
		// 	$this->db->select("*");
		// 	$this->db->from('ad_schedules');
		// 	$query=$this->db->get();
		// 	return $query->result_array();
		// }

		// // U P D A T E
		// public function edit_Ad_Schedule_Data($ad_id, $schedule_id)
		// {
		// 	$this->db->select("*");
		// 	$this->db->from('ad_schedules');
		// 	$this->db->where('ad_id', $ad_id);
		// 	$this->db->where('schedule_id', $schedule_id);
		// 	// $this->db->where(array('ad_id'=>$ad_id , 'schedule_id'=>$schedule_id));
		// 	$query = $this->db->get();
		// 	return $query->row_array();
		// }

		// public function update_Ad_Schedule_Data($data)
		// {
		// 	$this->db->where(array('ad_id'=>$data['ad_id'] , 'schedule_id'=>$data['schedule_id']));
		// 	$this->db->update('ad_schedules', $data);
		// 	return TRUE;
		// }

		// // D E L E T E
		// public function delete_Ad_Schedule_Data($data)
		// {
		// 	$this->db->where(array('ad_id'=>$data['ad_id'] , 'schedule_id'=>$data['schedule_id']));
		// 	$this->db->delete('ad_schedules');
		// 	return TRUE;
		// }

		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////
		
	}

// END OF AD SCHEDULE MODEL