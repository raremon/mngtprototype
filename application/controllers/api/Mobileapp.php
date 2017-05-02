<?php
require(APPPATH.'libraries/REST_Controller.php');
class Mobileapp extends REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('users_model', 'users');

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

			$response = ($result>0)?1:0;	
			
			//just in case datestamps are needed to be added
			// $date = date_create();
			// $response["datestamp"] = $date->format('Y-m-d H:i:s');	
			
		}else{
			$response = 0;
		}
		$this->response($response);	

	}
	
	public function login($user,$pass){
		
		//retrieval of data from mobile app
		$data["user"] = $user;
		$data["pass"] = $pass;
		
		//goes to model to validate username and password
		$response["result"] = $this->users->validate_mobile($data);

		//just in case datestamps are needed to be added
		$date = date_create();
		$response["datestamp"] = $date->format('Y-m-d H:i:s');	
		
		//prints "response" and "datestamp" in web service
		echo json_encode($response);
		}
	}
