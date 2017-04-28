<?php
require(APPPATH.'libraries/REST_Controller.php');

class Jlogs extends REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('ads_model','Ads');
		$this->load->model('adlogs_model','AdLogs');
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

	public function addlogs_post(){
		
		$d = $this->post();
		
		/* JSON method to save logs of ads played on buses via POST method call by VB app */
		/* POSTED variables:
			Array
			(
				[logID] => 1
				[ad_id] => 1
				[dateLog] => 2017-04-28
				[bus_id] => 1
				[amCount] => 25
				[pmCount] => 30
				[eveCount] => 10
				[route_id] => 7
			)			
		*/
			
		if($_SERVER['REQUEST_METHOD']=='POST'){
			
			if( isset($d['bus_id']) && isset($d['ad_id']) && isset($d['dateLog']) && isset($d['route_id']) ){
				
				//check if log for the day from this bus already exists
				
				$where = array('date_log'=>$d['dateLog'],'bus_id'=>$d['bus_id'],'ad_id'=>$d['ad_id']);
				
				$check = $this->AdLogs->getAdLogs($where);
				
				if( count($check)>0 ){ //update old log with new log

					$record = array(
								'amCount' => $d['amCount'],
								'pmCount' => $d['pmCount'],
								'eveCount' => $d['eveCount'],
								'updated' => ''
								);
					 
					$result = $this->AdLogs->update_Adlogs($record,$where);
					
				}
				else{ // save new log 
					
					$record = array(
								'ad_id' => $d['ad_id'],
								'date_log' => $d['dateLog'],
								'bus_id' => $d['bus_id'],
								'amCount' => $d['amCount'],
								'pmCount' => $d['pmCount'],
								'eveCount' => $d['eveCount'],
								'route_id' => $d['route_id']	
								);
								
					$result = $this->AdLogs->save_Adlogs($record);					
				}
					
				$msg = ($result>0)?'Logs successfully synched.':'Failed to synch logs.';
				
				$response = array('message' => $msg);
				
			}else{
				$response = array('message' => 'Failed to synch logs.');
			}
		}else{
			return false;
		}	
	
		$this->response($response);		
	}
	
}