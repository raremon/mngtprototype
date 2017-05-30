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
		// Array ( [app] => 001 [route] => 7 )
		
		$data = $this->get();
		
		// if( isset($data['app']) && isset($data['route']) && is_numeric($data['route']) ){
		if( isset($data['route']) && is_numeric($data['route']) ){
			$where = array('tbappupdate.RouteId'=>$data['route']);
			
			if( isset($data['app']) ){
				$app_where = array('tbappupdate.Appid'=>$data['app']);
				$where = array_merge($where, $app_where);
			}
			
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
	
	public function appupdates_post(){
		
		// localhost/mngtprototype/api/jappupdate/appupdates
		
		$d = $this->post();

		// Appid, DbStatus 
		
		if( isset($d['Appid']) && strlen($d['Appid'])>0 && isset($d['DbStatus']) && is_numeric($d['DbStatus'])  ){
			
			$where = array('Appid'=>$d['Appid']);
			$updates = $this->Appupdate->get_Appupdate($where);
			
			if( count($updates)>0 ){
				$data = array('DbStatus'=>$d['DbStatus']);
				$response = $this->Appupdate->update_Appupdate($data, $where);
			}
			else{
				$response = array();
			}
		}else{
			$response = array('Message'=>'No records');
		}
		
		$this->response($response);		
	}
		
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