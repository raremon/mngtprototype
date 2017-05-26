<?php
require(APPPATH.'libraries/REST_Controller.php');

class Jtbhwdefect extends REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('tbhwdefect_model','Tbhwdefect');
    }
		
	public function index_get() {
		
		// http://[::1]/mngtprototype/api/jtbhwdefect/
		// http://180.232.67.229/api/jtbhwdefect/
		$data = $this->get();
		
		// $where = array(''=>0);
		$records = $this->Tbhwdefect->get_Data();
		
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
		
		// print_r($d);
		// exit;
		
		//Posted variables: board, key, dateopr, daterep, part, vehicle
		//	MBoardID, HwKeyId, 	DateOprt, DateReplace, PartDesc, VehicleId
		
		if( isset($d['board']) && isset($d['key']) && isset($d['dateopr']) && isset($d['vehicle']) ){

			/* //check if record already exists
			$where = array('HwkeyId'=>$d['key'],'VehicleId'=>$d['vehicle'],'MBoardID'=>$d['board']);
			$check = $this->Tbhwdefect->get_Data($where);
		
			if( count($check)>0 ){ //update/replace old data
				$response = array('message' => 'Record already exists!');
			}
			else{ // save new data */

			// [board] => 1
			// [key] => 1
			// [dateopr] => 2017-05-01
			// [daterep] => 2017-05-01
			// [part] => 1
			// [vehicle] => 1

			
				$record = array(
							'Mboardid' => $d['board'],
							'HwKeyid' => $d['key'],
							'DateOprt' => $d['dateopr'],
							'DateReplace' => $d['daterep'],
							'PartDesc' => $d['part'],
							'VehicleId' => $d['vehicle']
							);
				
				// print_r($record);
				// exit;
				
								
				$result = $this->Tbhwdefect->save_Data($record);					
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
			
			$check = $this->Tbhwdefect->delete_Data($where);

			$response = ($check>0)?1:0;	
			
		}else{				
			$response = false;
		}
	
		$this->response($response);		
	}	
	
}