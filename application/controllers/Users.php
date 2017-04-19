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
		$data['title']='Add User';
		$data['breadcrumbs']=array
		(
			array('Add User','users/add'),
		);
		$data['page_description']='Add and Update User Accounts';

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

		$data['treeActive'] = 'users_management';
		$data['childActive'] = 'add_user' ;

		$this->load->view("template/header", $data);
		$this->load->view("users/user_add", $data);
		$this->load->view("template/footer", $data);
	}

	public function delete()
	{
		$data['role'] = $this->logged_out_check();
		$data['title']='Delete User';
		$data['breadcrumbs']=array
		(
			array('Delete User','users/delete'),
		);
		$data['page_description']='Delete User Accounts';

		$data['treeActive'] = 'users_management';
		$data['childActive'] = 'delete_user' ;

		$this->load->view("template/header", $data);
		$this->load->view("users/user_delete", $data);
		$this->load->view("template/footer", $data);
	}

// 	// Index Function
// 	public function index()
// 	{
// 		$data['title']='BUS CRUD';

// 		$bus_type_data = $this->Bus_type->show_Bus_Type();
// 		$data['bustype'] = array();
// 		foreach ($bus_type_data as $rows) {
// 			array_push($data['bustype'],
// 				array(
// 					$rows['bus_type_id'],
// 					$rows['bus_type_name'],
// 				)
// 			);
// 		}

// 		$this->load->view('bus_crud', $data);
// 	}

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
			array_push($data,
				array(
					$rows['user_id'],
					$rows['user_fname'],
					$rows['user_lname'],
					$rows['user_role'],
					$rows['user_name'],
					$rows['user_lastlogin'],
					'<a href="javascript:void(0)" class="btn btn-info btn-sm" onclick="edit_user('."'".$rows['user_id']."'".')">Edit</a>'
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}

	public function showUserDelete()
	{
		$user_table = $this->User->show_User();
		$data = array();
		foreach ($user_table as $rows) {
			array_push($data,
				array(
					$rows['user_id'],
					$rows['user_fname'],
					$rows['user_lname'],
					$rows['user_role'],
					$rows['user_name'],
					$rows['user_lastlogin'],
					'<a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="delete_user('."'".$rows['user_id']."'".')">Delete</a>'
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