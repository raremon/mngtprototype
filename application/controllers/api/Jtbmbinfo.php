<?php
require(APPPATH.'libraries/REST_Controller.php');

class Jtbmbinfo extends REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('tbmbinfo_model','Tbmbinfo');
    }
		
	public function index_get() {
		
		// http://[::1]/mngtprototype/api/jtbmbinfo/
		// http://180.232.67.229/api/jtbmbinfo/
		$data = $this->get();
		
		// $where = array(''=>0);
		$records = $this->Tbmbinfo->get_Data();
		
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

		//Posted variables: board, key, dateopr, hddcap, hwcap, vehicle
		//	MBoardID, HwKeyId, 	DateOprt, HddCap, HwCap, VehicleId
		
		if( isset($d['board']) && isset($d['key']) && isset($d['dateopr']) && isset($d['vehicle']) ){

			/* //check if record already exists
			$where = array('HwkeyId'=>$d['key'],'VehicleId'=>$d['vehicle'],'RouteId'=>$d['route']);
			$check = $this->Tbmbinfo->get_Data($where);
		
			if( count($check)>0 ){ //update/replace old data
				$response = array('message' => 'Record already exists!');
			}
			else{ // save new data */
					
				$record = array(
							'MBoardID' => $d['board'],
							'HwKeyId' => $d['key'],
							'DateOprt' => $d['dateopr'],
							'HddCap' => $d['hddcap'],
							'HwCap' => $d['hwcap'],
							'VehicleId' => $d['vehicle']
							);
								
				$result = $this->Tbmbinfo->save_Data($record);					
				$msg = ($result>0)?1:0;	
				$response = $msg;				
			// }
			
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
			
			$check = $this->Tbmbinfo->delete_Data($where);

			$response = ($check>0)?1:0;	
			
		}else{				
			$response = false;
		}
	
		$this->response($response);		
	}	
	
}