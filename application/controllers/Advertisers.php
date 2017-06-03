<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advertisers extends MY_Controller {

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');

		$this->load->model('advertisers_model', 'Advertiser');
	}
			
	public function add()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Add Advertiser';
		$data['breadcrumbs']=array
		(
			array('Add Advertiser','advertisers/add'),
		);
		$data['css']=array
		(
			'assets/css/browse_style.css',
		);
		$data['script']=array
		(
			'assets/js/jquery.form.js',
		);
		$data['page_description']='Add Advertisement Companies';

		$data['treeActive'] = 'ad_companies';
		$data['childActive'] = 'new_advertiser' ;

		$this->load->view("template/header", $data);
		$this->load->view("ads_mngt/advertiser_add", $data);
		$this->load->view("template/footer", $data);
	}

	public function show()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();

		$data['title']='Show Advertiser';

		$data['breadcrumbs']=array
		(
			array('Show Advertiser','advertisers/show'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);
		$data['page_description']='Update and Delete Advertisement Companies';

		$data['treeActive'] = 'ad_companies';
		$data['childActive'] = 'browse_ad_companies' ;

		$this->load->view("template/header", $data);
		$this->load->view("ads_mngt/advertiser_show", $data);
		$this->load->view("template/footer", $data);
	}

	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////

	// C R E A T E
	public function saveAdvertiser()
	{
		$validate = array (
			array('field'=>'advertiser_name','label'=>'Company Name','rules'=>'required|is_unique[advertisers.advertiser_name]|min_length[2]','errors' => array('required' => 'You must enter your %s.',),),
			array('field'=>'advertiser_address','label'=>'Company Address','rules'=>'required|is_unique[advertisers.advertiser_address]|min_length[8]','errors' => array('required' => 'You must enter a %s.',),),
			array('field'=>'advertiser_contact','label'=>'Contact Information','rules'=>'required|is_unique[advertisers.advertiser_contact]|min_length[5]','errors' => array('required' => 'You must enter your company\'s %s.',),),
			array('field'=>'advertiser_email','label'=>'Email Address','rules'=>'required|is_unique[advertisers.advertiser_email]|valid_email|min_length[10]','errors' => array('required' => 'You must enter an %s.',),),
			array('field'=>'advertiser_website','label'=>'Company Website','rules'=>'required|is_unique[advertisers.advertiser_website]|valid_url|min_length[9]','errors' => array('required' => 'You must enter the Website of your Company.',),),
			array('field'=>'advertiser_image','label'=>'Company Logo','rules'=>'required|is_unique[advertisers.advertiser_image]','errors' => array('required' => 'Please upload your %s.',),),
		);

		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) 
		{
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}
		else
		{
			$ext = pathinfo($_FILES["image_file"]["name"], PATHINFO_EXTENSION);

			$config['upload_path'] = "./assets/company_logo/";
			$config['allowed_types'] = 'jpeg|jpg|png|gif';

			$config['max_size'] = '10000';
			$config['file_name'] = $this->input->post('advertiser_name');


			$this->load->library('upload', $config);
			// $this->upload->initialize($config);

			if( ! $this->upload->do_upload('image_file'))
			{
				$info['success']=FALSE;
				$info['errors']=$this->upload->display_errors();
			}
			else
			{
				$info['success']=TRUE;

				$data=array(
					'advertiser_name'=>$this->input->post('advertiser_name'),
					'advertiser_address'=>$this->input->post('advertiser_address'),
					'advertiser_contact'=>$this->input->post('advertiser_contact'),
					'advertiser_email'=>$this->input->post('advertiser_email'),
					'advertiser_website'=>$this->input->post('advertiser_website'),
					'advertiser_image'=> str_replace(' ', '_', preg_replace("/ {2,}/", " ", $config['file_name'].".".$ext) ),
					'advertiser_description'=>$this->input->post('advertiser_description'),
				);
				$this->Advertiser->save_Advertiser($data);
				$info['message']="You have successfully saved your data!";
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// R E A D
	public function showAdvertiser()
	{
		$advertiser_table = $this->Advertiser->show_Advertiser();
		$data = array();
		foreach ($advertiser_table as $rows) {
			array_push($data,
				array(
					$rows['advertiser_name'],
					$rows['advertiser_address'],
					$rows['advertiser_contact'],
					$rows['advertiser_email'],
					// '<a href="'.$rows['advertiser_website'].'" class="btn btn-sm btn-block btn-info" target="_blank">'.$rows['advertiser_name'].'\'s Website</a>',
					'<a href="http://'.$rows['advertiser_website'].'" class="btn btn-sm btn-block btn-info" title="Visit '.$rows['advertiser_name'].' Website" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a>',
					$rows['info'].' ... ',

					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_advertiser('."'".$rows['advertiser_id']."'".')">Edit</a>'.
					'<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_advertiser('."'".$rows['advertiser_id']."'".')">Delete</a>'

				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}

	// U P D A T E
	public function editAdvertiser()
	{
		$advertiser_id=$this->input->post('advertiser_id');
		$data=$this->Advertiser->edit_Advertiser_Data($advertiser_id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function updateAdvertiser()
	{

		$validate = array (
			array('field'=>'advertiser_id','label'=>'Advertiser Id','rules'=>'required'),
			array('field'=>'advertiser_name','label'=>'Company Name','rules'=>'required|min_length[2]','errors' => array('required' => 'You must enter your %s.',),),
			array('field'=>'advertiser_address','label'=>'Company Address','rules'=>'required|min_length[8]','errors' => array('required' => 'You must enter a %s.',),),
			array('field'=>'advertiser_contact','label'=>'Contact Information','rules'=>'required|min_length[5]','errors' => array('required' => 'You must enter your company\'s %s.',),),
			array('field'=>'advertiser_email','label'=>'Email Address','rules'=>'required|valid_email|min_length[10]','errors' => array('required' => 'You must enter an %s.',),),
			array('field'=>'advertiser_website','label'=>'Company Website','rules'=>'required|valid_url|min_length[9]','errors' => array('required' => 'You must enter the Website of your Company.',),),
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
				'advertiser_id'=>$this->input->post('advertiser_id'),
				'advertiser_name'=>$this->input->post('advertiser_name'),
				'advertiser_address'=>$this->input->post('advertiser_address'),
				'advertiser_contact'=>$this->input->post('advertiser_contact'),
				'advertiser_email'=>$this->input->post('advertiser_email'),
				'advertiser_description'=>$this->input->post('advertiser_description'),
			);
			$this->Advertiser->update_Advertiser_Data($data);
			$info['message']="You have successfully updated your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// D E L E T E
	public function deleteAdvertiser()
	{
		$validate=array(
			array('field'=>'advertiser_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'advertiser_id'=>$this->input->post('advertiser_id')
			);
			$this->Advertiser->delete_Advertiser_Data($data);
			$info['message']='Data Successfully Deleted';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////

}

// END OF ADVERTISER CONTROLLER