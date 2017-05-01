<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Time_blocks_model extends CI_Model
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
		public function save_Time_Block($data)
		{
			$this->db->insert('time_blocks', $data);
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

		// D E L E T E
		public function delete_Time_Block_Data($data)
		{
			$this->db->where(array('time_block_id'=>$data['time_block_id']));
			$this->db->delete('time_blocks');
			return TRUE;
		}

		public function get_Time_Block_Data($advertiser_id)
		{
			$this->db->select("*");
			$this->db->from('time_blocks');
			$this->db->where('advertiser_id', $advertiser_id);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_Record($advertiser_id, $time_start, $time_end)
		{
			$this->db->select("*");
			$this->db->from('time_blocks');
			$this->db->where('advertiser_id', $advertiser_id);
			$this->db->where('time_start', $time_start);
			$this->db->where('time_end', $time_end);
			$query = $this->db->get();
			if ($query->num_rows() > 0){
		        return true;
		    }
		    else{
		        return false;
		    }
		}

		public function get_Airtimes($time_block_id)
		{
			$this->db->select("*");
			$this->db->from('time_blocks');
			$this->db->where('time_block_id', $time_block_id);
			$query = $this->db->get();
			return $query->row_array();
		}
		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////
		
	}

// END OF TIME BLOCKS MODEL