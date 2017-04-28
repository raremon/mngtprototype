<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	// Program Schedule Controller

	// MY_Controller in Core Folder
	class Program extends MY_Controller {	

		// Constructor
		public function __construct()
		{
			parent::__construct();
			$this->load->model('users_model', 'User');
			$this->load->model('roles_model', 'Role');
		}
		
		// Index Function
		public function create()
		{
			$data['role'] = $this->logged_out_check();
			$data['title'] = 'Program Schedule';
			$data['page_description'] = 'Manage Program Schedule';
            $data['breadcrumbs']=array
		      (
                array('Create Program Schedule','program/create'),
		      );
            $data['css']=array
            (
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
            );
			$data['treeActive'] = 'program_schedule';
			$data['childActive'] = 'create_program_schedule' ;

			$this->load->view("template/header", $data);
			$this->load->view("program/program_create", $data);
			$this->load->view("template/footer", $data);
		}

	}

// END OF PROGRAM SCHEDULE CONTROLLER