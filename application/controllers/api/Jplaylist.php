<?php
require(APPPATH.'libraries/REST_Controller.php');

class Jplaylist extends REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('playlist_model','Playlist');
    }
		
	public function index_get() {

		$data = $this->get();
	
		if( isset($data['route']) ){
			$where = array('playlist.route_id'=>$data['route']);
		}
		else{
			$serial = ( preg_match('/%20/',$data['serial']) ) ?	urldecode($data['serial']) : $data['serial'];
			$where = array('tvs.tv_serial'=> $serial );
		}

		$date = date('Y-m-d');
	
		$list = $this->Playlist->read($date, $where);

		$this->response($list);		
		
	}
	
}