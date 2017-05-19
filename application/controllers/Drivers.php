<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drivers extends MY_Controller {

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');

		$this->load->model('drivers_model', 'Driver');
		$this->load->model('active_vehicles_model', 'Active');
	}
			
	public function add()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='New Driver';
		$data['breadcrumbs']=array
		(
			array('New Driver','drivers/add'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);
		$data['page_description']='Add New Driver Records';

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'new_driver' ;

		$this->load->view("template/header", $data);
		$this->load->view("users/driver_add", $data);
		$this->load->view("template/footer", $data);
	}

	public function browse()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Browse Drivers';
		$data['breadcrumbs']=array
		(
			array('Browse Drivers','drivers/browse'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);
		$data['page_description']='Browse Driver Records';

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'browse_drivers' ;

		$this->load->view("template/header", $data);
		$this->load->view("users/driver_browse", $data);
		$this->load->view("template/footer", $data);
	}

	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////

	// C R E A T E
	public function saveDriver()
	{
		$validate = array (
			array('field'=>'driver_fname','label'=>'First Name','rules'=>'required|min_length[2]'),
			array('field'=>'driver_mname','label'=>'Last Name','rules'=>'required|min_length[2]'),
			array('field'=>'driver_lname','label'=>'Last Name','rules'=>'required|min_length[2]'),
			array('field'=>'driver_contact','label'=>'Contact Information','rules'=>'trim|required'),
			array('field'=>'driver_address','label'=>'Address','rules'=>'required'),
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
				'driver_fname'=>$this->input->post('driver_fname'),
				'driver_mname'=>$this->input->post('driver_mname'),
				'driver_lname'=>$this->input->post('driver_lname'),
				'driver_contact'=>$this->input->post('driver_contact'),
				'driver_address'=>$this->input->post('driver_address'),
			);
			$this->Driver->save_Driver($data);
			$info['message']="You have successfully saved your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}


	// R E A D
	public function showDriver()
	{
		$driver_table = $this->Driver->show_Driver();
		$assigned="";
		$data = array();
		foreach ($driver_table as $rows) {
			$creation = new DateTime($rows['created_at']); 
			if($this->Active->find_Driver($rows['driver_id']))
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="unassign_driver('."'".$rows['driver_id']."'".')">Unassign</a>';
			}
			else
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_driver('."'".$rows['driver_id']."'".')">Delete</a>';
			}
			array_push($data,
				array(
					$rows['driver_fname']." ".substr($rows['driver_mname'],0,1).". ".$rows['driver_lname'],
					$rows['driver_contact'],
					$rows['driver_address'],
					$creation->format('M / d / Y'),
					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_driver('."'".$rows['driver_id']."'".')">Edit</a>'.
					$assigned,
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}

	// U P D A T E
	public function editDriver()
	{
		$driver_id=$this->input->post('driver_id');
		$data=$this->Driver->edit_Driver($driver_id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function updateDriver()
	{

		$validate = array (
			array('field'=>'driver_fname','label'=>'First Name','rules'=>'required|min_length[2]'),
			array('field'=>'driver_mname','label'=>'Last Name','rules'=>'required|min_length[2]'),
			array('field'=>'driver_lname','label'=>'Last Name','rules'=>'required|min_length[2]'),
			array('field'=>'driver_contact','label'=>'Contact Information','rules'=>'trim|required'),
			array('field'=>'driver_address','label'=>'Address','rules'=>'required'),
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
				'driver_id'=>$this->input->post('driver_id'),
				'driver_fname'=>$this->input->post('driver_fname'),
				'driver_mname'=>$this->input->post('driver_mname'),
				'driver_lname'=>$this->input->post('driver_lname'),
				'driver_contact'=>$this->input->post('driver_contact'),
				'driver_address'=>$this->input->post('driver_address'),
			);
			$this->Driver->update_Driver($data);
			$info['message']="You have successfully updated your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// D E L E T E
	public function delete_Driver()
	{
		$validate=array(
			array('field'=>'driver_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			if($this->Active->find_Driver($this->input->post('driver_id')))
			{	
				$info['success']=FALSE;
				$info['errors']="Cannot Delete Driver that's Currently Assigned on Bus!<br><h3>UNASSIGN FIRST</h3>";
			}
			else
			{
				$info['success']=TRUE;
				$data=array(
					'driver_id'=>$this->input->post('driver_id')
				);
				$this->Driver->delete_Driver($data);
				$info['message']='Data Successfully Deleted';
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// U N A S S I G N
	public function unassign_Driver()
	{
		$validate=array(
			array('field'=>'driver_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'driver_id'=>$this->input->post('driver_id')
			);
			$this->Active->unassign_Driver($data);
			$info['message']='Driver Successfully Unassigned';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////

}

// END OF DRIVERS CONTROLLER