<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gps extends MY_Controller {
	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');

		$this->load->model('gps_model', 'Gps');
		// $this->load->model('ready_vehicles_model', 'Media');
		$this->load->model('deployment_model', 'Media');
	}
	public function browse()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Browse GPS';
		$data['breadcrumbs']=array
		(
			array('Browse GPS','gps/browse'),
		);
		$data['css']=array
		(
			'assets/css/browse_style.css',
			'assets/css/jquery.switchButton.css',
		);
		$data['script']=array
		(
			'assets/js/jquery.form.js',
			'assets/js/jquery.switchButton.js',
		);
		$data['page_description']='Browse GPS Records';

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'browse_gps';

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
			array('field'=>'gps_serial-add','label'=>'GPS Serial','rules'=>'trim|required|min_length[2]|is_unique[gps.gps_serial]'),
			array('field'=>'gps_description-add','label'=>'Description','rules'=>'trim|required'),
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
				'gps_serial'=>$this->input->post('gps_serial-add'),
				'gps_description'=>$this->input->post('gps_description-add'),
			);
			$info['id'] = $this->Gps->create($data);
			$info['tag'] = $data['gps_serial'];
			$info['message']="<p class='success-message'>You have successfully saved <span class='message-name'>".$data['gps_serial']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// R E A D
	public function show()
	{
		$table = $this->Gps->read();
		$assigned="";
		$status="";
		$data = array();
		foreach ($table as $rows) {
			if($this->Media->find_Gps($rows['gps_id']))
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="unassign_gps('."'".$rows['gps_id']."'".')">Unassign</a>';
			}
			else
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_gps('."'".$rows['gps_id']."'".')">Delete</a>';
			}
			if($rows['gps_status'])
			{
				$status =  '<div class="switch-wrapper">
			                  <input id="gps'.$rows['gps_id'].'" value="'.$rows['gps_id'].'" class="gps_status" onchange="switchStatus(\'#gps'.$rows['gps_id'].'\')" type="checkbox" checked>
			                </div>';
			}
			else
			{
				$status =  '<div class="switch-wrapper">
			                  <input id="gps'.$rows['gps_id'].'" value="'.$rows['gps_id'].'" class="gps_status" onchange="switchStatus(\'#gps'.$rows['gps_id'].'\')" type="checkbox">
			                </div>';
			}
			array_push($data,
				array(
					$rows['gps_serial'],
					$rows['info']."...",
					$status,
					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_gps('."'".$rows['gps_id']."'".')">Edit</a>'.
					$assigned,
				)
			);
		}
		if(count($data) > 0)
		{
			$data[0][2] = $data[0][2]."<script> gpsInit(); </script>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	// U P D A T E
	public function edit()
	{
		$id=$this->input->post('gps_id');
		$data=$this->Gps->edit($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function update()
	{
		$validate = array (
			array('field'=>'gps_serial','label'=>'GPS Serial','rules'=>'trim|required|min_length[2]'),
			array('field'=>'gps_description','label'=>'Description','rules'=>'trim|required'),
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
			$this->Gps->update($data);
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
				$this->Gps->delete($data);
				$info['message']='Data Successfully Deleted';
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
	// T O G G L E   S T A T U S
	public function toggle_Status()
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
			$status = $this->Gps->toggle_Status($data);
			$info['message']='GPS Successfully '.$status;
			// $this->sendLog($data['gps_id'], $status);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// S E N D   L O G S   T H A T   G P S   I S   T O G G L E D
	public function sendLog($id, $status)
	{
		
	}
	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////
}
// END OF GPS CONTROLLER