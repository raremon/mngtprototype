<?php
require(APPPATH.'libraries/REST_Controller.php');

class Jtblconfig extends REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('tblconfig_model','Tblconfig');
    }
		
	public function index_get() {
		
		// http://[::1]/mngtprototype/api/jtblconfig/
		// http://180.232.67.229/api/jtblconfig/
		$data = $this->get();
		
		// $where = array(''=>0);
		$records = $this->Tblconfig->get_Data();
		
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

		//Posted variables: path, function, route
		//LcPath, LcFunction
		
		if( isset($d['path']) && isset($d['function']) ){

			//check if record already exists
			$where = array('LcPath'=>$d['path'],'LcFunction'=>$d['function'],'route_id'=>$d['route']);
			$check = $this->Tblconfig->get_Data($where);

			// print_r($check);
			// exit;
		
			if( count($check)>0 ){ //update/replace old data
				$response = array('message' => 'Record already exists!');
			}
			else{ // save new data
					
				$record = array(
							'LcPath' => $d['path'],
							'LcFunction' => $d['function'],
							'route_id' => $d['route']
							);
								
				$result = $this->Tblconfig->save_Data($record);				
				// $msg = ($result>0)?'Logs successfully synched.':'Failed to synch new logs ...';	
				// $msg = ($result>0)?1:0;		
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
			
			$check = $this->Tblconfig->delete_Data($where);

			$response = ($check>0)?1:0;	
			
		}else{				
			$response = false;
		}
	
		$this->response($response);		
	}	
	
}