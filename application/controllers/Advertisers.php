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
		$this->load->model('agencies_model', 'Agency');
		$this->load->model('ads_model', 'Ad');
	}
	public function browse()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();

		$data['title']='Browse Advertisers';

		$data['breadcrumbs']=array
		(
			array('Browse Advertisers','advertisers/browse'),
		);
		$data['css']=array
		(
			'assets/css/browse_style.css',
		);
		$data['script']=array
		(
			'assets/js/jquery.form.js',
		);
		$data['page_description']='Browse Advertisement Companies';

		$agency_data = $this->Agency->read();
		$data['agency'] = array();
		foreach ($agency_data as $rows) {
			array_push($data['agency'],
				array(
					$rows['agency_id'],
					$rows['agency_name'],
				)
			);
		}

		$data['treeActive'] = 'ad_companies';
		$data['childActive'] = 'browse_ad_companies' ;

		$this->load->view("template/header", $data);
		$this->load->view("ads_mngt/advertiser_show", $data);
		$this->load->view("template/footer", $data);
	}
	////////////////////////////////////////////////////////////////
	//        O  T  H  E  R     F  U  N  C  T  I  O  N  S         //
	////////////////////////////////////////////////////////////////
	public function getAds($id)
	{
    	$table = $this->Ad->get_Ad_Data($id);
		$data = array();
		foreach ($table as $rows) {
			array_push($data,
				array(
                	$rows['ad_name'],
                	$rows['ad_duration'].' seconds',
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////
	public function saveAdvertiser()
	{
		$validate = array (
			array('field'=>'advertiser_name-add','label'=>'Company Name','rules'=>'trim|required|is_unique[advertisers.advertiser_name]|min_length[2]','errors' => array('required' => 'You must enter your %s.',),),
			array('field'=>'advertiser_address-add','label'=>'Company Address','rules'=>'trim|required|is_unique[advertisers.advertiser_address]|min_length[8]','errors' => array('required' => 'You must enter a %s.',),),
			array('field'=>'advertiser_contact-add','label'=>'Contact Information','rules'=>'trim|required|is_unique[advertisers.advertiser_contact]|min_length[5]','errors' => array('required' => 'You must enter your company\'s %s.',),),
			array('field'=>'advertiser_email-add','label'=>'Email Address','rules'=>'trim|required|is_unique[advertisers.advertiser_email]|valid_email|min_length[10]','errors' => array('required' => 'You must enter an %s.',),),
			array('field'=>'advertiser_website-add','label'=>'Company Website','rules'=>'trim|required|is_unique[advertisers.advertiser_website]|valid_url|min_length[9]','errors' => array('required' => 'You must enter the Website of your Company.',),),
			array('field'=>'advertiser_image-add','label'=>'Company Logo','rules'=>'trim|required|is_unique[advertisers.advertiser_image]','errors' => array('required' => 'Please upload your %s.',),),
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
			$config['file_name'] = $this->input->post('advertiser_name-add');

			$this->load->library('upload', $config);

			if( ! $this->upload->do_upload('image_file'))
			{
				$info['success']=FALSE;
				$info['errors']=$this->upload->display_errors();
			}
			else
			{
				$info['success']=TRUE;

				$data=array(
					'advertiser_name'=>$this->input->post('advertiser_name-add'),
					'advertiser_address'=>$this->input->post('advertiser_address-add'),
					'advertiser_contact'=>$this->input->post('advertiser_contact-add'),
					'advertiser_email'=>$this->input->post('advertiser_email-add'),
					'advertiser_website'=>$this->input->post('advertiser_website-add'),
					'agency_id'=>$this->input->post('agency_id-add'),
					'advertiser_image'=> str_replace(' ', '_', preg_replace("/ {2,}/", " ", $config['file_name'].".".$ext) ),
					'advertiser_description'=>$this->input->post('advertiser_description-add'),
				);
				$info['id'] = $this->Advertiser->save_Advertiser($data);
				$info['name'] = $data['advertiser_name'];
				$info['message']="<p class='success-message'>You have successfully saved <span class='message-name'>".$data['advertiser_name']."</span>!</p>";
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	public function showAdvertiser()
	{
		$advertiser_table = $this->Advertiser->show_Advertiser();
		$assigned="";
		$data = array();
		foreach ($advertiser_table as $rows) {
			if( $this->Ad->findAds($rows['advertiser_id']) )
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-primary btn-sm btn-block" onclick="see_ad('."'".$rows['advertiser_id']."'".')">See Advertisement</a>';
			}
			else
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_advertiser('."'".$rows['advertiser_id']."'".')">Delete</a>';
			}
			$agency = $this->Agency->edit($rows['agency_id']);
			array_push($data,
				array(
					// $rows['advertiser_name'],
					'<a href="javascript:void(0)" class="btn btn-link" onclick="show_image('."'".$rows['advertiser_image']."'".')">'.$rows['advertiser_name'].'</a>',
					$rows['advertiser_address'],
					$rows['advertiser_contact'],
					$rows['advertiser_email'],
					'<a href="http://'.$rows['advertiser_website'].'" class="btn btn-sm btn-block btn-info" title="Visit '.$rows['advertiser_name'].' Website" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a>',
					$agency['agency_name'],
					$rows['info'].' ... ',
					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_advertiser('."'".$rows['advertiser_id']."'".')">Edit</a>'.
					$assigned,
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
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
			array('field'=>'advertiser_name','label'=>'Company Name','rules'=>'trim|required|min_length[2]','errors' => array('required' => 'You must enter your %s.',),),
			array('field'=>'advertiser_address','label'=>'Company Address','rules'=>'trim|required|min_length[8]','errors' => array('required' => 'You must enter a %s.',),),
			array('field'=>'advertiser_contact','label'=>'Contact Information','rules'=>'trim|required|min_length[5]','errors' => array('required' => 'You must enter your company\'s %s.',),),
			array('field'=>'advertiser_email','label'=>'Email Address','rules'=>'trim|required|valid_email|min_length[10]','errors' => array('required' => 'You must enter an %s.',),),
			array('field'=>'advertiser_website','label'=>'Company Website','rules'=>'trim|required|valid_url|min_length[9]','errors' => array('required' => 'You must enter the Website of your Company.',),),
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
				'advertiser_website'=>$this->input->post('advertiser_website'),
				'advertiser_description'=>$this->input->post('advertiser_description'),
				'agency_id'=>$this->input->post('agency_id'),
			);
			$this->Advertiser->update_Advertiser_Data($data);
			$info['message']="<p class='success-message'>You have successfully update <span class='message-name'>".$data['advertiser_name']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
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
			$data=array(
				'advertiser_id'=>$this->input->post('advertiser_id')
			);
			if( $this->Ad->findAds($data['advertiser_id']) )
			{
				$info['success']=FALSE;
				$info['message']='Cannot Delete Advertiser that have Ads';
			}
			else
			{
				$info['success']=TRUE;
				$this->Advertiser->delete_Advertiser_Data($data);
				$info['message']='Advertiser Successfully Deleted';
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////
}
// END OF ADVERTISER CONTROLLER