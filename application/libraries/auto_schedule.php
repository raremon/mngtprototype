<?php

class Auto_schedule {
	private $CI;
	private $totalSecs = 3600;
	private $fillers = array();
	private $fillerFlag;
	
	private $airtime=0;
	
	// public $tmp = array();
	
	private $prog_list = array();

	public function __construct() {
		$this->CI =& get_instance();
	}
	
	public function getTotalAirTime($ads){
		
		$total = 0;
		foreach($ads as $a){
			$total += $a['times_repeat']*$a['paid_duration'];
		}
		
		return $total;
		
	}

	public function rearrange_list($stack, $tmp){
		
		$temp = $tmp;
		
		foreach( $stack as $key => $s ){
			foreach( $tmp as $t ){			
				
				// echo "<br />".$s['id']."-".$t['id'];
								
				if( $s['id']!=$t['id'] ){
					if( $tmp[count($tmp)-1]['id']!=$s['id'] ){
						unset($stack[$key]);
						array_push($temp, $s);
					}
					break;
				}
				/* if( $s['id']!=$t['id'] ){
					// array_splice( $original, 3, 0, $inserted ); 
					array_splice( $tmp, $tmp[$ky+1], 0, $s ); 
					// if( $tmp[count($tmp)-1]['id']!=$s['id'] ){
					unset($stack[$key]);
						// array_push($temp, $s);
					// }
					break; 
				}		*/		
			}
		}
		return array($stack,$temp);
	}

