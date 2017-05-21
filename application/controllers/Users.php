<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');


	}
			
	public function add()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='New User';
		$data['breadcrumbs']=array
		(
			array('New User','users/add'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);
		$data['page_description']='Add New User Accounts';

		$role_data = $this->Role->show_Roles();
		$data['roles'] = array();
		foreach ($role_data as $rows) {
			array_push($data['roles'],
				array(
					$rows['role_id'],
					$rows['role_name'],
					$rows['role_description'],
				)
			);
		}

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'browse_users' ;

		$this->load->view("template/header", $data);
		$this->load->view("users/user_add", $data);
		$this->load->view("template/footer", $data);
	}

	public function browse()
	{
		$data['role'] = $this->logged_out_check();
		$data['title']='Browse Users';
		$data['breadcrumbs']=array
		(
			array('Browse Users','users/browse'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);
		$data['page_description']='Browse User Accounts';

		$role_data = $this->Role->show_Roles();
		$data['roles'] = array();
		foreach ($role_data as $rows) {
			array_push($data['roles'],
				array(
					$rows['role_id'],
					$rows['role_name'],
					$rows['role_description'],
				)
			);
		}

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'browse_users' ;

		$this->load->view("template/header", $data);
		$this->load->view("users/user_browse", $data);
		$this->load->view("template/footer", $data);
	}

	public function toggleStatus()
	{
		$validate=array(
			array('field'=>'is_online','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'is_online'=>$this->input->post('is_online'),
				'user_id'=>$this->session->userdata("user_id"),
			);
			$this->User->onlineStatus($data);
			$info['message']='Data Successfully Deleted';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////

	// C R E A T E
	public function saveUser()
	{
		$validate = array (
			array('field'=>'user_fname','label'=>'First Name','rules'=>'required|min_length[2]'),
			array('field'=>'user_lname','label'=>'Last Name','rules'=>'required|min_length[2]'),
			array('field'=>'user_name','label'=>'User Name','rules'=>'required|is_unique[users.user_name]|min_length[10]'),
			array('field'=>'user_password','label'=>'Password','rules'=>'required|min_length[8]'),
			array('field'=>'confirm_password','label'=>'Password Confirmation','rules'=>'required|matches[user_password]'),
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
				'user_fname'=>$this->input->post('user_fname'),
				'user_lname'=>$this->input->post('user_lname'),
				'user_role'=>$this->input->post('user_role'),
				'user_name'=>$this->input->post('user_name'),
				'user_password'=> sha1($this->input->post('user_password')),
			);
			$this->User->save_User($data);
			$info['message']="You have successfully saved your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}


	// R E A D
	public function showUser()
	{
		$user_table = $this->User->show_User();
		$data = array();
		foreach ($user_table as $rows) {
			$userRole = $this->Role->edit_Role_Data($rows['user_role']);
			$lastlogin = new DateTime($rows['user_lastlogin']); 
			array_push($data,
				array(
					$rows['user_fname'],
					$rows['user_lname'],
					$userRole['role_name'],
					$rows['user_name'],
					$lastlogin->format('M / d / Y h:ia'),
					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_user('."'".$rows['user_id']."'".')">Edit</a>'.
					'<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_user('."'".$rows['user_id']."'".')">Delete</a>'
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}

	// U P D A T E
	public function editUser()
	{
		$user_id=$this->input->post('user_id');
		$data=$this->User->edit_User($user_id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function updateUser()
	{

		$validate = array (
			array('field'=>'user_fname','label'=>'First Name','rules'=>'required|min_length[2]'),
			array('field'=>'user_lname','label'=>'Last Name','rules'=>'required|min_length[2]'),
			array('field'=>'user_name','label'=>'User Name','rules'=>'required|min_length[10]'),
			array('field'=>'user_password','label'=>'Password','rules'=>'required|min_length[8]'),
			array('field'=>'confirm_password','label'=>'Password Confirmation','rules'=>'required|matches[user_password]'),
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
				'user_id'=>$this->input->post('user_id'),
				'user_fname'=>$this->input->post('user_fname'),
				'user_lname'=>$this->input->post('user_lname'),
				'user_role'=>$this->input->post('user_role'),
				'user_name'=>$this->input->post('user_name'),
				'user_password'=> sha1($this->input->post('user_password')),
			);
			$this->User->update_User($data);
			$info['message']="You have successfully updated your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// D E L E T E
	public function delete_User()
	{
		$validate=array(
			array('field'=>'user_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'user_id'=>$this->input->post('user_id')
			);
			$this->User->delete_User($data);
			$info['message']='Data Successfully Deleted';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////

}

// END OF USERS CONTROLLER