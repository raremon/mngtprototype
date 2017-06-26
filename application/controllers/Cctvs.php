<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cctvs extends MY_Controller {
	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');

		$this->load->model('cctvs_model', 'CCTV');
		// $this->load->model('ready_vehicles_model', 'Media');
		$this->load->model('deployment_model', 'Media');
	}
	public function browse()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Browse CCTVs';
		$data['breadcrumbs']=array
		(
			array('Browse CCTVs','cctvs/browse'),
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
		$data['page_description']='Browse CCTV Records';

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'browse_cctvs' ;

		$this->load->view("template/header", $data);
		$this->load->view("vehicles/cctv_browse", $data);
		$this->load->view("template/footer", $data);
	}
	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////
	// C R E A T E
	public function save()
	{
		$validate = array (
			array('field'=>'cctv_serial-add','label'=>'CCTV Serial','rules'=>'trim|required|min_length[2]|is_unique[cctvs.cctv_serial]'),
			array('field'=>'cctv_description-add','label'=>'Description','rules'=>'trim|required'),
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
				'cctv_serial'=>$this->input->post('cctv_serial-add'),
				'cctv_description'=>$this->input->post('cctv_description-add'),
			);
			$info['id'] = $this->CCTV->create($data);
			$info['tag'] = $data['cctv_serial'];
			$info['message']="<p class='success-message'>You have successfully saved <span class='message-name'>".$data['cctv_serial']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// R E A D
	public function show()
	{
		$table = $this->CCTV->read();
		$assigned="";
		$status="";
		$data = array();
		foreach ($table as $rows) {
			if($this->Media->find_Cctv($rows['cctv_id']))
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="unassign_cctv('."'".$rows['cctv_id']."'".')">Unassign</a>';
			}
			else
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_cctv('."'".$rows['cctv_id']."'".')">Delete</a>';
			}
			if($rows['cctv_status'])
			{
				$status =  '<div class="switch-wrapper">
			                  <input id="cctv'.$rows['cctv_id'].'" value="'.$rows['cctv_id'].'" class="cctv_status" onchange="switchStatus(\'#cctv'.$rows['cctv_id'].'\')" type="checkbox" checked>
			                </div>';
			}
			else
			{
				$status =  '<div class="switch-wrapper">
			                  <input id="cctv'.$rows['cctv_id'].'" value="'.$rows['cctv_id'].'" class="cctv_status" onchange="switchStatus(\'#cctv'.$rows['cctv_id'].'\')" type="checkbox">
			                </div>';
			}
			array_push($data,
				array(
					$rows['cctv_serial'],
					$rows['info']."...",
					$status,
					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_cctv('."'".$rows['cctv_id']."'".')">Edit</a>'.
					$assigned,
				)
			);
		}
		if(count($data) > 0)
		{
			$data[0][2] = $data[0][2]."<script> cctvInit(); </script>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	// U P D A T E
	public function edit()
	{
		$id=$this->input->post('cctv_id');
		$data=$this->CCTV->edit($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function update()
	{
		$validate = array (
			array('field'=>'cctv_serial','label'=>'CCTV Serial','rules'=>'trim|required|min_length[2]'),
			array('field'=>'cctv_description','label'=>'Description','rules'=>'trim|required'),
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
				'cctv_id'=>$this->input->post('cctv_id'),
				'cctv_serial'=>$this->input->post('cctv_serial'),
				'cctv_description'=>$this->input->post('cctv_description'),
			);
			$this->CCTV->update($data);
			$info['message']="<p class='success-message'>You have successfully updated <span class='message-name'>".$data['cctv_serial']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// D E L E T E
	public function delete()
	{
		$validate=array(
			array('field'=>'cctv_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			if($this->Media->find_Cctv($this->input->post('cctv_id')))
			{
				$info['success']=FALSE;
				$info['errors']="Cannot Delete Already Assigned CCTV!";
			}
			else
			{
				$info['success']=TRUE;
				$data=array(
					'cctv_id'=>$this->input->post('cctv_id')
				);
				$this->CCTV->delete($data);
				$info['message']='Data Successfully Deleted';
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// U N A S S I G N
	public function unassign()
	{
		$validate=array(
			array('field'=>'cctv_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'cctv_id'=>$this->input->post('cctv_id')
			);
			$this->Media->unassign_Cctv($data);
			$info['message']='CCTV Successfully Unassigned';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// T O G G L E   S T A T U S
	public function toggle_Status()
	{
		$validate=array(
			array('field'=>'cctv_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'cctv_id'=>$this->input->post('cctv_id')
			);
			$status = $this->CCTV->toggle_Status($data);
			$info['message']='CCTV Successfully '.$status;
			// $this->sendLog($data['cctv_id'], $status);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// S E N D   L O G S   T H A T   C C T V   I S   T O G G L E D
	public function sendLog($id, $status)
	{
		
	}
	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////
}
// END OF CCTV CONTROLLER