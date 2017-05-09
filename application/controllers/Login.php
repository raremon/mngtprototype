<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	// Login Controller
	// The Default Controller of the Application
	// MY_Controller in Core Folder
	class Login extends MY_Controller {	
		// Constructor
		public function __construct()
		{
			parent::__construct();
			// Loads the User Model as Auth
			$this->load->model('users_model', 'auth');
		}
		// Checks if the user is logged in
		public function logged_in_check()
		{
			if ($this->session->userdata("logged_in")) {
				redirect("dashboard");
			}
		}
		// Index Function of Login Controller
		public function index()
		{	
			$this->logged_in_check();
			$this->load->view("login");
		}
		public function login()
		{
			$validate = array (
				array('field'=>'username','label'=>'Username','rules'=>'trim|required'),
				array('field'=>'password','label'=>'Password','rules'=>'trim|required'),
			);
			$this->form_validation->set_rules($validate);
			if ($this->form_validation->run()===FALSE) 
			{
				$info['success']=FALSE;
				$info['errors']=validation_errors();
			}
			else
			{
				$status = $this->auth->validate();
				if ($status == ERR_INVALID_USERNAME) {
					$info['success']=FALSE;
					$info['errors']="Username is invalid";
				}
				elseif ($status == ERR_INVALID_PASSWORD) {
					$info['success']=FALSE;
					$info['errors']="Password is invalid";
				}
				else
				{
					$this->session->set_userdata($this->auth->get_data());
					$this->session->set_userdata("logged_in", true);
					$info['success']=TRUE;
				}
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($info));
		}
		// Logout Function of Login Controller
		public function logout()
		{
			// Update the last login of user
			$this->auth->logout();
			// Unsets the user data then destroys the session
			$this->session->unset_userdata("logged_in");
			$this->session->sess_destroy();
			// Redirects the user to the login page
			redirect("login");
		}
	}
// END OF LOGIN CONTROLLER