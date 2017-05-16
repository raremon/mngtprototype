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
			
	public function add()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='New Mediabox';
		$data['breadcrumbs']=array
		(
			array('New Mediabox','mediaboxes/add'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);
		$data['page_description']='Add New Mediabox Records';

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'new_mediabox' ;

		$this->load->view("template/header", $data);
		$this->load->view("vehicles/mediabox_add", $data);
		$this->load->view("template/footer", $data);
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
			
		);
		$data['script']=array
		(
			
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
			array('field'=>'box_tag','label'=>'Box Tag','rules'=>'required|min_length[2]|is_unique[mediaboxes.box_tag]'),
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
				'box_tag'=>$this->input->post('box_tag'),
			);
			$this->Box->save_Mediabox($data);
			$info['message']="You have successfully saved your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}


	// R E A D
	public function showBox()
	{
		$table = $this->Box->show_Mediabox();
		$assigned="";
		$data = array();
		foreach ($table as $rows) {
			$creation = new DateTime($rows['created_at']); 
			if($this->Media->find_Box($rows['box_id']))
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="unassign_box('."'".$rows['box_id']."'".')">Unassign</a>';
			}
			else
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_box('."'".$rows['box_id']."'".')">Delete</a>';
			}
			array_push($data,
				array(
					$rows['box_tag'],
					$creation->format('M / d / Y'),
					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_box('."'".$rows['box_id']."'".')">Edit</a>'.
					$assigned,
				)
			);
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
			array('field'=>'box_tag','label'=>'Box Tag','rules'=>'required|min_length[2]'),
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
			);
			$this->Box->update_Mediabox($data);
			$info['message']="You have successfully updated your data!";
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

	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////

}

// END OF BOX CONTROLLER