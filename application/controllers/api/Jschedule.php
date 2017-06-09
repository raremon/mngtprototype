<?php
require(APPPATH.'libraries/REST_Controller.php');

class Jschedule extends REST_Controller {
	
	public function __construct() {
        parent::__construct();
		
		ini_set('max_execution_time', 300);
		
		$this->load->model('schedules_model','Schedule');		
		$this->load->model('timeslots_model', 'Timeslots');
		$this->load->model('fillers_model', 'Fillers');

		$this->load->model('nschedules_model', 'Nschedule');		
		$this->load->model('playlist_model', 'Playlist');		
		
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

	private static function my_sort($a,$b){
		if ($a==$b) return 0;
		return ($a<$b)?-1:1;
					
	}

	public function auto_get(){
		
		$data = $this->get();
		
		// Array ( [time] => 4 [sdate] => 2017-06-01 )
		
		// print_r($data);
		// exit;

		$this->load->library('auto_schedule');
		
		//check if there is already  a playlist for the timeslots of air dates
		// $where = array('order_id'=>$data['order_id']);	
		
		$where = array('timeslot'=>$data['time']);		
		$ads = $this->Playlist->read($data['sdate'],$where);	

		// print_r($ads);
		// exit;
		
		//if found, get the list
		//on that list, remove fillers
		//on that list, add new ad order
		//check if fillers can be added to vacant time
	
		$schedule = array();	
		
		if( count($ads)==0 ){
			//get order_id in n_schedules
			// $where = array('order_id'=>$data['order_id']);			
			// $where = array('timeslot'=>$data['time']);			
			// $ads = $this->Nschedule->getSchedulesDetailed($where);
			
			// print_r($ads);
			// echo count($ads);
			// exit;
			
			//get all route_id in n_schedules for chosen order_id
			$fields = 'DISTINCT(route_id) AS route';
			// $where = array('order_id'=>$data['order_id']);	
			$where = array('timeslot'=>$data['time']);	
			$routes = $this->Nschedule->getDistinct($fields, $where);	

			// $fields = 'DISTINCT(timeslot) AS slots';
			// $where = array('order_id'=>$data['order_id']);		
			// $where = array('timeslot'=>$data['order_id']);		
			// $slots = $this->Nschedule->getDistinct($fields, $where);	
			
			// print_r($routes);
			// print_r($slots);
				
			foreach($routes as $r){
				
				// print_r($r);
				//get the ads on this route
				$where = array('timeslot'=>$data['time'],'route_id'=>$r['route']);		
				$ads_by_route = $this->Nschedule->getSchedulesDetailed($where,$data['sdate']);	
				
				// echo "<br />Ads".count($ads_by_route);
				$airtime = 0;
				$by_hour = array();
				$sdate = '';
				$edate = '';
				foreach($ads_by_route as $ad){	
					for( $i=0; $i<$ad['times_repeat']; $i++ ){
						$info=array();
						$info['id'] = $ad['schedule_id'];
						$info['content_type'] = 'ad'; //content type is ad or filler
						$info['content_id'] = $ad['ad_id'];
						$info['date_start'] = $ad['date_start'];
						$info['date_end'] = $ad['date_end'];
						$info['timeslot'] = $ad['timeslot'];
						$info['tslot_time'] = $ad['tslot_time'];
						$info['times_repeat'] = $ad['times_repeat'];
						$info['display_type'] = $ad['display_type'];
						$info['win_123'] = $ad['win_123'];
						$info['route_id'] = $r['route'];
						$info['duration'] = $ad['paid_duration'];
						$info['filename'] = $ad['ad_filename'];
						$info['owner'] = $ad['advertiser_name'];
						$info['length'] = $ad['ad_duration'];
						$info['order_id'] = $ad['order_id'];
						
						$sdate = $ad['date_start'];
						$edate = $ad['date_end'];
						
						$airtime += $ad['paid_duration'];
						
						array_push($by_hour, $info);	
						// $by_hour[] = $info;	
						$tslot_time = $ad['tslot_time'];
						
					}
					echo "<p>By Hour: ".count($by_hour)."</p>";
				}	
				
				//insert filler
				
				//check if total airtime is less than 3600
				echo "<br />Total Airtime for Timeslot: ".$airtime;
				
				//determine	airtime for ads
				$filler_time = 3600 - $airtime;
				
				// echo "<br />Filler Time: $filler_time";
				// exit;
				
				//get minimum filler
				$fill_least_time = $this->Fillers->getMinFiller(array('status'=>0));	
				
				// print_r($fill_least_time);
				// exit;
				
				if( $filler_time > $fill_least_time[0]['min_time'] ){
					//insert filler
					$run_airtime = 0;
					
					echo "ok";
					// exit;
					
					$fillers = $this->Fillers->getFillers(array('status'=>0));	
					
					echo "<br />Total No. of Fillers: ".count($fillers);
					// exit;
					
					while( $run_airtime<=$filler_time ){
						
						foreach($fillers as $a){				
							$info = array();
							$info['id'] = $a['filler_id'];
							$info['content_type'] = 'filler'; //content type is ad or filler
							$info['content_id'] = $a['filler_id'];
							$info['date_start'] = $sdate;
							$info['date_end'] = $edate;
							$info['timeslot'] = $data['time'];
							$info['tslot_time'] = $tslot_time;
							$info['times_repeat'] = 0;
							$info['display_type'] = '3';
							$info['win_123'] = 0;
							$info['route_id'] = $r['route'];
							$info['duration'] = $a['filler_duration'];
							$info['filename'] = $a['filler_file'];
							$info['owner'] = 'star8';
							$info['length'] = $a['filler_duration'];	
							$info['order_id'] = 0;
							
							$run_airtime += $a['filler_duration'];
							
							// echo "<br />$run_airtime";
							
							if( $run_airtime <= $filler_time)
								array_push($by_hour, $info);

						}	
					}	 
				}
				else{ //no room for fillers
					echo "no room for fillers";
				}
				
				// print_r($by_hour);
				// $ctr=1;
				// echo "<h1>Displaying Ads by Hour $tslot_time</h1>";
				// foreach($by_hour as $col){
					// echo "<br />$ctr. ".$col['content_type']." ".$col['content_id']." ".$col['tslot_time']." ".$col['filename']." @ route".$col['route_id'];
					// $ctr += 1;
				// } 
				
				echo "<p>Total (By Hour): ".count($by_hour)."</p>";
				echo "----------------------------------------";
				// $list = array();
				$list = $this->auto_schedule->boosort($by_hour);
				echo "<p>Total After: ".count($list)."</p>";
				// $list = $this->auto_schedule->custom_sort($by_hour);
				echo "----------------------------------------";

				$schedule = array_merge($schedule, $list);
				// array_push($schedule, $list);
					
			}
		}
		else{ //there is already a playlist in the table
			
		}

		// print_r($schedule);				
		$ctr=1;
		foreach($schedule as $s){
			// print_r($s);
			// echo $s['content_type'];
			// echo is_array($s)?'yes':'no';
			// exit;
			
			$data = array(
							'id'=>$s['id'],
							'content_type'=>$s['content_type'],
							'content_id'=>$s['content_id'], 
							'date_start'=>$s['date_start'],
							'date_end'=>$s['date_end'], 
							'timeslot'=>$s['timeslot'], 
							'tslot_time'=>$s['tslot_time'], 
							'times_repeat'=>$s['times_repeat'], 
							'display_type'=>$s['display_type'],
							'win_123'=>$s['win_123'], 
							'route_id'=>$s['route_id'], 
							'duration'=>$s['duration'],  
							'filename'=>$s['filename'], 
							'play_order'=>$ctr, 
							'order_id'=>$s['order_id']				
						);
			$ctr += 1;
			// print_r($data);
			$id = $this->Playlist->create($data);
		}
		// echo "<br />Total Schedule: ".count($schedule);
		// print_r($schedule);
		// foreach($schedule as $s){
			// echo "<br />".$s['filename'];
		// }
		// $schedule = $by_hour;
		// $ctr=1;
		// foreach($schedule as $col){
			// echo "<br />$ctr. ".$col['content_type']." ".$col['content_id']." ".$col['tslot_time']." ".$col['filename']." route".$col['route_id'];
			// $ctr += 1;
		// } 
		// forea
		
		// echo "<br />".count($schedule);
		// $this->response($schedule);
		
	}

	public function auto_old_get(){
		
		$data = $this->get();
		
		//check if there is already  a playlist for the timeslots of air dates
		// $where = array('order_id'=>$data['order_id']);	
		
		$where = array();		
		$ads = $this->Playlist->read($data['sdate'],$where);	

		// print_r($ads);
		// exit;
		
		//if found, get the list
		//on that list, remove fillers
		//on that list, add new ad order
		//check if fillers can be added to vacant time
		
		if( count($ads)==0 ){
			//get order_id in n_schedules
			$where = array('order_id'=>$data['order_id']);			
			$ads = $this->Nschedule->getSchedulesDetailed($where);
				
			//get all route_id in n_schedules for chosen order_id
			$fields = 'DISTINCT(route_id) AS route';
			$where = array('order_id'=>$data['order_id']);	
			$routes = $this->Nschedule->getDistinct($fields, $where);	

			$fields = 'DISTINCT(timeslot) AS slots';
			$where = array('order_id'=>$data['order_id']);		
			$slots = $this->Nschedule->getDistinct($fields, $where);	
			
			// print_r($routes);
			// print_r($slots);
			
			$schedule = array();
			$by_hour = array();
			foreach($routes as $r){
				foreach($slots as $s){
					//generate list
					//get the ad order 
					$where = array('order_id'=>$data['order_id'],'timeslot'=>$s['slots'],'route_id'=>$r['route']);			
					$ad = $this->Nschedule->getSchedulesDetailed($where);	
					
					// echo "<hr />";
					// print_r($ads);
					$by_hour = array();
					for( $i=0; $i<$ad[0]['times_repeat']; $i++ ){
						$info=array();
						$info['id'] = $ad[0]['schedule_id'];
						$info['content_type'] = 'ad'; //content type is ad or filler
						$info['content_id'] = $ad[0]['ad_id'];
						$info['date_start'] = $ad[0]['date_start'];
						$info['date_end'] = $ad[0]['date_end'];
						$info['timeslot'] = $ad[0]['timeslot'];
						$info['tslot_time'] = $ad[0]['tslot_time'];
						$info['times_repeat'] = $ad[0]['times_repeat'];
						$info['display_type'] = $ad[0]['display_type'];
						$info['win_123'] = $ad[0]['win_123'];
						$info['route_id'] = $ad[0]['route_id'];
						$info['duration'] = $ad[0]['paid_duration'];
						$info['filename'] = $ad[0]['ad_filename'];
						$info['owner'] = $ad[0]['advertiser_name'];
						$info['length'] = $ad[0]['ad_duration'];
						
						//do the sorting by hour
						
							
						$by_hour[] = $info;						
						
					}
					// echo count($by_hour);
					
					$list = array();
					
					$list = $by_hour;
					
					$sorted = array();
					array_push($sorted,$list[0]);
					$init = $list[0];
					
					// print_r($init);
					// exit;
					
					// array_splice($list,0,1);
					
					// while(count($list) != 0)
					// {
						// $ctr = 0;
						// foreach($list as $row)
						// {
						   // if( $init === $row )
						   // {    
							   // $ctr += 1;
						   // }
						   // else
						   // {
							   // array_push($sorted,$row);
							   // $init = $row;
							   echo $list[$ctr]." ".$ctr." ";
							   // array_splice($list,$ctr,1);
						   // }
						// }
					// }
					array_push($schedule, $sorted);
					// echo count($sorted);
					
				}			
			}
		}
		else{ //there is already a playlist in the table
			
		}


		// $a = 1;
		// $b = 2;
		// $c = 3;
		// $d = 4;
		
	 /*   $list = array(
		   $a,$a,$a,$a,$b,$b,$b,$c,$c,$d,$c,$c,$d
					);
		
		$list = $schedule;
		
		$sorted = array();
		array_push($sorted,$list[0]);
		$init = $list[0];
		
		// print_r($init);
		// exit;
		
		array_splice($list,0,1);
		
		while(count($list) != 0)
		{
			$ctr = 0;
			foreach($list as $row)
			{
			   if( $init === $row )
			   {    
				   $ctr += 1;
			   }
			   else
			   {
				   array_push($sorted,$row);
				   $init = $row;
				   //echo $list[$ctr]." ".$ctr." ";
				   array_splice($list,$ctr,1);
			   }
			}
		}*/
		
		foreach($schedule as $col)
		{
			echo "<br />".$col['content_type']." ".$col['content_id']." ".$col['tslot_time']." ".$col['filename'];
		} 
		
		// echo count($schedule);
		// $this->response($schedule);
		
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
						$info['filename'] = $a['ad_filename'];
						
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
							$info['filename'] = $a['filler_file'];
							
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
			$schedule['timeslot-'.$t['tslot_code']] = $list_per_hour;
			
			// $schedule = array_merge($schedule, $this->dynamic_schedule->generateAdHour($t['tslot_id'], $date, $d['route']));
		}
		
		// $obj = (object) $schedule;
		// $this->response($obj);
		
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