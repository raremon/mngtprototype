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

		$this->load->model('mediaboxes_model', 'Box');
		$this->load->model('tvs_model', 'Tv');
		$this->load->model('card_readers_model', 'Card');
		$this->load->model('gps_model', 'Gps');
		$this->load->model('cctvs_model', 'Cctv');
		$this->load->model('ipcams_model', 'Ipcam');
		$this->load->model('pos_model', 'Pos');
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
		$data['childActive'] = 'browse_vehicles' ;

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

		$type_data = $this->Type->read();
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
	public function browse_type()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Browse Vehicle Types';
		$data['breadcrumbs']=array
		(
			array('Browse Vehicle','vehicles/browse'),
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
	public function save()
	{
		$validate = array (
			array('field'=>'vehicle_name-add','label'=>'Vehicle Name','rules'=>'trim|required|is_unique[vehicles.vehicle_name]|min_length[2]'),
			array('field'=>'plate_number-add','label'=>'Plate Number','rules'=>'trim|required|is_unique[vehicles.plate_number]|min_length[5]'),
			array('field'=>'chassi_number-add','label'=>'Chassi Number','rules'=>'trim|required|is_unique[vehicles.chassi_number]|min_length[2]'),
			array('field'=>'sim_number-add','label'=>'Sim Number','rules'=>'trim|required|is_unique[vehicles.sim_number]|min_length[5]'),
			array('field'=>'vehicle_description-add','label'=>'Description','rules'=>'trim|required'),
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
				'vehicle_name'=>$this->input->post('vehicle_name-add'),
				'plate_number'=>$this->input->post('plate_number-add'),
				'chassi_number'=>$this->input->post('chassi_number-add'),
				'sim_number'=>$this->input->post('sim_number-add'),
				'vehicle_description'=>$this->input->post('vehicle_description-add'),
				'vehicle_type'=>$this->input->post('vehicle_type-add'),
			);
			$this->Vehicle->save($data);
			$info['message']="<p class='success-message'>You have successfully saved <span class='message-name'>".$data['vehicle_name']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	public function show()
	{
		$table = $this->Vehicle->read();
		$assigned="";
		$data = array();
		foreach ($table as $rows) {
			$type_data = $this->Type->find_Type($rows['vehicle_type']);
			if($this->Media->find_Vehicle($rows['vehicle_id']))
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-primary btn-sm btn-block" onclick="see_media('."'".$rows['vehicle_id']."'".')">See Devices in Vehicle</a>';
			}
			else
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_vehicle('."'".$rows['vehicle_id']."'".')">Delete</a>';
			}
			array_push($data,
				array(
					$rows['vehicle_name'],
					$rows['plate_number'],
					$rows['chassi_number'],
					$rows['sim_number'],
					$rows['vehicle_description'],
					$type_data,
					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_vehicle('."'".$rows['vehicle_id']."'".')">Edit</a>'.
					$assigned,
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	public function getDevices($id)
	{
		$table = $this->Media->get_Info($id);
		$data = array();
		// BOX
		if($table['box_id']!=null)
		{
			$box = $this->Box->edit_Mediabox($table['box_id']);
			array_push($data,
				array(
					'Mediabox',
	            	$box['box_tag'],
					$box['box_description'],
				)
			);
		}
		// TV
		if($table['tv_id']!=null)
		{
			$tv = $this->Tv->edit($table['tv_id']);
			array_push($data,
				array(
					'Television',
	            	$tv['tv_serial'],
					$tv['tv_description'],
				)
			);
		}
		// CARD
		if($table['card_id']!=null)
		{
			$card = $this->Card->edit($table['card_id']);
			array_push($data,
				array(
					'Card Reader',
	            	$card['card_serial'],
					$card['card_description'],
				)
			);
		}
		// GPS
		if($table['gps_id']!=null)
		{
			$gps = $this->Gps->edit($table['gps_id']);
			array_push($data,
				array(
					'GPS',
	            	$gps['gps_serial'],
					$gps['gps_description'],
				)
			);
		}
		// CCTV
		if($table['cctv_id']!=null)
		{
			$cctv = $this->Cctv->edit($table['cctv_id']);
			array_push($data,
				array(
					'CCTV',
	            	$cctv['cctv_serial'],
					$cctv['cctv_description'],
				)
			);
		}
		// IP CAM
		if($table['ipcam_id']!=null)
		{
			$ipcam = $this->Ipcam->edit($table['ipcam_id']);
			array_push($data,
				array(
					'IP Camera',
	            	$ipcam['ipcam_serial'],
					$ipcam['ipcam_description'],
				)
			);
		}
		// POS
		if($table['pos_id']!=null)
		{
			$pos = $this->Pos->edit($table['pos_id']);
			array_push($data,
				array(
					'POS',
	            	$pos['pos_serial'],
					$pos['pos_description'],
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	public function edit()
	{
		$id=$this->input->post('vehicle_id');
		$data=$this->Vehicle->edit($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function update()
	{
		$validate = array (
			array('field'=>'vehicle_name','label'=>'Vehicle Name','rules'=>'trim|required'),
			array('field'=>'plate_number','label'=>'Plate Number','rules'=>'trim|required'),
			array('field'=>'chassi_number','label'=>'Chassi Number','rules'=>'trim|required'),
			array('field'=>'sim_number','label'=>'Sim Number','rules'=>'trim|required'),
			array('field'=>'vehicle_description','label'=>'Vehicle Description','rules'=>'trim|required'),
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
				'chassi_number'=>$this->input->post('chassi_number'),
				'sim_number'=>$this->input->post('sim_number'),
				'vehicle_description'=>$this->input->post('vehicle_description'),
				'vehicle_type'=>$this->input->post('vehicle_type'),
			);
			$this->Vehicle->update($data);
			$info['message']="<p class='success-message'>You have successfully updated <span class='message-name'>".$data['vehicle_name']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	public function delete()
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
				$info['errors']="Cannot Delete Vehicle that have Devices!";
			}
			else
			{
				$info['success']=TRUE;
				$data=array(
					'vehicle_id'=>$this->input->post('vehicle_id')
				);
				$this->Vehicle->delete($data);
				$info['message']='Data Successfully Deleted';
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	////////////////////////////////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S    B  U  S    T  Y  P  E  S           //
	////////////////////////////////////////////////////////////////////////////////////////////
	public function saveType()
	{
		$validate = array (
			array('field'=>'vehicle_type_name-add','label'=>'Vehicle Type Name','rules'=>'trim|required|is_unique[vehicle_types.vehicle_type_name]|min_length[2]'),
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
				'vehicle_type_name'=>$this->input->post('vehicle_type_name-add'),
			);
			$this->Type->create($data);
			$info['message']="<p class='success-message'>You have successfully saved <span class='message-name'>".$data['vehicle_type_name']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	public function showType()
	{
		$table = $this->Type->read();
		$assigned="";
		$data = array();
		foreach ($table as $rows) {
			$creation = new DateTime($rows['created_at']); 
			if($this->Vehicle->find_Type($rows['vehicle_type_id']))
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-primary btn-sm btn-block" onclick="see_vehicles('."'".$rows['vehicle_type_id']."'".')">See Vehicles of this Type</a>';
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
	public function getVehicles($id)
	{
    	$table = $this->Vehicle->getType($id);
		$data = array();
		foreach ($table as $rows) {
			array_push($data,
				array(
                	$rows['vehicle_name'],
					$rows['plate_number'],
					$rows['info'].' ... ',
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	public function editType()
	{
		$id=$this->input->post('vehicle_type_id');
		$data=$this->Type->edit($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function updateType()
	{
		$validate = array (
			array('field'=>'vehicle_type_name','label'=>'Vehicle Type Name','rules'=>'trim|required|min_length[2]'),
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
			$this->Type->update($data);
			$info['message']="<p class='success-message'>You have successfully updated <span class='message-name'>".$data['vehicle_type_name']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
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
				$this->Type->delete($data);
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