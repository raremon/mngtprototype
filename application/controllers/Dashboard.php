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

			$this->load->model('buses_model', 'Bus');
			$this->load->model('ads_model', 'Ad');
			$this->load->model('advertisers_model', 'Advertiser');
			$this->load->model('schedules_model', 'Schedule');
		}
		
		// Index Function
		public function index()
		{
			$data['role'] = $this->logged_out_check();
			$data['title'] = 'Dashboard';
			$data['page_description'] = 'Summary of Data';
			$data['breadcrumbs']=array
			(
				array('Dashboard','dashboard'),
			);
			$data['css']=array
			(
				'assets/css/browse_style.css',

				'assets/plugins/daterangepicker/daterangepicker.css',
				'assets/plugins/datepicker/datepicker3.css',
				'assets/plugins/select2/select2.min.css',
				'assets/plugins/iCheck/all.css',
				'assets/plugins/timepicker/bootstrap-timepicker.min.css',
			);
			$data['script']=array
			(
				'assets/js/program_sched.js',
				'assets/plugins/input-mask/jquery.inputmask.js',
				'assets/plugins/input-mask/jquery.inputmask.date.extensions.js',
				'assets/plugins/input-mask/jquery.inputmask.extensions.js',
				'assets/js/moment.min.js',
				'assets/plugins/daterangepicker/daterangepicker.js',
				'assets/plugins/datepicker/bootstrap-datepicker.js',
				'assets/plugins/select2/select2.full.min.js',
				'assets/plugins/iCheck/icheck.min.js',
				'assets/plugins/timepicker/bootstrap-timepicker.min.js',
				'assets/js/jquery.form.js',
			);
			$data['treeActive'] = 'dashboard';
			$data['childActive'] = '' ;

			$role_data = $this->Role->show_Roles();
			$data['roles'] = array();
			foreach ($role_data as $rows) {
				array_push($data['roles'],
					array(
						$rows['role_id'],
						$rows['role_name'],
						$rows['role_description'],
					)
				);
			}

			$advertiser_data = $this->Advertiser->show_Advertiser();
			$data['advertiser'] = array();
			foreach ($advertiser_data as $rows) {
				array_push($data['advertiser'],
					array(
						$rows['advertiser_id'],
						$rows['advertiser_name'],
					)
				);
			}

			$data['bus_count'] = $this->Bus->count_Bus();
			$data['ad_count'] = $this->Ad->count_Ad();
			$data['advertiser_count'] = $this->Advertiser->count_Advertiser();
			$data['schedule_count'] = $this->Schedule->count_Schedule();

			$firstSection = array
			(
				"program/program_create",
			);

			$secondSection = array
			(
				"ads_mngt/ad_upload",
				"users/user_add",
			);

			$this->load->view("template/header", $data);
			$this->load->view("dashboard/dashboard_head", $data);

			$this->load->view("dashboard/dashboard_section_open", $data);
			foreach($firstSection as $fs)
			{
				$this->load->view($fs, $data);
			}
			// $this->load->view("program/program_create", $data);
			$this->load->view("dashboard/dashboard_section_close", $data);

			$this->load->view("dashboard/dashboard_section_open", $data);
			foreach($secondSection as $ss)
			{
				$this->load->view($ss, $data);
			}
			$this->load->view("dashboard/dashboard_section_close", $data);

			$this->load->view("dashboard/dashboard_foot", $data);
			// $this->load->view("dashboard", $data);
			$this->load->view("template/footer", $data);
		}

	}

// END OF DASHBOARD CONTROLLER