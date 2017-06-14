<?php
require(APPPATH.'libraries/REST_Controller.php');
class MValidate extends REST_Controller 
{
	
	public function __construct() 
	{
        parent::__construct();
		$this->load->model('Adowneraccounts_model', 'Owner_Accounts');
		$this->load->model('Users_model', 'Users');
	}

	public function login_post()
	{
		/* JSON method to authenticate ad owner in Android app */
		// http://[::1]/star8/api/mobileapp/login
		
		$data = $this->post();
		if( isset($data['user']) && isset($data['pass']) )
		{
			// Goes to ad owner model to validate username and password
			$result = $this->Owner_Accounts->validate_mobile($data);
			
			// If no account is found
			if($result == -2)
			{
				// Goes to users model to validate username and password
				$result = $this->Users->validate_mobile($data);
			}
		}
		else
		{
			// If direct controller access
			$result = -1;
		}
		// Returns an object or -1
		$this->response($result);	
	}
	
	public function logout_post()
	{
		/* JSON method to log ad owner out of Android app */
		// http://[::1]/star8/api/mobileapp/logout
		
		$data = $this->post();
		if( isset($data['owner_id']) && isset($data['owner_uname']) && isset($data['owner_upass']) )
		{
			// Goes to model to update ad owner login status
			$response = $this->Owner_Accounts->logout_mobile($data);	
		}
		else if(isset($data['user_id']) && isset($data['user_name']) && isset($data['user_password']))
		{
			if($data['user_type'] == 2){
				// Goes to model to update salesman login status
				$response = $this->Users->logout_mobile($data);
			}			
			else{
				// If direct user access
				$response = -1;
			}
		}
		else
		{
			// If direct controller access
			$response = -1;
		}
		// Returns 1 or -1
		$this->response($response);
	}
}