<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cashiers extends MY_Controller {
    // Constructor
	public function __construct(){
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');
                $this->load->model('cashiers_model', 'Cashier');
	}
        
        public function index(){
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']="Cashier's Accounts";
		$data['page_description']="Browse Cashier's Accounts";
		$data['treeActive'] = 'epayment';
		$data['childActive'] = 'cashier' ;
		
		$data['breadcrumbs']=array
		(
			array("Cashier's Accounts",'cashiers')
		);

		$this->load->view("template/header", $data);
		$this->load->view("epayment/cashier_browse", $data);
		$this->load->view("template/footer", $data);
	}
        
        public function add(){
                $data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='New Cashier';
		$data['breadcrumbs']=array
		(
			array("Cashier's Accounts",'cashiers'),
			array('New Cashier','cashiers/add'),
		);

		$data['page_description']='Add New Cashier';

		$data['treeActive'] = 'epayment';
		$data['childActive'] = 'cashier' ;

		$this->load->view("template/header", $data);
		$this->load->view("epayment/cashier_add", $data);
		$this->load->view("template/footer", $data);
        }
        
        public function saveCashier()
	{
		$validate = array (
			array('field'=>'first_name','label'=>'First Name','rules'=>'required'),
			array('field'=>'last_name','label'=>'Last Name','rules'=>'required'),
			array('field'=>'username','label'=>'Username','rules'=>'required'),
                        array('field'=>'password','label'=>'password','rules'=>'required'),
                        array('field'=>'card_id','label'=>'Card ID','rules'=>'required'),
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
				'first_name'=>$this->input->post('first_name'),
				'last_name'=>$this->input->post('last_name'),
				'username'=>$this->input->post('username'),
				'password'=> md5($this->input->post('password')),
                                'card_id'=>$this->input->post('card_id'),
			);
                        
			$this->Cashier->save_Cashier($data);
			$info['message']="You have successfully saved your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

        public function showCashiers()
	{	
		$cashiers_table = $this->Cashier->show_Cashiers();
		$data = array();
		foreach ($cashiers_table as $rows) {
			array_push($data,
				array(
                                    $rows['first_name']." ".$rows['last_name'],
                                    $rows['username'],
                                    
//                                    '<a href="javascript:void(0)" class="btn btn-primary btn-sm btn-block" onclick="view_cashier('."'".$rows['user_id']."'".') )">View</a>'.
                                    '<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_cashier('."'".$rows['cashier_id']."'".')">Edit</a>'.
                                    '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_cashier('."'".$rows['cashier_id']."'".')">Delete</a>'
				)
			);
			$ctr += 1;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
        
        public function editCashier()
	{
		$cashier_id=$this->input->post('cashier_id');
		$data=$this->Cashier->edit_Cashier_Data($cashier_id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
        
        public function updateCashier()
	{

		$validate = array (
			array('field'=>'first_name','label'=>'First Name','rules'=>'required'),
			array('field'=>'last_name','label'=>'Last Name','rules'=>'required'),
			array('field'=>'username','label'=>'Username','rules'=>'required'),
                        array('field'=>'password','label'=>'password','rules'=>'required'),
                        array('field'=>'card_id','label'=>'Card ID','rules'=>'required'),
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
				'cashier_id'=>$this->input->post('cashier_id'),
				'first_name'=>$this->input->post('first_name'),
				'last_name'=>$this->input->post('last_name'),
				'username'=>$this->input->post('username'),
				'password'=> md5($this->input->post('password')),
                                'card_id'=>$this->input->post('card_id'),
			);
			$this->Cashier->update_Cashier_Data($data);
			$info['message']="You have successfully updated your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
        
        public function delete_Cashier()
	{
		$validate=array(
			array('field'=>'cashier_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'cashier_id'=>$this->input->post('cashier_id')
			);
			$this->Cashier->delete_Cashier_Data($data);
			$info['message']='Data Successfully Deleted';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
}
