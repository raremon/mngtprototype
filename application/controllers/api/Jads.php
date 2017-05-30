<?php
require(APPPATH.'libraries/REST_Controller.php');

class Jads extends REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('ads_model','Ads');
    }
		
	public function index_get() {
		
		/* JSON method to return list of ads owned by selected Advertiser */
		//http://[::1]/star8/api/jads/get/advertiser/1
		
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

	public function getAds_get() {
		
		/* JSON method to return list of ads */
		
		$data = $this->get();
		
		$where = array();
		$response = $this->Ads->getAds($where);

		$this->response($response);	
		
	}	
	
	public function try_get() {
		
		/* testing ito scrap scrap crap garbage */
		
		$data = $this->get();
		
		print_r($data);
		exit;
		
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