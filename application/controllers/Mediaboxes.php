<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mediaboxes extends MY_Controller {
	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');

		$this->load->model('mediaboxes_model', 'Box');
		$this->load->model('ready_vehicles_model', 'Media');
	}
	public function browse()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Browse Mediaboxes';
		$data['breadcrumbs']=array
		(
			array('Browse Mediaboxes','mediaboxes/browse'),
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
		$data['page_description']='Browse Mediabox Records';

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'browse_mediaboxes' ;

		$this->load->view("template/header", $data);
		$this->load->view("vehicles/mediabox_browse", $data);
		$this->load->view("template/footer", $data);
	}
	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////
	// C R E A T E
	public function saveBox()
	{
		$validate = array (
			array('field'=>'box_tag-add','label'=>'Box Tag','rules'=>'trim|required|min_length[2]|is_unique[mediaboxes.box_tag]'),
			array('field'=>'box_description-add','label'=>'Description','rules'=>'trim|required'),
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
				'box_tag'=>$this->input->post('box_tag-add'),
				'box_description'=>$this->input->post('box_description-add'),
			);
			$this->Box->save_Mediabox($data);
			$info['message']="<p class='success-message'>You have successfully saved <span class='message-name'>".$data['box_tag']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// R E A D
	public function showBox()
	{
		$table = $this->Box->show_Mediabox();
		$assigned="";
		$status="";
		$data = array();
		foreach ($table as $rows) {
			if($this->Media->find_Box($rows['box_id']))
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="unassign_box('."'".$rows['box_id']."'".')">Unassign</a>';
			}
			else
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_box('."'".$rows['box_id']."'".')">Delete</a>';
			}
			if($rows['box_status'])
			{
				$status =  '<div class="switch-wrapper">
			                  <input id="box'.$rows['box_id'].'" value="'.$rows['box_id'].'" class="box_status" onchange="switchStatus(\'#box'.$rows['box_id'].'\')" type="checkbox" checked>
			                </div>';
			}
			else
			{
				$status =  '<div class="switch-wrapper">
			                  <input id="box'.$rows['box_id'].'" value="'.$rows['box_id'].'" class="box_status" onchange="switchStatus(\'#box'.$rows['box_id'].'\')" type="checkbox">
			                </div>';
			}
			array_push($data,
				array(
					$rows['box_tag'],
					$rows['info']."...",
					$status,
					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_box('."'".$rows['box_id']."'".')">Edit</a>'.
					$assigned,
				)
			);
		}
		if(count($data) > 0)
		{
			$data[0][2] = $data[0][2]."<script> checkInit(); </script>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	// U P D A T E
	public function editBox()
	{
		$id=$this->input->post('box_id');
		$data=$this->Box->edit_Mediabox($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function updateBox()
	{
		$validate = array (
			array('field'=>'box_tag','label'=>'Box Tag','rules'=>'trim|required|min_length[2]'),
			array('field'=>'box_description','label'=>'Description','rules'=>'trim|required'),
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
				'box_id'=>$this->input->post('box_id'),
				'box_tag'=>$this->input->post('box_tag'),
				'box_description'=>$this->input->post('box_description'),
			);
			$this->Box->update_Mediabox($data);
			$info['message']="<p class='success-message'>You have successfully updated <span class='message-name'>".$data['box_tag']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// D E L E T E
	public function delete_Box()
	{
		$validate=array(
			array('field'=>'box_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			if($this->Media->find_Box($this->input->post('box_id')))
			{
				$info['success']=FALSE;
				$info['errors']="Cannot Delete Already Assigned Mediabox!";
			}
			else
			{
				$info['success']=TRUE;
				$data=array(
					'box_id'=>$this->input->post('box_id')
				);
				$this->Box->delete_Mediabox($data);
				$info['message']='Data Successfully Deleted';
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// U N A S S I G N
	public function unassign_Box()
	{
		$validate=array(
			array('field'=>'box_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'box_id'=>$this->input->post('box_id')
			);
			$this->Media->unassign_Box($data);
			$info['message']='Box Successfully Unassigned';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// T O G G L E   S T A T U S
	public function toggle_Status()
	{
		$validate=array(
			array('field'=>'box_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'box_id'=>$this->input->post('box_id')
			);
			$status = $this->Box->toggle_Status($data);
			$info['message']='Box Successfully '.$status;
			// $this->sendBoxLog($data['box_id'], $status);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// S E N D   L O G S   T H A T   M E D I A B O X   I S   T O G G L E D
	public function sendBoxLog($box_id, $status)
	{
		
	}
	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////
}
// END OF BOX CONTROLLER