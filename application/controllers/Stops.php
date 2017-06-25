<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Stops extends MY_Controller {

	// Constructor
	public function __construct(){
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');	

		$this->load->model('regions_model', 'Region');
		$this->load->model('locations_model', 'Location');
		$this->load->model('cities_model', 'City');
		$this->load->model('routes_model', 'Route');
		$this->load->model('stops_model', 'Stops');
                $this->load->model('fares_model', 'Fare');
	}

	public function index(){
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Manage Stops';
		
		$data['breadcrumbs']=array
		(
			array('Browse Fares','fares'),
			array('Manage Stops','stops?id='.$_GET['id'])
		);

		$route = $this->Route->get_route_data($_GET['id']);
		$route['location_from'] = $this->Location->get_Name( $route['location_from'] );
		$route['location_to'] = $this->Location->get_Name( $route['location_to'] );
                
                $stops_table = $this->Stops->show_Stops($_GET['id']);
                $data['stops']=array();
                foreach ($stops_table as $stop) {
                    array_push($data['stops'],
                        array(
                            $stop['stop_name']
                        )
                    );
		}

		

		$data['page_description']=$route['route_name'];
		$data['route_details']=$this->route_details($route);

		$data['treeActive'] = 'epayment';
		$data['childActive'] = 'fares' ;

		$this->load->view("template/header", $data);
		$this->load->view("epayment/stop_browse", $data);
		$this->load->view("template/footer", $data);
	}

	

	public function add(){
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='New Stop';
		$data['breadcrumbs']=array
		(
			array('Browse Fares','fares'),
			array('Manage Stops','stops?id='.$_GET['id']),
			array('New Stop','stops/add?id='.$_GET['id']),
		);

		$route = $this->Route->get_route_data($_GET['id']);
		$route['location_from'] = $this->Location->get_Name( $route['location_from'] );
		$route['location_to'] = $this->Location->get_Name( $route['location_to'] );
		$data['page_description']=$route['route_name'];
                
                $region_data = $this->Region->show_Region();
		$data['region'] = array();
                
		foreach ($region_data as $rows) {
			array_push($data['region'],
				array(
					$rows['region_id'],
					$rows['region_abbr']." : ".$rows['region_name'],
				)
			);
		}
		
 
		$city_data = $this->City->show_City();
		$data['city'] = array();
		foreach ($city_data as $rows) {
			array_push($data['city'],
				array(
					$rows['city_id'],
					$rows['city_name'],
					$rows['region_id'],
				)
			);
		}

		$location_data = $this->Location->read();
		$data['location'] = array();
		foreach ($location_data as $rows) {
			array_push($data['location'],
				array(
					$rows['location_id'],
					$rows['location_name'],
					$rows['city_id'],
				)
			);
		}

		$data['treeActive'] = 'epayment';
		$data['childActive'] = 'fares' ;

		$this->load->view("template/header", $data);
		$this->load->view("epayment/stop_add", $data);
		$this->load->view("template/footer", $data);
	}

	public function route_details($route){
		$details="
			<div class='col-md-4'>
				<div style='margin-top:20px' id='table-map-canvas' class='table-canvas'> </div>
					  <script type='text/javascript'>

					  	var Xmarkers= [
							[ '".$route['location_from']['location_name']."' , ".$route['location_from']['latitude']." , ".$route['location_from']['longitude']." ],
							[ '".$route['location_to']['location_name']."' , ".$route['location_to']['latitude']." , ".$route['location_to']['longitude']." ]
						];

						initialize(Xmarkers);

						function initialize(markers) 
						{
							var bounds = new google.maps.LatLngBounds();
							var mapOptions = {
							    mapTypeId: 'roadmap',
							    navigationControl: false,
							    mapTypeControl: false,
							    scrollwheel: false,
							    scaleControl: false,
							    draggable: false,
							    disableDefaultUI: true,
							};

							var map = new google.maps.Map( document.getElementById('table-map-canvas'), mapOptions);
							map.setTilt(45);

							for( i = 0; i < markers.length; i++ ) {
							    var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
							    bounds.extend(position);
							    marker = new google.maps.Marker({
							        position: position,
							        map: map,
							        title: markers[i][0]
							    });
							}
							    map.fitBounds(bounds);

							google.maps.event.addListenerOnce(map, 'zoom_changed', function() {
							  map.setZoom(map.getZoom()-1);
							});
						}
					  </script>
			</div>
			<div style='text-align: center;' class='col-md-4'>
				<h3>".$route['route_name']."</h3>
				<h4>".$route['route_description']."</h4>
			</div>
		";

		return $details;
	}

	public function showStops()
	{
                $route = $this->Route->get_route_data($_GET['id']);
		$route['location_from'] = $this->Location->get_Name( $route['location_from'] );
		$route['location_to'] = $this->Location->get_Name( $route['location_to'] );
		$stop_table = $this->Stops->show_Stops($_GET['id']);
		$ctr = 0;
		$data = array();
		foreach ($stop_table as $rows) {
			$location = $this->Location->get_Name( $rows['location'] );
			array_push($data,
				array(
					$rows['stop_name'],
					$rows['stop_description'],
					$location['location_name'],
                                    
					"<div id='table-map-canvas-".$ctr."' class='table-canvas'> </div>
					  <script type='text/javascript'>

					  function initMap".$ctr."() {
					  		var mapOptions = {
							    mapTypeId: 'roadmap',
							    navigationControl: false,
							    mapTypeControl: false,
							    scrollwheel: false,
							    scaleControl: false,
							    draggable: false,
							    disableDefaultUI: true,
							};
					        var uluru = {lat: ".$location['latitude'].", lng: ".$location['longitude']."};
					        var map = new google.maps.Map(document.getElementById('table-map-canvas-".$ctr."'), {
					          zoom: 15,
					          center: uluru
					        });
					        var marker = new google.maps.Marker({
					          position: uluru,
					          map: map
					        });
					      }
					  </script>
					  <script async defer
					    src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCJAq_K8XorLcD2nKKsrmB7BserF3Wh3Ss&callback=initMap".$ctr."'>
					    </script>
					",
					'<a href="javascript:void(0)" class="btn btn-info btn-sm btn-block" onclick="edit_stop('."'".$rows['stop_id']."'".')">Edit</a>'.
					'<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_stop('."'".$rows['stop_id']."'".')">Delete</a>'
				)
			);
			$ctr += 1;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}

	public function saveStop()
	{
		$validate = array (
			array('field'=>'stop_name','label'=>'Stop Name','rules'=>'required|min_length[5]'),
			array('field'=>'stop_description','label'=>'Stop Description','rules'=>'required'),
			array('field'=>'location','label'=>'Location','rules'=>'required')
		);

		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) 
		{
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}
		else
		{
			$info['success']=TRUE;
                        
                        $route = $this->Route->get_route_data($this->input->post('route'));
                        $loc1 = $this->Location->get_Name( $route['location_from'] );
                        $stop = $this->Location->get_Name($this->input->post('location'));
                        $origin=array('lat'=>$loc1['latitude'],'long'=>$loc1['longitude']);
                        $destination=array('lat'=>$stop['latitude'],'long'=>$stop['longitude']);
			$data=array(
				'route'=> $this->input->post('route'),
				'stop_name'=>$this->input->post('stop_name'),
				'stop_description'=>$this->input->post('stop_description'),
				'location'=>$this->input->post('location'),
                                'km_fromLoc1' => $this->Distance($origin, $destination)
			);
			$this->Stops->save_Stop($data);
			$info['message']="You have successfully saved your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
        
        public function FareMatrixHead(){
            $data="";
            $stops = $this->Stops->show_Stops($_GET['id']);
            $data .= "<tr><th></th>";
            foreach ($stops as $stop){
                $data .= "<th>".$stop['stop_name']."</th>";
            }
            $data .= "</tr>";
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }


        public function PUBFareMatrix() {
            $data="";
            
            $stops = $this->Stops->show_Stops($_GET['id']);
            $fareDB=$this->Fare->get_fare($_GET['id']);
            
            foreach ($stops as $stop){
                $data .="<tr>"
                        . "<th style='background:#339440;color:white;text-align:center'>".$stop['stop_name']."</th>";
                $loc1 = $this->Location->get_Name($stop['location']);
                foreach ($stops as $stop1){
                    $loc2 = $this->Location->get_Name($stop1['location']);
                    $coordinates=array(
                        'lat1'=>$loc1['latitude'],
                        'long1'=>$loc1['longitude'],
                        'lat2'=>$loc2['latitude'],
                        'long2'=>$loc2['longitude']
                    );
                    $fare=$this->CalcFare($coordinates, $fareDB['PUBminimum_fare'], $fareDB['PUBminimum_km'], $fareDB['PUBadded_fare']);
                    $discounted= $this->CalcFare($coordinates, $fareDB['PUBminimum_fare'], $fareDB['PUBminimum_km'], $fareDB['PUBadded_fare'],$fareDB['PUBdiscount']);
                    $display="<td></td>";
                    if($fare!=0){ $display="<td>Php ".$fare."<br>(Discounted: Php ".$discounted.")</td>"; }
                    $data .=$display;
                }
                $data .="</tr>";
            }
            
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        public function PUJFareMatrix() {
            $data="";
            
            $stops = $this->Stops->show_Stops($_GET['id']);
            $fareDB=$this->Fare->get_fare($_GET['id']);
            
            foreach ($stops as $stop){
                $data .="<tr>"
                        . "<th style='background:#339440;color:white;text-align:center'>".$stop['stop_name']."</th>";
                $loc1 = $this->Location->get_Name($stop['location']);
                foreach ($stops as $stop1){
                    $loc2 = $this->Location->get_Name($stop1['location']);
                    $coordinates=array(
                        'lat1'=>$loc1['latitude'],
                        'long1'=>$loc1['longitude'],
                        'lat2'=>$loc2['latitude'],
                        'long2'=>$loc2['longitude']
                    );
                    $fare=$this->CalcFare($coordinates, $fareDB['PUJminimum_fare'], $fareDB['PUJminimum_km'], $fareDB['PUJadded_fare']);
                    $discounted= $this->CalcFare($coordinates, $fareDB['PUJminimum_fare'], $fareDB['PUJminimum_km'], $fareDB['PUJadded_fare'],$fareDB['PUJdiscount']);
                    $display="<td></td>";
                    if($fare!=0){ $display="<td>Php ".$fare."<br>(Discounted: Php ".$discounted.")</td>"; }
                    $data .=$display;
                }
                $data .="</tr>";
            }
            
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        
        private function Distance($origin,$destination){
            $degrees = rad2deg(acos((sin(deg2rad($origin['lat']))*sin(deg2rad($destination['lat']))) 
                    + (cos(deg2rad($origin['lat']))*cos(deg2rad($destination['lat']))
                            *cos(deg2rad($origin['long']-$destination['long'])))));
            $distance = $degrees * 111.13384;

            return $distance;
        }
        private function CalcFare($coordinates,$minFare,$minKM,$rate,$discount=0) {
            $degrees = rad2deg(acos((sin(deg2rad($coordinates['lat1']))*sin(deg2rad($coordinates['lat2']))) 
                    + (cos(deg2rad($coordinates['lat1']))*cos(deg2rad($coordinates['lat2']))
                            *cos(deg2rad($coordinates['long1']-$coordinates['long2'])))));
            $distance = $degrees * 111.13384;
            if($distance<=0.01){
                    $fare=0;
            }else if($distance<=$minKM){
                    $fare=$minFare;
            }else{
                    $fare=$minFare;
                    $addedKM=$distance-$minKM;
                    $fare+=$addedKM*$rate;
            }
            if ($discount>0) {
                    $fare-=$fare*($discount/100);
            }
            return round($fare);
        }
}