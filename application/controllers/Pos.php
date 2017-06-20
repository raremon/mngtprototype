<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pos extends MY_Controller {
	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');

		$this->load->model('pos_model', 'Pos');
		$this->load->model('ready_vehicles_model', 'Media');
	}
	public function browse()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Browse POS';
		$data['breadcrumbs']=array
		(
			array('Browse POS','pos/browse'),
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
		$data['page_description']='Browse POS Records';

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'browse_pos' ;

		$this->load->view("template/header", $data);
		$this->load->view("vehicles/pos_browse", $data);
		$this->load->view("template/footer", $data);
	}
	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////
	// C R E A T E
	public function save()
	{
		$validate = array (
			array('field'=>'pos_serial-add','label'=>'POS Serial','rules'=>'trim|required|min_length[2]|is_unique[pos.pos_serial]'),
			array('field'=>'pos_description-add','label'=>'Description','rules'=>'trim|required'),
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
				'pos_serial'=>$this->input->post('pos_serial-add'),
				'pos_description'=>$this->input->post('pos_description-add'),
			);
			$this->Pos->create($data);
			$info['message']="<p class='success-message'>You have successfully saved <span class='message-name'>".$data['pos_serial']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// R E A D
	public function show()
	{
		$table = $this->Pos->read();
		$assigned="";
		$status="";
		$data = array();
		foreach ($table as $rows) {
			if($this->Media->find_Pos($rows['pos_id']))
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="unassign_pos('."'".$rows['pos_id']."'".')">Unassign</a>';
			}
			else
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_pos('."'".$rows['pos_id']."'".')">Delete</a>';
			}
			if($rows['pos_status'])
			{
				$status =  '<div class="switch-wrapper">
			                  <input id="pos'.$rows['pos_id'].'" value="'.$rows['pos_id'].'" class="pos_status" onchange="switchStatus(\'#pos'.$rows['pos_id'].'\')" type="checkbox" checked>
			                </div>';
			}
			else
			{
				$status =  '<div class="switch-wrapper">
			                  <input id="pos'.$rows['pos_id'].'" value="'.$rows['pos_id'].'" class="pos_status" onchange="switchStatus(\'#pos'.$rows['pos_id'].'\')" type="checkbox">
			                </div>';
			}
			array_push($data,
				array(
					$rows['pos_serial'],
					$rows['info']."...",
					$status,
					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_pos('."'".$rows['pos_id']."'".')">Edit</a>'.
					$assigned,
				)
			);
		}
		if(count($data) > 0)
		{
			$data[0][2] = $data[0][2]."<script> posInit(); </script>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	// U P D A T E
	public function edit()
	{
		$id=$this->input->post('pos_id');
		$data=$this->Pos->edit($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function update()
	{
		$validate = array (
			array('field'=>'pos_serial','label'=>'POS Serial','rules'=>'trim|required|min_length[2]'),
			array('field'=>'pos_description','label'=>'Description','rules'=>'trim|required'),
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
				'pos_id'=>$this->input->post('pos_id'),
				'pos_serial'=>$this->input->post('pos_serial'),
				'pos_description'=>$this->input->post('pos_description'),
			);
			$this->Pos->update($data);
			$info['message']="<p class='success-message'>You have successfully updated <span class='message-name'>".$data['pos_serial']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// D E L E T E
	public function delete()
	{
		$validate=array(
			array('field'=>'pos_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			if($this->Media->find_Pos($this->input->post('pos_id')))
			{
				$info['success']=FALSE;
				$info['errors']="Cannot Delete Already Assigned POS!";
			}
			else
			{
				$info['success']=TRUE;
				$data=array(
					'pos_id'=>$this->input->post('pos_id')
				);
				$this->Pos->delete($data);
				$info['message']='Data Successfully Deleted';
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// U N A S S I G N
	public function unassign()
	{
		$validate=array(
			array('field'=>'pos_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'pos_id'=>$this->input->post('pos_id')
			);
			$this->Media->unassign_Pos($data);
			$info['message']='POS Successfully Unassigned';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// T O G G L E   S T A T U S
	public function toggle_Status()
	{
		$validate=array(
			array('field'=>'pos_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'pos_id'=>$this->input->post('pos_id')
			);
			$status = $this->Pos->toggle_Status($data);
			$info['message']='POS Successfully '.$status;
			// $this->sendLog($data['pos_id'], $status);
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
// END OF POS CONTROLLER