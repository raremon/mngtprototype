<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terminals extends MY_Controller {

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');

		// $this->load->model('Terminal');
		$this->load->model('terminals_model', 'Terminal');
	}

	// Index Function
	public function index()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Terminals';
		$data['breadcrumbs']=array
		(
			array('Add Bus','buses/add'),
			array('Terminals','terminals'),
		);
		$data['page_description']='Add, Update, and Delete Terminals';

		// $bus_type_data = $this->Bus_type->show_Bus_Type();
		// $data['bustype'] = array();
		// foreach ($bus_type_data as $rows) {
		// 	array_push($data['bustype'],
		// 		array(
		// 			$rows['bus_type_id'],
		// 			$rows['bus_type_name'],
		// 		)
		// 	);
		// }

		$data['treeActive'] = 'bus_management';
		$data['childActive'] = 'add_bus' ;

		$this->load->view("template/header", $data);
		$this->load->view("buses/terminals", $data);
		$this->load->view("template/footer", $data);
	}

	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////

	// C R E A T E
	public function saveTerminal()
	{
		$validate = array (
			array('field'=>'terminal_name','label'=>'Terminal Name','rules'=>'required|is_unique[terminals.terminal_name]'),
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
				'terminal_name'=>$this->input->post('terminal_name'),
				'latitude'=>$this->input->post('latitude'),
				'longitude'=>$this->input->post('longitude'),
			);
			$this->Terminal->save_Terminal($data);
			$info['message']="You have successfully saved your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// R E A D
	public function show_Terminal()
	{
		$terminal_table = $this->Terminal->show_Terminal();
		$ctr = 0;
		$data = array();
		foreach ($terminal_table as $rows) {
			array_push($data,
				array(
					$rows['terminal_id'],
					$rows['terminal_name'],
					"<div id='table-map-canvas-".$ctr."' class='table-canvas'> </div>
					  <script type='text/javascript'>

						var map".$ctr." = new google.maps.Map( document.getElementById('table-map-canvas-".$ctr."'),{
							center:{
								lat: ". $rows['latitude'] .",
								lng: ". $rows['longitude'] ."
							},
							zoom:17,
							scrollwheel: false,
						    navigationControl: false,
						    mapTypeControl: false,
						    scaleControl: false,
						    draggable: false,
						    mapTypeId: google.maps.MapTypeId.ROADMAP
						});

						var marker".$ctr." = new google.maps.Marker({
							position:{
								lat: ". $rows['latitude'] .",
								lng: ". $rows['longitude'] ."
							},
							map:map".$ctr.",
							draggable: false
						});
					  </script>
					",
					
					'<a href="#main-cont" class="btn btn-info btn-sm" onclick="edit_terminal('."'".$rows['terminal_id']."'".')">Edit</a>'.
					'&nbsp;<a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="delete_terminal('."'".$rows['terminal_id']."'".')">Delete</a>'
				)
			);
			$ctr += 1;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}

	// U P D A T E
	public function edit_Terminal()
	{
		$terminal_id=$this->input->post('terminal_id');
		$data=$this->Terminal->edit_Terminal_Data($terminal_id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function updateTerminal()
	{

		$validate = array (
			array('field'=>'terminal_name','label'=>'Terminal Name','rules'=>'required'),
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
				'terminal_id'=>$this->input->post('terminal_id'),
				'terminal_name'=>$this->input->post('terminal_name'),
				'latitude'=>$this->input->post('latitude'),
				'longitude'=>$this->input->post('longitude')
			);
			$this->Terminal->update_Terminal_Data($data);
			$info['message']="You have successfully updated your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// D E L E T E
	public function delete_Terminal()
	{
		$validate=array(
			array('field'=>'terminal_id','label'=>'Terminal Id','rules'=>'required'),
		);

		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else
		{
			$info['success']=TRUE;
			$data=array(
				'terminal_id'=>$this->input->post('terminal_id')
			);
			$this->Terminal->delete_Terminal_Data($data);
			$info['message']='Data Successfully Deleted';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////

}

// END OF TERMINAL CONTROLLER