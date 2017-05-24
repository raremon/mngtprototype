<?php
require(APPPATH.'libraries/REST_Controller.php');

class Jtbmbregs extends REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('tbmbregs_model','Tbmbregs');
    }
		
	public function index_get() {
		
		// http://[::1]/mngtprototype/api/jtbmbregs/
		// http://180.232.67.229/api/jtbmbregs/
		$data = $this->get();
		
		// $where = array(''=>0);
		$records = $this->Tbmbregs->get_Data();
		
		if( count($records)>0 ){
			$response = $records;
		}
		else{
			$response = array('message' => 'No records to display.');
		}

		$this->response($response);
	}
	
	public function add_post(){
		
		$d = $this->post();

		//Posted variables: key, vehicle, route
		//	HwkeyId, VehicleId, RouteId
		
		if( isset($d['key']) && isset($d['vehicle']) && isset($d['route']) ){

			//check if record already exists
			$where = array('HwkeyId'=>$d['key'],'VehicleId'=>$d['vehicle'],'RouteId'=>$d['route']);
			$check = $this->Tbmbregs->get_Data($where);
		
			if( count($check)>0 ){ //update/replace old data
				$response = array('message' => 'Record already exists!');
			}
			else{ // save new data
					
				$record = array(
							'HwkeyId' => $d['key'],
							'VehicleId' => $d['vehicle'],
							'RouteId' => $d['route']
							);
								
				$result = $this->Tbmbregs->save_Data($record);					
				$msg = ($result>0)?1:0;	
				$response = $msg;				
			}
			
		}else{				
			$response = false;
		}
	
		$this->response($response);		
	}

	public function delete_post(){
		
		$d = $this->post();

		//Posted variables: key
		
		if( isset($d['key']) && is_numeric($d['key']) ){

			$where = array('keyid'=>$d['key']);
			
			$check = $this->Tbmbregs->delete_Data($where);

			$response = ($check>0)?1:0;	
			
		}else{				
			$response = false;
		}
	
		$this->response($response);		
	}	
	
}