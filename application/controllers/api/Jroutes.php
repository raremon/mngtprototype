<?php
require(APPPATH.'libraries/REST_Controller.php');

class Jroutes extends REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('routes_model','Routes');
    }
		
	public function index_get() {
		
		/* Return list of routes */
		//http://180.232.67.229/api/jroutes/
		
		$d = $this->get();
		
		$where = array();
		$response = $this->Routes->show_Route($where);
		
		$this->response($response);	
		
	}
	
}