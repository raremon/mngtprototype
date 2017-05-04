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

			$this->load->model('routes_model', 'Route');
			$this->load->model('advertisers_model', 'Advertiser');
			$this->load->model('ads_model', 'Ad');
			$this->load->model('buses_model', 'Bus');

			$this->load->model('adlogs_model', 'Ad_Log');
		}


		public function upload()
		{
			$data['role'] = $this->logged_out_check();
			$data['title'] = 'Upload New Ad';
			$data['page_description'] = 'Upload Advertisements';
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

		public function browse()
		{
			$data['role'] = $this->logged_out_check();
			$data['title'] = 'Browse Ads';
			$data['page_description'] = 'Browse Advertisements';
            $data['breadcrumbs']=array
			(
				array('Browse Ads','ads_mngt/browse'),
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
			$data['childActive'] = 'browse_ads' ;

			$this->load->view("template/header", $data);
			$this->load->view("ads_mngt/ad_browse", $data);
			$this->load->view("template/footer", $data);
		}

		public function report()
		{
			$data['role'] = $this->logged_out_check();
			$data['title'] = 'Ad Report';
			$data['page_description'] = 'View Ad Statistics';
            $data['breadcrumbs']=array
			(
				array('Ad Report','ads_mngt/report'),
			);
            $data['css']=array
            (
            	'assets/css/browse_style.css',
            );
            $data['script']=array
            (
            	'assets/js/jquery.form.js',
                'assets/js/Chart.min.js'
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

			$data['treeActive'] = 'ads_management';
			$data['childActive'] = 'ad_report' ;

			$this->load->view("template/header", $data);
			$this->load->view("ads_mngt/ad_report", $data);
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
					$config['allowed_types'] = 'mp4|mpeg4|m4v|mkv';

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
						$ad_filename = str_replace(' ', '_', preg_replace("/ {2,}/", " ", $config['file_name'].".".$ext) );

						$info['message']='<video id="Xvideo" width="100%" controls>
					  						<source src="'.base_url("assets/ads/".$ad_filename).'" type="video/mp4">
					  						Your browser does not support HTML5 video.
											</video>
											<script>	
													var video = document.getElementById("Xvideo");
													video.addEventListener("durationchange", function() {
													    $("#video_duration").val(Math.ceil(video.duration));
													    $("#video_filename").val("'.$ad_filename.'");
													    save();
													});
											</script>';
						
					}
				}
			}
			else
			{
				$info['success']=FALSE;
				$info['errors']="The file is invalid";
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($info));
		}

		public function saveAdRecord()
		{
			$info['success']=TRUE;
			$data=array(
				'ad_name'=>$this->input->post('ad_name'),
				'ad_filename'=> $this->input->post('video_filename'),
				'ad_duration' => (int)$this->input->post('ad_duration'),
				'advertiser_id'=>$this->input->post('advertiser_id'),
			);
			$this->Ad->save_Ad($data);
			$info['message']="You have successfully saved your data!";
			$this->output->set_content_type('application/json')->set_output(json_encode($info));
		}

		// R E A D
		public function showAd()
		{
			$ad_table = $this->Ad->show_Ad();
			$data = array();
			foreach ($ad_table as $rows) {
				$advertiser = $this->Advertiser->edit_Advertiser_Data($rows['advertiser_id']);
				array_push($data,
					array(
						$rows['ad_id'],
						$rows['ad_name'],
						$advertiser['advertiser_name'],
						'

							<button class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#modal'.$rows['ad_id'].'">Play</button>


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

						'<a href="javascript:void(0)" class="btn btn-info btn-sm" onclick="edit_ad('."'".$rows['ad_id']."'".')">Edit</a>'.
						'<a href="javascript:void(0)" class="btn btn-danger btn-sm pull-right" onclick="delete_ad('."'".$rows['ad_id']."'".')">Delete</a>'

					)
				);
			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}

		public function get_Report()
		{
			$report_data = $this->Ad_Log->get_logs();
			$amCount = 0;
			$pmCount = 0;
			$eveCount = 0;
			foreach($report_data as $report)
			{
				$amCount += $report['amCount'];
				$pmCount += $report['pmCount'];
				$eveCount += $report['eveCount'];
			}
			$total=$amCount + $pmCount + $eveCount;
			$data = array(
				$amCount, $pmCount, $eveCount, $total
			);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}

		public function displayReport()
		{
			$report_data = $this->Ad_Log->get_full_logs();
			$data = array();
			foreach ($report_data as $rows) {
				$ad = $this->Ad->edit_Ad_Data($rows['ad_id']);
				$bus = $this->Bus->edit_Bus_Data($rows['bus_id']);
				$route = $this->Route->edit_Route_Data($rows['route_id']);
				array_push($data,
					array(
						$rows['log_id'],
						$ad['ad_filename'],
						$rows['date_log'],
						$bus['bus_name'],
						$route['route_name'],
						$rows['amCount'],
						$rows['pmCount'],
						$rows['eveCount'],
						$rows['amCount'] + $rows['pmCount'] + $rows['eveCount'],
					)
				);
			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}

		public function displayCompanyReport($advertiser_id, $route_id)
		{
			$data = array();
			$ad_data = $this->Ad->get_Ad_Data($advertiser_id);
			foreach($ad_data as $ad)
			{
				$report_data = $this->Ad_Log->get_full_logs_company($ad['ad_id'], $route_id);
				foreach($report_data as $rows)
				{
					$ad = $this->Ad->edit_Ad_Data($rows['ad_id']);
					$bus = $this->Bus->edit_Bus_Data($rows['bus_id']);
					$route = $this->Route->edit_Route_Data($rows['route_id']);
					array_push($data,
						array(
							$rows['log_id'],
							$ad['ad_filename'],
							$rows['date_log'],
							$bus['bus_name'],
							$route['route_name'],
							$rows['amCount'],
							$rows['pmCount'],
							$rows['eveCount'],
							$rows['amCount'] + $rows['pmCount'] + $rows['eveCount'],
						)
					);
				}
			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}

		public function getCompanyReport($advertiser_id, $route_id)
		{
			$amCount = 0;
			$pmCount = 0;
			$eveCount = 0;
			$ad_data = $this->Ad->get_Ad_Data($advertiser_id);
			foreach($ad_data as $ad)
			{
				$report_data = $this->Ad_Log->get_logs_company($ad['ad_id'], $route_id);
				foreach($report_data as $report)
				{
					$amCount += $report['amCount'];
					$pmCount += $report['pmCount'];
					$eveCount += $report['eveCount'];
				}
			}
			$total=$amCount + $pmCount + $eveCount;
			$data = array(
				$amCount, $pmCount, $eveCount, $total
			);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}

		// U P D A T E
		public function editAd()
		{
			$ad_id=$this->input->post('ad_id');
			$data=$this->Ad->edit_Ad_Data($ad_id);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}

		public function updateAd()
		{

			$validate = array (
				array('field'=>'ad_id','label'=>'Ad Id','rules'=>'required'),
				array('field'=>'ad_name','label'=>'Ad Name','rules'=>'required|min_length[2]'),
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
					'ad_id'=>$this->input->post('ad_id'),
					'ad_name'=>$this->input->post('ad_name'),
					'advertiser_id'=>$this->input->post('advertiser_id'),
				);
				$this->Ad->update_Ad_Data($data);
				$info['message']="You have successfully updated your data!";
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($info));
		}

		// D E L E T E
		public function deleteAd()
		{
			$validate=array(
				array('field'=>'ad_id','rules'=>'required')
			);
			$this->form_validation->set_rules($validate);
			if ($this->form_validation->run()===FALSE) {
				$info['success']=FALSE;
				$info['errors']=validation_errors();
			}else{

				$file=$this->Ad->edit_Ad_Data($this->input->post('ad_id'));
				$this->load->helper("file");
				unlink("./assets/ads/".$file['ad_filename']);

				$info['success']=TRUE;
				$data=array(
					'ad_id'=>$this->input->post('ad_id')
				);
				$this->Ad->delete_Ad_Data($data);
				$info['message']='Data Successfully Deleted';
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($info));
		}

		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////

	}

// END OF AD MANAGEMENT CONTROLLER