<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Locations extends MY_Controller {

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
	}
			
	public function add()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='New Location';
		$data['breadcrumbs']=array
		(
			array('Browse Locations','locations/browse'),
			array('New Location','locations/add'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);

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

		$data['page_description']='Add New Location Records';

		$data['treeActive'] = 'route_management';
		$data['childActive'] = 'locations' ;

		$this->load->view("template/header", $data);
		$this->load->view("routes/location_add", $data);
		$this->load->view("template/footer", $data);
	}

	public function browse()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Browse Locations';
		$data['breadcrumbs']=array
		(
			array('Browse Locations','locations/browse'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);

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

		$data['page_description']='Browse Location Records';

		$data['treeActive'] = 'route_management';
		$data['childActive'] = 'locations' ;

		$this->load->view("template/header", $data);
		$this->load->view("routes/location_browse", $data);
		$this->load->view("template/footer", $data);
	}

	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////
	// C R E A T E
	public function save()
	{
		$validate = array (
			array('field'=>'location_name','label'=>'Location Name','rules'=>'trim|required|min_length[3]|is_unique[locations.location_name]'),
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
				'location_name'=>$this->input->post('location_name'),
				'city_id'=>$this->input->post('city_id'),
			);
			$this->Location->create($data);
			$info['message']="You have successfully saved <b>".$data['location_name']."</b>!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// R E A D
	public function show()
	{
		$table = $this->Location->read();
		$data = array();
		foreach ($table as $rows) {
			$creation = new DateTime($rows['created_at']); 
			$name = $this->City->get_Name($rows['city_id']);
			array_push($data,
				array(
					$rows['location_name'],
					$name,
					$creation->format('M / d / Y'),
					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_location('."'".$rows['location_id']."'".')">Edit</a>'.
					'<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_location('."'".$rows['location_id']."'".",'".$rows['location_name']."'".')">Delete</a>'
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	// U P D A T E
	public function edit()
	{
		$id=$this->input->post('location_id');
		$data=$this->Location->edit($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function update()
	{
		$validate = array (
			array('field'=>'location_name','label'=>'Location Name','rules'=>'trim|required|min_length[3]'),
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
				'location_id'=>$this->input->post('location_id'),
				'location_name'=>$this->input->post('location_name'),
				'city_id'=>$this->input->post('city_id'),
			);
			$this->Location->update($data);
			$info['message']="You have successfully updated <b>".$data['location_name']."</b>!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// D E L E T E
	public function delete()
	{
		$validate=array(
			array('field'=>'location_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			if($this->Route->find_Location($this->input->post('location_id')))
			{	
				$info['success']=FALSE;
				$info['errors']="Cannot Delete Location that's Currently on Route!";
			}
			else
			{
				$info['success']=TRUE;
				$data=array(
					'location_id'=>$this->input->post('location_id')
				);
				$name = $this->Location->get_Name($this->input->post('location_id'));
				$this->Location->delete($data);
				$info['message']='<b>'.$name.'</b> Successfully Deleted';
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////
}

// END OF LOCATIONS CONTROLLER