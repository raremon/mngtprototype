<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buses extends MY_Controller {

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');

		$this->load->model('bustypes_model', 'Bus_type');
		$this->load->model('buses_model', 'Bus');
		$this->load->model('routes_model', 'Route');
	}
			
	public function add()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Add Bus';
		$data['breadcrumbs']=array
		(
			array('Add Bus','buses/add'),
		);
		$data['css']=array
		(

		);
		$data['script']=array
		(
			
		);
		$data['page_description']='Add and Update Buses';

		$bus_type_data = $this->Bus_type->show_Bus_Type();
		$data['bustype'] = array();
		foreach ($bus_type_data as $rows) {
			array_push($data['bustype'],
				array(
					$rows['bus_type_id'],
					$rows['bus_type_name'],
				)
			);
		}

		$route_data = $this->Route->show_Route();
		$data['busroute'] = array();
		foreach ($route_data as $rows) {
			array_push($data['busroute'],
				array(
					$rows['route_id'],
					$rows['route_name'],
				)
			);
		}

		$data['treeActive'] = 'bus_management';
		$data['childActive'] = 'add_bus' ;

		$this->load->view("template/header", $data);
		$this->load->view("buses/bus_add", $data);
		$this->load->view("template/footer", $data);
	}

	public function delete()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Delete Bus';
		$data['breadcrumbs']=array
		(
			array('Delete Bus','buses/delete'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);
		$data['page_description']='Delete Buses';

		$bus_type_data = $this->Bus_type->show_Bus_Type();
		$data['bustype'] = array();
		foreach ($bus_type_data as $rows) {
			array_push($data['bustype'],
				array(
					$rows['bus_type_id'],
					$rows['bus_type_name'],
				)
			);
		}

		$data['treeActive'] = 'bus_management';
		$data['childActive'] = 'delete_bus' ;

		$this->load->view("template/header", $data);
		$this->load->view("buses/bus_delete", $data);
		$this->load->view("template/footer", $data);
	}

	public function bus_type()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Bus Types';
		$data['breadcrumbs']=array
		(
			array('Add Bus','buses/add'),
			array('Bus Types','buses/bus_type'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);
		$data['page_description']='Add, Update, and Delete Bus Types';

		$data['treeActive'] = 'bus_management';
		$data['childActive'] = 'add_bus' ;

		$this->load->view("template/header", $data);
		$this->load->view("buses/bus_type", $data);
		$this->load->view("template/footer", $data);
	}

	/////////////////////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S    B  U  S  E  S           //
	/////////////////////////////////////////////////////////////////////////////////

	// // C R E A T E
	public function saveBus()
	{
		$validate = array (
			array('field'=>'bus_name','label'=>'Bus Name','rules'=>'required|is_unique[buses.bus_name]|min_length[5]'),
			array('field'=>'plate_number','label'=>'Plate Number','rules'=>'required|is_unique[buses.plate_number]|min_length[5]'),
			array('field'=>'bus_desc','label'=>'Bus Description','rules'=>'required'),
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
				'bus_name'=>$this->input->post('bus_name'),
				'plate_number'=>$this->input->post('plate_number'),
				'bus_desc'=>$this->input->post('bus_desc'),
				'bus_type'=>$this->input->post('bus_type'),
				'route_id'=>$this->input->post('bus_route'),
			);
			$this->Bus->save_Bus($data);
			$info['message']="You have successfully saved your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// R E A D
	public function show_Bus()
	{
		$bus_table = $this->Bus->show_Bus();
		$data = array();
		foreach ($bus_table as $rows) {
			$bus_type_data = $this->Bus_type->edit_Bus_Type_Data($rows['bus_type']);
			$route_data = $this->Route->edit_Route_Data($rows['route_id']);
			array_push($data,
				array(
					$rows['bus_id'],
					$rows['bus_name'],
					$rows['plate_number'],
					$rows['bus_desc'],
					$bus_type_data['bus_type_name'],
					$route_data['route_name'],
					'<a href="javascript:void(0)" class="btn btn-info btn-sm" onclick="edit_bus('."'".$rows['bus_id']."'".')">Edit</a>'
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}

	public function show_Bus_Delete()
	{
		$bus_table = $this->Bus->show_Bus();
		$data = array();
		foreach ($bus_table as $rows) {
			$bus_type_data = $this->Bus_type->edit_Bus_Type_Data($rows['bus_type']);
			$route_data = $this->Route->edit_Route_Data($rows['route_id']);
			array_push($data,
				array(
					$rows['bus_id'],
					$rows['bus_name'],
					$rows['plate_number'],
					$rows['bus_desc'],
					$bus_type_data['bus_type_name'],
					$route_data['route_name'],
					'<a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="delete_bus('."'".$rows['bus_id']."'".')">Delete</a>'
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}


	// U P D A T E
	public function edit_Bus()
	{
		$bus_id=$this->input->post('bus_id');
		$data=$this->Bus->edit_Bus_Data($bus_id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function updateBus()
	{

		$validate = array (
			array('field'=>'bus_name','label'=>'Bus Name','rules'=>'required'),
			array('field'=>'plate_number','label'=>'Plate Number','rules'=>'required'),
			array('field'=>'bus_desc','label'=>'Bus Description','rules'=>'required'),
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
				'bus_id'=>$this->input->post('bus_id'),
				'bus_name'=>$this->input->post('bus_name'),
				'plate_number'=>$this->input->post('plate_number'),
				'bus_desc'=>$this->input->post('bus_desc'),
				'bus_type'=>$this->input->post('bus_type'),
				'route_id'=>$this->input->post('bus_route'),
			);
			$this->Bus->update_Bus_Data($data);
			$info['message']="You have successfully updated your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// D E L E T E
	public function delete_Bus()
	{
		$validate=array(
			array('field'=>'bus_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'bus_id'=>$this->input->post('bus_id')
			);
			$this->Bus->delete_Bus_Data($data);
			$info['message']='Data Successfully Deleted';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	////////////////////////////////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S    B  U  S    T  Y  P  E  S           //
	////////////////////////////////////////////////////////////////////////////////////////////

	// C R E A T E
	public function saveBusType()
	{
		$validate = array (
			array('field'=>'bus_type_name','label'=>'Bus Type Name','rules'=>'required|is_unique[bus_type.bus_type_name]'),
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
				'bus_type_name'=>$this->input->post('bus_type_name'),
			);
			$this->Bus_type->save_Bus_Type($data);
			$info['message']="You have successfully saved your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// R E A D
	public function show_Bus_Type()
	{
		$bus_type_table = $this->Bus_type->show_Bus_Type();
		$data = array();
		foreach ($bus_type_table as $rows) {
			array_push($data,
				array(
					$rows['bus_type_id'],
					$rows['bus_type_name'],
					'<a href="javascript:void(0)" class="btn btn-info btn-sm" onclick="edit_bus_type('."'".$rows['bus_type_id']."'".')">Edit</a>'.
					'&nbsp;<a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="delete_bus_type('."'".$rows['bus_type_id']."'".')">Delete</a>'
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}

	// U P D A T E
	public function edit_Bus_Type()
	{
		$bus_type_id=$this->input->post('bus_type_id');
		$data=$this->Bus_type->edit_Bus_Type_Data($bus_type_id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function updateBusType()
	{

		$validate = array (
			array('field'=>'bus_type_name','label'=>'Bus Type Name','rules'=>'required'),
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
				'bus_type_id'=>$this->input->post('bus_type_id'),
				'bus_type_name'=>$this->input->post('bus_type_name'),
			);
			$this->Bus_type->update_Bus_Type_Data($data);
			$info['message']="You have successfully updated your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// D E L E T E
	public function delete_Bus_Type()
	{
		$validate=array(
			array('field'=>'bus_type_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'bus_type_id'=>$this->input->post('bus_type_id')
			);
			$this->Bus_type->delete_Bus_Type_Data($data);
			$info['message']='Data Successfully Deleted';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////

}

// END OF BUSES CONTROLLER