<?php
require(APPPATH.'libraries/REST_Controller.php');

class Jschedule extends REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('schedules_model','Schedule');
		$this->load->model('nschedules_model', 'Nschedule');		
		$this->load->model('timeslots_model', 'Timeslots');
		$this->load->model('fillers_model', 'Fillers');
		
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

				function my_sort($a,$b){
					if ($a==$b) return 0;
					return ($a<$b)?-1:1;
					
				}
				
	public function programlist_get(){
		
		$d = $this->get();
		
		$this->load->library('auto_schedule');
		// $this->load->library('dynamic_schedule');
		
		$timeslots = $this->Timeslots->read();
		
		$where = array('route_id'=>$d['route']);
		$today = date('Y-m-d');
	
		$schedule = array();
			
		//get fillers
		$fillers = $this->Fillers->getFillers(array('status'=>0));		
		
		foreach( $timeslots as $t ){

			$where = array('timeslot'=>$t['tslot_id'],'route_id'=>$d['route']);			
			$ads = $this->Nschedule->getSchedulesDetailed($where,$today);
			
			$airtime =  $this->auto_schedule->getTotalAirTime($ads);
			
			if( $airtime<=3600 ){
				
				$by_hour = array();
				foreach($ads as $a){
					
					$ctr = $a['times_repeat'];
						
					while( $ctr!=0 ){
						$info=array();
						$info['id'] = $a['schedule_id'];
						$info['content_type'] = 'ad'; //content type is ad or filler
						$info['content_id'] = $a['ad_id'];
						$info['date_start'] = $a['date_start'];
						$info['date_end'] = $a['date_end'];
						$info['timeslot'] = $a['timeslot'];
						$info['tslot_time'] = $a['tslot_time'];
						$info['times_repeat'] = $a['times_repeat'];
						$info['display_type'] = $a['display_type'];
						$info['win_123'] = $a['win_123'];
						$info['route_id'] = $a['route_id'];
						$info['duration'] = $a['paid_duration'];
						
						array_push($schedule, $info);
												
						$ctr--;	
						// $by_hour[] = $info;	
						// shuffle($schedule);
					}
					
					//re arrange ads in $by_hour 
					// $by_hour = $this->auto_schedule->do_sort($by_hour);
					
					// $schedule = array_merge($schedule, $by_hour);
				}


				//determine	airtime for ads
				$filler_time = 3600 - $airtime;
				
				//get minimum filler
				$fill_least_time = $this->Fillers->getMinFiller(array('status'=>0));	
				
				if( $filler_time > $fill_least_time[0]['min_time'] ){
					//insert filler
					$run_airtime = 0;
					
					while( $run_airtime<=$filler_time ){
						
						foreach($fillers as $a){				
							$info = array();
							$info['id'] = $a['filler_id'];
							$info['content_type'] = 'filler'; //content type is ad or filler
							$info['content_id'] = $a['filler_id'];
							$info['date_start'] = '';
							$info['date_end'] = '';
							$info['timeslot'] = $t['tslot_id'];
							$info['tslot_time'] = $t['tslot_time'];
							$info['times_repeat'] = '';
							$info['display_type'] = '3';
							$info['win_123'] = '';
							$info['route_id'] = $d['route'];
							$info['duration'] = $a['filler_duration'];
							
							$run_airtime += $a['filler_duration'];
							
							array_push($schedule, $info);

						}	
					}	 	
				}
				else{ //no room for fillers
				
				}
			}
			else{ //do manual scheduling, override or reduce times repeat to air all ads
				
			}

		}  
		
		// shuffle($schedule);
		
		$this->response($schedule);

		
	}
	

	
	public function schedules_get(){
		
		$d = $this->get();
		
		$this->load->library('dynamic_schedule');
		
		$timeslots = $this->Timeslots->read();
		
		$date = date("Y-m-d");
		
		$schedule = array();
		
		foreach( $timeslots as $t ){
			
			$list_per_hour = $this->dynamic_schedule->generateAdHour($t['tslot_id'], $date, $d['route']);
			
			$schedule = array_merge($schedule, $list_per_hour);

		}
		
		$this->response($schedule);

		
	}
	
	public function routeschedules_get(){
		
		$d = $this->get();
			
		// if( isset($d['timeslot']) && is_numeric($d['timeslot']) && is_numeric($d['today']) ){
			
			// $where = array('status'=>0,'timeslot'=>$d['timeslot']);
			$where = array();
			$today = date("Y-m-d");
			
			$ads = $this->Nschedule->getSchedules($where,$today);
			
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

		// }
		// else{
			// $response = array('message' => 'No schedule to retrieve.');
		// }
		
		$this->response($response);
		
	}

}