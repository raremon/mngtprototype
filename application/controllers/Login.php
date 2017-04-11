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
			$this->load->model('user', 'auth');
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
			
			$this->load->library('form_validation');
			$this->form_validation->set_rules("username", "Username", "trim|required");
			$this->form_validation->set_rules("password", "Password", "trim|required");
			if ($this->form_validation->run() == true) 
			{	
				// Validates the Username and Password
				$status = $this->auth->validate();

				// Error Messages
				if ($status == ERR_INVALID_USERNAME) {
					$this->session->set_flashdata("error", "Username is invalid");
				}
				elseif ($status == ERR_INVALID_PASSWORD) {
					$this->session->set_flashdata("error", "Password is invalid");
				}
				else
				{
					// Stores the user information into session
					$this->session->set_userdata($this->auth->get_data());
					$this->session->set_userdata("logged_in", true);

					// Redirects to dashboard
					redirect("dashboard");
				}
			}

			// If no form is run, it will just load the login view
			$this->load->view("login");
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