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
			
		if( isset($d['timeslot']) && is_numeric($d['timeslot']) ){
			
			$where = array('status'=>0,'timeslot'=>$d['timeslot']);
			$date = date("Y-m-d");	
		
			$ads = $this->Nschedule->getSchedules($where,$date);
			
			$timeslot = number_format($d['timeslot'],2,':','');
			$time2 = number_format($d['timeslot']+1,2,':','');
			
			// echo '<h2>Auto Ad Scheduling</h2>';
			// echo '<h3>Time Slot: '.date("h:ia", strtotime($timeslot)).' - '.date("h:ia", strtotime($time2)).'</h3>';
			
			if( count($ads)>0 ){
				$listing = array();
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

	
	public function showterminal_get() {
		$this->load->model('terminals_model', 'Terminal');
		$terminal_table = $this->Terminal->show_Terminal();
		$ctr = 0;
		$data = array();
		foreach ($terminal_table as $rows) {
			array_push($data,
				array(
					$rows['terminal_id'],
					$rows['terminal_name'],
					"<div id='table-map-canvas-".$ctr."' class='table-canvas'> </div>
					  <script type='text/javascript'>

						var map".$ctr." = new google.maps.Map( document.getElementById('table-map-canvas-".$ctr."'),{
							center:{
								lat: ". $rows['latitude'] .",
								lng: ". $rows['longitude'] ."
							},
							zoom:17,
							scrollwheel: false,
						    navigationControl: false,
						    mapTypeControl: false,
						    scaleControl: false,
						    draggable: false,
						    mapTypeId: google.maps.MapTypeId.ROADMAP
						});

						var marker".$ctr." = new google.maps.Marker({
							position:{
								lat: ". $rows['latitude'] .",
								lng: ". $rows['longitude'] ."
							},
							map:map".$ctr.",
							draggable: false
						});
					  </script>
					",
					
					'<a href="#main-cont" class="btn btn-info btn-sm" onclick="edit_terminal('."'".$rows['terminal_id']."'".')">Edit</a>'.
					'&nbsp;<a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="delete_terminal('."'".$rows['terminal_id']."'".')">Delete</a>'
				)
			);
			$ctr += 1;
		}
		
		$this->response(array('data' => $data));
	}
	
	public function editterminal_post() {
		$terminalId = $this->post('terminal_id');

		if(!isset($terminalId)) {
			$this->response(array('success' => false, 'message' => 'Error in terminal_id'));
		} else {
			$this->load->model('terminals_model', 'Terminal');
			$data = $this->Terminal->edit_Terminal_Data($terminalId);	
			$this->response($data);
		}
	}
	
	public function updateterminal_post() {
		$data = $this->post();
		
		$this->form_validation->set_data($data);
		
		$validate = array (
			array('field'=>'terminal_name','label'=>'Terminal Name','rules'=>'required'),
		);

		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		} else {
			
			$this->load->model('terminals_model', 'Terminal');
			$info['success']=TRUE;

			$data=array(
				'terminal_id'=>$this->input->post('terminal_id'),
				'terminal_name'=>$this->input->post('terminal_name'),
				'latitude'=>$this->input->post('latitude'),
				'longitude'=>$this->input->post('longitude')
			);
			$this->Terminal->update_Terminal_Data($data);
			$info['message']="You have successfully updated your data!";
		}
		
		$this->response($info);
	}
}