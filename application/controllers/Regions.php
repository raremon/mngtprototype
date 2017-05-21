<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regions extends MY_Controller {

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');

		$this->load->model('regions_model', 'Region');
		$this->load->model('cities_model', 'City');
	}
			
	public function add()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='New Region';
		$data['breadcrumbs']=array
		(
			array('New Region','regions/add'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);
		$data['page_description']='Add New Region Records';

		$data['treeActive'] = 'route_management';
		$data['childActive'] = 'browse_regions' ;

		$this->load->view("template/header", $data);
		$this->load->view("routes/region_add", $data);
		$this->load->view("template/footer", $data);
	}

	public function browse()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Browse Regions';
		$data['breadcrumbs']=array
		(
			array('Browse Regions','regions/browse'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);
		$data['page_description']='Browse Region Records';

		$data['treeActive'] = 'route_management';
		$data['childActive'] = 'browse_regions' ;

		$this->load->view("template/header", $data);
		$this->load->view("routes/region_browse", $data);
		$this->load->view("template/footer", $data);
	}

	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////

	// C R E A T E
	public function saveRegion()
	{
		$validate = array (
			array('field'=>'region_name','label'=>'Region Name','rules'=>'trim|required|min_length[3]'),
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
				'region_name'=>$this->input->post('region_name'),
			);
			$this->Region->save_Region($data);
			$info['message']="You have successfully saved your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}


	// R E A D
	public function showRegion()
	{
		$region_table = $this->Region->show_Region();
		$data = array();
		foreach ($region_table as $rows) {
			$creation = new DateTime($rows['created_at']); 
			array_push($data,
				array(
					$rows['region_name'],
					$creation->format('M / d / Y'),
					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_region('."'".$rows['region_id']."'".')">Edit</a>'.
					'<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_region('."'".$rows['region_id']."'".')">Delete</a>'
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}

	// U P D A T E
	public function editRegion()
	{
		$region_id=$this->input->post('region_id');
		$data=$this->Region->edit_Region($region_id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function updateRegion()
	{

		$validate = array (
			array('field'=>'region_name','label'=>'Region Name','rules'=>'trim|required|min_length[3]'),
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
				'region_id'=>$this->input->post('region_id'),
				'region_name'=>$this->input->post('region_name'),
			);
			$this->Region->update_Region($data);
			$info['message']="You have successfully updated your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// D E L E T E
	public function delete_Region()
	{
		$validate=array(
			array('field'=>'region_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			if($this->City->find_Region($this->input->post('region_id')))
			{
				$info['success']=FALSE;
				$info['errors']="Cannot Delete A Non-Empty Region!";
			}
			else
			{
				$info['success']=TRUE;
				$data=array(
					'region_id'=>$this->input->post('region_id')
				);
				$this->Region->delete_Region($data);
				$info['message']='Data Successfully Deleted';
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////

}

// END OF REGION CONTROLLER