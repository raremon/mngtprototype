<?php
require(APPPATH.'libraries/REST_Controller.php');
class Mobileapp extends REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('adowneraccounts_model', 'Owners');
	}
	public function login_post(){
		
		$d = $this->post();
		/* JSON method to authenticate ad owner in Android app */
		//http://[::1]/star8/api/mobileapp/login
			
		if( isset($d['user']) && isset($d['pass']) ){
			//Goes to model to validate username and password
			$result = $this->Owners->validate_mobile($d);
			$response = $result;	
			
		}else{
			//If username or password is empty
			$response = -1;
		}
		$this->response($response);	
	}
	public function getinfo_post(){
		
		$d = $this->post();
		/* JSON method to get ad owner info in Android app */
		//http://[::1]/star8/api/mobileapp/getinfo
		
		if( isset($d['owner_id']) ){
			
			//Goes to model to get ad owner data
			$result = $this->Owners->get_info_mobile($d['owner_id']);
			
		}else{
			//Response to get rid of other mobile sessions if ad owner changes password
			//Or just a normal fail response :D
			$result = -1;
		}
		$this->response($result);
	}
	public function logout_post(){
		$d = $this->post();
		/* JSON method to log ad owner out of Android app */
		//http://[::1]/star8/api/mobileapp/logout
		
		if( isset($d['owner_id']) ){
			
			//Goes to model to update owner data
			$result = $this->Owners->logout_mobile($d['owner_id']);
			
		}else{
			//Justin case :D
			$result = -1;
		}
		$this->response($result);
	}
	}