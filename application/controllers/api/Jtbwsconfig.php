<?php
require(APPPATH.'libraries/REST_Controller.php');

class Jtbwsconfig extends REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('tbwsconfig_model','Tbwsconfig');
    }
		
	public function index_get() {
		
		// http://[::1]/mngtprototype/api/jtbwsconfig/
		// http://180.232.67.229/api/jtbwsconfig/
		$data = $this->get();
		
		// $where = array(''=>0);
		$records = $this->Tbwsconfig->get_Data();
		
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

		//Posted variables: link, function
		//	WsLink, WsFunction
		
		if( isset($d['link']) && isset($d['function']) ){

			//check if record already exists
			$where = array('WsLink'=>$d['link'],'WsFunction'=>$d['function']);
			$check = $this->Tbwsconfig->get_Data($where);
		
			if( count($check)>0 ){ //update/replace old data
				$response = array('message' => 'Record already exists!');
			}
			else{ // save new data
					
				$record = array(
							'WsLink' => $d['link'],
							'WsFunction' => $d['function']
							);
								
				$result = $this->Tbwsconfig->save_Data($record);					
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
			
			$check = $this->Tbwsconfig->delete_Data($where);

			$response = ($check>0)?1:0;	
			
		}else{				
			$response = false;
		}
	
		$this->response($response);		
	}	
	
}