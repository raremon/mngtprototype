<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Routes extends MY_Controller {

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');

		$this->load->model('terminals_model', 'Terminal');
		$this->load->model('routes_model', 'Route');
	}
			
	public function index()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Routes';
		$data['breadcrumbs']=array
		(
			array('Add Bus','buses/add'),
			array('Add Route','routes'),
		);
		$data['css']=array
		(

		);
		$data['script']=array
		(
			'assets/js/maps.js',
		);
		$data['page_description']='Add, Update, and Delete Routes';

		$terminal_data = $this->Terminal->show_Terminal();
		$data['terminal'] = array();
		foreach ($terminal_data as $rows) {
			array_push($data['terminal'],
				array(
					$rows['terminal_id'],
					$rows['terminal_name'],
					$rows['latitude'],
					$rows['longitude'],
				)
			);
		}

		$data['treeActive'] = 'bus_management';
		$data['childActive'] = 'add_bus' ;

		$this->load->view("template/header", $data);
		$this->load->view("routes/routes", $data);
		$this->load->view("template/footer", $data);
	}

	public function terminals()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Terminals';
		$data['breadcrumbs']=array
		(
			array('Add Bus','buses/add'),
			array('Add Route','routes'),
			array('Terminals','terminals'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			'assets/js/maps.js',
		);
		$data['page_description']='Add, Update, and Delete Terminals';

		$data['treeActive'] = 'bus_management';
		$data['childActive'] = 'add_bus' ;

		$this->load->view("template/header", $data);
		$this->load->view("routes/terminals", $data);
		$this->load->view("template/footer", $data);
	}

	/////////////////////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S    B  U  S  E  S           //
	/////////////////////////////////////////////////////////////////////////////////

	// C R E A T E
	public function saveRoute()
	{
		$validate = array (
			array('field'=>'route_name','label'=>'Route Name','rules'=>'required|is_unique[routes.route_name]|min_length[5]'),
			array('field'=>'route_description','label'=>'Route Description','rules'=>'required'),
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
				'route_name'=>$this->input->post('route_name'),
				'route_description'=>$this->input->post('route_description'),
				'terminal_from'=>$this->input->post('terminal_from'),
				'terminal_to'=>$this->input->post('terminal_to'),
			);
			$this->Route->save_Route($data);
			$info['message']="You have successfully saved your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// R E A D
	public function show_Route()
	{
		$route_table = $this->Route->show_Route();
		$ctr = 0;
		$data = array();
		foreach ($route_table as $rows) {
			$terminal_from_data = $this->Terminal->edit_Terminal_Data( $rows['terminal_from'] );
			$terminal_to_data = $this->Terminal->edit_Terminal_Data( $rows['terminal_to'] );
			array_push($data,
				array(
					$rows['route_id'],
					$rows['route_name'],
					$rows['route_description'],

					"<div id='table-map-canvas-".$ctr."' class='table-canvas'> </div>
					  <script type='text/javascript'>

					  	var Xmarkers".$ctr." = [
							[ '".$terminal_from_data['terminal_name']."' , ".$terminal_from_data['latitude']." , ".$terminal_from_data['longitude']." ],
							[ '".$terminal_to_data['terminal_name']."' , ".$terminal_to_data['latitude']." , ".$terminal_to_data['longitude']." ]
						];

						initialize".$ctr."(Xmarkers".$ctr.");

						function initialize".$ctr."(markers) 
						{
							var bounds = new google.maps.LatLngBounds();
							var mapOptions = {
							    mapTypeId: 'roadmap',
							    navigationControl: false,
							    mapTypeControl: false,
							    scrollwheel: false,
							    scaleControl: false,
							    draggable: false,
							    disableDefaultUI: true,
							};

							var map = new google.maps.Map( document.getElementById('table-map-canvas-".$ctr."'), mapOptions);
							map.setTilt(45);

							for( i = 0; i < markers.length; i++ ) {
							    var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
							    bounds.extend(position);
							    marker = new google.maps.Marker({
							        position: position,
							        map: map,
							        title: markers[i][0]
							    });
							}
							    map.fitBounds(bounds);

							google.maps.event.addListenerOnce(map, 'zoom_changed', function() {
							  map.setZoom(map.getZoom()-1);
							});
						}
					  </script>
					",

					'<a href="javascript:void(0)" class="btn btn-info btn-sm" onclick="edit_route('."'".$rows['route_id']."'".')">Edit</a>'.
					'&nbsp;<a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="delete_route('."'".$rows['route_id']."'".')">Delete</a>'
				)
			);
			$ctr += 1;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}

	// U P D A T E
	public function edit_Route()
	{
		$route_id=$this->input->post('route_id');
		$data=$this->Route->edit_Route_Data($route_id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function updateRoute()
	{

		$validate = array (
			array('field'=>'route_id','label'=>'Route ID','rules'=>'required'),
			array('field'=>'route_name','label'=>'Route Name','rules'=>'required|min_length[5]'),
			array('field'=>'route_description','label'=>'Route Description','rules'=>'required'),
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
				'route_id'=>$this->input->post('route_id'),
				'route_name'=>$this->input->post('route_name'),
				'route_description'=>$this->input->post('route_description'),
				'terminal_from'=>$this->input->post('terminal_from'),
				'terminal_to'=>$this->input->post('terminal_to'),
			);
			$this->Route->update_Route_Data($data);
			$info['message']="You have successfully updated your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// D E L E T E
	public function delete_Route()
	{
		$validate=array(
			array('field'=>'route_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'route_id'=>$this->input->post('route_id')
			);
			$this->Route->delete_Route_Data($data);
			$info['message']='Data Successfully Deleted';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	/////////////////////////////////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S    T  E  R  M  I  N  A  L  S           //
	/////////////////////////////////////////////////////////////////////////////////////////////

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
						    disableDefaultUI: true,
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

// END OF BUSES CONTROLLER