<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends MY_Controller {

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');

		$this->load->model('mediaboxes_model', 'Box');
		$this->load->model('tvs_model', 'TV');
		$this->load->model('vehicles_model', 'Vehicle');
		$this->load->model('vehicle_types_model', 'Vehicle_Type');

		$this->load->model('ready_vehicles_model', 'Media');
		$this->load->model('active_vehicles_model', 'Active');
	}
			
	public function assign()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Assign Media';
		$data['breadcrumbs']=array
		(
			array('Assign Media','Media/assign'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);
		$data['page_description']='Assign Mediabox and TV to Vehicle';

		$vehicle_type_data = $this->Vehicle_Type->show_Vehicle_Type();
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

		$box_data = $this->Box->find_Mediabox();
		$data['boxes'] = array();
		foreach ($box_data as $rows) {
			array_push($data['boxes'],
				array(
					$rows['box_id'],
					$rows['box_tag'],
				)
			);
		}

		$tv_data = $this->TV->find_Tv();
		$data['tvs'] = array();
		foreach ($tv_data as $rows) {
			array_push($data['tvs'],
				array(
					$rows['tv_id'],
					$rows['tv_serial'],
				)
			);
		}

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'assign_media' ;

		$this->load->view("template/header", $data);
		$this->load->view("vehicles/media_assign", $data);
		$this->load->view("template/footer", $data);
	}

	public function browse()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='View Assigned Tv and Mediabox';
		$data['breadcrumbs']=array
		(
			array('View Assigned Tv and Mediabox','Media/browse'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);
		$data['page_description']='View Assigned Tv and Mediabox';

		$vehicle_type_data = $this->Vehicle_Type->show_Vehicle_Type();
		$data['types'] = array();
		foreach ($vehicle_type_data as $rows) {
			array_push($data['types'],
				array(
					$rows['vehicle_type_id'],
					$rows['vehicle_type_name'],
				)
			);
		}

		$vehicle_data = $this->Vehicle->show_Vehicle();
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

		$box_data = $this->Box->show_Mediabox();
		$data['boxes'] = array();
		foreach ($box_data as $rows) {
			array_push($data['boxes'],
				array(
					$rows['box_id'],
					$rows['box_tag'],
				)
			);
		}

		$tv_data = $this->TV->show_Tv();
		$data['tvs'] = array();
		foreach ($tv_data as $rows) {
			array_push($data['tvs'],
				array(
					$rows['tv_id'],
					$rows['tv_serial'],
				)
			);
		}

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'browse_assignment' ;

		$this->load->view("template/header", $data);
		$this->load->view("vehicles/media_browse", $data);
		$this->load->view("template/footer", $data);
	}

	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////

	// C R E A T E
	public function saveMedia()
	{
		// VALIDATE
		// SAVE TO READY_VEHICLES THEN GET READY_VEHICLE_ID
		// UPDATE VEHICLE['ASSIGNED TO'] == READY_VEHICLE_ID
		// UPDATE TV['ASSIGNED TO'] == READY_VEHICLE_ID
		// UPDATE BOX['ASSIGNED TO'] == READY_VEHICLE_ID
		$validate = array (
			array('field'=>'vehicle_id','label'=>'Vehicle','rules'=>'required|is_unique[ready_vehicles.vehicle_id]'),
			array('field'=>'box_id','label'=>'Mediabox','rules'=>'required|is_unique[ready_vehicles.box_id]'),
			array('field'=>'tv_id','label'=>'Tv','rules'=>'required|is_unique[ready_vehicles.tv_id]'),
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
				'box_id'=>$this->input->post('box_id'),
				'tv_id'=>$this->input->post('tv_id'),
			);
			$media_id = $this->Media->save_Media($data);
			$this->Vehicle->assign_Media($media_id, $this->input->post('vehicle_id'));
			$this->Box->assign_Media($media_id, $this->input->post('box_id'));
			$this->TV->assign_Media($media_id, $this->input->post('tv_id'));
			$info['message']="You have successfully saved your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}


	// R E A D
	public function showMedia()
	{
		$table = $this->Media->show_Media();
		$data = array();
		foreach ($table as $rows) {
			$creation = new DateTime($rows['created_at']);
			$vehicle = $this->Vehicle->edit_Vehicle($rows['vehicle_id']);
			$box = $this->Box->edit_Mediabox($rows['box_id']);
			$tv = $this->TV->edit_Tv($rows['tv_id']);
			array_push($data,
				array(
					$vehicle['vehicle_name'],
					$box['box_tag'],
					$tv['tv_serial'],
					$creation->format('M / d / Y'),
					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_media('."'".$rows['ready_vehicle_id']."'".')">Edit</a>'.
					'<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_media('."'".$rows['ready_vehicle_id']."'".')">Delete</a>'
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}

	// U P D A T E
	public function editMedia()
	{
		$id=$this->input->post('ready_vehicle_id');
		$data=$this->Media->edit_Media($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function updateMedia()
	{

		$validate = array (
			array('field'=>'vehicle_id','label'=>'Vehicle','rules'=>'required'),
			array('field'=>'box_id','label'=>'Mediabox','rules'=>'required'),
			array('field'=>'tv_id','label'=>'Tv','rules'=>'required'),
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
				'ready_vehicle_id'=>$this->input->post('ready_vehicle_id'),
				'vehicle_id'=>$this->input->post('vehicle_id'),
				'box_id'=>$this->input->post('box_id'),
				'tv_id'=>$this->input->post('tv_id'),
			);

			$media=$this->Media->edit_Media($this->input->post('ready_vehicle_id'));

			$this->Vehicle->unassign_Media($media['ready_vehicle_id'], $media['vehicle_id']);
			$this->Box->unassign_Media($media['ready_vehicle_id'], $media['box_id']);
			$this->TV->unassign_Media($media['ready_vehicle_id'], $media['tv_id']);

			$this->Media->update_Media($data);

			$this->Vehicle->assign_Media($media['ready_vehicle_id'], $this->input->post('vehicle_id'));
			$this->Box->assign_Media($media['ready_vehicle_id'], $this->input->post('box_id'));
			$this->TV->assign_Media($media['ready_vehicle_id'], $this->input->post('tv_id'));
			$info['message']="You have successfully updated your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// D E L E T E
	public function delete_Media()
	{
		$validate=array(
			array('field'=>'ready_vehicle_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			if($this->Active->find_Media($this->input->post('ready_vehicle_id')))
			{
				$info['success']=FALSE;
				$info['errors']="Cannot Delete Already Assigned Media!";
			}
			else
			{
				$info['success']=TRUE;
				$data=array(
					'ready_vehicle_id'=>$this->input->post('ready_vehicle_id')
				);

				$media=$this->Media->edit_Media($this->input->post('ready_vehicle_id'));

				$this->Vehicle->unassign_Media($media['ready_vehicle_id'], $media['vehicle_id']);
				$this->Box->unassign_Media($media['ready_vehicle_id'], $media['box_id']);
				$this->TV->unassign_Media($media['ready_vehicle_id'], $media['tv_id']);

				$this->Media->delete_Media($data);
				$info['message']='Data Successfully Deleted';
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////

}

// END OF BOX CONTROLLER