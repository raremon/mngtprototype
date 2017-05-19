<?php
require(APPPATH.'libraries/REST_Controller.php');

class Jappupdate extends REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('appupdate_model','Appupdate');
    }
		
	public function index_get() {
		
		/* JSON method to return updates for the infotainment app/exe */
		//http://localhost/mngtprototype/api/jappupdate/get/app/001/route/7
		//http://180.232.67.229 
		// Array ( [app] => 001 [route] => 7 )
		
		$data = $this->get();
		
		// print_r($data);
		// exit;
		
		if( isset($data['app']) && isset($data['route']) && is_numeric($data['route']) ){
			$where = array('tbappupdate.Appid'=>$data['app'],'tbappupdate.RouteId'=>$data['route'],);
			$response = $this->Appupdate->getAppupdates($where);
		}
		else{			
			$response = array('message' => 'No updates to retrieve.');
		}
		
		$this->response($response);	
		
	}

	public function addappupdate_post(){
		
		$d = $this->post();

		/* JSON method to save logs of ads played on buses via POST method call by VB app */
		// http://[::1]/mngtprototype/api/jappupdate/addappupdate
		/* POSTED variables:

`tbappupdate` (
  `KeyId` int(11) NOT NULL AUTO_INCREMENT,
  `Appid` varchar(45) DEFAULT NULL,
  `AppFilename` varchar(45) DEFAULT NULL,
  `AppDtMod` varchar(45) DEFAULT NULL,
  `AppFileSize` varchar(45) DEFAULT NULL,
  `DbStatus` varchar(45) DEFAULT NULL,
  `RouteId` varchar(45) DEFAULT NULL,
  
  Posted variables: app, filename, datemod, filesize, dbstat, route
		*/
			
		if( isset($d['app']) && isset($d['filename']) && isset($d['datemod']) && isset($d['dbstat']) && isset($d['route']) ){

			//check if app update already exists
				
			$where = array(
							'tbappupdate.Appid'=>$d['app'],'tbappupdate.RouteId'=>$d['route'],'AppDtMod'=>$d['datemod']
							);
				
			$check = $this->Appupdate->getAppupdates($where);
				
			if( count($check)>0 ){ //update old update with new update

				$record = array(
							'AppFilename' => $d['filename'],
							'AppDtMod' => $d['datemod'],
							'AppFileSize' => $d['filesize'],
							'DbStatus' => $d['dbstat'],
							'RouteId' => $d['route']
							);
				 
				$result = $this->Appupdate->update_Appupdate($record,$where);
				
			}
			else{ // save new log 
					
				$record = array(
							'Appid' => $d['app'],
							'AppFilename' => $d['filename'],
							'AppDtMod' => $d['datemod'],
							'AppFileSize' => $d['filesize'],
							'DbStatus' => $d['dbstat'],
							'RouteId' => $d['route']	
							);
								
				$result = $this->Appupdate->save_Appupdate($record);		
				// $msg = ($result>0)?'Logs successfully synched.':'Failed to synch new logs ...';	
				// $msg = ($result>0)?1:0;					
			}
				
			$msg = ($result>0)?1:0;	
			$response = $msg;
			
		}else{				
		
			$response = false;

		}
	
		$this->response($response);		
	}
	
	public function addlogs_get(){
		
		$d = $this->get();

		/* JSON method to save logs of ads played on buses via POST method call by VB app */
		//http://[::1]/star8/api/jlogs/addlogs
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
			
		if( isset($d['bus_id']) && isset($d['ad_id']) && isset($d['dateLog']) && isset($d['route_id']) ){

			//check if log for the day from this bus already exists
				
			$where = array(
							'date_log'=>$d['dateLog'],'bus_id'=>$d['bus_id'],'ad_logs.ad_id'=>$d['ad_id']
							);
				
			$check = $this->AdLogs->getAdLogs($where);
			
			// echo count($check);
			// exit;
			
			if( count($check)>0 ){ //update old log with new log

				$record = array(
							'amCount' => $d['amCount'],
							'pmCount' => $d['pmCount'],
							'eveCount' => $d['eveCount']
							);
				 
				$result = $this->AdLogs->update_Adlogs($record,$where);
					
				// $msg = ($result>0)?'Logs successfully synched.':'Failed to synch updated logs ...';
				// $msg = ($result>0)?1:0;
				
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
				// $msg = ($result>0)?'Logs successfully synched.':'Failed to synch new logs ...';	
				// $msg = ($result>0)?1:0;					
			}
				
			$msg = ($result>0)?1:0;	
			$response = $msg;
			
		}else{				
		
			$response = false;

		}
	
		$this->response($response);		
	}
	
	public function addlogs_post(){
		
		$d = $this->post();

		/* JSON method to save logs of ads played on buses via POST method call by VB app */
		//http://[::1]/star8/api/jlogs/addlogs
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
			
		if( isset($d['bus_id']) && isset($d['ad_id']) && isset($d['dateLog']) && isset($d['route_id']) ){

			//check if log for the day from this bus already exists
				
			$where = array(
							'date_log'=>$d['dateLog'],'bus_id'=>$d['bus_id'],'ad_logs.ad_id'=>$d['ad_id']
							);
				
			$check = $this->AdLogs->getAdLogs($where);
				
			if( count($check)>0 ){ //update old log with new log

				$record = array(
							'amCount' => $d['amCount'],
							'pmCount' => $d['pmCount'],
							'eveCount' => $d['eveCount']
							);
				 
				$result = $this->AdLogs->update_Adlogs($record,$where);
					
				// $msg = ($result>0)?'Logs successfully synched.':'Failed to synch updated logs ...';
				// $msg = ($result>0)?1:0;
				
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
				// $msg = ($result>0)?'Logs successfully synched.':'Failed to synch new logs ...';	
				// $msg = ($result>0)?1:0;					
			}
				
			$msg = ($result>0)?1:0;	
			$response = $msg;
			
		}else{				
		
			$response = false;

		}
	
		$this->response($response);		
	}

	public function adstatsowner_get() {
		
		/* JSON method to return stats of all ads played for selected Advertiser 
			group by route_id, ad_id, total for AM, PM, EVENING */
		// http://[::1]/star8/api/jlogs/adstatsowner/advertiser/1/from/2017-04-20/to/2017-04-30
		// http://180.232.67.229/api/jlogs/adstatsowner/advertiser/1/from/2017-04-20/to/2017-04-30
		
		$data = $this->get();
		
		if( isset($data['advertiser']) && is_numeric($data['advertiser']) ){
			
			$where = array('advertiser_id'=>$data['advertiser']);
			
			if( isset($data['from']) && isset($data['to']) ){
				
				$from = $data['from'];
				$to = $data['to'];
				$custom_condition = '(date_log>="$from" || date_log<="$to")';

			}
			
			$response = $this->AdLogs->getAdLogsTotal($where,NULL,$custom_condition);
		
		}
		else{			
			$response = array('message' => 'No ads stats to show.');
		}
		
		$this->response($response);	
		
	}

	public function adstats_get() {
		
		/* JSON method to return stats of all ads played group by route_id, ad_id, total for AM, PM, EVENING */
		
		$data = $this->get();		
		
		$where = array(); //conditions to be determined later
		
		if( isset($data['from']) && isset($data['to']) ){
			$from = $data['from'];
			$to = $data['to'];	
			$custom_condition = '(date_log>="$from" || date_log<="$to")';			
		}
			
		// $response = $this->AdLogs->getAdLogsTotal($where);
		$response = $this->AdLogs->getAdLogsTotal($where,NULL,$custom_condition);
		
		$this->response($response);	
		
	}		
	
}