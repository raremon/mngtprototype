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
			$this->load->model('airtimes_model', 'Airtime');
			$this->load->model('time_blocks_model', 'Time_Block');
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
							<button class="btn btn-info btn-lg" data-toggle="modal" data-target="#regmodal'.$rows['ad_id'].'">Play</button>

							<div id="regmodal'.$rows['ad_id'].'" class="modal fade" role="dialog">
							  <div class="modal-dialog modal-lg">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title">'.$rows['ad_filename'].'</h4>
							      </div>
							      <div class="modal-body">
							        <video id="regv'.$rows["ad_id"].'" width="100%" controls>
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
							<p id="regp'.$rows["ad_id"].'"></p>
							<script>	
								
									var regvideo'.$rows["ad_id"].' = document.getElementById("regv'.$rows["ad_id"].'");
									regvideo'.$rows["ad_id"].'.addEventListener("durationchange", function() {
									    $("#regp'.$rows["ad_id"].'").text(regvideo'.$rows["ad_id"].'.duration + " seconds");
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

				$schedule_id = $this->Schedule->save_Schedule($data);

				$selected_ads = json_decode($this->input->post('selected_ads_reg'), TRUE);
				foreach($selected_ads as $row)
				{
					$this->Ad_Schedule->save_Ad_Schedule($row, $schedule_id);
				}

				$info['message']="You have successfully saved your data!";
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($info));
		}

		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////

		////////////////////////////////////////////////////////////////////////////////////////////////////
		//            E  N  D     O  F     R  E  G  U  L  A  R     F  U  N  C  T  I  O  N  S              //
		////////////////////////////////////////////////////////////////////////////////////////////////////


		////////////////////////////////////////////////////////////////////////////////////////////////////
		//                  S  C  H  E  D  U  L  E  D     F  U  N  C  T  I  O  N  S                       //
		////////////////////////////////////////////////////////////////////////////////////////////////////
		public function showAdSched($advertiser_id)
		{
			// $ad_table = $this->Ad->show_Ad();
			$ad_table = $this->Ad->get_Ad_Data($advertiser_id);
			$data = array();
			$data = $this->advertisementPushSched($ad_table);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}

		public function appendAdSched($ad_id)
		{
			$selected_table = $this->Ad->find_Ad_Data($ad_id);
			$data = array();
			$data = $this->selectedPushSched($selected_table);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}

		public function advertisementPushSched($table)
		{
			$pushdata = array();
			foreach ($table as $rows) {
				array_push($pushdata,
					array(
						$rows['ad_id'],
						'
							<button class="btn btn-info btn-lg" data-toggle="modal" data-target="#schedmodal'.$rows['ad_id'].'">Play</button>

							<div id="schedmodal'.$rows['ad_id'].'" class="modal fade" role="dialog">
							  <div class="modal-dialog modal-lg">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title">'.$rows['ad_filename'].'</h4>
							      </div>
							      <div class="modal-body">
							        <video id="schedv'.$rows["ad_id"].'" width="100%" controls>
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
							<p id="schedp'.$rows["ad_id"].'"></p>
							<script>	
								
									var schedvideo'.$rows["ad_id"].' = document.getElementById("schedv'.$rows["ad_id"].'");
									schedvideo'.$rows["ad_id"].'.addEventListener("durationchange", function() {
									    $("#schedp'.$rows["ad_id"].'").text(schedvideo'.$rows["ad_id"].'.duration + " seconds");
									});
								  
								

							</script>
						',
						'<a href="javascript:void(0)" class="btn btn-info btn-sm" onclick="get_ad_sched('."'".$rows['ad_id']."'".')">Get Ad</a>',
					)
				);
			}
			return $pushdata;
		}

		public function selectedPushSched($table)
		{
			$pushdata = array();
			foreach ($table as $rows) {
				array_push($pushdata,
					array(
						$rows['ad_id'],
						$rows['ad_name'],
						$rows['ad_filename'],
						'<a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="remove_ad_sched('."'".$rows['ad_id']."'".')">Remove Ad</a>',
					)
				);
			}
			return $pushdata;
		}

		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////

		// C R E A T E
		public function saveScheduleProgram()
		{
			$validate = array (
				array('field'=>'selected_ads_sched','label'=>'Selected Ads','rules'=>'required'),
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
				$start = new DateTime($this->input->post('start_sched'));
				$end = new DateTime($this->input->post('end_sched'));
				$data=array(
					'advertiser_id'=>$this->input->post('advertiser_id_sched'),
					'route_id'=>$this->input->post('route_id_sched'),
					'date_start'=>$start->format('Y-m-d'),
					'date_end'=>$end->format('Y-m-d'),
					'schedule_type'=>$this->input->post('schedule_type_sched'),
				);

				$schedule_id = $this->Schedule->save_Schedule($data);

				$selected_ads = json_decode($this->input->post('selected_ads_sched'), TRUE);
				foreach($selected_ads as $row)
				{
					$this->Ad_Schedule->save_Ad_Schedule($row, $schedule_id);
				}

				$time_start = date("H:i", strtotime($this->input->post('start_time_sched')));
				$this->Airtime->save_Airtime($time_start, $schedule_id);

				$info['message']="You have successfully saved your data!";
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($info));
		}

		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////

		////////////////////////////////////////////////////////////////////////////////////////////////////
		//         E  N  D     O  F     S  C  H  E  D  U  L  E  D     F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////////////////////////////////////////

		//////////////////////////////////////////////////////////////////////////////////////////////
		//                  B  L  O  C  K  E  D     F  U  N  C  T  I  O  N  S                       //
		//////////////////////////////////////////////////////////////////////////////////////////////
		public function showAdBlock($advertiser_id)
		{
			$ad_table = $this->Ad->get_Ad_Data($advertiser_id);
			$data = array();
			$data = $this->advertisementPushBlock($ad_table);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}

		public function appendAdBlock($ad_id)
		{
			$selected_table = $this->Ad->find_Ad_Data($ad_id);
			$data = array();
			$data = $this->selectedPushBlock($selected_table);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}

		public function advertisementPushBlock($table)
		{
			$pushdata = array();
			foreach ($table as $rows) {
				array_push($pushdata,
					array(
						$rows['ad_id'],
						'
							<button class="btn btn-info btn-lg" data-toggle="modal" data-target="#blockmodal'.$rows['ad_id'].'">Play</button>

							<div id="blockmodal'.$rows['ad_id'].'" class="modal fade" role="dialog">
							  <div class="modal-dialog modal-lg">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title">'.$rows['ad_filename'].'</h4>
							      </div>
							      <div class="modal-body">
							        <video id="blockv'.$rows["ad_id"].'" width="100%" controls>
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
							<p id="blockp'.$rows["ad_id"].'"></p>
							<script>	
								
									var blockvideo'.$rows["ad_id"].' = document.getElementById("blockv'.$rows["ad_id"].'");
									blockvideo'.$rows["ad_id"].'.addEventListener("durationchange", function() {
									    $("#blockp'.$rows["ad_id"].'").text(blockvideo'.$rows["ad_id"].'.duration + " seconds");
									});
								  
								

							</script>
						',
						'<a href="javascript:void(0)" class="btn btn-info btn-sm" onclick="get_ad_block('."'".$rows['ad_id']."'".')">Get Ad</a>',
					)
				);
			}
			return $pushdata;
		}

		public function selectedPushBlock($table)
		{
			$pushdata = array();
			foreach ($table as $rows) {
				array_push($pushdata,
					array(
						$rows['ad_id'],
						$rows['ad_name'],
						$rows['ad_filename'],
						'<a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="remove_ad_block('."'".$rows['ad_id']."'".')">Remove Ad</a>',
					)
				);
			}
			return $pushdata;
		}

		public function showTimeBlock($advertiser_id)
		{
			$time_block_table = $this->Time_Block->get_Time_Block_Data($advertiser_id);
			$data = array();
			$data = $this->timeBlockPush($time_block_table);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}

		public function timeBlockPush($table)
		{
			$pushdata = array();
			foreach ($table as $rows) {
				array_push($pushdata,
					array(
						'
							<div class="checkbox">
							  <label><input type="checkbox" class="timeblockcheck" onchange="triggered()" value="'.$rows["time_block_id"].'"></label>
							</div>
						',
						$rows['time_start'],
						$rows['time_end'],
						'<a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="remove_time_block('."'".$rows['time_block_id']."'".')">Remove</a>',
					)
				);
			}
			return $pushdata;
		}
		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////
		// C R E A T E
		public function saveBlockProgram()
		{
			$validate = array (
				array('field'=>'selected_ads_block','label'=>'Selected Ads','rules'=>'required'),
				array('field'=>'selected_block','label'=>'Selected Block Time','rules'=>'required'),
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
				$start = new DateTime($this->input->post('start_block'));
				$end = new DateTime($this->input->post('end_block'));

				$data=array(
					'advertiser_id'=>$this->input->post('advertiser_id_block'),
					'route_id'=>$this->input->post('route_id_block'),
					'date_start'=>$start->format('Y-m-d'),
					'date_end'=>$end->format('Y-m-d'),
					'schedule_type'=>$this->input->post('schedule_type_block'),
				);

				$schedule_id = $this->Schedule->save_Schedule($data);

				$selected_ads = json_decode($this->input->post('selected_ads_block'), TRUE);
				foreach($selected_ads as $row)
				{
					$this->Ad_Schedule->save_Ad_Schedule($row, $schedule_id);
				}

				$selected_block = json_decode($this->input->post('selected_block'), TRUE);
				foreach($selected_block as $row)
				{
					$time = $this->Time_Block->get_Airtimes($row);
					$block_data=array(
						'schedule_id' => $schedule_id,
						'time_start'=> $time['time_start'],
						'time_end'=> $time['time_end'],
					);
					$this->Airtime->save_Airtime_Block($block_data);
				}

				$info['message']="You have successfully saved your data!";
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($info));
		}

		public function addBlock()
		{
			$start = date("H:i", strtotime($this->input->post('start_time_block')));
			$end = date("H:i", strtotime($this->input->post('end_time_block')));
			$advertiser_id = $this->input->post('advertiser_id_block');
			if( $this->Time_Block->get_Record($advertiser_id, $start, $end) )
			{
				$info['success']=FALSE;
				$info['errors']="There is already a record existing!";
			}
			else
			{
				$info['success']=TRUE;
				$data=array(
					'time_start'=>$start,
					'time_end'=>$end,
					'advertiser_id'=>$advertiser_id,
				);

				$this->Time_Block->save_Time_Block($data);

				$info['message']="You have successfully saved your data!";
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($info));
		}

		// D E L E T E
		public function delete_Time_Block()
		{
			$validate=array(
				array('field'=>'time_block_id','rules'=>'required')
			);
			$this->form_validation->set_rules($validate);
			if ($this->form_validation->run()===FALSE) {
				$info['success']=FALSE;
				$info['errors']=validation_errors();
			}else{
				$info['success']=TRUE;
				$data=array(
					'time_block_id'=>$this->input->post('time_block_id')
				);
				$this->Time_Block->delete_Time_Block_Data($data);
				$info['message']='Data Successfully Deleted';
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($info));
		}
		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////

		//////////////////////////////////////////////////////////////////////////////////////////////
		//         E  N  D     O  F     B  L  O  C  K  E  D     F  U  N  C  T  I  O  N  S           //
		//////////////////////////////////////////////////////////////////////////////////////////////

	}

// END OF PROGRAM SCHEDULE CONTROLLER