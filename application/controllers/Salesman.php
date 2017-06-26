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
	}
			
	public function schedules()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Place Ad Order';
		$data['breadcrumbs']=array
		(
			array('Place Ad Order','salesman/schedules'),
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
		$data['page_description']='View Available Schedules';

		$data['treeActive'] = 'ads_management';
        $data['childActive'] = 'browse_ad_orders' ;

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

		//TIMESLOT
		$timeslot_data = $this->Timeslot->read();
		$data['timeslot'] = array();
		foreach ($timeslot_data as $rows) {
			$orders = $this->Tslot->find_Orders($rows['tslot_id']);
			$total_time = 0;
			if( count($orders)>0 ){
				foreach ($orders as $order_id){
					$total_time = $total_time + $this->Order->get_Time($order_id['order_id']);
				}
			}
			$available_time = round(((3600 - $total_time)/3600)*100, 2);
			// FIND TIMESLOT ID IN ORDER_SLOT
			// IN EACH ORDER_SLOT FOUND, GET AD_DURATION IN ORDERS
			array_push($data['timeslot'],
				array(
					$rows['tslot_id'],
					$rows['tslot_time'],
					$rows['tslot_session'],
					$available_time." %",
				)
			);
		}

		//ADVERTISER
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

		//SALESMAN
		$sales_data = $this->Sales->read();
		$data['sales'] = array();
		foreach ($sales_data as $rows) {
			array_push($data['sales'],
				array(
					$rows['sales_id'],
					$rows['sales_fname']." ".$rows['sales_lname'],
				)
			);
		}
		
		$agency_data = $this->Agency->read();
		$data['agency'] = array();
		foreach ($agency_data as $rows) {
			array_push($data['agency'],
				array(
					$rows['agency_id'],
					$rows['agency_name'],
				)
			);
		}
		
		$this->load->view("template/header", $data);
		$this->load->view("salesman/salesman_sched", $data);
		$this->load->view("template/footer", $data);
	}

	public function add()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='New Salesman';
		$data['breadcrumbs']=array
		(
			array('Browse Salesmen','salesman/browse'),
			array('New Salesman','salesman/add'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);
		$data['page_description']='Add New Salesman Records';

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'browse_salesmen';

		$this->load->view("template/header", $data);
		$this->load->view("salesman/salesman_add", $data);
		$this->load->view("template/footer", $data);
	}

	public function browse()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Browse Salesmen';
		$data['breadcrumbs']=array
		(
			array('Browse Salesmen','salesman/browse'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);
		$data['page_description']='Browse Salesmen Records';

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'browse_salesmen' ;

		$this->load->view("template/header", $data);
		$this->load->view("salesman/salesman_browse", $data);
		$this->load->view("template/footer", $data);
	}

	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////

	// C R E A T E
	public function save()
	{
		$validate = array (
			array('field'=>'sales_fname','label'=>'First Name','rules'=>'trim|required|min_length[2]'),
			array('field'=>'sales_lname','label'=>'Last Name','rules'=>'trim|required|min_length[2]'),
			array('field'=>'sales_contactno','label'=>'Contact Information','rules'=>'trim|required|is_unique[salesmen.sales_contactno]'),
			array('field'=>'sales_email','label'=>'Email Address','rules'=>'trim|required|is_unique[salesmen.sales_email]|valid_email|min_length[10]'),
		);

		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) 
		{
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}
		else
		{
			$info['success']=TRUE;

			$data=array(
				'sales_fname'=>$this->input->post('sales_fname'),
				'sales_lname'=>$this->input->post('sales_lname'),
				'sales_contactno'=>$this->input->post('sales_contactno'),
				'sales_email'=>$this->input->post('sales_email'),
			);
			$this->Sales->create($data);
			$info['message']="<p class='success-message'>You have successfully saved <span class='message-name'>".$data['sales_fname']." ".$data['sales_lname']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// P L A C E O R D E R
	public function placeOrder()
	{
		$validate = array (
			array('field'=>'route_selected','label'=>'Selected Routes','rules'=>'trim|required'),
			array('field'=>'date_start','label'=>'Start Date','rules'=>'trim|required'),
			array('field'=>'tslots_selected','label'=>'Timeslots','rules'=>'trim|required'),
			array('field'=>'advertiser_id','label'=>'Advertiser','rules'=>'trim|required'),
			array('field'=>'ad_duration','label'=>'Ad Duration','rules'=>'trim|required'),
			array('field'=>'sales_id','label'=>'Salesman','rules'=>'trim|required'),
			array('field'=>'display_type','label'=>'Display Type','rules'=>'trim|required'),
		);

		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) 
		{
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}
		else
		{
			$info['success']=TRUE;

			$start = new DateTime($this->input->post('date_start'));
			if($this->input->post('date_end') != "")
			{
				$end = new DateTime($this->input->post('date_end'));
				$end = $end->format('Y-m-d');
			}
			else
			{
				$end = null;
			}

			$order=array(
				'sales_id'=>$this->input->post('sales_id'),
				'ad_duration'=>$this->input->post('ad_duration'),
				'advertiser_id'=>$this->input->post('advertiser_id'),
				'date_start'=>$start->format('Y-m-d'),
				'date_end'=>$end,
				'ad_id'=>0,
				'order_status'=>0,
				'filler_image'=>0,
			);

			$order_id = $this->Order->create($order);
			$selected_tslot = json_decode($this->input->post('tslots_selected'), TRUE);
			foreach($selected_tslot as $row)
			{
				$win_123 = 0;
				$display_type = 0;
				if($this->input->post('display_type') == 1)
				{
					$display_type = 1;
				}
				else if($this->input->post('display_type') == 2)
				{
					$display_type = 2;
					$win_123 = 1;
				}
				else if($this->input->post('display_type') == 4)
				{
					$display_type = 2;
					$win_123 = 2;
				}
				else if($this->input->post('display_type') == 5)
				{
					$display_type = 2;
					$win_123 = 3;
				}
				else
				{
					$display_type = 3;
				}
				$tslot = array(
					'order_id'=>$order_id,
					'tslot_id'=>$row,
					'display_type'=>$display_type,
					'win_123'=>$win_123,
					// 'times_repeat'=>$this->input->post('times_repeat'),
					'times_repeat'=>$this->input->post('time-'.(string)$row),
				);
				$this->Tslot->create($tslot);
			}

			$selected_route = json_decode($this->input->post('route_selected'), TRUE);
		 	if(count($selected_route) < 2)
			{
			  	$routes = array(
		   			'order_id'=>$order_id,
			 		'route_id'=>$selected_route,
			 	);
			  	$this->RouteOrder->create($routes);
			}
			else
			{
				foreach($selected_route as $row)
				{
					$routes = array(
						'order_id'=>$order_id,
						'route_id'=>$row,
					);
					$this->RouteOrder->create($routes);
				}
			}
			// $info['message']=count($selected_route);
			$info['message']="<p class='success-message'>You have successfully saved <span class='message-name'> Order # ".$order_id."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// R E A D
	public function show()
	{
		$table = $this->Sales->read();
		$assigned="";
		$data = array();
		foreach ($table as $rows) {
			$creation = new DateTime($rows['created_at']); 
			if($this->Order->find_Salesman($rows['sales_id']))
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" disabled="disabled">Assigned</a>';
			}
			else
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_sales('."'".$rows['sales_id']."'".')">Delete</a>';
			}
			array_push($data,
				array(
					$rows['sales_lname'].", ".$rows['sales_fname'],
					$rows['sales_contactno'],
					$rows['sales_email'],
					$creation->format('M / d / Y'),
					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_sales('."'".$rows['sales_id']."'".')">Edit</a>'.
					$assigned,
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}

	// U P D A T E
	public function edit()
	{
		$id=$this->input->post('sales_id');
		$data=$this->Sales->edit($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function update()
	{

		$validate = array (
			array('field'=>'sales_fname','label'=>'First Name','rules'=>'trim|required|min_length[2]'),
			array('field'=>'sales_lname','label'=>'Last Name','rules'=>'trim|required|min_length[2]'),
			array('field'=>'sales_contactno','label'=>'Contact Information','rules'=>'trim|required'),
			array('field'=>'sales_email','label'=>'Email Address','rules'=>'trim|required|valid_email|min_length[10]'),
		);

		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) 
		{
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}
		else
		{
			$info['success']=TRUE;

			$data=array(
				'sales_id'=>$this->input->post('sales_id'),
				'sales_fname'=>$this->input->post('sales_fname'),
				'sales_lname'=>$this->input->post('sales_lname'),
				'sales_contactno'=>$this->input->post('sales_contactno'),
				'sales_email'=>$this->input->post('sales_email'),
			);
			$this->Sales->update($data);
			$info['message']="<p class='success-message'>You have successfully updated <span class='message-name'>".$data['sales_fname']." ".$data['sales_lname']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// D E L E T E
	public function delete()
	{
		$validate=array(
			array('field'=>'sales_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			if($this->Order->find_Salesman($this->input->post('sales_id')))
			{	
				$info['success']=FALSE;
				$info['errors']="Cannot Delete Salesman that's Currently Assigned on Order!<br><h3>UNASSIGN FIRST</h3>";
			}
			else
			{
				$info['success']=TRUE;
				$data=array(
					'sales_id'=>$this->input->post('sales_id')
				);
				$this->Sales->delete($data);
				$info['message']='Data Successfully Deleted';
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////
}

// END OF SALESMAN CONTROLLER