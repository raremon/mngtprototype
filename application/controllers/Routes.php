<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Routes extends MY_Controller {

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');

		$this->load->model('regions_model', 'Region');
		$this->load->model('cities_model', 'City');
		$this->load->model('routes_model', 'Route');		
	}
	
	public function add()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='New Route';
		$data['breadcrumbs']=array
		(
			array('New Route','routes/add'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);

		$region_data = $this->Region->show_Region();
		$data['region'] = array();
		foreach ($region_data as $rows) {
			array_push($data['region'],
				array(
					$rows['region_id'],
					$rows['region_name'],
				)
			);
		}

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

		$data['page_description']='Add New Route Records';

		$data['treeActive'] = 'route_management';
		$data['childActive'] = 'new_route' ;

		$this->load->view("template/header", $data);
		$this->load->view("routes/route_add", $data);
		$this->load->view("template/footer", $data);
	}

	public function browse()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Browse Routes';
		$data['breadcrumbs']=array
		(
			array('Browse Routes','routes/browse'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);

		$region_data = $this->Region->show_Region();
		$data['region'] = array();
		foreach ($region_data as $rows) {
			array_push($data['region'],
				array(
					$rows['region_id'],
					$rows['region_name'],
				)
			);
		}

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

		$data['page_description']='Browse Route Records';

		$data['treeActive'] = 'route_management';
		$data['childActive'] = 'browse_routes' ;

		$this->load->view("template/header", $data);
		$this->load->view("routes/route_browse", $data);
		$this->load->view("template/footer", $data);
	}

	/////////////////////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S    R  O  U  T  E           //
	/////////////////////////////////////////////////////////////////////////////////

	// C R E A T E
	public function saveRoute()
	{
		$validate = array (
			array('field'=>'route_name','label'=>'Route Name','rules'=>'required|is_unique[routes.route_name]|min_length[5]'),
			array('field'=>'route_description','label'=>'Route Description','rules'=>'required'),
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
				'route_name'=>$this->input->post('route_name'),
				'route_description'=>$this->input->post('route_description'),
				'city_from'=>$this->input->post('city_from'),
				'city_to'=>$this->input->post('city_to'),
			);
			$this->Route->save_Route($data);
			$info['message']="You have successfully saved your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// R E A D
	public function showRoute()
	{
		$route_table = $this->Route->show_Route();
		$data = array();
		foreach ($route_table as $rows) {
			$city_from_data = $this->City->edit_City( $rows['city_from'] );
			$city_to_data = $this->City->edit_City( $rows['city_to'] );
			array_push($data,
				array(
					$rows['route_name'],
					$rows['route_description'],
					$city_from_data['city_name'],
					$city_to_data['city_name'],
					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_route('."'".$rows['route_id']."'".')">Edit</a>'.
					'<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_route('."'".$rows['route_id']."'".')">Delete</a>'
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}

	// U P D A T E
	public function editRoute()
	{
		$route_id=$this->input->post('route_id');
		$data=$this->Route->edit_Route_Data($route_id);
		$city_from = $this->City->edit_City($data['city_from']);
		$city_to = $this->City->edit_City($data['city_to']);

		array_push($data,
			array(
				'region_from'=>$city_from['region_id'],
				'region_to'=>$city_to['region_id'],
			)
		);

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function updateRoute()
	{

		$validate = array (
			array('field'=>'route_id','label'=>'Route ID','rules'=>'required'),
			array('field'=>'route_name','label'=>'Route Name','rules'=>'required|min_length[5]'),
			array('field'=>'route_description','label'=>'Route Description','rules'=>'required'),
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
				'route_id'=>$this->input->post('route_id'),
				'route_name'=>$this->input->post('route_name'),
				'route_description'=>$this->input->post('route_description'),
				'city_from'=>$this->input->post('city_from'),
				'city_to'=>$this->input->post('city_to'),
			);
			$this->Route->update_Route_Data($data);
			$info['message']="You have successfully updated your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// D E L E T E
	public function delete_Route()
	{
		$validate=array(
			array('field'=>'route_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'route_id'=>$this->input->post('route_id')
			);
			$this->Route->delete_Route_Data($data);
			$info['message']='Data Successfully Deleted';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////

}

// END OF ROUTES CONTROLLER