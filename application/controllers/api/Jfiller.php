<?php
require(APPPATH.'libraries/REST_Controller.php');

class Jfiller extends REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('fillers_model','Fillers');
    }
		
	public function index_get() {
		
		// http://[::1]/mngtprototype/api/jfiller/
		// http://180.232.67.229/api/jfiller/
		$data = $this->get();
		
		$where = array('status'=>0);
		$fillers = $this->Fillers->getFillers($where);
		
		if( count($fillers)>0 ){
			$response = $fillers;
		}
		else{
			$response = array('message' => 'No Star8 Contents to display.');
		}

		$this->response($response);
	}
	
	
}