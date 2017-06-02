<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cities extends MY_Controller {

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');

		$this->load->model('routes_model', 'Route');
		$this->load->model('cities_model', 'City');
		$this->load->model('locations_model', 'Location');
		$this->load->model('regions_model', 'Region');
	}
			
	public function add()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='New City';
		$data['breadcrumbs']=array
		(
			array('Browse Cities','cities/browse'),
			array('New City','cities/add'),
		);
		$data['css']=array
		(
			// custom css here
		);
		$data['script']=array
		(
			// custom script here
		);

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

		$data['page_description']='Add New City Records';

		$data['treeActive'] = 'route_management';
		$data['childActive'] = 'browse_cities' ;

		$this->load->view("template/header", $data);
		$this->load->view("routes/city_add", $data);
		$this->load->view("template/footer", $data);
	}

	public function browse()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Browse Cities';
		$data['breadcrumbs']=array
		(
			array('Browse Cities','cities/browse'),
		);
		$data['css']=array
		(
			// custom css here
		);
		$data['script']=array
		(
			// custom script here
		);

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

		$data['page_description']='Browse City Records';

		$data['treeActive'] = 'route_management';
		$data['childActive'] = 'browse_cities' ;

		$this->load->view("template/header", $data);
		$this->load->view("routes/city_browse", $data);
		$this->load->view("template/footer", $data);
	}

	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////

	// C R E A T E
	public function saveCity()
	{
		$validate = array (
			array('field'=>'city_name','label'=>'City Name','rules'=>'trim|required|min_length[3]|is_unique[cities.city_name]'),
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
				'city_name'=>$this->input->post('city_name'),
				'region_id'=>$this->input->post('region_id'),
			);
			$this->City->save_City($data);
			$info['message']="You have successfully saved your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}


	// R E A D
	public function showCity()
	{
		$city_table = $this->City->show_City();
		$data = array();
		foreach ($city_table as $rows) {
			$creation = new DateTime($rows['created_at']); 
			$region_name = $this->Region->get_Region_Name($rows['region_id']);
			array_push($data,
				array(
					$rows['city_name'],
					$region_name['region_abbr']." : ".$region_name['region_name'],
					$creation->format('M / d / Y'),
					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_city('."'".$rows['city_id']."'".')">Edit</a>'.
					'<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_city('."'".$rows['city_id']."'".')">Delete</a>'
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}

	// U P D A T E
	public function editCity()
	{
		$city_id=$this->input->post('city_id');
		$data=$this->City->edit_City($city_id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function updateCity()
	{

		$validate = array (
			array('field'=>'city_name','label'=>'City Name','rules'=>'trim|required|min_length[3]'),
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
				'city_id'=>$this->input->post('city_id'),
				'city_name'=>$this->input->post('city_name'),
				'region_id'=>$this->input->post('region_id'),
			);
			$this->City->update_City($data);
			$info['message']="You have successfully updated your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// D E L E T E
	public function delete_City()
	{
		$validate=array(
			array('field'=>'city_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			if($this->Location->find_City($this->input->post('city_id')))
			{	
				$info['success']=FALSE;
				$info['errors']="Cannot Delete City that has an Location";
			}
			else
			{
				$info['success']=TRUE;
				$data=array(
					'city_id'=>$this->input->post('city_id')
				);
				$this->City->delete_City($data);
				$info['message']='Data Successfully Deleted';
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////

}

// END OF CITY CONTROLLER