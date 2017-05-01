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
	}

// END OF PROGRAM SCHEDULE CONTROLLER