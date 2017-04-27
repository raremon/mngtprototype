<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	// Dashboard Controller

	// MY_Controller in Core Folder
	class Dashboard extends MY_Controller {	

		// Constructor
		public function __construct()
		{
			parent::__construct();
			$this->load->model('users_model', 'User');
			$this->load->model('roles_model', 'Role');
		}
		
		// Index Function
		public function index()
		{
			$data['role'] = $this->logged_out_check();
			$data['title'] = 'Dashboard';
			$data['page_description'] = 'Summary of Data';

			$data['treeActive'] = 'dashboard';
			$data['childActive'] = '' ;

			// $data['role'] = $current_user_role;

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

			$this->load->view("template/header", $data);
			$this->load->view("dashboard", $data);
			$this->load->view("template/footer", $data);
		}

	}

// END OF DASHBOARD CONTROLLER