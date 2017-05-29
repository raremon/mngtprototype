<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	// Program Schedule Controller

	// MY_Controller in Core Folder
class Schedules extends MY_Controller {	

	public function __construct(){
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');
		
		$this->load->model('nschedules_model', 'Nschedule');

		// $this->load->model('advertisers_model', 'Advertiser');
		// $this->load->model('routes_model', 'Route');
		// $this->load->model('ads_model', 'Ad');

		// $this->load->model('schedules_model', 'Schedule');
		
		// $this->load->model('ad_schedules_model', 'Ad_Schedule');
		// $this->load->model('airtimes_model', 'Airtime');
	}
	
	public function index(){
		//Menu Navi:	Program Schedule > Ads for Scheduling
		
		//retrieve ads on tbl n_schedules with status=0 (unscheduled)
		
		//display list of timeslots with pending ads regardless of region
		
		$where = array('status'=>0);
		$date = date("Y-m-d");
		
		$timeslots = $this->Nschedule->getTimeSlots($where,date("Y-m-d"));
		
		// $timeslots = $this->Nschedule->getTimeSlots($where,"2017-01-01");
		
		
		// print_r($timeslots);
		if( count($timeslots)>0 ){
			echo '<table border="1">';
			echo '	<tr>
						<td>Time Slot</td>
						<td>No. of Ads</td>
						<td>Action</td>
					</tr>
					';			
			foreach($timeslots as $t){
				// $num = ($t['timeslot']>12)?($t['timeslot']-12):$t['timeslot'];
				// $num = $t['timeslot'];
				$time1 = number_format($t['timeslot'],2,':','');
				$time2 = number_format($t['timeslot']+1,2,':','');
				// $b = strtotime($a);
				// $time = date('H:i', $a);
				echo '	<tr>
							<td style="text-align:center">'.date('h:ia', strtotime($time1)).'-'.date('h:ia', strtotime($time2)).'</td>
							<td style="text-align:center">'.$t['ads'].'</td>
							<td style="text-align:center"><a href="schedules/ads_schedule/'.$t['timeslot'].'">View</a></td>
						</tr>
						';
			}
			echo '</table>';
		}		
		
	}
	
	public function ads_schedule($timeslot=null){
		//get time slot and start from that time
		if( isset($timeslot) && is_numeric($timeslot) ){
			
			$where = array('status'=>0,'timeslot'=>$timeslot);
			$date = date("Y-m-d");
			
			$this->load->library('dynamic_schedule');
			$rundown = $this->dynamic_schedule->generateAdHour($timeslot, $date);
			
			debug($rundown);
			
			
			$ads = $this->Nschedule->getSchedules($where,$date);
					
			// print_r($ads[0]);
			// Array ( [schedule_id] => 1 [ad_id] => 1 [date_start] => 2017-05-10 
			// [date_end] => 2017-06-10 [timeslot] => 8 [times_repeat] => 4 
			// [display_type] => 1 [win_123] => 0 [created_at] => 2017-05-21 22:59:19 
			// [updated] => 2017-05-21 22:59:19 [status] => 0 
			// [ad_name] => Kaya Niya, Kaya Mo [ad_filename] => 1-Kaya_Niya,_Kaya_Mo.mp4 
			// [ad_duration] => 78 [advertiser_id] => 1 )
			
			$timeslot = number_format($timeslot,2,':','');
			
			echo '<h2>Auto Ad Scheduling</h2>';
			
			if( count($ads)>0 ){
				$listing = array();
				$start_time = strtotime($timeslot);
				
				foreach($ads as $a){
					$info = array();
					$info['time'] = date("h:i:s a", $start_time);
					$info['ad_name'] = $a['ad_name'];
					$info['advertiser_name'] = $a['advertiser_name'];
					$info['ad_duration'] = $a['ad_duration'];
					
					$listing[] = $info;
					$start_time += $a['ad_duration'];
				}
			}
			
			// print_r($listing);

			if( count($listing)>0 ){
				echo '<table border="1">';
				echo '	<tr>
							<td style="text-align:center;font-weight:bold">Air Time</td>
							<td style="text-align:center;font-weight:bold">Ad Title</td>
							<td style="text-align:center;font-weight:bold">Advertiser</td>
							<td style="text-align:center;font-weight:bold">Duration (in seconds)</td>
							<td style="text-align:center;font-weight:bold">Order</td>
						</tr>
						';			
				foreach($listing as $t){
					echo '	<tr>
								<td style="text-align:center; width: 20%">'.$t['time'].'</td>
								<td style="text-align:center; width: 35%">'.$t['ad_name'].'</td>
								<td style="text-align:center; width: 25%">'.$t['advertiser_name'].'</td>
								<td style="text-align:center">'.$t['ad_duration'].'</td>
								<td style="text-align:center">RANK</td>
							</tr>
							';
				}
				echo '	<tr>
							<td colspan="3" style="font-weight:bold">TOTAL AIR TIME</>
							<td style="text-align:center;font-weight:bold">TOTAL HERE</>
							<td>&nbsp;</>
						</tr>
						';
				echo '</table>';	
			}
		
		}
		else{
			redirect('/schedules','refresh');	
		}
	}

}

// END OF SCHEDULE CONTROLLER