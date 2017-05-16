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
		$data['title']='Salesman';
		$data['breadcrumbs']=array
		(
			array('Salesman','salesman'),
		);
		$data['css']=array
		(
		'assets/plugins/jQuerySteps/jquery.steps.css',	
		);
		$data['script']=array
		(
		'assets/plugins/jQuerySteps/jquery.steps.min.js',	
		);
		$data['page_description']='View Available Schedules';

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'salesman' ;

		$this->load->view("template/header", $data);
		$this->load->view("salesman/salesman_sched", $data);
		$this->load->view("template/footer", $data);
	}

}

// END OF SALESMAN CONTROLLER