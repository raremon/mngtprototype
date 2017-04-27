<?php
require(APPPATH.'libraries/REST_Controller.php');

class Jschedule extends REST_Controller {
	
	public function __construct() {
        parent::__construct();
    }
		
	public function index_get() {
		$data = $this->get();
		
		if( isset($data['busID']) && isset($data['today']) && is_numeric($data['busID']) && $data['today']!='' ){
			$this->load->model('schedule_model');
			
			$response = $this->schedule_model->getSchedule($data['busID'],$data['today']);
		}
		else{
			$response = array('message' => 'No schedule to retrieve.');
		}

		$this->response($response);
	}
	
	public function scheduledads_get() {
		$data = $this->get();
		
		if( isset($data['busID']) && isset($data['today']) && is_numeric($data['busID']) && $data['today']!='' ){
			$this->load->model('schedule_model');
			
			$schedule = $this->schedule_model->getScheduleAds($data['busID'],$data['today']);
		
			$response = $this->schedule_model->getSchedule($data['busID'],$data['today']);
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
			$this->response(array('success': false, 'message' => 'Error in terminal_id'));
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