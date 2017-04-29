<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	// Ad Management Controller

	// MY_Controller in Core Folder
	class Ads_mngt extends MY_Controller {	

		// Constructor
		public function __construct()
		{
			parent::__construct();
			$this->load->model('users_model', 'User');
			$this->load->model('roles_model', 'Role');

			$this->load->model('advertisers_model', 'Advertiser');
			$this->load->model('ads_model', 'Ad');
		}
		
		// Index Function
		public function upload()
		{
			$data['role'] = $this->logged_out_check();
			$data['title'] = 'Ads Management';
			$data['page_description'] = 'Upload/Browse Ads';
            $data['breadcrumbs']=array
			(
				array('Upload New Ad','ads_mngt/upload'),
			);
            $data['css']=array
            (
            	'assets/css/browse_style.css',
            );
            $data['script']=array
            (
            	'assets/js/jquery.form.js',
            );

            $advertiser_data = $this->Advertiser->show_Advertiser();
			$data['advertiser'] = array();
			foreach ($advertiser_data as $rows) {
				array_push($data['advertiser'],
					array(
						$rows['advertiser_id'],
						$rows['advertiser_name'],
					)
				);
			}

			$data['treeActive'] = 'ads_management';
			$data['childActive'] = 'upload_new_ad' ;

			$this->load->view("template/header", $data);
			$this->load->view("ads_mngt/ad_upload", $data);
			$this->load->view("template/footer", $data);
		}

		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////

		// C R E A T E
		public function saveAd()
		{
			if(isset($_FILES["ad_file"]["name"]))
			{
				$validate = array (
					array('field'=>'ad_name','label'=>'Ad Name','rules'=>'required|is_unique[ads.ad_name]|min_length[2]'),
					array('field'=>'ad_filename','label'=>'Ad File Name','rules'=>'required'),
				);

				$this->form_validation->set_rules($validate);
				if ($this->form_validation->run()===FALSE) 
				{
					$info['success']=FALSE;
					$info['errors']=validation_errors();
				}
				else
				{	
					$ext = pathinfo($_FILES["ad_file"]["name"], PATHINFO_EXTENSION);

					$config['upload_path'] = "./assets/ads/";
					$config['allowed_types'] = 'mp4|mpeg|m4v|mkv';

					$config['max_size'] = '100000000';
					$config['file_name'] = $this->input->post('advertiser_id')."-".$this->input->post('ad_name');


					$this->load->library('upload', $config);
					// $this->upload->initialize($config);

					if( ! $this->upload->do_upload('ad_file'))
					{
						$info['success']=FALSE;
						$info['errors']=$this->upload->display_errors();
					}
					else
					{
						$info['success']=TRUE;

						$data=array(
							'ad_name'=>$this->input->post('ad_name'),
							'ad_filename'=> str_replace(' ', '_', preg_replace("/ {2,}/", " ", $config['file_name'].".".$ext) ),
							'advertiser_id'=>$this->input->post('advertiser_id'),
						);
						$this->Ad->save_Ad($data);
						$info['message']="You have successfully saved your data!";
					}
				}
			}
			else
			{
				$info['success']=FALSE;
				$info['errors']="There's nothing on the file bruh";
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($info));
		}

		// // R E A D
		// public function showUser()
		// {
		// 	$user_table = $this->User->show_User();
		// 	$data = array();
		// 	foreach ($user_table as $rows) {
		// 		$userRole = $this->Role->edit_Role_Data($rows['user_role']);
		// 		array_push($data,
		// 			array(
		// 				$rows['user_id'],
		// 				$rows['user_fname'],
		// 				$rows['user_lname'],
		// 				$userRole['role_name'],
		// 				$rows['user_name'],
		// 				$rows['user_lastlogin'],
		// 				'<a href="javascript:void(0)" class="btn btn-info btn-sm" onclick="edit_user('."'".$rows['user_id']."'".')">Edit</a>'
		// 			)
		// 		);
		// 	}
		// 	$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		// }

		// public function showUserDelete()
		// {
		// 	$user_table = $this->User->show_User();
		// 	$data = array();
		// 	foreach ($user_table as $rows) {
		// 		$userRole = $this->Role->edit_Role_Data($rows['user_role']);
		// 		array_push($data,
		// 			array(
		// 				$rows['user_id'],
		// 				$rows['user_fname'],
		// 				$rows['user_lname'],
		// 				$userRole['role_name'],
		// 				$rows['user_name'],
		// 				$rows['user_lastlogin'],
		// 				'<a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="delete_user('."'".$rows['user_id']."'".')">Delete</a>'
		// 			)
		// 		);
		// 	}
		// 	$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		// }

		// // U P D A T E
		// public function editUser()
		// {
		// 	$user_id=$this->input->post('user_id');
		// 	$data=$this->User->edit_User($user_id);
		// 	$this->output->set_content_type('application/json')->set_output(json_encode($data));
		// }

		// public function updateUser()
		// {

		// 	$validate = array (
		// 		array('field'=>'user_fname','label'=>'First Name','rules'=>'required|min_length[2]'),
		// 		array('field'=>'user_lname','label'=>'Last Name','rules'=>'required|min_length[2]'),
		// 		array('field'=>'user_name','label'=>'User Name','rules'=>'required|min_length[10]'),
		// 		array('field'=>'user_password','label'=>'Password','rules'=>'required|min_length[8]'),
		// 		array('field'=>'confirm_password','label'=>'Password Confirmation','rules'=>'required|matches[user_password]'),
		// 	);

		// 	$this->form_validation->set_rules($validate);
		// 	if ($this->form_validation->run()===FALSE) 
		// 	{
		// 		$info['success']=FALSE;
		// 		$info['errors']=validation_errors();
		// 	}
		// 	else
		// 	{
		// 		$info['success']=TRUE;

		// 		$data=array(
		// 			'user_id'=>$this->input->post('user_id'),
		// 			'user_fname'=>$this->input->post('user_fname'),
		// 			'user_lname'=>$this->input->post('user_lname'),
		// 			'user_role'=>$this->input->post('user_role'),
		// 			'user_name'=>$this->input->post('user_name'),
		// 			'user_password'=> sha1($this->input->post('user_password')),
		// 		);
		// 		$this->User->update_User($data);
		// 		$info['message']="You have successfully updated your data!";
		// 	}
		// 	$this->output->set_content_type('application/json')->set_output(json_encode($info));
		// }

		// // D E L E T E
		// public function delete_User()
		// {
		// 	$validate=array(
		// 		array('field'=>'user_id','rules'=>'required')
		// 	);
		// 	$this->form_validation->set_rules($validate);
		// 	if ($this->form_validation->run()===FALSE) {
		// 		$info['success']=FALSE;
		// 		$info['errors']=validation_errors();
		// 	}else{
		// 		$info['success']=TRUE;
		// 		$data=array(
		// 			'user_id'=>$this->input->post('user_id')
		// 		);
		// 		$this->User->delete_User($data);
		// 		$info['message']='Data Successfully Deleted';
		// 	}
		// 	$this->output->set_content_type('application/json')->set_output(json_encode($info));
		// }

		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////

	}

// END OF AD MANAGEMENT CONTROLLER