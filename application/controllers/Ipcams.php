<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ipcams extends MY_Controller {
	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');

		$this->load->model('ipcams_model', 'Ipcam');
		// $this->load->model('ready_vehicles_model', 'Media');
		$this->load->model('deployment_model', 'Media');
	}
	public function browse()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Browse IP Cameras';
		$data['breadcrumbs']=array
		(
			array('Browse IP Cameras','ipcams/browse'),
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
		$data['page_description']='Browse IP Camera Records';

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'browse_ip_cameras' ;

		$this->load->view("template/header", $data);
		$this->load->view("vehicles/ipcam_browse", $data);
		$this->load->view("template/footer", $data);
	}
	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////
	// C R E A T E
	public function save()
	{
		$validate = array (
			array('field'=>'ipcam_serial-add','label'=>'IP Camera Serial','rules'=>'trim|required|min_length[2]|is_unique[ip_cameras.ipcam_serial]'),
			array('field'=>'ipcam_description-add','label'=>'Description','rules'=>'trim|required'),
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
				'ipcam_serial'=>$this->input->post('ipcam_serial-add'),
				'ipcam_description'=>$this->input->post('ipcam_description-add'),
			);
			$info['id'] = $this->Ipcam->create($data);
			$info['tag'] = $data['ipcam_serial'];
			$info['message']="<p class='success-message'>You have successfully saved <span class='message-name'>".$data['ipcam_serial']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// R E A D
	public function show()
	{
		$table = $this->Ipcam->read();
		$assigned="";
		$status="";
		$data = array();
		foreach ($table as $rows) {
			if($this->Media->find_Ipcam($rows['ipcam_id']))
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="unassign_ipcam('."'".$rows['ipcam_id']."'".')">Unassign</a>';
			}
			else
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_ipcam('."'".$rows['ipcam_id']."'".')">Delete</a>';
			}
			if($rows['ipcam_status'])
			{
				$status =  '<div class="switch-wrapper">
			                  <input id="ipcam'.$rows['ipcam_id'].'" value="'.$rows['ipcam_id'].'" class="ipcam_status" onchange="switchStatus(\'#ipcam'.$rows['ipcam_id'].'\')" type="checkbox" checked>
			                </div>';
			}
			else
			{
				$status =  '<div class="switch-wrapper">
			                  <input id="ipcam'.$rows['ipcam_id'].'" value="'.$rows['ipcam_id'].'" class="ipcam_status" onchange="switchStatus(\'#ipcam'.$rows['ipcam_id'].'\')" type="checkbox">
			                </div>';
			}
			array_push($data,
				array(
					$rows['ipcam_serial'],
					$rows['info']."...",
					$status,
					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_ipcam('."'".$rows['ipcam_id']."'".')">Edit</a>'.
					$assigned,
				)
			);
		}
		if(count($data) > 0)
		{
			$data[0][2] = $data[0][2]."<script> ipcamInit(); </script>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	// U P D A T E
	public function edit()
	{
		$id=$this->input->post('ipcam_id');
		$data=$this->Ipcam->edit($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function update()
	{
		$validate = array (
			array('field'=>'ipcam_serial','label'=>'Ip Camera Serial','rules'=>'trim|required|min_length[2]'),
			array('field'=>'ipcam_description','label'=>'Description','rules'=>'trim|required'),
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
				'ipcam_id'=>$this->input->post('ipcam_id'),
				'ipcam_serial'=>$this->input->post('ipcam_serial'),
				'ipcam_description'=>$this->input->post('ipcam_description'),
			);
			$this->Ipcam->update($data);
			$info['message']="<p class='success-message'>You have successfully updated <span class='message-name'>".$data['ipcam_serial']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// D E L E T E
	public function delete()
	{
		$validate=array(
			array('field'=>'ipcam_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			if($this->Media->find_Ipcam($this->input->post('ipcam_id')))
			{
				$info['success']=FALSE;
				$info['errors']="Cannot Delete Already Assigned IP Camera!";
			}
			else
			{
				$info['success']=TRUE;
				$data=array(
					'ipcam_id'=>$this->input->post('ipcam_id')
				);
				$this->Ipcam->delete($data);
				$info['message']='Data Successfully Deleted';
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// U N A S S I G N
	public function unassign()
	{
		$validate=array(
			array('field'=>'ipcam_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'ipcam_id'=>$this->input->post('ipcam_id')
			);
			$this->Media->unassign_Ipcam($data);
			$info['message']='IP Camera Successfully Unassigned';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// T O G G L E   S T A T U S
	public function toggle_Status()
	{
		$validate=array(
			array('field'=>'ipcam_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'ipcam_id'=>$this->input->post('ipcam_id')
			);
			$status = $this->Ipcam->toggle_Status($data);
			$info['message']='IP Camera Successfully '.$status;
			// $this->sendLog($data['ipcam_id'], $status);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// S E N D   L O G S   T H A T   I P C A M E R A   I S   T O G G L E D
	public function sendLog($id, $status)
	{
		
	}
	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////
}
// END OF IP CAMERA CONTROLLER