<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	// Dashboard Controller

	// MY_Controller in Core Folder
	class Dashboard extends MY_Controller {	

		// Constructor
		public function __construct()
		{
			parent::__construct();
		}

		// Checks if the user is logged out
		// If so, redirects the user to the login page
		public function logged_out_check()
		{
			if (!($this->session->userdata("logged_in"))) {
				redirect("login");
			}
		}
		
		// Index Function
		public function index()
		{
			$this->logged_out_check();
			$this->load->view("dashboard");
		}

	}

// END OF DASHBOARD CONTROLLER