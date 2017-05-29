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

		$this->load->model('salesmen_model', 'Sales');
		$this->load->model('orders_model', 'Order');
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