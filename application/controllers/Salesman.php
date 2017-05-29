<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salesman extends MY_Controller {

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');

		$this->load->model('routes_model', 'Route');
		$this->load->model('cities_model', 'City');
		$this->load->model('regions_model', 'Region');

	}
			
	public function schedules()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Schedule Availability';
		$data['breadcrumbs']=array
		(
			array('Salesman','salesman'),
		);
		$data['css']=array
		(
		'assets/plugins/jQuerySteps/jquery.steps.css',	
        'assets/plugins/daterangepicker/daterangepicker.css',
		'assets/plugins/datepicker/datepicker3.css',
		'assets/plugins/select2/select2.min.css',
		'assets/plugins/iCheck/all.css',
		'assets/plugins/timepicker/bootstrap-timepicker.min.css'
		);
		$data['script']=array
		(
		'assets/plugins/jQuerySteps/jquery.steps.min.js',
        'assets/js/moment.min.js',
		'assets/plugins/input-mask/jquery.inputmask.js',
		'assets/plugins/input-mask/jquery.inputmask.date.extensions.js',
		'assets/plugins/input-mask/jquery.inputmask.extensions.js',
		'assets/plugins/daterangepicker/daterangepicker.js',
		'assets/plugins/datepicker/bootstrap-datepicker.js',
		'assets/plugins/select2/select2.full.min.js',
		'assets/plugins/iCheck/icheck.min.js',
        'assets/js/program_sched.js'
		);
		$data['page_description']='View Available Schedules';

		$data['treeActive'] = 'salesman';
		$data['childActive'] = '' ;

		$this->load->view("template/header", $data);
		$this->load->view("salesman/salesman_sched", $data);
		$this->load->view("template/footer", $data);
	}

}

// END OF SALESMAN CONTROLLER