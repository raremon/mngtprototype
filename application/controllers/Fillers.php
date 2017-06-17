<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	// MY_Controller in Core Folder
	class Fillers extends MY_Controller {	

		// Constructor
		public function __construct()
		{
			parent::__construct();
			$this->load->model('users_model', 'User');
			$this->load->model('roles_model', 'Role');

			// $this->load->model('advertisers_model', 'Advertiser');
			// $this->load->model('ads_model', 'Ad');

			$this->load->model('fillers_model', 'Filler');
		}


		public function upload()
		{
			$data['role'] = $this->logged_out_check();
			$data['title'] = 'Upload New Filler';
			$data['page_description'] = 'Upload Filler Content';
            $data['breadcrumbs']=array
			(
				array('Browse Fillers','fillers/browse'),
				array('Upload New Filler','fillers/upload'),
			);
            $data['css']=array
            (
            	'assets/css/browse_style.css',
            );
            $data['script']=array
            (
            	'assets/js/jquery.form.js',
            );

			$data['treeActive'] = 'ads_management';
			$data['childActive'] = 'browse_fillers' ;

			$this->load->view("template/header", $data);
			$this->load->view("ads_mngt/filler_upload", $data);
			$this->load->view("template/footer", $data);
		}

		public function browse()
		{
			$data['role'] = $this->logged_out_check();
			$data['title'] = 'Browse Fillers';
			$data['page_description'] = 'Browse Filler Content';
            $data['breadcrumbs']=array
			(
				array('Browse Fillers','fillers/browse'),
			);
            $data['css']=array
            (
            	'assets/css/browse_style.css',
            );
            $data['script']=array
            (
            	'assets/js/jquery.form.js',
            );

			$data['treeActive'] = 'ads_management';
			$data['childActive'] = 'browse_fillers' ;

			$this->load->view("template/header", $data);
			$this->load->view("ads_mngt/filler_browse", $data);
			$this->load->view("template/footer", $data);
		}

		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////

		// C R E A T E
		public function saveFiller()
		{
			if(isset($_FILES["filler_file"]["name"]))
			{
				$validate = array (
					array('field'=>'filler_title','label'=>'Filler Title','rules'=>'trim|required|is_unique[fillers.filler_title]|min_length[2]'),
					array('field'=>'filler_description','label'=>'Filler Description','rules'=>'trim|required|min_length[2]'),
					array('field'=>'filler_filename','label'=>'Filler File Name','rules'=>'required'),
				);

				$this->form_validation->set_rules($validate);
				if ($this->form_validation->run()===FALSE) 
				{
					$info['success']=FALSE;
					$info['errors']=validation_errors();
				}
				else
				{	
					$ext = pathinfo($_FILES["filler_file"]["name"], PATHINFO_EXTENSION);

					$config['upload_path'] = "./assets/fillers/";
					$config['allowed_types'] = 'mp4|mpeg4|m4v|mkv|jpg|png|gif';

					$config['max_size'] = '100000000';
					//NOTE
					$config['file_name'] = $this->input->post('filler_filename');

					$this->load->library('upload', $config);

					if( ! $this->upload->do_upload('filler_file'))
					{
						$info['success']=FALSE;
						$info['errors']=$this->upload->display_errors();
					}
					else
					{
						$info['success']=TRUE;
						$upload_data = $this->upload->data();
						$filename = $upload_data['file_name'];

						// $filename = str_replace(' ', '_', preg_replace("/ {2,}/", " ", $config['file_name'].".".$ext) );
						if($ext == 'mp4' || $ext == 'mpeg4' || $ext == 'm4v' || $ext == 'mkv')
						{
							$info['message']='<video id="Xvideo" width="100%" controls>
						  						<source src="'.base_url("assets/fillers/".$filename).'" type="video/mp4">
						  						Your browser does not support HTML5 video.
											  </video>
											  <div class="form-group">
										        <input name="filler_type" type="text" class="form-control hidden" value="1">
										      </div>
											  <script>	
													var video = document.getElementById("Xvideo");
													video.addEventListener("durationchange", function() {
													    $("#video_duration").val(Math.ceil(video.duration));
													    $("#video_filename").val("'.$filename.'");
													    save();
													});
											  </script>';
						}
						else
						{
							$info['message']='<div class="form-group">
										        <input name="filler_type" type="text" class="form-control" value="2">
										      </div>
										      <script>
												    $("#video_duration").val(0);
												    $("#video_filename").val("'.$filename.'");
												    save();
											  </script>';
						}
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

		public function saveFill()
		{
			$info['success']=TRUE;
			$data=array(
				'filler_title'=>$this->input->post('filler_title'),
				'filler_description'=>$this->input->post('filler_description'),
				'filler_type'=>$this->input->post('filler_type'),
				'filler_file'=> $this->input->post('video_filename'),
				'filler_duration' => (int)$this->input->post('filler_duration'),

			);
			$this->Filler->save_Filler($data);
			$info['message']="<p class='success-message'>You have successfully saved <span class='message-name'>".$data['filler_title']."</span>!</p>";
			$this->output->set_content_type('application/json')->set_output(json_encode($info));
		}

		// R E A D
		public function showFiller()
		{
			$table = $this->Filler->show_Filler();
			$content = "";
			$data = array();
			foreach ($table as $rows) {
				if($rows['filler_type']==1)
				{
					//video
					$content='<button class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#modal'.$rows['filler_id'].'">Play Video</button>

							<div id="modal'.$rows['filler_id'].'" class="modal fade" role="dialog">
							  <div class="modal-dialog modal-lg">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title">'.$rows['filler_title'].'</h4>
							      </div>
							      <div class="modal-body">
							        <video id="v'.$rows["filler_id"].'" width="100%" controls>
							  			<source src="'.base_url("assets/fillers/".$rows["filler_file"]).'" type="video/mp4">
							  			Your browser does not support HTML5 video.
									</video>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							      </div>
							    </div>
							  </div>
							</div>

							<script type="text/javascript">
							  $(document).on("show.bs.modal","#modal'.$rows['filler_id'].'", function () {
							  	$("#v'.$rows["filler_id"].'").load();
								$("#v'.$rows["filler_id"].'").trigger("play");
							  })
							</script>
							';
				}
				else
				{
					//image
					$content='<button class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#modal'.$rows['filler_id'].'">Show Image</button>

							<div id="modal'.$rows['filler_id'].'" class="modal fade" role="dialog">
							  <div class="modal-dialog modal-lg">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title">'.$rows['filler_title'].'</h4>
							      </div>
							      <div class="modal-body">
									<img id="v'.$rows["filler_id"].'" src="'.base_url("assets/fillers/".$rows["filler_file"]).'" class="img-responsive">
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							      </div>
							    </div>
							  </div>
							</div>
							';
				}
				array_push($data,
					array(
						$rows['filler_title'],
						$rows['filler_description'],
						$content,
						'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_filler('."'".$rows['filler_id']."'".')">Edit</a>'.
						'<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_filler('."'".$rows['filler_id']."'".')">Delete</a>'

					)
				);
			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}

		// U P D A T E
		public function editFiller()
		{
			$id=$this->input->post('filler_id');
			$data=$this->Filler->edit_Filler($id);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}

		public function updateFiller()
		{

			$validate = array (
				array('field'=>'filler_id','label'=>'Filler Id','rules'=>'required'),
				array('field'=>'filler_title','label'=>'Filler Title','rules'=>'required|min_length[2]'),
				array('field'=>'filler_description','label'=>'Filler Description','rules'=>'required|min_length[2]'),
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
					'filler_id'=>$this->input->post('filler_id'),
					'filler_title'=>$this->input->post('filler_title'),
					'filler_description'=>$this->input->post('filler_description'),
				);
				$this->Filler->update_Filler($data);
				$info['message']="<p class='success-message'>You have successfully updated <span class='message-name'>".$data['filler_title']."</span>!</p>";
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($info));
		}

		// D E L E T E
		public function deleteFiller()
		{
			// CHECK IF FILLER IS IN ANOTHER TABLE ?? di ko alam anong table hehe
			$validate=array(
				array('field'=>'filler_id','rules'=>'required')
			);
			$this->form_validation->set_rules($validate);
			if ($this->form_validation->run()===FALSE) {
				$info['success']=FALSE;
				$info['errors']=validation_errors();
			}else{

				$file=$this->Filler->edit_Filler($this->input->post('filler_id'));
				$this->load->helper("file");
				unlink("./assets/fillers/".$file['filler_file']);

				$info['success']=TRUE;
				$data=array(
					'filler_id'=>$this->input->post('filler_id')
				);
				$this->Filler->delete_Filler($data);
				$info['message']='Filler Successfully Deleted';
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($info));
		}

		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////

	}

// END OF FILLERS CONTROLLER