	// public function auto($timeslot, $route, $order_detail=array()){
	public function auto($order_detail){
		
		$this->CI->load->model('orders_model');
		$this->CI->load->model('playlist_model');
		$this->CI->load->model('nschedules_model');			
		$this->CI->load->model('fillers_model');			
			
		$fields = 'DISTINCT(route_id) AS route';
		$where = array('order_id'=>$order_detail[0]['order_id']);		
		$routes = $this->CI->nschedules_model->getDistinct($fields, $where);	
		// $routes = $this->CI->nschedules_model->getSchedules($where);	
		// print_r($fields);
		// print_r($routes);
		
		$fields = 'DISTINCT(timeslot) AS slots';
		$where = array('order_id'=>$order_detail[0]['order_id']);				
		$slots = $this->CI->nschedules_model->getDistinct($fields, $where);	
		
		// print_r($order_detail);	
		// print_r($slots);

		$schedule = array();
	

		foreach($routes as $r){
			// echo "<hr />";			
			// echo "<br />route: ".$r['route'];
			
			foreach($slots as $s){
				$this->airtime = 0;
				$where = array('timeslot'=>$s['slots'],'route_id'=>$r['route'],'order_id'=>$order_detail[0]['order_id']);		
				$ads_by_route_slot = $this->CI->nschedules_model->getSchedulesDetailed($where);	
				
				// $airtime = 0;
				$by_hour = array();
				$sdate = '';
				$edate = '';
				foreach($ads_by_route_slot as $ad){	
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
						
						$this->airtime += $ad['paid_duration'];
						
						array_push($by_hour, $info);	
						// $by_hour[] = $info;	
						$tslot_time = $ad['tslot_time'];
						
					}
					// echo "<p>By Hour (New): ".count($by_hour)."</p>"; 
				}	 		
				
				// echo "<br />";
				// print_r($s);
				// $info = array();
				// array_push($schedule, $s);	
				// $schedule = array_merge($schedule, $by_hour);	
				
				//get other approved ads on current time slots 
				//content_type = ad
				//timeslot = slots
				//route = route_id
				// $where = array('timeslot'=>$s['slots'],'route_id'=>$r['route'],'content_type'=>'ad','order_id<>'.$order_detail[0]['order_id']=>NULL);		
				// $existing_ads = $this->CI->playlist_model->getSchedulesDetailed($where);	

				$where = array('timeslot'=>$s['slots'],'route_id'=>$r['route'],'content_type'=>'ad','playlist.order_id<>'.$order_detail[0]['order_id']=>NULL);		
				$existing_ads = $this->CI->playlist_model->getList($where);	
				

				// echo "<br />Total Existing: ".count($existing_ads);
				// exit;
				// echo print_r($existing_ads[0]);
				
				foreach($existing_ads as $ad){
						$info=array();
						$info['id'] = $ad['id'];
						$info['content_type'] = $ad['content_type']; //content type is ad or filler
						$info['content_id'] = $ad['content_id'];
						$info['date_start'] = $ad['date_start'];
						$info['date_end'] = $ad['date_end'];
						$info['timeslot'] = $ad['timeslot'];
						$info['tslot_time'] = $ad['tslot_time'];
						$info['times_repeat'] = $ad['times_repeat'];
						$info['display_type'] = $ad['display_type'];
						$info['win_123'] = $ad['win_123'];
						$info['route_id'] = $ad['route_id'];
						$info['duration'] = $ad['duration'];
						$info['filename'] = $ad['filename'];
						$info['owner'] = $ad['advertiser_name'];
						$info['length'] = $ad['ad_duration'];
						$info['order_id'] = $ad['order_id'];
						
						$sdate = $ad['date_start'];
						$edate = $ad['date_end'];
						
						$this->airtime += $ad['duration'];
						
						array_push($by_hour, $info);						
				}
				
				// echo "<p>By Hour (All): ".count($by_hour)."</p>"; 
				// exit;
				//delete the existing ads
				$where = array('timeslot'=>$s['slots'],'route_id'=>$r['route'],'content_type'=>'ad','order_id<>'.$order_detail[0]['order_id']=>NULL);	
				$delete_exising_ads = $this->CI->playlist_model->delete_(NULL,$where);
				// echo "<br />Timeslot: ".$s['slots']." Route: ".$r['route']." Airtime: ".$this->airtime;
				
				//insert filler
				
				//check if total airtime is less than 3600
				// echo "<br />Total Airtime for Timeslot: ".$airtime;
				
				//determine	airtime for ads
				$filler_time = 3600 - $this->airtime;
				
				// echo "<br />Filler Time: $filler_time";
				
				//get minimum filler
				$fill_least_time = $this->CI->fillers_model->getMinFiller(array('status'=>0));	
				
				if( $filler_time > $fill_least_time[0]['min_time'] ){
					
					//insert filler
					$run_airtime = 0;
					
					// echo "ok";
					// exit;
					
					$fillers = $this->CI->fillers_model->getFillers(array('status'=>0));	
					
					// echo "<br />Total No. of Fillers: ".count($fillers);
					// exit;
					
					while( $run_airtime<=$filler_time ){
						
						foreach($fillers as $a){				
							$info = array();
							$info['id'] = $a['filler_id'];
							$info['content_type'] = 'filler'; //content type is ad or filler
							$info['content_id'] = $a['filler_id'];
							$info['date_start'] = $sdate;
							$info['date_end'] = $edate;
							$info['timeslot'] = $s['slots'];
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

				// echo "<br />Total Items: ".count($by_hour);

				$this->prog_list = array();
				$list = $this->boosort($by_hour);
				
				$schedule = array_merge($schedule, $list);

				$ctr=1;
				foreach($list as $s){

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

					$id = $this->CI->playlist_model->create($data);
				}				
				// echo "<p>Total After: ".count($list)."</p>";
				
				// print_r($by_hour);
				// exit;
				$schedule = array_merge($schedule, $by_hour);	

			}
		}
	
		//update the table playlist_updates for the mediabox
		
		$this->CI->load->model('order_routes_model');
		$routes = $this->CI->order_routes_model->get_by_order_id($order_detail[0]['order_id']);
		
		// print_r($routes);
		// exit;
		
		$this->CI->load->model('playlist_updates_model');
		

		foreach($routes as $r){ //insert to playlist_updates
			$data = array(
						'route_id'=>$r['route_id']
						);			
			$insert = $this->CI->playlist_updates_model->create($data);
		}
		
		
		// return $msg;
		
		return $schedule;

	}
	
	public function boosort($list){
		
		for($i=0; $i<=count($list); $i++){
			$list = $this->custom_sort($list);
		}
			
		return $this->prog_list;
	}
	
	private function custom_sort($list){
		
		$tmp = array();
		$tmp = $list[0];
		array_push($this->prog_list,$tmp);

		array_splice($list, 0, 1);
		
		$ctr=0;
		foreach($list as $row){
			if( $row == $tmp ){
				$ctr += 1;
			}else{
				$tmp = $row;
				array_push($this->prog_list, $row);
				array_splice($list, $ctr, 1);
			}	
			
		}
		
		return $list;  			
	}
	
}