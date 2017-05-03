<?php
require(APPPATH.'libraries/REST_Controller.php');
class Mobileapp extends REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('adowneraccounts_model', 'Owners');
	}
	public function login_post(){
		
		// echo sha1('admin');
		
		$d = $this->post();
		/* JSON method to authenticate ad owner in Android app */
		//http://[::1]/star8/api/mobileapp/login
			
		if( isset($d['user']) && isset($d['pass']) ){
			//goes to model to validate username and password
			$result = $this->Owners->validate_mobile($d);
			$response = $result;	
			
			//just in case datestamps are needed to be added
			// $date = date_create();
			// $response["datestamp"] = $date->format('Y-m-d H:i:s');	
			
		}else{
			$response = -1;
		}
		$this->response($response);	
	}
	public function getinfo_post(){
		
		$d = $this->post();
		/* JSON method to get ad owner info in Android app */
		//http://[::1]/star8/api/mobileapp/getinfo
		
		if( isset($d['user']) && isset($d['pass']) ){
			
			//goes to model to get ad owner data
			$result = $this->Owners->get_info($d['owner_id']);
			
		}else{
			
		}
	}
	}