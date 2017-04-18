<?php
require(APPPATH.'libraries/REST_Controller.php');

class Programs extends REST_Controller {
	
	public function __construct() {
        parent::__construct();
    }
		
	public function index_get() {
		$data = $this->get();
		// return multiple record
		$data[] = array('multiple', 'program', 'record');
		$this->response($data);
	}
	
	public function index_put() {
		$data = $this->put();
		// save a program
		$data[] = array('put', 'program');
		$this->response($data);
	}
	
	public function index_post() {
		$data = $this->post();
		
		// updates a program
		$data[] = array('post', 'program');
		$this->response($data);
	}
	
	public function index_delete() {
		// to capture the input for deletion
		$data = $this->delete();
		// deactivate a program
		$data[] = array('deactivate', 'program');
		$this->response($data);
	}
	
}