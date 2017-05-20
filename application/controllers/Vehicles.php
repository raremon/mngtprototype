<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicles extends MY_Controller {

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');

		$this->load->model('vehicle_types_model', 'Type');
		$this->load->model('vehicles_model', 'Vehicle');
		$this->load->model('ready_vehicles_model', 'Media');
	}
			
	public function add()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Add Vehicle';
		$data['breadcrumbs']=array
		(
			array('Add Vehicle','vehicles/add'),
		);
		$data['css']=array
		(

		);
		$data['script']=array
		(
			
		);
		$data['page_description']='Add Vehicle Records';

		$type_data = $this->Type->show_Vehicle_Type();
		$data['type'] = array();
		foreach ($type_data as $rows) {
			array_push($data['type'],
				array(
					$rows['vehicle_type_id'],
					$rows['vehicle_type_name'],
				)
			);
		}

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'new_vehicle' ;

		$this->load->view("template/header", $data);
		$this->load->view("vehicles/vehicle_add", $data);
		$this->load->view("template/footer", $data);
	}

	public function browse()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Browse Vehicles';
		$data['breadcrumbs']=array
		(
			array('Browse Vehicles','vehicles/browse'),
		);
		$data['css']=array
		(

		);
		$data['script']=array
		(
			
		);
		$data['page_description']='Browse Vehicle Records';

		$type_data = $this->Type->show_Vehicle_Type();
		$data['type'] = array();
		foreach ($type_data as $rows) {
			array_push($data['type'],
				array(
					$rows['vehicle_type_id'],
					$rows['vehicle_type_name'],
				)
			);
		}

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'browse_vehicles' ;

		$this->load->view("template/header", $data);
		$this->load->view("vehicles/vehicle_browse", $data);
		$this->load->view("template/footer", $data);
	}

	public function add_type()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Add Vehicle Type';
		$data['breadcrumbs']=array
		(
			array('Add Vehicle','vehicles/add'),
			array('Browse Vehicle Type', 'vehicles/browse_type'),
			array('Add Vehicle Type', 'vehicles/add_type'),
		);
		$data['css']=array
		(

		);
		$data['script']=array
		(
			
		);
		$data['page_description']='Add Vehicle Type Records';

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'new_vehicle' ;

		$this->load->view("template/header", $data);
		$this->load->view("vehicles/vehicle_type_add", $data);
		$this->load->view("template/footer", $data);
	}

	public function browse_type()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Browse Vehicle Types';
		$data['breadcrumbs']=array
		(
			array('Add Vehicle','vehicles/add'),
			array('Browse Vehicle Type', 'vehicles/browse_type'),
		);
		$data['css']=array
		(

		);
		$data['script']=array
		(
			
		);
		$data['page_description']='Browse Vehicle Type Records';

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'new_vehicle' ;

		$this->load->view("template/header", $data);
		$this->load->view("vehicles/vehicle_type_browse", $data);
		$this->load->view("template/footer", $data);
	}

	/////////////////////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S    B  U  S  E  S           //
	/////////////////////////////////////////////////////////////////////////////////

	// // C R E A T E
	public function saveVehicle()
	{
		$validate = array (
			array('field'=>'vehicle_name','label'=>'Vehicle Name','rules'=>'required|is_unique[vehicles.vehicle_name]|min_length[5]'),
			array('field'=>'plate_number','label'=>'Plate Number','rules'=>'required|is_unique[vehicles.plate_number]|min_length[5]'),
			array('field'=>'vehicle_description','label'=>'Vehicle Description','rules'=>'required'),
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
				'vehicle_name'=>$this->input->post('vehicle_name'),
				'plate_number'=>$this->input->post('plate_number'),
				'vehicle_description'=>$this->input->post('vehicle_description'),
				'vehicle_type'=>$this->input->post('vehicle_type'),
			);
			$this->Vehicle->save_Vehicle($data);
			$info['message']="You have successfully saved your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// R E A D
	public function showVehicle()
	{
		$table = $this->Vehicle->show_Vehicle();
		$assigned="";
		$data = array();
		foreach ($table as $rows) {
			$type_data = $this->Type->find_Type($rows['vehicle_type']);
			$creation = new DateTime($rows['created_at']);
			if($this->Media->find_Vehicle($rows['vehicle_id']))
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" disabled="disabled">ASSIGNED</a>';
			}
			else
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_vehicle('."'".$rows['vehicle_id']."'".')">Delete</a>';
			}
			array_push($data,
				array(
					$rows['vehicle_name'],
					$rows['plate_number'],
					$rows['vehicle_description'],
					$type_data['vehicle_type_name'],
					$creation->format('M / d / Y'),
					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_vehicle('."'".$rows['vehicle_id']."'".')">Edit</a>'.
					$assigned,
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}

	// U P D A T E
	public function editVehicle()
	{
		$id=$this->input->post('vehicle_id');
		$data=$this->Vehicle->edit_Vehicle($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function updateVehicle()
	{

		$validate = array (
			array('field'=>'vehicle_name','label'=>'Vehicle Name','rules'=>'required'),
			array('field'=>'plate_number','label'=>'Plate Number','rules'=>'required'),
			array('field'=>'vehicle_description','label'=>'Vehicle Description','rules'=>'required'),
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
				'vehicle_id'=>$this->input->post('vehicle_id'),
				'vehicle_name'=>$this->input->post('vehicle_name'),
				'plate_number'=>$this->input->post('plate_number'),
				'vehicle_description'=>$this->input->post('vehicle_description'),
				'vehicle_type'=>$this->input->post('vehicle_type'),
			);
			$this->Vehicle->update_Vehicle($data);
			$info['message']="You have successfully updated your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// D E L E T E
	public function delete_Vehicle()
	{
		$validate=array(
			array('field'=>'vehicle_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			if($this->Media->find_Vehicle($this->input->post('vehicle_id')))
			{
				$info['success']=FALSE;
				$info['errors']="Cannot Delete Already Assigned Vehicle!";
			}
			else
			{
				$info['success']=TRUE;
				$data=array(
					'vehicle_id'=>$this->input->post('vehicle_id')
				);
				$this->Vehicle->delete_Vehicle($data);
				$info['message']='Data Successfully Deleted';
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	////////////////////////////////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S    B  U  S    T  Y  P  E  S           //
	////////////////////////////////////////////////////////////////////////////////////////////

	// C R E A T E
	public function saveType()
	{
		$validate = array (
			array('field'=>'vehicle_type_name','label'=>'Vehicle Type Name','rules'=>'required|is_unique[vehicle_types.vehicle_type_name]'),
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
				'vehicle_type_name'=>$this->input->post('vehicle_type_name'),
			);
			$this->Type->save_Vehicle_Type($data);
			$info['message']="You have successfully saved your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// R E A D
	public function showType()
	{
		$table = $this->Type->show_Vehicle_Type();
		$assigned="";
		$data = array();
		foreach ($table as $rows) {
			$creation = new DateTime($rows['created_at']); 
			if($this->Vehicle->find_Type($rows['vehicle_type_id']))
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" disabled="disabled">ASSIGNED</a>';
			}
			else
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_type('."'".$rows['vehicle_type_id']."'".')">Delete</a>';
			}
			array_push($data,
				array(
					$rows['vehicle_type_name'],
					$creation->format('M / d / Y'),
					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_type('."'".$rows['vehicle_type_id']."'".')">Edit</a>'.
					$assigned,
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}

	// U P D A T E
	public function editType()
	{
		$id=$this->input->post('vehicle_type_id');
		$data=$this->Type->edit_Vehicle_Type($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function updateType()
	{
		$validate = array (
			array('field'=>'vehicle_type_name','label'=>'Vehicle Type Name','rules'=>'required|min_length[2]'),
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
				'vehicle_type_id'=>$this->input->post('vehicle_type_id'),
				'vehicle_type_name'=>$this->input->post('vehicle_type_name'),
			);
			$this->Type->update_Vehicle_Type($data);
			$info['message']="You have successfully updated your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// D E L E T E
	public function delete_Type()
	{
		$validate=array(
			array('field'=>'vehicle_type_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			if($this->Vehicle->find_Type($this->input->post('vehicle_type_id')))
			{
				$info['success']=FALSE;
				$info['errors']="Cannot Delete Already Assigned Vehicle Type!";
			}
			else
			{
				$info['success']=TRUE;
				$data=array(
					'vehicle_type_id'=>$this->input->post('vehicle_type_id')
				);
				$this->Type->delete_Vehicle_Type($data);
				$info['message']='Data Successfully Deleted';
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////

}

// END OF VEHICLES CONTROLLER