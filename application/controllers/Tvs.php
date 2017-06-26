<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tvs extends MY_Controller {
	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');

		$this->load->model('tvs_model', 'TV');
		// $this->load->model('ready_vehicles_model', 'Media');
		$this->load->model('deployment_model', 'Media');
	}
	public function browse()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Browse Television';
		$data['breadcrumbs']=array
		(
			array('Browse Television','tvs/browse'),
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
		$data['page_description']='Browse Television Records';

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'browse_tvs' ;

		$this->load->view("template/header", $data);
		$this->load->view("vehicles/tv_browse", $data);
		$this->load->view("template/footer", $data);
	}
	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////
	// C R E A T E
	public function save()
	{
		$validate = array (
			array('field'=>'tv_serial-add','label'=>'Television Serial','rules'=>'trim|required|min_length[2]|is_unique[tvs.tv_serial]'),
			array('field'=>'tv_description-add','label'=>'Description','rules'=>'trim|required'),
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
				'tv_serial'=>$this->input->post('tv_serial-add'),
				'tv_description'=>$this->input->post('tv_description-add'),
			);
			$info['id'] = $this->TV->create($data);
			$info['tag'] = $data['tv_serial'];
			$info['message']="<p class='success-message'>You have successfully saved <span class='message-name'>".$data['tv_serial']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// R E A D
	public function show()
	{
		$table = $this->TV->read();
		$assigned="";
		$status="";
		$data = array();
		foreach ($table as $rows) {
			if($this->Media->find_Tv($rows['tv_id']))
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="unassign_tv('."'".$rows['tv_id']."'".')">Unassign</a>';
			}
			else
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_tv('."'".$rows['tv_id']."'".')">Delete</a>';
			}
			if($rows['tv_status'])
			{
				$status =  '<div class="switch-wrapper">
			                  <input id="tv'.$rows['tv_id'].'" value="'.$rows['tv_id'].'" class="tv_status" onchange="switchStatus(\'#tv'.$rows['tv_id'].'\')" type="checkbox" checked>
			                </div>';
			}
			else
			{
				$status =  '<div class="switch-wrapper">
			                  <input id="tv'.$rows['tv_id'].'" value="'.$rows['tv_id'].'" class="tv_status" onchange="switchStatus(\'#tv'.$rows['tv_id'].'\')" type="checkbox">
			                </div>';
			}
			array_push($data,
				array(
					$rows['tv_serial'],
					$rows['info']."...",
					$status,
					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_tv('."'".$rows['tv_id']."'".')">Edit</a>'.
					$assigned,
				)
			);
		}
		if(count($data) > 0)
		{
			$data[0][2] = $data[0][2]."<script> tvInit(); </script>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	// U P D A T E
	public function edit()
	{
		$id=$this->input->post('tv_id');
		$data=$this->TV->edit($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function update()
	{
		$validate = array (
			array('field'=>'tv_serial','label'=>'Television Serial','rules'=>'trim|required|min_length[2]'),
			array('field'=>'tv_description','label'=>'Description','rules'=>'trim|required'),
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
				'tv_id'=>$this->input->post('tv_id'),
				'tv_serial'=>$this->input->post('tv_serial'),
				'tv_description'=>$this->input->post('tv_description'),
			);
			$this->TV->update($data);
			$info['message']="<p class='success-message'>You have successfully updated <span class='message-name'>".$data['tv_serial']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// D E L E T E
	public function delete()
	{
		$validate=array(
			array('field'=>'tv_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			if($this->Media->find_Tv($this->input->post('tv_id')))
			{
				$info['success']=FALSE;
				$info['errors']="Cannot Delete Already Assigned TV!";
			}
			else
			{
				$info['success']=TRUE;
				$data=array(
					'tv_id'=>$this->input->post('tv_id')
				);
				$this->TV->delete($data);
				$info['message']='Data Successfully Deleted';
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// U N A S S I G N
	public function unassign()
	{
		$validate=array(
			array('field'=>'tv_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'tv_id'=>$this->input->post('tv_id')
			);
			$this->Media->unassign_TV($data);
			$info['message']='Television Successfully Unassigned';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// T O G G L E   S T A T U S
	public function toggle_Status()
	{
		$validate=array(
			array('field'=>'tv_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'tv_id'=>$this->input->post('tv_id')
			);
			$status = $this->TV->toggle_Status($data);
			$info['message']='Television Successfully '.$status;
			// $this->sendLog($data['tv_id'], $status);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// S E N D   L O G S   T H A T   T E L E V I S I O N   I S   T O G G L E D
	public function sendLog($id, $status)
	{
	}
	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////
}
// END OF TELEVISION CONTROLLER