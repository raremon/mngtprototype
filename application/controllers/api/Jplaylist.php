<?php
require(APPPATH.'libraries/REST_Controller.php');

class Jplaylist extends REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('playlist_model','Playlist');
    }
		
	public function index_get() {
		
		$data = $this->get();
		
		// print_r($data);
		// exit;
		$where = array('route_id'=>$data['route']);
		$date = date('Y-m-d');
	
		$list = $this->Playlist->read($date, $where);

		$this->response($list);		
		
	}
	
}