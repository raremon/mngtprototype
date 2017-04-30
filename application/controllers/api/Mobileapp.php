<?php
require(APPPATH.'libraries/REST_Controller.php');
class Mobileapp extends REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('users_model', 'users');
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
