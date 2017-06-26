<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Fares extends MY_Controller {

	// Constructor
	public function __construct(){
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');	

		$this->load->model('regions_model', 'Region');
                $this->load->model('routes_model', 'Routes');
		$this->load->model('fares_model', 'Fares');
                $this->load->model('stops_model', 'Stops');

	}

	public function index(){
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Browse Fares';
		$data['page_description']="Browse Fare Rates";
		$data['treeActive'] = 'epayment';
		$data['childActive'] = 'fares' ;
		
		$data['breadcrumbs']=array
		(
			array('Browse Fares','fares')
		);

		$this->load->view("template/header", $data);
		$this->load->view("epayment/fare_browse", $data);
		$this->load->view("template/footer", $data);
	}

	public function add(){
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='New Fare';
		$data['treeActive'] = 'epayment';
		$data['childActive'] = 'fares' ;


		$data['breadcrumbs']=array
		(
			array('Browse Fares','fares'),
			array('New Fare','fares/add')
		);

		$route_data = $this->Routes->show_Route();
		$data['routes'] = array();
		foreach ($route_data as $rows) {
			array_push($data['routes'],
				array(
					$rows['route_id'],
					$rows['route_name']
				)
			);
		}

		$this->load->view("template/header", $data);
		$this->load->view("epayment/fare_add", $data);
		$this->load->view("template/footer", $data);
	}

	public function showFares()
	{	
		$fares_table = $this->Fares->show_Fares();
		$data = array();
		foreach ($fares_table as $rows) {
			$route = $this->Routes->get_route_data( $rows['route'] );
			array_push($data,
				array(
                                    $route['route_name'],
                                    
                                    "<p>Minimum Fare:<br><b>Php ".$rows['PUBminimum_fare']." (first ".$rows['PUBminimum_km']." kilometers)</b></p>"
                                    . "<p>Rate/km (After Minimum):<br><b>Php ".$rows['PUBadded_fare']."</b></p>"
                                    . "<p>Discount:<br><b>".$rows['PUBdiscount']."%</b></p>",
                                    
                                    "<p>Minimum Fare:<br><b>Php ".$rows['PUJminimum_fare']." (first ".$rows['PUJminimum_km']." kilometers)</b></p>"
                                    . "<p>Rate/km (After Minimum):<br><b>Php ".$rows['PUJadded_fare']."</b></p>"
                                    . "<p>Discount:<br><b>".$rows['PUJdiscount']."%</p>",
                                    
                                    '<a href="'.site_url('Stops?id='.$route['route_id']).'" class="btn btn-warning btn-sm btn-block" )">Manage Stops</a>'.
                                    '<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_fare('."'".$rows['fare_id']."'".')">Edit</a>'.
                                    '<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_fare('."'".$rows['fare_id']."'".')">Delete</a>'
				)
			);
			$ctr += 1;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}

	public function saveFare()
	{
		$validate = array (
			array('field'=>'route','label'=>'Route','rules'=>'required|is_unique[fares.route]'),
			array('field'=>'PUBminimum_fare','label'=>'PUB Minimum Fare','rules'=>'required|greater_than[0]'),
			array('field'=>'PUBminimum_km','label'=>'PUB Minimum Kilometer(s)','rules'=>'required|greater_than[0]'),
			array('field'=>'PUBadded_fare','label'=>'PUB Rate/km (After Minimum)','rules'=>'required|greater_than[0]'),
			array('field'=>'PUBdiscount','label'=>'PUB Discount','rules'=>'required|greater_than[0]'),
                        array('field'=>'PUJminimum_fare','label'=>'PUJ Minimum Fare','rules'=>'required|greater_than[0]'),
			array('field'=>'PUJminimum_km','label'=>'PUJ Minimum Kilometer(s)','rules'=>'required|greater_than[0]'),
			array('field'=>'PUJadded_fare','label'=>'PUJ Rate/km (After Minimum)','rules'=>'required|greater_than[0]'),
			array('field'=>'PUJdiscount','label'=>'PUJ discount','rules'=>'required|greater_than[0]'),
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
				'route'=> $this->input->post('route'),
				'PUBminimum_fare'=>$this->input->post('PUBminimum_fare'),
				'PUBminimum_km'=>$this->input->post('PUBminimum_km'),
				'PUBadded_fare'=>$this->input->post('PUBadded_fare'),
				'PUBdiscount'=>$this->input->post('PUBdiscount'),
                                'PUJminimum_fare'=>$this->input->post('PUJminimum_fare'),
				'PUJminimum_km'=>$this->input->post('PUJminimum_km'),
				'PUJadded_fare'=>$this->input->post('PUJadded_fare'),
				'PUJdiscount'=>$this->input->post('PUJdiscount'),
			);
			$this->Fares->save_Fare($data);
			$info['message']="You have successfully saved your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
        
        public function editFare()
	{
		$fare_id=$this->input->post('fare_id');
		$data=$this->Fares->edit_Fare_Data($fare_id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
        
        public function updateFare()
	{

		$validate = array (
			array('field'=>'PUBminimum_fare','label'=>'PUB Minimum Fare','rules'=>'required|greater_than[0]'),
			array('field'=>'PUBminimum_km','label'=>'PUB Minimum Kilometer(s)','rules'=>'required|greater_than[0]'),
			array('field'=>'PUBadded_fare','label'=>'PUB Rate/km (After Minimum)','rules'=>'required|greater_than[0]'),
			array('field'=>'PUBdiscount','label'=>'PUB Discount','rules'=>'required|greater_than[0]'),
                        array('field'=>'PUJminimum_fare','label'=>'PUJ Minimum Fare','rules'=>'required|greater_than[0]'),
			array('field'=>'PUJminimum_km','label'=>'PUJ Minimum Kilometer(s)','rules'=>'required|greater_than[0]'),
			array('field'=>'PUJadded_fare','label'=>'PUJ Rate/km (After Minimum)','rules'=>'required|greater_than[0]'),
			array('field'=>'PUJdiscount','label'=>'PUJ discount','rules'=>'required|greater_than[0]'),
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
				'fare_id'=> $this->input->post('fare_id'),
				'PUBminimum_fare'=>$this->input->post('PUBminimum_fare'),
				'PUBminimum_km'=>$this->input->post('PUBminimum_km'),
				'PUBadded_fare'=>$this->input->post('PUBadded_fare'),
				'PUBdiscount'=>$this->input->post('PUBdiscount'),
                                'PUJminimum_fare'=>$this->input->post('PUJminimum_fare'),
				'PUJminimum_km'=>$this->input->post('PUJminimum_km'),
				'PUJadded_fare'=>$this->input->post('PUJadded_fare'),
				'PUJdiscount'=>$this->input->post('PUJdiscount'),
			);
			$this->Fares->update_Fare_Data($data);
			$info['message']="You have successfully updated your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
        
        public function delete_Fare()
	{
		$validate=array(
			array('field'=>'fare_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'fare_id'=>$this->input->post('fare_id')
			);
                        $fare=$this->Fares->view_fare($data['fare_id']);
                        $this->Stops->delete_Stops($fare['route']);
			$this->Fares->delete_Fare_Data($data);
			$info['message']='Data Successfully Deleted';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
        

}