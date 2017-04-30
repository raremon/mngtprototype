<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	// Program Schedule Controller

	// MY_Controller in Core Folder
	class Program extends MY_Controller {	

		// Constructor
		public function __construct()
		{
			parent::__construct();
			$this->load->model('users_model', 'User');
			$this->load->model('roles_model', 'Role');

			$this->load->model('advertisers_model', 'Advertiser');
			$this->load->model('routes_model', 'Route');
			$this->load->model('ads_model', 'Ad');

			$this->load->model('schedules_model', 'Schedule');
			$this->load->model('ad_schedules_model', 'Ad_Schedule');
		}
		
		// Index Function
		public function create()
		{
			$data['role'] = $this->logged_out_check();
			$data['title'] = 'Program Schedule';
			$data['page_description'] = 'Manage Program Schedule';
            $data['breadcrumbs']=array
		      (
                array('Create Program Schedule','program/create'),
		      );
            $data['css']=array
            (
            	'assets/plugins/daterangepicker/daterangepicker.css',
				'assets/plugins/datepicker/datepicker3.css',
				'assets/plugins/select2/select2.min.css',
				'assets/plugins/iCheck/all.css',
				'assets/plugins/timepicker/bootstrap-timepicker.min.css',
            );
            $data['script']=array
            (
            	'assets/js/program_sched.js',
				'assets/plugins/input-mask/jquery.inputmask.js',
				'assets/plugins/input-mask/jquery.inputmask.date.extensions.js',
				'assets/plugins/input-mask/jquery.inputmask.extensions.js',
				'assets/js/moment.min.js',
				'assets/plugins/daterangepicker/daterangepicker.js',
				'assets/plugins/datepicker/bootstrap-datepicker.js',
				'assets/plugins/select2/select2.full.min.js',
				'assets/plugins/iCheck/icheck.min.js',
				'assets/plugins/timepicker/bootstrap-timepicker.min.js',
            );
			$data['treeActive'] = 'program_schedule';
			$data['childActive'] = 'create_program_schedule' ;

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

			$route_data = $this->Route->show_Route();
			$data['route'] = array();
			foreach ($route_data as $rows) {
				array_push($data['route'],
					array(
						$rows['route_id'],
						$rows['route_name'],
					)
				);
			}

			// $ad_data = $this->Ad->show_Ad();
			// $data['ad'] = array();
			// foreach ($ad_data as $rows) {
			// 	array_push($data['ad'],
			// 		array(
			// 			$rows['ad_id'],
			// 			$rows['ad_name'],
			// 			$rows['ad_filename'],
			// 		)
			// 	);
			// }

			$this->load->view("template/header", $data);
			$this->load->view("program/program_create", $data);
			$this->load->view("template/footer", $data);
		}

		// R E A D
		public function showAd()
		{
			$ad_table = $this->Ad->show_Ad();
			$data = array();
			foreach ($ad_table as $rows) {
				array_push($data,
					array(
						$rows['ad_id'],
						'
							<button class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal'.$rows['ad_id'].'">Play</button>

							<div id="modal'.$rows['ad_id'].'" class="modal fade" role="dialog">
							  <div class="modal-dialog modal-lg">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title">'.$rows['ad_filename'].'</h4>
							      </div>
							      <div class="modal-body">
							        <video id="v'.$rows["ad_id"].'" width="100%" controls>
							  			<source src="'.base_url("assets/ads/".$rows["ad_filename"]).'" type="video/mp4">
							  			Your browser does not support HTML5 video.
									</video>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							      </div>
							    </div>
							  </div>
							</div>
						',
						$rows['ad_filename'],
						'
							<p id="p'.$rows["ad_id"].'"></p>
							<script>	
								
									var video'.$rows["ad_id"].' = document.getElementById("v'.$rows["ad_id"].'");
									video'.$rows["ad_id"].'.addEventListener("durationchange", function() {
									    $("#p'.$rows["ad_id"].'").text(video'.$rows["ad_id"].'.duration + " seconds");
									});
								  
								

							</script>
						',
						$rows['ad_name'],
					)
				);
			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}

		////////////////////////////////////////////////////////////////////////////////////////////////////
		//                     R  E  G  U  L  A  R     F  U  N  C  T  I  O  N  S                          //
		////////////////////////////////////////////////////////////////////////////////////////////////////
		public function showAdReg($advertiser_id)
		{
			// $ad_table = $this->Ad->show_Ad();
			$ad_table = $this->Ad->get_Ad_Data($advertiser_id);
			$data = array();
			$data = $this->advertisementPush($ad_table);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}

		public function appendAd($ad_id)
		{
			$selected_table = $this->Ad->find_Ad_Data($ad_id);
			$data = array();
			$data = $this->selectedPush($selected_table);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}

		public function advertisementPush($table)
		{
			$pushdata = array();
			foreach ($table as $rows) {
				array_push($pushdata,
					array(
						$rows['ad_id'],
						'
							<button class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal'.$rows['ad_id'].'">Play</button>

							<div id="modal'.$rows['ad_id'].'" class="modal fade" role="dialog">
							  <div class="modal-dialog modal-lg">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title">'.$rows['ad_filename'].'</h4>
							      </div>
							      <div class="modal-body">
							        <video id="v'.$rows["ad_id"].'" width="100%" controls>
							  			<source src="'.base_url("assets/ads/".$rows["ad_filename"]).'" type="video/mp4">
							  			Your browser does not support HTML5 video.
									</video>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							      </div>
							    </div>
							  </div>
							</div>
						',
						$rows['ad_name'],
						$rows['ad_filename'],
						'
							<p id="p'.$rows["ad_id"].'"></p>
							<script>	
								
									var video'.$rows["ad_id"].' = document.getElementById("v'.$rows["ad_id"].'");
									video'.$rows["ad_id"].'.addEventListener("durationchange", function() {
									    $("#p'.$rows["ad_id"].'").text(video'.$rows["ad_id"].'.duration + " seconds");
									});
								  
								

							</script>
						',
						'<a href="javascript:void(0)" class="btn btn-info btn-sm" onclick="get_ad('."'".$rows['ad_id']."'".')">Get Ad</a>',
					)
				);
			}
			return $pushdata;
		}

		public function selectedPush($table)
		{
			$pushdata = array();
			foreach ($table as $rows) {
				array_push($pushdata,
					array(
						$rows['ad_id'],
						$rows['ad_name'],
						$rows['ad_filename'],
						'<a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="remove_ad('."'".$rows['ad_id']."'".')">Remove Ad</a>',
					)
				);
			}
			return $pushdata;
		}

		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////

		// C R E A T E
		public function saveRegularProgram()
		{
			$validate = array (
				array('field'=>'selected_ads_reg','label'=>'Selected Ads','rules'=>'required'),
			);

			$this->form_validation->set_rules($validate);
			if ($this->form_validation->run()===FALSE) 
			{
				$info['success']=FALSE;
				$info['errors']="Please Select Ads before submitting";
			}
			else
			{
				$info['success']=TRUE;
				$start = new DateTime($this->input->post('start_reg'));
				$end = new DateTime($this->input->post('end_reg'));
				$data=array(
					'advertiser_id'=>$this->input->post('advertiser_id_reg'),
					'route_id'=>$this->input->post('route_id_reg'),
					'date_start'=>$start->format('Y-m-d'),
					'date_end'=>$end->format('Y-m-d'),
					'schedule_type'=>$this->input->post('schedule_type_reg'),
				);

				$schedule_id = $this->Schedule->save_Regular_Schedule($data);

				$selected_ads = json_decode($this->input->post('selected_ads_reg'), TRUE);
				foreach($selected_ads as $row)
				{
					$this->Ad_Schedule->save_Ad_Schedule($row, $schedule_id);
				}

				$info['message']="You have successfully saved your data!";
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

		////////////////////////////////////////////////////////////////////////////////////////////////////
		//            E  N  D     O  F     R  E  G  U  L  A  R     F  U  N  C  T  I  O  N  S              //
		////////////////////////////////////////////////////////////////////////////////////////////////////

	}

// END OF PROGRAM SCHEDULE CONTROLLER