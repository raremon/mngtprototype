<?php
require(APPPATH.'libraries/REST_Controller.php');

class Jschedule extends REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('schedules_model','Schedule');
		$this->load->model('nschedules_model', 'Nschedule');		
    }
		
	public function index_get() {
		
		// http://[::1]/star8/api/jschedule/get/busID/1/today/2017-04-29
		// http://[::1]/star8/api/jschedule/get/routeID/1/today/2017-04-29
		$data = $this->get();
		// echo sha1('star8');
		
		if( isset($data['routeID']) && isset($data['today']) && is_numeric($data['routeID']) && $data['today']!='' ){
			// $this->load->model('schedule_model');
			
			$response = $this->Schedule->getScheduleAds($data['routeID'],$data['today']);
		}
		else{
			$response = array('message' => 'No schedule to retrieve.');
		}

		$this->response($response);
	}
	
	public function scheduledads_get() {
		
		$data = $this->get();
		
		if( isset($data['routeID']) && isset($data['today']) && is_numeric($data['routeID']) && $data['today']!='' ){
			$schedule = $this->Schedule->getScheduleAds($data['routeID'],$data['today']);
		}
		else{
			$response = array('message' => 'No schedule to retrieve.');
		}

		$this->response($response);
	}

	public function routeschedules_get(){
		
		$d = $this->get();
			
		if( isset($d['timeslot']) && is_numeric($d['timeslot']) && is_numeric($d['today']) ){
			
			$where = array('status'=>0,'timeslot'=>$d['timeslot']);
		
			$ads = $this->Nschedule->getSchedules($where,$d['today']);
			
			$timeslot = number_format($d['timeslot'],2,':','');
			$time2 = number_format($d['timeslot']+1,2,':','');
			
			// echo '<h2>Auto Ad Scheduling</h2>';
			// echo '<h3>Time Slot: '.date("h:ia", strtotime($timeslot)).' - '.date("h:ia", strtotime($time2)).'</h3>';
			
			$listing = array();
			
			if( count($ads)>0 ){
				
				$start_time = strtotime($timeslot);
				
				foreach($ads as $a){
					$info = array();
					$info['time'] = date("h:i:s a", $start_time);
					$info['ad_name'] = $a['ad_name'];
					$info['advertiser_name'] = $a['advertiser_name'];
					$info['ad_duration'] = $a['ad_duration'];
					$info['times_repeat'] = $a['times_repeat'];
					$info['display_type'] = $a['display_type'];
					$info['win_123'] = $a['win_123'];
					
					$listing[] = $info;
					$start_time += $a['ad_duration'];
				}
			}
			
			$response = $listing;

		}
		else{
			$response = array('message' => 'No schedule to retrieve.');
		}
		
		$this->response($response);
		
	}

}