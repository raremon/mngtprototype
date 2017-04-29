<?php
require(APPPATH.'libraries/REST_Controller.php');

class Jads extends REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('ads_model','Ads');
    }
		
	public function index_get() {
		
		/* JSON method to return list of ads owned by selected Advertiser */
		
		$data = $this->get();
		
		if( isset($data['advertiser']) && is_numeric($data['advertiser']) ){
			$where = array('advertisers.advertiser_id'=>$data['advertiser']);
			$response = $this->Ads->getAds($where);
		}
		else{			
			$response = array('message' => 'No schedule to retrieve.');
		}
		
		$this->response($response);	
		
	}
	
}