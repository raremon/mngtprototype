<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tvs extends MY_Controller {

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');

		$this->load->model('tvs_model', 'Tv');
		$this->load->model('ready_vehicles_model', 'Media');
	}
			
	public function add()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='New TV';
		$data['breadcrumbs']=array
		(
			array('New TV','tvs/add'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);
		$data['page_description']='Add New TV Records';

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'browse_tvs' ;

		$this->load->view("template/header", $data);
		$this->load->view("vehicles/tv_add", $data);
		$this->load->view("template/footer", $data);
	}

	public function browse()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Browse Tvs';
		$data['breadcrumbs']=array
		(
			array('Browse Tvs','tvs/browse'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
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
	public function saveTv()
	{
		$validate = array (
			array('field'=>'tv_serial','label'=>'TV\'s Serial','rules'=>'required|min_length[2]|is_unique[tvs.tv_serial]'),
			array('field'=>'tv_description','label'=>'TV\'s Description','rules'=>'required|min_length[2]'),
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
				'tv_serial'=>$this->input->post('tv_serial'),
				'tv_description'=>$this->input->post('tv_description'),
			);
			$this->Tv->save_Tv($data);
			$info['message']="You have successfully saved your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// R E A D
	public function showTv()
	{
		$table = $this->Tv->show_Tv();
		$assigned="";
		$data = array();
		foreach ($table as $rows) {
			$creation = new DateTime($rows['created_at']); 
			if($this->Media->find_Tv($rows['tv_id']))
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="unassign_tv('."'".$rows['tv_id']."'".')">Unassign</a>';
			}
			else
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_tv('."'".$rows['tv_id']."'".')">Delete</a>';
			}
			array_push($data,
				array(
					$rows['tv_serial'],
					$rows['tv_description'],
					$creation->format('M / d / Y'),
					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_tv('."'".$rows['tv_id']."'".')">Edit</a>'.
					$assigned,
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}

	// U P D A T E
	public function editTv()
	{
		$id=$this->input->post('tv_id');
		$data=$this->Tv->edit_Tv($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function updateTv()
	{
		$validate = array (
			array('field'=>'tv_serial','label'=>'TV\'s Serial','rules'=>'required|min_length[2]'),
			array('field'=>'tv_description','label'=>'TV\'s Description','rules'=>'required|min_length[2]'),
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
			$this->Tv->update_Tv($data);
			$info['message']="You have successfully updated your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// D E L E T E
	public function delete_Tv()
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
				$info['errors']="Cannot Delete Already Assigned Tv!";
			}
			else
			{
				$info['success']=TRUE;
				$data=array(
					'tv_id'=>$this->input->post('tv_id')
				);
				$this->Tv->delete_Tv($data);
				$info['message']='Data Successfully Deleted';
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// U N A S S I G N
	public function unassign_Tv()
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
			$this->Media->unassign_Tv($data);
			$info['message']='Tv Successfully Unassigned';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////

}

// END OF TVS CONTROLLER