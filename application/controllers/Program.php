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

		public function browse()
        {
            $data = array();
            $data['role'] = $this->logged_out_check();
            $data['title']='Browse Program Schedule';
            $data['page_description'] = 'Browse Created Program Schedule';
            $data['breadcrumbs']=array
            (
                array('Browse Program Schedule','program/browse'),
            );
            $data['css']=array
            (

            );
            $data['script']=array
            (

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
            $data['treeActive'] = 'program_schedule';
            $data['childActive'] = 'browse_program_schedule' ;

            $this->load->view("template/header", $data);
            $this->load->view("program/program_browse", $data);
            $this->load->view("template/footer", $data);
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
							<button class="btn btn-info btn-md btn-block" data-toggle="modal" data-target="#regmodal'.$rows['ad_id'].'">Play</button>

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
						'<a href="javascript:void(0)" class="btn btn-success btn-sm btn-block" onclick="get_ad('."'".$rows['ad_id']."'".')">Get Ad</a>',
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
							<button class="btn btn-info btn-md btn-block" data-toggle="modal" data-target="#schedmodal'.$rows['ad_id'].'">Play</button>

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
						'<a href="javascript:void(0)" class="btn btn-success btn-sm btn-block" onclick="get_ad_sched('."'".$rows['ad_id']."'".')">Get Ad</a>',
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
							<button class="btn btn-info btn-md btn-block" data-toggle="modal" data-target="#blockmodal'.$rows['ad_id'].'">Play</button>

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
						'<a href="javascript:void(0)" class="btn btn-success btn-sm btn-block" onclick="get_ad_block('."'".$rows['ad_id']."'".')">Get Ad</a>',
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
		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////
		// C R E A T E
		public function saveBlockProgram()
		{
			$validate = array (
				array('field'=>'selected_ads_block','label'=>'Selected Ads','rules'=>'required'),
				array('field'=>'start_time_block','label'=>'Block Time','rules'=>'required'),
				array('field'=>'end_time_block','label'=>'Block Time','rules'=>'required'),
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

				$selected_start = json_decode($this->input->post('start_time_block'), TRUE);
				$selected_end = json_decode($this->input->post('end_time_block'), TRUE);
				$allBlock = json_decode($this->input->post('all_time_block'), TRUE);
				$test = array($selected_start, $selected_end);

				foreach($allBlock as $row)
				{
					$block_data=array(
						'time_start'=> $row[0],
						'time_end'=> $row[1],
						'schedule_id'=> $schedule_id,
					);
					$this->Airtime->save_Airtime_Block($block_data);
				}

				$info['message']="You have successfully saved your data!";
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($info));
		}
		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////

		//////////////////////////////////////////////////////////////////////////////////////////////
		//         E  N  D     O  F     B  L  O  C  K  E  D     F  U  N  C  T  I  O  N  S           //
		//////////////////////////////////////////////////////////////////////////////////////////////

		/////////////////////////////////////////////////////////////////////////////////////////////////
		//                     B  R  O  W  S  E     F  U  N  C  T  I  O  N  S                          //
		/////////////////////////////////////////////////////////////////////////////////////////////////

		public function advertiser_Table($advertiser_id)
		{
			$ad_table = $this->Schedule->get_Schedule_Data($advertiser_id);
			$data = array();
			$data = $this->advertisementShowPush($ad_table, $advertiser_id);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}

		public function route_Table($route_id)
		{
			$ad_table = $this->Schedule->get_Schedule_Route($route_id);
			$data = array();
			$data = $this->routeShowPush($ad_table, $route_id);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}

		public function type_Table($type_id)
		{
			$type_table = $this->Schedule->get_Schedule_Type($type_id);
			$data = array();
			$data = $this->typeShowPush($type_table);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}

		public function advertisementShowPush($table, $advertiser)
		{
			$pushdata = array();
            $ctr1=0;
            $ctr2=0;
            $advertiserData = $this->Advertiser->edit_Advertiser_Data($advertiser);
			foreach ($table as $rows) {
				$routeData = $this->Route->edit_Route_Data($rows['route_id']);
				$scheduledAds = $this->Ad_Schedule->get_Ad_Schedule($rows['schedule_id']);
                $text = '';
                $text = $text . '<h3>ADVERTISER : '.$advertiserData["advertiser_name"].'</h3>';
                $text = $text . '<h3>ROUTE : '.$routeData["route_name"].'</h3>';
				$text = $text . '<h3 style="text-align:center;background-color:#339440;color:white;padding:10px 0 10px 0;">LIST OF ADS IN SCHEDULE</h3>';
                $text = $text . '<table class="table table-hover table-bordered"><thead><th style="text-align:center;">THUMBNAIL</th><th style="text-align:center;">AD NAME</th><th style="text-align:center;">DURATION</th></thead><tbody>';
				foreach($scheduledAds as $ads)
				{
					$ad_Data = $this->Ad->edit_Ad_Data($ads['ad_id']);
                    $text=$text.'<tr>
                                <td width="20%">
                                    <video id="v'.$ctr1.$ctr2.'" width="100%" controls>
							  			<source src="'.base_url("assets/ads/".$ad_Data["ad_filename"]).'" type="video/mp4">
							  			Your browser does not support HTML5 video.
									</video>
                                </td>
                                <td style="text-align:center;font-size:20px;vertical-align: middle;">'.$ad_Data['ad_name'].'</td>
                                <td id="schedtd'.$ctr1.$ctr2.'" style="text-align:center;font-size:20px;vertical-align: middle;"></td>
                                <script>	
                                        var schedvideo'.$ctr1.$ctr2.' = document.getElementById("v'.$ctr1.$ctr2.'");
                                        schedvideo'.$ctr1.$ctr2.'.addEventListener("durationchange", function() {
                                            $("#schedtd'.$ctr1.$ctr2.'").html(schedvideo'.$ctr1.$ctr2.'.duration + " seconds");
                                        });
                                </script>
                                </tr>';
//					$text=$text.'<li>'.$ad_Data['ad_name'].'</li>';
                    $ctr2++;
				}
                $ctr1++;
				$text = $text.'</tbody></table>';
				if($rows['schedule_type'] == 1)
				{
					$scheduleData = 'Regular';
				}
				else if($rows['schedule_type'] == 2)
				{
					$scheduleData = 'Scheduled';
					$text = $text.'<h3 style="text-align:center;background-color:#339440;color:white;padding:10px 0 10px 0;">SCHEDULE AIRTIME</h3>';
					$airtimeData = $this->Airtime->get_Airtime($rows['schedule_id']);
					$text = $text.'<table class="table table-hover table-bordered"><thead><th style="text-align:center;">TIME START</th></thead><tbody>';
					foreach($airtimeData as $at)
					{
						$text = $text.'<tr><td style="text-align:center;font-size:16px;">'.$at['time_start'].'</td></tr>';
					}
					$text = $text.'</tbody></table>';
				}
				else
				{
					$scheduleData = 'Block';
					$text = $text.'<h3 style="text-align:center;background-color:#339440;color:white;padding:10px 0 10px 0;">SCHEDULE AIRTIME</h3>';
					$airtimeData = $this->Airtime->get_Airtime($rows['schedule_id']);
					$text = $text.'<table class="table table-hover table-bordered"><thead><th style="text-align:center;">TIME START</th><th style="text-align:center;">TIME END</th></thead><tbody>';
					foreach($airtimeData as $at)
					{
                        $text = $text.'<tr><td style="text-align:center;font-size:16px;">'.$at['time_start'].'</td><td style="text-align:center;font-size:16px;">'.$at['time_end'].'</td></tr>';
					}
					$text = $text.'</tbody></table>';
				}
				array_push($pushdata,
					array(
						'
							<button class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#modaladv'.$rows['schedule_id'].'">Summary</button>

							<div id="modaladv'.$rows['schedule_id'].'" class="modal fade" role="dialog">
							  <div class="modal-dialog modal-lg">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title"><i class="fa fa-calendar"></i>&nbsp;SCHEDULE ID:'.$rows['schedule_id'].'</h4>
							      </div>
							      <div class="modal-body">
							        '.$text.'
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							      </div>
							    </div>
							  </div>
							</div>
						',
						$routeData['route_name'],
						date('m/d/Y', strtotime($rows['date_start'])),
						date('m/d/Y', strtotime($rows['date_end'])),
						$scheduleData,
					)
				);
			}
			return $pushdata;
		}

		public function routeShowPush($table, $route)
		{
			$pushdata = array();
            $ctr1=0;
            $ctr2=0;
            $routeData = $this->Route->edit_Route_Data($route);
			foreach ($table as $rows) {
				$advertiserData = $this->Advertiser->edit_Advertiser_Data($rows['advertiser_id']);
				$scheduledAds = $this->Ad_Schedule->get_Ad_Schedule($rows['schedule_id']);

				$text = '';
                $text = $text . '<h3>ADVERTISER : '.$advertiserData["advertiser_name"].'</h3>';
                $text = $text . '<h3>ROUTE : '.$routeData["route_name"].'</h3>';
				$text = $text . '<h3 style="text-align:center;background-color:#339440;color:white;padding:10px 0 10px 0;">LIST OF ADS IN SCHEDULE</h3>';
                $text = $text . '<table class="table table-hover table-bordered"><thead><th style="text-align:center;">THUMBNAIL</th><th style="text-align:center;">AD NAME</th><th style="text-align:center;">DURATION</th></thead><tbody>';
                
				foreach($scheduledAds as $ads)
				{
					$ad_Data = $this->Ad->edit_Ad_Data($ads['ad_id']);
                    $text=$text.'<tr>
                                <td width="20%">
                                    <video id="s'.$ctr1.$ctr2.'" width="100%" controls>
							  			<source src="'.base_url("assets/ads/".$ad_Data["ad_filename"]).'" type="video/mp4">
							  			Your browser does not support HTML5 video.
									</video>
                                </td>
                                <td style="text-align:center;font-size:20px;vertical-align: middle;">'.$ad_Data['ad_name'].'</td>
                                <td id="schedxtd'.$ctr1.$ctr2.'" style="text-align:center;font-size:20px;vertical-align: middle;"></td>
                                <script>	
                                        var schedvideo'.$ctr1.$ctr2.' = document.getElementById("s'.$ctr1.$ctr2.'");
                                        schedvideo'.$ctr1.$ctr2.'.addEventListener("durationchange", function() {
                                            $("#schedxtd'.$ctr1.$ctr2.'").html(schedvideo'.$ctr1.$ctr2.'.duration + " seconds");
                                        });
                                </script>
                                </tr>';
                                $ctr2++;
				}
                $ctr1++;
				$text = $text.'</tbody></table>';
				if($rows['schedule_type'] == 1)
				{
					$scheduleData = 'Regular';
				}
				else if($rows['schedule_type'] == 2)
				{
					$scheduleData = 'Scheduled';
					$text = $text.'<h3 style="text-align:center;background-color:#339440;color:white;padding:10px 0 10px 0;">SCHEDULE AIRTIME</h3>';
					$airtimeData = $this->Airtime->get_Airtime($rows['schedule_id']);
					$text = $text.'<table class="table table-hover table-bordered"><thead><th style="text-align:center;">TIME START</th></thead><tbody>';
					foreach($airtimeData as $at)
					{
						$text = $text.'<tr><td style="text-align:center;font-size:16px;">'.$at['time_start'].'</td></tr>';
					}
					$text = $text.'</tbody></table>';
				}
				else
				{
					$scheduleData = 'Block';
					$text = $text.'<h3 style="text-align:center;background-color:#339440;color:white;padding:10px 0 10px 0;">SCHEDULE AIRTIME</h3>';
					$airtimeData = $this->Airtime->get_Airtime($rows['schedule_id']);
					$text = $text.'<table class="table table-hover table-bordered"><thead><th style="text-align:center;">TIME START</th><th style="text-align:center;">TIME END</th></thead><tbody>';
					foreach($airtimeData as $at)
					{
                        $text = $text.'<tr><td style="text-align:center;font-size:16px;">'.$at['time_start'].'</td><td style="text-align:center;font-size:16px;">'.$at['time_end'].'</td></tr>';
					}
					$text = $text.'</tbody></table>';
				}
				array_push($pushdata,
					array(
						'
							<button class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#modalrou'.$rows['schedule_id'].'">Summary</button>

							<div id="modalrou'.$rows['schedule_id'].'" class="modal fade" role="dialog">
							  <div class="modal-dialog modal-lg">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title">SCHEDULE #'.$rows['schedule_id'].'</h4>
							      </div>
							      <div class="modal-body">
							        '.$text.'
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							      </div>
							    </div>
							  </div>
							</div>
						',
						$advertiserData['advertiser_name'],
						date('m/d/Y', strtotime($rows['date_start'])),
						date('m/d/Y', strtotime($rows['date_end'])),
						$scheduleData,
					)
				);
			}
			return $pushdata;
		}

		public function typeShowPush($table)
		{
			$pushdata = array();
            $ctr1=0;
            $ctr2=0;
			foreach ($table as $rows) {
				$advertiserData = $this->Advertiser->edit_Advertiser_Data($rows['advertiser_id']);
				$routeData = $this->Route->edit_Route_Data($rows['route_id']);
				$scheduledAds = $this->Ad_Schedule->get_Ad_Schedule($rows['schedule_id']);

				$text = '';
                $text = $text . '<h3>ADVERTISER : '.$advertiserData["advertiser_name"].'</h3>';
                $text = $text . '<h3>ROUTE : '.$routeData["route_name"].'</h3>';
				$text = $text . '<h3 style="text-align:center;background-color:#339440;color:white;padding:10px 0 10px 0;">LIST OF ADS IN SCHEDULE</h3>';
                $text = $text . '<table class="table table-hover table-bordered"><thead><th style="text-align:center;">THUMBNAIL</th><th style="text-align:center;">AD NAME</th><th style="text-align:center;">DURATION</th></thead><tbody>';
                
				foreach($scheduledAds as $ads)
				{
					$ad_Data = $this->Ad->edit_Ad_Data($ads['ad_id']);
                    $text=$text.'<tr>
                                <td width="20%">
                                    <video id="y'.$ctr1.$ctr2.'" width="100%" controls>
							  			<source src="'.base_url("assets/ads/".$ad_Data["ad_filename"]).'" type="video/mp4">
							  			Your browser does not support HTML5 video.
									</video>
                                </td>
                                <td style="text-align:center;font-size:20px;vertical-align: middle;">'.$ad_Data['ad_name'].'</td>
                                <td id="schedytd'.$ctr1.$ctr2.'" style="text-align:center;font-size:20px;vertical-align: middle;"></td>
                                <script>	
                                        var schedvideo'.$ctr1.$ctr2.' = document.getElementById("y'.$ctr1.$ctr2.'");
                                        schedvideo'.$ctr1.$ctr2.'.addEventListener("durationchange", function() {
                                            $("#schedytd'.$ctr1.$ctr2.'").html(schedvideo'.$ctr1.$ctr2.'.duration + " seconds");
                                        });
                                </script>
                                </tr>';
                                $ctr2++;
				}
                $ctr1++;
				$text = $text.'</tbody></table>';
				if($rows['schedule_type'] == 1)
				{
					$scheduleData = 'Regular';
				}
				else if($rows['schedule_type'] == 2)
				{
					$scheduleData = 'Scheduled';
					$text = $text.'<h3 style="text-align:center;background-color:#339440;color:white;padding:10px 0 10px 0;">SCHEDULE AIRTIME</h3>';
					$airtimeData = $this->Airtime->get_Airtime($rows['schedule_id']);
					$text = $text.'<table class="table table-hover table-bordered"><thead><th style="text-align:center;">TIME START</th></thead><tbody>';
					foreach($airtimeData as $at)
					{
						$text = $text.'<tr><td style="text-align:center;font-size:16px;">'.$at['time_start'].'</td></tr>';
					}
					$text = $text.'</tbody></table>';
				}
				else
				{
					$scheduleData = 'Block';
					$text = $text.'<h3 style="text-align:center;background-color:#339440;color:white;padding:10px 0 10px 0;">SCHEDULE AIRTIME</h3>';
					$airtimeData = $this->Airtime->get_Airtime($rows['schedule_id']);
					$text = $text.'<table class="table table-hover table-bordered"><thead><th style="text-align:center;">TIME START</th><th style="text-align:center;">TIME END</th></thead><tbody>';
					foreach($airtimeData as $at)
					{
                        $text = $text.'<tr><td style="text-align:center;font-size:16px;">'.$at['time_start'].'</td><td style="text-align:center;font-size:16px;">'.$at['time_end'].'</td></tr>';
					}
					$text = $text.'</tbody></table>';
				}
				array_push($pushdata,
					array(
						'
							<button class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#modalty'.$rows['schedule_id'].'">Summary</button>

							<div id="modalty'.$rows['schedule_id'].'" class="modal fade" role="dialog">
							  <div class="modal-dialog modal-lg">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title">SCHEDULE #'.$rows['schedule_id'].'</h4>
							      </div>
							      <div class="modal-body">
							        '.$text.'
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							      </div>
							    </div>
							  </div>
							</div>
						',
						$routeData['route_name'],
						$advertiserData['advertiser_name'],
						date('m/d/Y', strtotime($rows['date_start'])),
						date('m/d/Y', strtotime($rows['date_end'])),
					)
				);
			}
			return $pushdata;
		}
		/////////////////////////////////////////////////////////////////////////////////////////////////
		//            E  N  D     O  F     B  R  O  W  S  E    F  U  N  C  T  I  O  N  S               //
		/////////////////////////////////////////////////////////////////////////////////////////////////
	}

// END OF PROGRAM SCHEDULE CONTROLLER