<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Card_readers extends MY_Controller {

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');

		$this->load->model('card_readers_model', 'Card');
		$this->load->model('ready_vehicles_model', 'Media');
	}
			
	public function add()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='New Card Reader';
		$data['breadcrumbs']=array
		(
			array('Browse Card Readers','card_readers/browse'),
			array('New Card Reader','card_readers/add'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);
		$data['page_description']='Add New Card Reader Records';

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'browse_card_readers' ;

		$this->load->view("template/header", $data);
		$this->load->view("vehicles/card_add", $data);
		$this->load->view("template/footer", $data);
	}

	public function browse()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Browse Card Readers';
		$data['breadcrumbs']=array
		(
			array('Browse Card Readers','card_readers/browse'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);
		$data['page_description']='Browse Card Reader Records';

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'browse_card_readers' ;

		$this->load->view("template/header", $data);
		$this->load->view("vehicles/card_browse", $data);
		$this->load->view("template/footer", $data);
	}

	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////
	// C R E A T E
	public function save()
	{
		$validate = array (
			array('field'=>'card_serial','label'=>'Card Reader\'s Serial','rules'=>'required|min_length[2]|is_unique[card_readers.card_serial]'),
			array('field'=>'card_description','label'=>'Card Reader\'s Description','rules'=>'required|min_length[2]'),
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
				'card_serial'=>$this->input->post('card_serial'),
				'card_description'=>$this->input->post('card_description'),
			);
			$this->Card->create($data);
			$info['message']="<p class='success-message'>You have successfully saved <span class='message-name'>".$data['card_serial']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// R E A D
	public function show()
	{
		$table = $this->Card->read();
		$assigned="";
		$data = array();
		foreach ($table as $rows) {
			$creation = new DateTime($rows['created_at']); 
			if($this->Media->find_Card($rows['card_id']))
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="unassign_card('."'".$rows['card_id']."'".')">Unassign</a>';
			}
			else
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_card('."'".$rows['card_id']."'".')">Delete</a>';
			}
			array_push($data,
				array(
					$rows['card_serial'],
					$rows['card_description'],
					$creation->format('M / d / Y'),
					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_card('."'".$rows['card_id']."'".')">Edit</a>'.
					$assigned,
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	// U P D A T E
	public function edit()
	{
		$id=$this->input->post('card_id');
		$data=$this->Card->edit($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function update()
	{
		$validate = array (
			array('field'=>'card_serial','label'=>'Card\'s Serial','rules'=>'required|min_length[2]'),
			array('field'=>'card_description','label'=>'Card\'s Description','rules'=>'required|min_length[2]'),
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
				'card_id'=>$this->input->post('card_id'),
				'card_serial'=>$this->input->post('card_serial'),
				'card_description'=>$this->input->post('card_description'),
			);
			$this->Card->update($data);
			$info['message']="<p class='success-message'>You have successfully updated <span class='message-name'>".$data['card_serial']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// D E L E T E
	public function delete()
	{
		$validate=array(
			array('field'=>'card_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			if($this->Media->find_Card($this->input->post('card_id')))
			{
				$info['success']=FALSE;
				$info['errors']="Cannot Delete Already Assigned Card Reader!";
			}
			else
			{
				$info['success']=TRUE;
				$data=array(
					'card_id'=>$this->input->post('card_id')
				);
				$this->Card->delete($data);
				$info['message']='Card Reader Successfully Deleted';
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	// U N A S S I G N
	public function unassign()
	{
		$validate=array(
			array('field'=>'card_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'card_id'=>$this->input->post('card_id')
			);
			$this->Media->unassign_Card($data);
			$info['message']='Card Reader Successfully Unassigned';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////
}

// END OF CARD READERS CONTROLLER