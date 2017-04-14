<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	// Dashboard Controller

	// MY_Controller in Core Folder
	class Dashboard extends MY_Controller {	

		// Constructor
		public function __construct()
		{
			parent::__construct();
			$this->load->model('User');
			$this->load->model('Role');
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

			$data['title']='Dashboard';

			$current_user_role = $this->Role->current_Role($this->session->userdata("user_role"));
			$data['role'] = $current_user_role;
			// $bus_type_data = $this->Bus_type->show_Bus_Type();
			// $data['bustype'] = array();
			// foreach ($bus_type_data as $rows) {
			// 	array_push($data['bustype'],
			// 		array(
			// 			$rows['bus_type_id'],
			// 			$rows['bus_type_name'],
			// 		)
			// 	);
			// }

			$this->load->view("dashboard", $data);
		}

	}

// END OF DASHBOARD CONTROLLER