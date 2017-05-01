<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Schedules_model extends CI_Model
	{
		private $table = "schedules";
		//Constructor
		public function __construct()
		{
			parent::__construct();
		}

		public function count_Schedule()
		{
			$this->db->select('schedule_id');
			$this->db->from('schedules');
			return $this->db->count_all_results();
		}

	public function getSchedule($busID,$date){

		// SELECT * FROM schedule 
		// INNER JOIN routes ON schedule.route_id=routes.route_id 
		// INNER JOIN airtime ON schedule.schedID=airtime.schedID 
		// INNER JOIN buses ON routes.route_id=buses.route_id
		// WHERE buses.bus_id=1
		// AND schedule.date_start<'2017-04-27' AND schedule.date_end>'2017-04-27'

		$this->db->select('*')
				->from($this->table)
				->join('routes','schedules.route_id=routes.route_id','inner')
				->join('airtime','schedules.schedID=airtime.schedID','inner')
				->join('buses','routes.route_id=buses.route_id','inner');
				
		// $this->db->where('id <', $id);
		// $where = array(
						// 'bus_id'=>$busID,
						// 'schedule.date_start<'
						// );
		
		// if( isset($where) )
			$this->db->where('bus_id',$busID);
			$this->db->where('schedules.date_start <',$date);
			$this->db->where('schedules.date_end >',$date);

		if( isset($orwhere) )
			$this->db->or_where($orwhere);
			
		$query = $this->db->get();
		
		// echo $this->db->last_query();
		// exit;
		
		return $query->result_array();
	
	}
	
	public function getScheduleAds($busID,$date){
		
	// SELECT * FROM schedule INNER JOIN routes ON schedule.route_id=routes.route_id 
	// INNER JOIN airtime ON schedule.schedID=airtime.schedID 
	// INNER JOIN buses ON routes.route_id=buses.route_id 
	// INNER JOIN ad_sched ON schedule.schedID=ad_sched.schedID 
	// INNER JOIN ads ON ad_sched.ad_id=ads.ad_id 
	// WHERE buses.bus_id=1 AND schedule.date_start<'2017-04-27' AND schedule.date_end>'2017-04-27' 

		$this->db->select('*')
				->from($this->table)
				->join('routes','schedules.route_id=routes.route_id','inner')
				->join('airtime','schedules.schedID=airtime.schedID','inner')
				->join('buses','routes.route_id=buses.route_id','inner')
				->join('ad_sched','schedules.schedID=ad_sched.schedID','inner')
				->join('ads','ad_sched.ad_id=ads.ad_id','inner');
				
		// $this->db->where('id <', $id);
		// $where = array(
						// 'bus_id'=>$busID,
						// 'schedule.date_start<'
						// );
		
		// if( isset($where) ){
			$this->db->where('bus_id',$busID);
			$this->db->where('schedules.date_start <',$date);
			$this->db->where('schedules.date_end >',$date);
		// }

		if( isset($orwhere) )
			$this->db->or_where($orwhere);
			
		$query = $this->db->get();
		
		// echo $this->db->last_query();
		// exit;
		
		return $query->result_array();
		
	}
		
		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////

		// C R E A T E
		public function save_Schedule($data)
		{
			$this->db->insert('schedules', $data);
			return $this->db->insert_id();
		}

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