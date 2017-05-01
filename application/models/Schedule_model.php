<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_model extends CI_Model
{
	private $table = 'schedule';
	
	// Constructor
	public function __construct()
	{
		parent::__construct();
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
				->join('routes','schedule.route_id=routes.route_id','inner')
				->join('airtime','schedule.schedID=airtime.schedID','inner')
				->join('buses','routes.route_id=buses.route_id','inner');
				
		// $this->db->where('id <', $id);
		// $where = array(
						// 'bus_id'=>$busID,
						// 'schedule.date_start<'
						// );
		
		// if( isset($where) )
			$this->db->where('bus_id',$busID);
			$this->db->where('schedule.date_start <',$date);
			$this->db->where('schedule.date_end >',$date);

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
				->join('routes','schedule.route_id=routes.route_id','inner')
				->join('airtime','schedule.schedID=airtime.schedID','inner')
				->join('buses','routes.route_id=buses.route_id','inner')
				->join('ad_sched','schedule.schedID=ad_sched.schedID','inner')
				->join('ads','ad_sched.ad_id=ads.ad_id','inner');
				
		// $this->db->where('id <', $id);
		// $where = array(
						// 'bus_id'=>$busID,
						// 'schedule.date_start<'
						// );
		
		// if( isset($where) ){
			$this->db->where('bus_id',$busID);
			$this->db->where('schedule.date_start <',$date);
			$this->db->where('schedule.date_end >',$date);
		// }

		if( isset($orwhere) )
			$this->db->or_where($orwhere);
			
		$query = $this->db->get();
		
		// echo $this->db->last_query();
		// exit;
		
		return $query->result_array();
		
	}
}

// END OF TERMINAL MODEL