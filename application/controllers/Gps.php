<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gps extends MY_Controller {

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');

		$this->load->model('gps_model', 'GPS');
		$this->load->model('ready_vehicles_model', 'Media');
	}
			
	public function add()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='New GPS';
		$data['breadcrumbs']=array
		(
			array('Browse GPS\'','gps/browse'),
			array('New GPS','gps/add'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);
		$data['page_description']='Add New Global Positioning System Records';

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'browse_gps' ;

		$this->load->view("template/header", $data);
		$this->load->view("vehicles/gps_add", $data);
		$this->load->view("template/footer", $data);
	}

	public function browse()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Browse GPS\'';
		$data['breadcrumbs']=array
		(
			array('Browse GPS\'','gps/browse'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);
		$data['page_description']='Browse Global Positioning System Records';

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'browse_gps' ;

		$this->load->view("template/header", $data);
		$this->load->view("vehicles/gps_browse", $data);
		$this->load->view("template/footer", $data);
	}

	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////
	// C R E A T E
	public function save()
	{
		$validate = array (
			array('field'=>'gps_serial','label'=>'GPS\' Serial','rules'=>'required|min_length[2]|is_unique[card_readers.card_serial]'),
			array('field'=>'gps_description','label'=>'GPS\' Description','rules'=>'required|min_length[2]'),
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
				'gps_serial'=>$this->input->post('gps_serial'),
				'gps_description'=>$this->input->post('gps_description'),
			);
			$this->GPS->create($data);
			$info['message']="<p class='success-message'>You have successfully saved <span class='message-name'>".$data['gps_serial']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// R E A D
	public function show()
	{
		$table = $this->GPS->read();
		$assigned="";
		$data = array();
		foreach ($table as $rows) {
			$creation = new DateTime($rows['created_at']); 
			if($this->Media->find_Gps($rows['gps_id']))
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="unassign_gps('."'".$rows['gps_id']."'".')">Unassign</a>';
			}
			else
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_gps('."'".$rows['gps_id']."'".')">Delete</a>';
			}
			array_push($data,
				array(
					$rows['gps_serial'],
					$rows['gps_description'],
					$creation->format('M / d / Y'),
					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_gps('."'".$rows['gps_id']."'".')">Edit</a>'.
					$assigned,
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	// U P D A T E
	public function edit()
	{
		$id=$this->input->post('gps_id');
		$data=$this->GPS->edit($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function update()
	{
		$validate = array (
			array('field'=>'gps_serial','label'=>'GPS\' Serial','rules'=>'required|min_length[2]'),
			array('field'=>'gps_description','label'=>'GPS\' Description','rules'=>'required|min_length[2]'),
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
				'gps_id'=>$this->input->post('gps_id'),
				'gps_serial'=>$this->input->post('gps_serial'),
				'gps_description'=>$this->input->post('gps_description'),
			);
			$this->GPS->update($data);
			$info['message']="<p class='success-message'>You have successfully updated <span class='message-name'>".$data['gps_serial']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// D E L E T E
	public function delete()
	{
		$validate=array(
			array('field'=>'gps_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			if($this->Media->find_Gps($this->input->post('gps_id')))
			{
				$info['success']=FALSE;
				$info['errors']="Cannot Delete Already Assigned GPS!";
			}
			else
			{
				$info['success']=TRUE;
				$data=array(
					'gps_id'=>$this->input->post('gps_id')
				);
				$this->GPS->delete($data);
				$info['message']='GPS Successfully Deleted';
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// U N A S S I G N
	public function unassign()
	{
		$validate=array(
			array('field'=>'gps_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'gps_id'=>$this->input->post('gps_id')
			);
			$this->Media->unassign_Gps($data);
			$info['message']='GPS Successfully Unassigned';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////
}

// END OF GPS CONTROLLER