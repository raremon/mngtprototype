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
		// http://[::1]/star8/api/MValidate/login
		
		$data = $this->post();
		if( isset($data['user']) && isset($data['pass']) )
		{
			// Goes to ad owner model to validate username and password
			$result = $this->Owner_Accounts->login_mobile($data);
			
			// If no account is found
			if($result == -1)
			{
				// Goes to users model to validate username and password
				$result = $this->Users->login_mobile($data);
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
	
	public function validate_post()
	{
		/* JSON method to authenticate ad owner, salesman, or manager in Android app */
		// http://[::1]/star8/api/MValidate/validate
		
		$data = $this->post();
		if( isset($data['user']) && isset($data['pass']) )
		{
			// Goes to ad owner model to validate username and password
			$result = $this->Owner_Accounts->validate_mobile($data);
			
			// If no account is found
			if($result == -1)
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
		// http://[::1]/star8/api/MValidate/logout
		
		$data = $this->post();
		if( isset($data['owner_id']) && isset($data['owner_uname']) && isset($data['owner_upass']) )
		{
			// Goes to model to update ad owner login status
			$response = $this->Owner_Accounts->logout_mobile($data);	
		}
		else if(isset($data['user_id']) && isset($data['user_name']) && isset($data['user_password']))
		{
			// Goes to model to update salesman or manager login status
			$response = $this->Users->logout_mobile($data);
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