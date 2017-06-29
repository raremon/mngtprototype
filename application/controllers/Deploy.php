<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deploy extends MY_Controller {

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');

		$this->load->model('routes_model', 'Route');
		$this->load->model('locations_model', 'Location');
		$this->load->model('cities_model', 'City');
		$this->load->model('regions_model', 'Region');

		$this->load->model('timeslots_model', 'Timeslot');

		$this->load->model('advertisers_model', 'Advertiser');
		$this->load->model('agencies_model', 'Agency');

		$this->load->model('salesmen_model', 'Sales');
		$this->load->model('orders_model', 'Order');
		$this->load->model('order_slots_model', 'Tslot');
		$this->load->model('order_routes_model', 'RouteOrder');
        
		$this->load->model('vehicles_model', 'Vehicle');
		$this->load->model('vehicle_types_model', 'Vehicle_Type');
	}
			
	public function deploys()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Deploy Vehicle';
		$data['breadcrumbs']=array
		(
			array('Deploy Vehicle','deploy/deploys'),
		);
		$data['css']=array
		(
		'assets/plugins/jQuerySteps/jquery.steps.css',	
        'assets/plugins/daterangepicker/daterangepicker.css',
		'assets/plugins/datepicker/datepicker3.css',
		'assets/plugins/select2/select2.min.css',
		'assets/plugins/iCheck/all.css',
		'assets/plugins/timepicker/bootstrap-timepicker.min.css',
		'assets/css/browse_style.css',
		);
		$data['script']=array
		(
        'assets/js/jquery.form.js',
		'assets/plugins/jQuerySteps/jquery.steps.min.js',
        'assets/js/moment.min.js',
		'assets/plugins/input-mask/jquery.inputmask.js',
		'assets/plugins/input-mask/jquery.inputmask.date.extensions.js',
		'assets/plugins/input-mask/jquery.inputmask.extensions.js',
		'assets/plugins/daterangepicker/daterangepicker.js',
		'assets/plugins/datepicker/bootstrap-datepicker.js',
		'assets/plugins/select2/select2.full.min.js',
		'assets/plugins/iCheck/icheck.min.js',
        'assets/js/program_sched.js',
		);
		$data['page_description']='Deploy Vehicle to Different Routes';
        
		$vehicle_type_data = $this->Vehicle_Type->read();
		$data['types'] = array();
		foreach ($vehicle_type_data as $rows) {
			array_push($data['types'],
				array(
					$rows['vehicle_type_id'],
					$rows['vehicle_type_name'],
				)
			);
		}

		$vehicle_data = $this->Vehicle->find_Vehicle();
		$data['vehicles'] = array();
		foreach ($vehicle_data as $rows) {
			array_push($data['vehicles'],
				array(
					$rows['vehicle_id'],
					$rows['vehicle_name'],
					$rows['vehicle_type'],
				)
			);
		}
        
		//ROUTE
		$route_data = $this->Route->show_Route();
		$data['route'] = array();
		foreach ($route_data as $rows) {
			$city_from = $this->Location->edit($rows['location_from']);
			$city_to = $this->Location->edit($rows['location_to']);
			array_push($data['route'],
				array(
					$rows['route_id'],
					$rows['route_name'],
					$city_from['city_id'],
					$city_to['city_id'],
					// $rows['location_from'],
					// $rows['location_to'],
				)
			);
		}
        
        		//REGION
		$region_data = $this->Region->show_Region();
		$data['region'] = array();
		foreach ($region_data as $rows) {
			array_push($data['region'],
				array(
					$rows['region_id'],
					$rows['region_abbr']." : ".$rows['region_name'],
				)
			);
		}

		//CITY
		$city_data = $this->City->show_City();
		$data['city'] = array();
		foreach ($city_data as $rows) {
			array_push($data['city'],
				array(
					$rows['city_id'],
					$rows['city_name'],
					$rows['region_id'],
				)
			);
		}

		//LOCATION
		$location_data = $this->Location->read();
		$data['location'] = array();
		foreach ($location_data as $rows) {
			array_push($data['location'],
				array(
					$rows['location_id'],
					$rows['location_name'],
					$rows['city_id']
				)
			);
		}
		$data['treeActive'] = 'deploy_vehicle';
        $data['childActive'] = '' ;

		
		$this->load->view("template/header", $data);
		$this->load->view("vehicles/deploy_vehicle", $data);
		$this->load->view("template/footer", $data);
	}

	public function browse()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();

		$data['title']='Browse Deployed Vehicles';

		$data['breadcrumbs']=array
		(
			array('Browse Deployed Vehicles','deploy/browse'),
		);
		$data['css']=array
		(
			'assets/css/browse_style.css',
		);
		$data['script']=array
		(
			'assets/js/jquery.form.js',
		);
		$data['page_description']='Browse Deployed Vehicles';

		// $agency_data = $this->Agency->read();
		// $data['agency'] = array();
		// foreach ($agency_data as $rows) {
			// array_push($data['agency'],
				// array(
					// $rows['agency_id'],
					// $rows['agency_name'],
				// )
			// );
		// }

		$data['treeActive'] = 'deploy_vehicle';
		$data['childActive'] = 'browse_deployed' ;

		$this->load->view("template/header", $data);
		$this->load->view("vehicles/deployed_browse", $data);
		$this->load->view("template/footer", $data);
	}	
}

// END OF DEPLOY CONTROLLER