<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Ad Management Controller

// MY_Controller in Core Folder
class Adslog extends MY_Controller {	

		// Constructor
	public function __construct()
	{
			parent::__construct();
			$this->load->model('users_model', 'User');
			$this->load->model('roles_model', 'Role');

			// $this->load->model('advertisers_model', 'Advertiser');
			// $this->load->model('ads_model', 'Ad');
			$this->load->model('adlogs_model', 'Adlogs');
	}
		
	public function index(){	
	}
		
	public function adstats_report() {
		
		/* method to return stats of all ads played for selected Advertiser 
			group by route_id, ad_id, total for AM, PM, EVENING */
		
		$d = $_POST;
		
		// required variables:	from, to, advertiser_id, <advanced filter or more options>
		
		if( $_SERVER['REQUEST_METHOD']=='POST' ){
			
			if( isset($d['advertiser']) && is_numeric($d['advertiser']) ){
				
				$where = array('advertiser_id'=>$d['advertiser']);
				
				if( isset($d['from']) && isset($d['to']) ){
					// $period = array('date_log>="'.$d['from'].'" OR date_log<="'.$d['to'].'"'=>NULL);
					// $where = array_merge($where,$period);
					$from = $data['from'];
					$to = $data['to'];	
					$custom_condition = '(date_log>="$from" || date_log<="$to")';	
					
				}
				
				$report = $this->Adlogs->getAdLogsTotal($where,NULL,$custom_condition);
				
				//load the view to show report stats with option for printable and export to PDF
				//graph can also be used to show stats
				// print_r($report);
				//sample report for ads
				echo '<h3>Ad Statistics</h3>';
				echo '<small>From '.date('m/d/Y',strtotime($d['from'])).' to '.date('m/d/Y',strtotime($d['to'])).'</small>';
				echo '<table border="1">
						<thead>
							<tr>
								<th>Route</th>
								<th>Ad Title</th>
								<th>Am Stats</th>
								<th>Pm Stats</th>
								<th>Eve Stats</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
				';
				foreach($report as $r){
					echo '	<tr>
								<td>'.$r['route_name'].'</td>
								<td>'.$r['ad_name'].'</td>
								<td>'.$r['am'].'</td>
								<td>'.$r['pm'].'</td>
								<td>'.$r['eve'].'</td>
								<td>'.($r['am']+$r['pm']+$r['eve']).'</td>
							</tr>';
				}
				
				echo '</tbody></table>';
			}
			else{			
				echo 'No stats to display';
			}			
			
		}else{ //display the report view
			
			echo 'Show the view for previewing Ad Stats report';
			
			// $this->load->view('');
		}
	}

}	
		