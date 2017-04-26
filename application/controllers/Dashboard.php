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
			$data['css']=array
			(
				
			);
			$data['script']=array
			(
				
			);
			$data['treeActive'] = 'dashboard';
			$data['childActive'] = '' ;

			$this->load->view("template/header", $data);
			$this->load->view("dashboard", $data);
			$this->load->view("template/footer", $data);
		}

	}

// END OF DASHBOARD CONTROLLER