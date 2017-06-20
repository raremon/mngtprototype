<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agencies extends MY_Controller {
	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');

		$this->load->model('agencies_model', 'Agency');
		$this->load->model('advertisers_model', 'Advertiser');
	}
	public function browse()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();

		$data['title']='Browse Agencies';

		$data['breadcrumbs']=array
		(
			array('Browse Agencies','agencies/browse'),
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
		$data['page_description']='Browse Agency Companies';

		$data['treeActive'] = 'ad_companies';
		$data['childActive'] = 'browse_agencies' ;

		$this->load->view("template/header", $data);
		$this->load->view("ads_mngt/agency_show", $data);
		$this->load->view("template/footer", $data);
	}
	////////////////////////////////////////////////////////////////
	//        O  T  H  E  R     F  U  N  C  T  I  O  N  S         //
	////////////////////////////////////////////////////////////////
	public function getAdvertisers($id)
	{
    	$table = $this->Advertiser->getAgency($id);
		$data = array();
		foreach ($table as $rows) {
			array_push($data,
				array(
                	$rows['advertiser_name'],
					$rows['advertiser_address'],
					$rows['advertiser_contact'],
					$rows['advertiser_email'],
					'<a href="http://'.$rows['advertiser_website'].'" class="btn btn-sm btn-block btn-info" title="Visit '.$rows['advertiser_name'].' Website" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a>',
					$rows['info'].' ... ',
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////
	public function save()
	{
		$validate = array (
			array('field'=>'agency_name-add','label'=>'Company Name','rules'=>'trim|required|is_unique[agencies.agency_name]|min_length[2]','errors' => array('required' => 'You must enter your %s.',),),
			array('field'=>'agency_address-add','label'=>'Company Address','rules'=>'trim|required|is_unique[agencies.agency_address]|min_length[8]','errors' => array('required' => 'You must enter a %s.',),),
			array('field'=>'agency_contact-add','label'=>'Contact Information','rules'=>'trim|required|is_unique[agencies.agency_contact]|min_length[5]','errors' => array('required' => 'You must enter your company\'s %s.',),),
			array('field'=>'agency_email-add','label'=>'Email Address','rules'=>'trim|required|is_unique[agencies.agency_email]|valid_email|min_length[10]','errors' => array('required' => 'You must enter an %s.',),),
			array('field'=>'agency_website-add','label'=>'Company Website','rules'=>'trim|required|is_unique[agencies.agency_website]|valid_url|min_length[9]','errors' => array('required' => 'You must enter the Website of your Company.',),),
			array('field'=>'agency_image-add','label'=>'Company Logo','rules'=>'trim|required|is_unique[agencies.agency_image]','errors' => array('required' => 'Please upload your %s.',),),
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) 
		{
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}
		else
		{
			$ext = pathinfo($_FILES["agency_file"]["name"], PATHINFO_EXTENSION);
			$config['upload_path'] = "./assets/agency_logo/";
			$config['allowed_types'] = 'jpeg|jpg|png|gif';
			$config['max_size'] = '10000';
			$config['file_name'] = $this->input->post('agency_name-add');
			$this->load->library('upload', $config);
			if( ! $this->upload->do_upload('agency_file'))
			{
				$info['success']=FALSE;
				$info['errors']=$this->upload->display_errors();
			}
			else
			{
				$info['success']=TRUE;
				$data=array(
					'agency_name'=>$this->input->post('agency_name-add'),
					'agency_address'=>$this->input->post('agency_address-add'),
					'agency_contact'=>$this->input->post('agency_contact-add'),
					'agency_email'=>$this->input->post('agency_email-add'),
					'agency_website'=>$this->input->post('agency_website-add'),
					'agency_image'=> str_replace(' ', '_', preg_replace("/ {2,}/", " ", $config['file_name'].".".$ext) ),
					'agency_description'=>$this->input->post('agency_description-add'),
					'billable'=>$this->input->post('billable-add'),
				);
				$this->Agency->create($data);
				$info['message']="<p class='success-message'>You have successfully saved <span class='message-name'>".$data['agency_name']."</span>!</p>";
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	public function show()
	{
		$table = $this->Agency->read();
		$assigned="";
		$bill="";
		$data = array();
		foreach ( $table as $rows ) {
			if( $this->Advertiser->findAgency($rows['agency_id']) )
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-primary btn-sm btn-block" onclick="see_advertiser('."'".$rows['agency_id']."'".')">See Advertisers</a>';
			}
			else
			{
				$assigned = '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_agency('."'".$rows['agency_id']."'".')">Delete</a>';
			}
			if( $rows['billable'] )
			{
				$bill = 'Billable';
			}
			else
			{
				$bill = 'Not Billable';
			}
			array_push($data,
				array(
					'<a href="javascript:void(0)" class="btn btn-link" onclick="show_image('."'".$rows['agency_image']."'".')">'.$rows['agency_name'].'</a>',
					$rows['agency_address'],
					$rows['agency_contact'],
					$rows['agency_email'],
					'<a href="http://'.$rows['agency_website'].'" class="btn btn-sm btn-block btn-info" title="Visit '.$rows['agency_name'].' Website" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a>',
					$rows['info'].' ... ',
					$bill,
					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_agency('."'".$rows['agency_id']."'".')">Edit</a>'.
					$assigned,
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	public function edit()
	{
		$id=$this->input->post('agency_id');
		$data=$this->Agency->edit($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function update()
	{
		$validate = array (
			array('field'=>'agency_id','label'=>'Agency Id','rules'=>'required'),
			array('field'=>'agency_name','label'=>'Company Name','rules'=>'trim|required|min_length[2]','errors' => array('required' => 'You must enter your %s.',),),
			array('field'=>'agency_address','label'=>'Company Address','rules'=>'trim|required|min_length[8]','errors' => array('required' => 'You must enter a %s.',),),
			array('field'=>'agency_contact','label'=>'Contact Information','rules'=>'trim|required|min_length[5]','errors' => array('required' => 'You must enter your company\'s %s.',),),
			array('field'=>'agency_email','label'=>'Email Address','rules'=>'trim|required|valid_email|min_length[10]','errors' => array('required' => 'You must enter an %s.',),),
			array('field'=>'agency_website','label'=>'Company Website','rules'=>'trim|required|valid_url|min_length[9]','errors' => array('required' => 'You must enter the Website of your Company.',),),
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
				'agency_id'=>$this->input->post('agency_id'),
				'agency_name'=>$this->input->post('agency_name'),
				'agency_address'=>$this->input->post('agency_address'),
				'agency_contact'=>$this->input->post('agency_contact'),
				'agency_email'=>$this->input->post('agency_email'),
				'agency_website'=>$this->input->post('agency_website'),
				'agency_description'=>$this->input->post('agency_description'),
				'billable'=>$this->input->post('billable'),
			);
			$this->Agency->update($data);
			$info['message']="<p class='success-message'>You have successfully updated <span class='message-name'>".$data['agency_name']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	public function delete()
	{
		$validate=array(
			array('field'=>'agency_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$data=array(
				'agency_id'=>$this->input->post('agency_id')
			);
			if( $this->Advertiser->findAgency($data['agency_id']) )
			{
				$info['success']=FALSE;
				$info['message']='Cannot Delete Agency that have Advertisers';
			}
			else
			{
				$this->Agency->delete($data);
				$info['success']=TRUE;
				$info['message']='Agency Successfully Deleted';
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////
}
// END OF AGENCY CONTROLLER