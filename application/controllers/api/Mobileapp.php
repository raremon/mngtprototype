<?php
require(APPPATH.'libraries/REST_Controller.php');
class Mobileapp extends REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('Adowneraccounts_model', 'Owner_Accounts');
		$this->load->model('Advertisers_model', 'Owners');
		$this->load->model('Regions_model', 'Regions');
		$this->load->model('Cities_model', 'Cities');
		$this->load->model('Locations_model', 'Locations');
		$this->load->model('Routes_model', 'Routes');
		//$this->load->model('Order_schedule_model', 'Orders');
	}
	
	// ----------------  LOGIN FUNCTIONS  ---------------- //

	public function login_post(){
		
		$d = $this->post();
		/* JSON method to authenticate ad owner in Android app */
		// http://[::1]/star8/api/mobileapp/login
			
		if( isset($d['user']) && isset($d['pass']) ){
			// Goes to model to validate username and password
			$result = $this->Owner_Accounts->validate_mobile($d);
			$response = $result;	
			
		}else{
			// If direct controller access
			$response = -1;
		}
		$this->response($response);	
	}
	
	public function logout_post(){
		
		$d = $this->post();
		/* JSON method to log ad owner out of Android app */
		// http://[::1]/star8/api/mobileapp/logout
		
		if( isset($d['owner_id']) ){
			// Goes to model to update owner data
			$result = $this->Owner_Accounts->logout_mobile($d['owner_id']);
			
		}else{
			// If direct controller access
			$result = -1;
		}
		$this->response($result);
	}
	
	// ----------------  DATA RETRIEVAL FUNCTIONS  ---------------- //
	public function getinfo_post(){
		
		$d = $this->post();
		/* JSON method to get ad owner info for Android app */
		// http://[::1]/star8/api/mobileapp/getinfo
		
		if( isset($d['owner_id']) ){
			
			// Goes to model to get ad owner data
			$result = $this->Owners->get_by_id($d['owner_id']);
			
		}else{
			// Response to get rid of other mobile sessions if ad owner changes password
			// Or if direct controller access
			$result = -1;
		}
		$this->response($result);
	}
	
	public function getregions_get(){
		/* JSON method to get all regions for Android app */
		// http://[::1]/star8/api/mobileapp/getregions
		
		// Goes to model to query all regions
		$result = $this->Regions->show_region();
		$this->response($result);
	}
	
	public function getcities_get(){
		/* JSON method to get all cities for Android app */
		// http://[::1]/star8/api/mobileapp/getcities
		
		// Goes to model to query all cities
		$result = $this->Cities->show_City();
		$this->response($result);
	}
	
	public function getcity_get(){
		/* JSON method to get all cities from a specific region for Android app */
		// http://[::1]/star8/api/mobileapp/getcity/region/     <---- *insert region id here*
		
		$data = $this->get();
		if( isset($data['region']) ){
			// Goes to model to query all cities according to the region specified
			$result = $this->Cities->get_by_region($data['region']);
		}
		else{
			// If direct controller access
			$result = -1;
		}
		
		// Returns either an array of cities or -1 if false
			$this->response($result);
	} 
	
	public function getlocations_get(){
		/* JSON method to get all locations for Android app */
		// http://[::1]/star8/api/mobileapp/getlocations
		
		// Goes to model to query all locations
		$result = $this->Locations->read();
		$this->response($result);
	}
	public function getlocation_get(){
		/* JSON method to get all locations from a specific city for Android app */
		// http://[::1]/star8/api/mobileapp/getlocation/city/     <---- *insert city id here*
		
		$data = $this->get();
		if( isset($data['city']) ){
			// Goes to model to query all location according to the city specified
			$result = $this->Locations->get_by_city($data['city']);	
		}
		else{
			// If direct controller access
			$result = -1;
		}
		
		// Returns either an array of locations or -1 if false
		$this->response($result);
	}
	
	public function getvehicletype_get(){
		/* JSON method to get all vehicle types for Android app */
		// http://[::1]/star8/api/mobileapp/getvehicletype
		
		// Goes to model to query all vehicle types
		$result = $this->Regions->show_Vehicle_type();
		$this->response($result);
	}
	
	public function getroute_get(){
		/* JSON method to get all routes from a specific city for Android app */
		// http://[::1]/star8/api/mobileapp/getroute/city/     <---- *insert city id here*
		
		$data = $this->get();
		if( isset($data['city']) ){
			// Goes to model to query all routes according to the city specified
			$result = $this->Routes->get_by_location($data['city']);	
		}
		else{
			// If direct controller access
			$result = -1;
		}
		
		// Returns either an array of routes or -1 if false
		$this->response($result);
	}
	
	public function getroutes_get(){
		/* JSON method to get all routes for Android app */
		// http://[::1]/star8/api/mobileapp/getroutes
		
		// Goes to model to query all routes
		$result = $this->Routes->show_Route();
		$this->response($result);
	}
	
	// ----------------  FORM DATA SUBMISSION FUNCTIONS  ---------------- //	
	public function putrequestschedule_post(){
		/* JSON method to submit a schedule request from Android app */
		// http://[::1]/star8/api/mobileapp/putrequestschedule
		
		$data = $this->post();
		if( isset($data['user_id']) ){
			
			// Submits form data to model
			//$result = $this->Orders->putrequestschedule($data);

		}
		else{
			// If direct controller access
			//$response = -1;
		}
		//$this->response($result);
	}
	public function changepass_post(){
		
		$data = $this->post();
		/* JSON method to authenticate ad owner in Android app */
		// http://[::1]/star8/api/mobileapp/changepass
		
		if( isset($data['user']) && isset($data['pass']) && isset($data['newpass'])){
			// Goes to model to validate username and password and change password if successful
			$response = $this->Owner_Accounts->change_pass($data);
		}else{
			// If direct controller access
			$response = -1;
		}
		$this->response($response);	
	}
	}