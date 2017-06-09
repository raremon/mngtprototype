<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	// Program Schedule Controller

	// MY_Controller in Core Folder
	class Program extends MY_Controller {	

		// Constructor
		public function __construct()
		{
			parent::__construct();
			$this->load->model('users_model', 'User');
			$this->load->model('roles_model', 'Role');

			$this->load->model('advertisers_model', 'Advertiser');
			$this->load->model('routes_model', 'Route');
			$this->load->model('locations_model', 'Location');
			$this->load->model('ads_model', 'Ad');

			$this->load->model('orders_model', 'Order');
			$this->load->model('order_slots_model', 'Tslot');
			$this->load->model('order_routes_model', 'RouteOrder');

			$this->load->model('timeslots_model', 'Timeslot');
			$this->load->model('salesmen_model', 'Sales');

			$this->load->model('nschedules_model', 'nSched');
            $this->load->model('playlists_model', 'Playlist');
		}
		
		// Index Function
		public function create()
		{
			$data['role'] = $this->logged_out_check();
			$data['title'] = 'Program Schedule';
			$data['page_description'] = 'Manage Program Schedule';
            $data['breadcrumbs']=array
		      (
                array('Create Program Schedule','program/create'),
		      );
            $data['css']=array
            (
            	'assets/plugins/daterangepicker/daterangepicker.css',
				'assets/plugins/datepicker/datepicker3.css',
				'assets/plugins/select2/select2.min.css',
				'assets/plugins/iCheck/all.css',
				'assets/plugins/timepicker/bootstrap-timepicker.min.css',
            );
            $data['script']=array
            (
            	'assets/js/moment.min.js',
				'assets/plugins/input-mask/jquery.inputmask.js',
				'assets/plugins/input-mask/jquery.inputmask.date.extensions.js',
				'assets/plugins/input-mask/jquery.inputmask.extensions.js',
				'assets/plugins/daterangepicker/daterangepicker.js',
				'assets/plugins/datepicker/bootstrap-datepicker.js',
				'assets/plugins/select2/select2.full.min.js',
				'assets/plugins/iCheck/icheck.min.js',
            	'assets/js/program_sched.js',
            );
			$data['treeActive'] = 'program_schedule';
			$data['childActive'] = 'create_program_schedule' ;

			$advertiser_data = $this->Advertiser->show_Advertiser();
			$data['advertiser'] = array();
			foreach ($advertiser_data as $rows) {
				array_push($data['advertiser'],
					array(
						$rows['advertiser_id'],
						$rows['advertiser_name'],
					)
				);
			}

			$route_data = $this->Route->show_Route();
			$data['route'] = array();
			foreach ($route_data as $rows) {
				array_push($data['route'],
					array(
						$rows['route_id'],
						$rows['route_name'],
					)
				);
			}

			$this->load->view("template/header", $data);
			$this->load->view("program/program_create_open", $data);
			$this->load->view("program/program_create_regular", $data);
			$this->load->view("program/program_create_scheduled", $data);
			$this->load->view("program/program_create_block", $data);
			$this->load->view("program/program_create_close", $data);
			$this->load->view("template/footer", $data);
		}

		public function browse()
        {
            $data = array();
            $data['role'] = $this->logged_out_check();
            $data['title']='Browse Program Schedule';
            $data['page_description'] = 'Browse Created Program Schedule';
            $data['breadcrumbs']=array
            (
                array('Browse Program Schedule','program/browse'),
            );
            $data['css']=array
            (
            	'assets/plugins/daterangepicker/daterangepicker.css',
				'assets/plugins/datepicker/datepicker3.css',
				'assets/plugins/select2/select2.min.css',
				'assets/plugins/iCheck/all.css',
				'assets/plugins/timepicker/bootstrap-timepicker.min.css',
            );
            $data['script']=array
            (
            	'assets/js/moment.min.js',
				'assets/plugins/input-mask/jquery.inputmask.js',
				'assets/plugins/input-mask/jquery.inputmask.date.extensions.js',
				'assets/plugins/input-mask/jquery.inputmask.extensions.js',
				'assets/plugins/daterangepicker/daterangepicker.js',
				'assets/plugins/datepicker/bootstrap-datepicker.js',
				'assets/plugins/select2/select2.full.min.js',
				'assets/plugins/iCheck/icheck.min.js',
            	'assets/js/program_sched.js',
            );
			$advertiser_data = $this->Advertiser->show_Advertiser();
			$data['advertiser'] = array();
			foreach ($advertiser_data as $rows) {
				array_push($data['advertiser'],
					array(
						$rows['advertiser_id'],
						$rows['advertiser_name'],
					)
				);
			}

			$route_data = $this->Route->show_Route();
			$data['route'] = array();
			foreach ($route_data as $rows) {
				array_push($data['route'],
					array(
						$rows['route_id'],
						$rows['route_name'],
					)
				);
			}
            $data['treeActive'] = 'program_schedule';
            $data['childActive'] = 'browse_program_schedule' ;

            $this->load->view("template/header", $data);
            $this->load->view("program/program_browse", $data);
            $this->load->view("template/footer", $data);
        }
        
		public function browseOrder()
        {
            $data = array();
            $data['role'] = $this->logged_out_check();
            $data['title']='Browse Approved Ad Order';
            $data['page_description'] = 'List Of Approved Ad Orders';
            $data['breadcrumbs']=array
            (
                array('Browse Approve Ad Order','program/browseOrder'),
            );
            $data['css']=array
            (

            );
            $data['script']=array
            (
                'assets/js/jquery.cropit.js',
            );
			$advertiser_data = $this->Advertiser->show_Advertiser();
			$data['advertiser'] = array();
			foreach ($advertiser_data as $rows) {
				array_push($data['advertiser'],
					array(
						$rows['advertiser_id'],
						$rows['advertiser_name'],
					)
				);
			}

			$route_data = $this->Route->show_Route();
			$data['route'] = array();
			foreach ($route_data as $rows) {
				array_push($data['route'],
					array(
						$rows['route_id'],
						$rows['route_name'],
					)
				);
			}
            $data['treeActive'] = 'program_schedule';
            $data['childActive'] = 'browse_approve_ad' ;

            $this->load->view("template/header", $data);
            $this->load->view("program/browse_approve_ad", $data);
            $this->load->view("template/footer", $data);
        }
        
		// public function order()
  //       {
  //           $data = array();
  //           $data['role'] = $this->logged_out_check();
  //           $data['title']='New Ad Order';
  //           $data['page_description'] = 'Approve/Cancel Orders';
  //           $data['breadcrumbs']=array
  //           (
  //               array('New Ad Order','program/order'),
  //           );
  //           $data['css']=array
  //           (

  //           );
  //           $data['script']=array
  //           (

  //           );

  //           $data['treeActive'] = 'program_schedule';
  //           $data['childActive'] = 'new_ad_order' ;

  //           $this->load->view("template/header", $data);
  //           $this->load->view("program/new_ad_order", $data);
  //           $this->load->view("template/footer", $data);
  //       }

        ////////////////////////////////////////////////////////////////////////////////////////////////////
		//                    A  P  P  R  O  V  E      F  U  N  C  T  I  O  N  S                          //
		////////////////////////////////////////////////////////////////////////////////////////////////////
        public function showOrders()
        {
        	$table = $this->Order->getpending();
			$data = array();
			foreach ($table as $rows) {
				$order_date = new DateTime($rows['order_date']);
				$advertiser = $this->Advertiser->edit_Advertiser_Data($rows['advertiser_id']);
				array_push($data,
					array(
						$rows['order_id'],
						$advertiser['advertiser_name'],
						$order_date->format('M / d / Y'),
						'<button type="button" class="btn btn-success" onclick="openModal('."'".$rows['order_id']."'".')">Manage Order</button>',
					)
				);
			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
        }
        public function editOrders()
        {
        	$id=$this->input->post('order_id');
			$data=$this->Order->edit($id);

			$advertiser = $this->Advertiser->edit_Advertiser_Data($data['advertiser_id']);
			$data['advertiser_name'] = $advertiser['advertiser_name'];

			$data['route_id'] = array();
			$route = $this->RouteOrder->getRoutes($data['order_id']);
			foreach ($route as $rows) {
				$route_data = $this->Route->edit_Route_Data($rows['route_id']);
				array_push($data['route_id'],
					array(
						$route_data['route_name'],
						'<button type="button" class="btn btn-danger routeDel" id="route'.$rows['orderroutes_id'].'" onclick="deleteRoute('."'".$rows['orderroutes_id']."'".')">Delete</button>',
					)
				);
			}

			$data['tslot_id'] = array();
			$tslot = $this->Tslot->getTslots($data['order_id']);
			foreach ($tslot as $rows) {
				$display = '';
				if($rows['display_type'] == 1)
				{
					$display = 'Normal';
				}
				else if($rows['display_type'] == 2)
				{
					if($rows['win_123'] == 1)
					{
						$display = 'Split Main';
					}
					else if($rows['win_123'] == 2)
					{
						$display = 'Split Top Right';
					}
					else if($rows['win_123'] == 3)
					{
						$display = 'Split Bottom Right';
					}
					else
					{
						$display = 'invalid';
					}
				}
				else if($rows['display_type'] == 3)
				{
					$display = 'Star 8 Content';
				}
				$tslot_data = $this->Timeslot->edit($rows['tslot_id']);
				array_push($data['tslot_id'],
					array(
						$tslot_data['tslot_time'],
						$display,
						$rows['times_repeat'].'x',
						'<button type="button" class="btn btn-danger slotDel" id="tslot'.$rows['orderslot_id'].'" onclick="deleteSlot('."'".$rows['orderslot_id']."'".')">Delete</button>',
					)
				);
			}

			$date_start = new DateTime($data['date_start']);
			$date_end = new DateTime($data['date_end']);
			if($data['date_end'] != NULL)
			{
				$data['dates'] = $date_start->format('M / d / Y').' to '.$date_end->format('M / d / Y');
			}
			else
			{
				$data['dates'] = $date_start->format('M / d / Y');
			}

			$ads = $this->Ad->get_Ad_Data($data['advertiser_id']);
			$data['advertisement_id'] = array();
			foreach ($ads as $rows) {
				array_push($data['advertisement_id'],
					array(
						$rows['ad_id'],
						'
							<button type="button" class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#modal'.$rows['ad_id'].'">Play</button>

							<div id="modal'.$rows['ad_id'].'" class="modal fade" role="dialog" style="width:100%;z-index:1100;">
							  <div class="modal-dialog modal-lg">
							    <div class="modal-content browser-style">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title">'.$rows['ad_filename'].'</h4>
							      </div>
							      <div class="modal-body">
							        <video id="v'.$rows["ad_id"].'" width="100%" controls>
							  			<source src="'.base_url("assets/ads/".$rows["ad_filename"]).'" type="video/mp4">
							  			Your browser does not support HTML5 video.
									</video>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal'.$rows['ad_id'].'">Close</button>
							      </div>
							    </div>
							  </div>
							</div>
						',
						$rows['ad_name'],
						$rows['ad_duration']." seconds",
						'<button type="button" class="btn btn-info selectAd" id="ad'.$rows['ad_id'].'" onclick="selectAd('."'".$rows['ad_id']."'".')">Select</button>',
					)
				);
			}


			$sales = $this->Sales->edit($data['sales_id']);
			$data['salesman'] = $sales['sales_fname']." ".$sales['sales_lname'];

			$this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        public function cancelOrder()
        {
        	$validate = array (
				array('field'=>'order_id','label'=>'Order Id','rules'=>'required'),
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

				$this->Order->cancelOrder($this->input->post('order_id'));

				$info['message']="<p class='success-message'>You have successfully canceled <span class='message-name'>Order Number ".$this->input->post('order_id')."</span>!</p>";
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($info));
        }
        public function approveOrder()
        {
        	$validate = array (
				array('field'=>'ad_id','label'=>'Ad Id','rules'=>'required'),
			);
			$this->form_validation->set_rules($validate);
			if ($this->form_validation->run()===FALSE) 
			{
				$info['success']=FALSE;
				$info['errors']='Please select Advertisement';
			}
			else
			{
				$info['success']=TRUE;

				$date = new DateTime(null, new DateTimeZone('Asia/Hong_Kong'));
				$data=array(
					'order_id'=>$this->input->post('order_id'),
					'ad_id'=>$this->input->post('ad_id'),
					'order_status'=>1,
					'status_date'=>$date->format('Y-m-d H:i:s'),
				);

				$this->Order->acceptOrder($data);

				$selected_route = json_decode($this->input->post('deleted_route'), TRUE);
				foreach ($selected_route as $rows) {
					$this->RouteOrder->deleteOrder($this->input->post('order_id'), $rows);
				}

				$selected_tslot = json_decode($this->input->post('deleted_tslot'), TRUE);
				foreach ($selected_tslot as $rows) {
					$this->Tslot->deleteTslot($this->input->post('order_id'), $rows);
				}
				$this->assignNewSchedule($data['order_id']);
				$this->generate_list($data['order_id']);
				$info['message']="<p class='success-message'>You have successfully approved <span class='message-name'>Order Number ".$this->input->post('order_id')."</span>!</p>";
			}

			$this->output->set_content_type('application/json')->set_output(json_encode($info));
        }
        public function assignNewSchedule($order_id)
        {
        	// GET ( AD ID, AD DURATION, DATE_START, DATE_END )
        	$order = $this->Order->edit($order_id);
        	// GET ( TSLOT ID, DISPLAY_TYPE, TIMES_REPEAT ) TIMESLOTS FROM ORDER_SLOTS(ORDER_ID)
        	$tslot = $this->Tslot->getTslots($order_id);
        	// GET ( ROUTE ID ) ROUTES FROM ORDER_ROUTES(ORDER_ID)
        	$orderroute = $this->RouteOrder->getRoutes($order_id);
        	// FOREACH TSLOT AS SLOT
        	foreach ($tslot as $slot) {
        		if($order['date_end'] == NULL)
        		{
        			$order['date_end'] = $order['date_start'];
        		}
        		//    FOREACH ORDERROUTE AS ROWS
        		foreach ($orderroute as $row) {
        			$data=array(
						'ad_id'=>$order['ad_id'],
						'paid_duration'=>$order['ad_duration'],
						'date_start'=>$order['date_start'],
						'date_end'=>$order['date_end'],
						'timeslot'=>$slot['tslot_id'],
						'times_repeat'=>$slot['times_repeat'],
						'display_type'=>$slot['display_type'],
						'win_123'=>$slot['win_123'],
						'route_id'=>$row['route_id'],
						'order_id'=>$order_id,
						'status'=>0,
					);
					$this->nSched->create($data);
        		}
        	}
        	return TRUE;
        }

        public function generate_list($order_id){
			    $this->load->library("auto_schedule");
			    $where = array('order_id'=>$order_id);
			    $details = $this->nSched->getSchedules($where);
			    $schedule = $this->auto_schedule->auto($details);
		    }

        ///////////////////////////////////////////////////////////////////////////////////////////////////
		//                    B  R  O  W  S  E        F  U  N  C  T  I  O  N  S                          //
		///////////////////////////////////////////////////////////////////////////////////////////////////
        public function showApprovedOrders()
        {
        	// Order Id , Advertiser, Ad Title, Ad Duration, Air Dates, Date Ordered, Date Approved
        	// orders.order_id
        	// advertisers.advertiser_name(orders.advertiser_id)
        	// ads.ad_name(orders.ad_id)
        	// orders.ad_duration
        	// orders.date_start and/or orders.date_end
        	// orders.order_date
        	// orders.status_date

        	$table = $this->Order->getapproved();
			$data = array();
			foreach ($table as $rows) {
				//advertiser
				$advertiser = $this->Advertiser->edit_Advertiser_Data($rows['advertiser_id']);
				// ads
				$ads = $this->Ad->edit_Ad_Data($rows['ad_id']);
				// datestart
				$date_start = new DateTime($rows['date_start']);
				// dateend
				$date_end = new DateTime($rows['date_end']);
				// order date
				$order_date = new DateTime($rows['order_date']);
				// status date
				$status_date = new DateTime($rows['status_date']);
				$dates = "";
				if($rows['date_end'] != NULL)
				{
					$dates = $date_start->format('M / d / Y').' to '.$date_end->format('M / d / Y');
				}
				else
				{
					$dates = $date_start->format('M / d / Y');
				}

				array_push($data,
					array(
						$rows['order_id'],
						'<button type="button" class="btn btn-link" onclick="getAdvertiserData('."'".$advertiser['advertiser_id']."'".')">'.$advertiser['advertiser_name'].'</button>',
						// $advertiser['advertiser_name'],
						'<button type="button" class="btn btn-link" onclick="getAdvertisementData('."'".$ads['ad_id']."'".')">'.$ads['ad_name'].'</button>',
						// $ads['ad_name'],
						$rows['ad_duration'].' seconds',
						$dates,
						$order_date->format('M / d / Y'),
						$status_date->format('M / d / Y'),
						'<button type="button" class="btn btn-info" onclick="seeMore('."'".$rows['order_id']."'".')"><span class="fa fa-eye"></span></button>',
					)
				);
			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
        }
        public function showCancelledOrders()
        {
        	// Order Id , Advertiser, Ad Title, Ad Duration, Air Dates, Date Ordered, Date Approved
        	// orders.order_id
        	// advertisers.advertiser_name(orders.advertiser_id)
        	// ads.ad_name(orders.ad_id)
        	// orders.ad_duration
        	// orders.date_start and/or orders.date_end
        	// orders.order_date
        	// orders.status_date

        	$table = $this->Order->getcancelled();
			$data = array();
			foreach ($table as $rows) {
				//advertiser
				$advertiser = $this->Advertiser->edit_Advertiser_Data($rows['advertiser_id']);
				// datestart
				$date_start = new DateTime($rows['date_start']);
				// dateend
				$date_end = new DateTime($rows['date_end']);
				// order date
				$order_date = new DateTime($rows['order_date']);
				// status date
				$status_date = new DateTime($rows['status_date']);
				$dates = "";
				if($rows['date_end'] != NULL)
				{
					$dates = $date_start->format('M / d / Y').' to '.$date_end->format('M / d / Y');
				}
				else
				{
					$dates = $date_start->format('M / d / Y');
				}

				array_push($data,
					array(
						$rows['order_id'],
						'<button type="button" class="btn btn-link" onclick="getAdvertiserData('."'".$advertiser['advertiser_id']."'".')">'.$advertiser['advertiser_name'].'</button>',
						// $advertiser['advertiser_name'],
						$rows['ad_duration'].' seconds',
						$dates,
						$order_date->format('M / d / Y'),
						$status_date->format('M / d / Y'),
						'<button type="button" class="btn btn-info" onclick="seeMore('."'".$rows['order_id']."'".')"><span class="fa fa-eye"></span></button>',
					)
				);
			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
        }
        public function seeMore()
        {		
        	$order=$this->input->post('order_id');
        	// $ctr = 0;

			$orderRoute = $this->RouteOrder->getRoutes($order);
			$routes = array();
			foreach($orderRoute as $row)
			{
				$route_data = $this->Route->edit_Route_Data($row['route_id']);
				$location_from = $this->Location->get_Name( $route_data['location_from'] );
				$location_to = $this->Location->get_Name( $route_data['location_to'] );
				array_push($routes,
					array(
						$route_data['route_name'],
						$route_data['route_description'],
						$location_from['location_name'].' to '.$location_to['location_name'],
						// "<div id='table-map-canvas-".$ctr.$order."' class='table-canvas'> </div>
						//   <script type='text/javascript'>
						//////////////////////////////////////////////////////
						//  MAP NOT WORKING YET
						//  CANT INITIALIZE IN MODAL
						//////////////////////////////////////////////////////
						//   	var Xmarkers".$ctr.$order." = [
						// 		[ '".$location_from['location_name']."' , ".$location_from['latitude']." , ".$location_from['longitude']." ],
						// 		[ '".$location_to['location_name']."' , ".$location_to['latitude']." , ".$location_to['longitude']." ]
						// 	];

						//     initialize".$ctr.$order."(Xmarkers".$ctr.$order.");

						// 	function initialize".$ctr.$order."(markers) 
						// 	{
						// 		var bounds = new google.maps.LatLngBounds();
						// 		var mapOptions = {
						// 		    mapTypeId: 'roadmap',
						// 		    navigationControl: false,
						// 		    mapTypeControl: false,
						// 		    scrollwheel: false,
						// 		    scaleControl: false,
						// 		    draggable: false,
						// 		    disableDefaultUI: true,
						// 		};

						// 		var map = new google.maps.Map( document.getElementById('table-map-canvas-".$ctr.$order."'), mapOptions);
						// 		map.setTilt(45);

						// 		for( i = 0; i < markers.length; i++ ) {
						// 		    var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
						// 		    bounds.extend(position);
						// 		    marker = new google.maps.Marker({
						// 		        position: position,
						// 		        map: map,
						// 		        title: markers[i][0]
						// 		    });
						// 		}
						// 		    map.fitBounds(bounds);

						// 		google.maps.event.addListenerOnce(map, 'zoom_changed', function() {
						// 		  map.setZoom(map.getZoom()-1);
						// 		});
						// 	}
						//   </script>
						// ",
					)
				);
				// $ctr += 1;
			}
			$data['route_data'] = $routes;
        	// ROUTE ID , ROUTE NAME, ROUTE DESC, LOCATION FROM, LOCATION TO

			$data['tslot_data'] = array();
			$tslot = $this->Tslot->getTslots($order);
			foreach ($tslot as $rows) {
				$display = '';
				if($rows['display_type'] == 1)
				{
					$display = 'Normal';
				}
				else if($rows['display_type'] == 2)
				{
					$display = 'Split Main';
				}
				else if($rows['display_type'] == 3)
				{
					$display = 'Star 8 Content';
				}
				else if($rows['display_type'] == 4)
				{
					$display = 'Split Top Right';
				}
				else if($rows['display_type'] == 5)
				{
					$display = 'Split Bottom Right';
				}
				$tslot_data = $this->Timeslot->edit($rows['tslot_id']);
				array_push($data['tslot_data'],
					array(
						$tslot_data['tslot_time'],
						$display,
						$rows['times_repeat'].'x',
					)
				);
			}

			$order_data = $this->Order->edit($order);
			$salesman = $this->Sales->edit($order_data['sales_id']);
			$data['salesman_data'] = $salesman['sales_fname'].' '.$salesman['sales_lname'];

        	

			// $data=$this->Ad->edit_Ad_Data($ad_id);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        public function morningTslot()
        {
        	$table = $this->Timeslot->getmorning();
			$data = array();
			foreach ($table as $rows) {
				$orders = 0;
				$tslot = $this->Tslot->find_Orders($rows['tslot_id']);
				foreach($tslot as $cols)
				{
					$orders = $orders + $this->Order->countAds($cols['order_id']);
				}

				array_push($data,
					array(
                        $rows['tslot_id'],
						$rows['tslot_time'],
						$orders,
					)
				);
			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
        }
        public function afternoonTslot()
        {
        	$table = $this->Timeslot->getafternoon();
			$data = array();
			foreach ($table as $rows) {
				$orders = 0;
				$tslot = $this->Tslot->find_Orders($rows['tslot_id']);
				foreach($tslot as $cols)
				{
					$orders = $orders + $this->Order->countAds($cols['order_id']);
				}

				array_push($data,
					array(
						$rows['tslot_id'],
                        $rows['tslot_time'],
						$orders,
					)
				);
			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
        }
        public function eveningTslot()
        {
        	$table = $this->Timeslot->getevening();
			$data = array();
			foreach ($table as $rows) {
				$orders = 0;
				$tslot = $this->Tslot->find_Orders($rows['tslot_id']);
				foreach($tslot as $cols)
				{
					$orders = $orders + $this->Order->countAds($cols['order_id']);
				}

				array_push($data,
					array(
						$rows['tslot_id'],
                        $rows['tslot_time'],
						$orders,
					)
				);
			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
        }
        public function programListing($id)
        {
//        	$id=$this->input->post('tslot_id');
            
            $table = $this->Playlist->getTimeslot($id);
			$data = array();
			foreach ($table as $rows) {
//                if($rows['content_type'] == 'Ad')
//                {
                    $ad_data = $this->Ad->edit_Ad_Data($rows['content_id']);
                    array_push($data,
                        array(
                            $rows['play_order'],
                            $ad_data['ad_name'],
                            $ad_data['ad_duration'],
                            $rows['duration'],
                            $rows['content_type'],
                        )
                    );
//                }
			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
        }
		////////////////////////////////////////////////////////////////////////////////////////////////////
		//                     R  E  G  U  L  A  R     F  U  N  C  T  I  O  N  S                          //
		////////////////////////////////////////////////////////////////////////////////////////////////////
		public function showAdReg($advertiser_id)
		{
			// $ad_table = $this->Ad->show_Ad();
			$ad_table = $this->Ad->get_Ad_Data($advertiser_id);
			$data = array();
			$data = $this->advertisementPush($ad_table);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}
		public function appendAd($ad_id)
		{
			$selected_table = $this->Ad->find_Ad_Data($ad_id);
			$data = array();
			$data = $this->selectedPush($selected_table);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}
		public function advertisementPush($table)
		{
			$pushdata = array();
			foreach ($table as $rows) {
				array_push($pushdata,
					array(
						$rows['ad_id'],
						'
							<button class="btn btn-info btn-md btn-block" data-toggle="modal" data-target="#regmodal'.$rows['ad_id'].'">Play</button>
							<div id="regmodal'.$rows['ad_id'].'" class="modal fade" role="dialog">
							  <div class="modal-dialog modal-lg">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title">'.$rows['ad_filename'].'</h4>
							      </div>
							      <div class="modal-body">
							        <video id="regv'.$rows["ad_id"].'" width="100%" controls>
							  			<source src="'.base_url("assets/ads/".$rows["ad_filename"]).'" type="video/mp4">
							  			Your browser does not support HTML5 video.
									</video>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							      </div>
							    </div>
							  </div>
							</div>
						',
						$rows['ad_name'],
						$rows['ad_filename'],
						$rows['ad_duration'].' Seconds',
						'<a href="javascript:void(0)" class="btn btn-success btn-sm btn-block" onclick="get_ad('."'".$rows['ad_id']."'".')">Get Ad</a>',
					)
				);
			}
			return $pushdata;
		}
		public function selectedPush($table)
		{
			$pushdata = array();
			foreach ($table as $rows) {
				array_push($pushdata,
					array(
						$rows['ad_id'],
						$rows['ad_name'],
						$rows['ad_filename'],
						$rows['ad_duration'].' sec',
						'<a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="remove_ad('."'".$rows['ad_id']."'".')">Remove Ad</a>',
					)
				);
			}
			return $pushdata;
		}
		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////
		// C R E A T E
		public function saveRegularProgram()
		{
			$validate = array (
				array('field'=>'selected_ads_reg','label'=>'Selected Ads','rules'=>'required'),
			);

			$this->form_validation->set_rules($validate);
			if ($this->form_validation->run()===FALSE) 
			{
				$info['success']=FALSE;
				$info['errors']="Please Select Ads before submitting";
			}
			else
			{
				$info['success']=TRUE;
				$start = new DateTime($this->input->post('start_reg'));
				$end = new DateTime($this->input->post('end_reg'));
				$data=array(
					'advertiser_id'=>$this->input->post('advertiser_id_reg'),
					'route_id'=>$this->input->post('route_id_reg'),
					'date_start'=>$start->format('Y-m-d'),
					'date_end'=>$end->format('Y-m-d'),
					'schedule_duration'=>$this->input->post('schedule_duration_reg'),
					'schedule_type'=>$this->input->post('schedule_type_reg'),
				);

				$schedule_id = $this->Schedule->save_Schedule($data);

				$selected_ads = json_decode($this->input->post('selected_ads_reg'), TRUE);
				foreach($selected_ads as $row)
				{
					$this->Ad_Schedule->save_Ad_Schedule($row, $schedule_id);
				}

				$info['message']="You have successfully saved your data!";
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($info));
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////
		//                  S  C  H  E  D  U  L  E  D     F  U  N  C  T  I  O  N  S                       //
		////////////////////////////////////////////////////////////////////////////////////////////////////
		public function showAdSched($advertiser_id)
		{
			// $ad_table = $this->Ad->show_Ad();
			$ad_table = $this->Ad->get_Ad_Data($advertiser_id);
			$data = array();
			$data = $this->advertisementPushSched($ad_table);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}
		public function appendAdSched($ad_id)
		{
			$selected_table = $this->Ad->find_Ad_Data($ad_id);
			$data = array();
			$data = $this->selectedPushSched($selected_table);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}
		public function advertisementPushSched($table)
		{
			$pushdata = array();
			foreach ($table as $rows) {
				array_push($pushdata,
					array(
						$rows['ad_id'],
						'

							<button class="btn btn-info btn-md btn-block" data-toggle="modal" data-target="#schedmodal'.$rows['ad_id'].'">Play</button>


							<div id="schedmodal'.$rows['ad_id'].'" class="modal fade" role="dialog">
							  <div class="modal-dialog modal-lg">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title">'.$rows['ad_filename'].'</h4>
							      </div>
							      <div class="modal-body">
							        <video id="schedv'.$rows["ad_id"].'" width="100%" controls>
							  			<source src="'.base_url("assets/ads/".$rows["ad_filename"]).'" type="video/mp4">
							  			Your browser does not support HTML5 video.
									</video>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							      </div>
							    </div>
							  </div>
							</div>
						',
						$rows['ad_name'],
						$rows['ad_filename'],
						$rows['ad_duration'].' Seconds',

						'<a href="javascript:void(0)" class="btn btn-success btn-sm btn-block" onclick="get_ad_sched('."'".$rows['ad_id']."'".')">Get Ad</a>',

					)
				);
			}
			return $pushdata;
		}
		public function selectedPushSched($table)
		{
			$pushdata = array();
			foreach ($table as $rows) {
				array_push($pushdata,
					array(
						$rows['ad_id'],
						$rows['ad_name'],
						$rows['ad_filename'],
						$rows['ad_duration'].' sec',
						'<a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="remove_ad_sched('."'".$rows['ad_id']."'".')">Remove Ad</a>',
					)
				);
			}
			return $pushdata;
		}
		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////
		// C R E A T E
		public function saveScheduleProgram()
		{
			$validate = array (
				array('field'=>'selected_ads_sched','label'=>'Selected Ads','rules'=>'required'),
				array('field'=>'airtime_sched','label'=>'Airtime','rules'=>'required'),
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
				$start = new DateTime($this->input->post('start_sched'));
				$end = new DateTime($this->input->post('end_sched'));
				$data=array(
					'advertiser_id'=>$this->input->post('advertiser_id_sched'),
					'route_id'=>$this->input->post('route_id_sched'),
					'schedule_duration'=>$this->input->post('airtime_sched'),
					'date_start'=>$start->format('Y-m-d'),
					'date_end'=>$end->format('Y-m-d'),
					'schedule_type'=>$this->input->post('schedule_type_sched'),
				);

				$schedule_id = $this->Schedule->save_Schedule($data);

				$selected_ads = json_decode($this->input->post('selected_ads_sched'), TRUE);
				foreach($selected_ads as $row)
				{
					$this->Ad_Schedule->save_Ad_Schedule($row, $schedule_id);
				}

				$time_start = date("H:i:s", strtotime($this->input->post('start_time_sched')));
				$time_end = date("H:i:s", strtotime($this->input->post('end_time_sched')));
				$this->Airtime->save_Airtime($time_start,$time_end,$schedule_id);

				$info['message']="You have successfully saved your data!";
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($info));
		}
		//////////////////////////////////////////////////////////////////////////////////////////////
		//                  B  L  O  C  K  E  D     F  U  N  C  T  I  O  N  S                       //
		//////////////////////////////////////////////////////////////////////////////////////////////
		public function showAdBlock($advertiser_id)
		{
			$ad_table = $this->Ad->get_Ad_Data($advertiser_id);
			$data = array();
			$data = $this->advertisementPushBlock($ad_table);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}
		public function appendAdBlock($ad_id)
		{
			$selected_table = $this->Ad->find_Ad_Data($ad_id);
			$data = array();
			$data = $this->selectedPushBlock($selected_table);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}
		public function advertisementPushBlock($table)
		{
			$pushdata = array();
			foreach ($table as $rows) {
				array_push($pushdata,
					array(
						$rows['ad_id'],
						'

							<button class="btn btn-info btn-md btn-block" data-toggle="modal" data-target="#blockmodal'.$rows['ad_id'].'">Play</button>


							<div id="blockmodal'.$rows['ad_id'].'" class="modal fade" role="dialog">
							  <div class="modal-dialog modal-lg">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title">'.$rows['ad_filename'].'</h4>
							      </div>
							      <div class="modal-body">
							        <video id="blockv'.$rows["ad_id"].'" width="100%" controls>
							  			<source src="'.base_url("assets/ads/".$rows["ad_filename"]).'" type="video/mp4">
							  			Your browser does not support HTML5 video.
									</video>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							      </div>
							    </div>
							  </div>
							</div>
						',
						$rows['ad_name'],
						$rows['ad_filename'],
						$rows['ad_duration'].' Seconds',

						'<a href="javascript:void(0)" class="btn btn-success btn-sm btn-block" onclick="get_ad_block('."'".$rows['ad_id']."'".')">Get Ad</a>',

					)
				);
			}
			return $pushdata;
		}
		public function selectedPushBlock($table)
		{
			$pushdata = array();
			foreach ($table as $rows) {
				array_push($pushdata,
					array(
						$rows['ad_id'],
						$rows['ad_name'],
						$rows['ad_filename'],
						'<a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="remove_ad_block('."'".$rows['ad_id']."'".')">Remove Ad</a>',
					)
				);
			}
			return $pushdata;
		}
		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////
		// C R E A T E
		public function saveBlockProgram()
		{
			$validate = array (
				array('field'=>'selected_ads_block','label'=>'Selected Ads','rules'=>'required'),
				array('field'=>'start_time_block','label'=>'Block Time','rules'=>'required'),
				array('field'=>'end_time_block','label'=>'Block Time','rules'=>'required'),
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
				$start = new DateTime($this->input->post('start_block'));
				$end = new DateTime($this->input->post('end_block'));

				$data=array(
					'advertiser_id'=>$this->input->post('advertiser_id_block'),
					'route_id'=>$this->input->post('route_id_block'),
					'date_start'=>$start->format('Y-m-d'),
					'date_end'=>$end->format('Y-m-d'),
					'schedule_type'=>$this->input->post('schedule_type_block'),
				);

				$schedule_id = $this->Schedule->save_Schedule($data);

				$selected_ads = json_decode($this->input->post('selected_ads_block'), TRUE);
				foreach($selected_ads as $row)
				{
					$this->Ad_Schedule->save_Ad_Schedule($row, $schedule_id);
				}

				$selected_start = json_decode($this->input->post('start_time_block'), TRUE);
				$selected_end = json_decode($this->input->post('end_time_block'), TRUE);
				$allBlock = json_decode($this->input->post('all_time_block'), TRUE);
				$test = array($selected_start, $selected_end);

				foreach($allBlock as $row)
				{
					$block_data=array(
						'time_start'=> $row[0],
						'time_end'=> $row[1],
						'schedule_id'=> $schedule_id,
					);
					$this->Airtime->save_Airtime_Block($block_data);
				}

				$info['message']="You have successfully saved your data!";
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($info));
		}
		/////////////////////////////////////////////////////////////////////////////////////////////////
		//                     B  R  O  W  S  E     F  U  N  C  T  I  O  N  S                          //
		/////////////////////////////////////////////////////////////////////////////////////////////////
		public function overall_Table()
		{
			$ad_table = $this->Schedule->get_Schedule_All();
			$data = array();

			$data = $this->overallShowPush($ad_table);

			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}
        public function advertiser_Table($advertiser_id)
		{
			$ad_table = $this->Schedule->get_Schedule_Data($advertiser_id);
			$data = array();

			$data = $this->advertisementShowPush($ad_table, $advertiser_id);

			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}
		public function route_Table($route_id)
		{
			$ad_table = $this->Schedule->get_Schedule_Route($route_id);
			$data = array();

			$data = $this->routeShowPush($ad_table, $route_id);

			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}
		public function type_Table($type_id)
		{
			$type_table = $this->Schedule->get_Schedule_Type($type_id);
			$data = array();
			$data = $this->typeShowPush($type_table);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
		}
        public function overallShowPush($table)
		{
			$pushdata = array();

            $ctr1=0;
            $ctr2=0;

			foreach ($table as $rows) {
				$advertiserData = $this->Advertiser->edit_Advertiser_Data($rows['advertiser_id']);
				$routeData = $this->Route->edit_Route_Data($rows['route_id']);
				$scheduledAds = $this->Ad_Schedule->get_Ad_Schedule($rows['schedule_id']);


				$text = '';
                $text = $text . '<h3>ADVERTISER : '.$advertiserData["advertiser_name"].'</h3>';
                $text = $text . '<h3>ROUTE : '.$routeData["route_name"].'</h3>';
				$text = $text . '<h3 style="text-align:center;background-color:#339440;color:white;padding:10px 0 10px 0;">LIST OF ADS IN SCHEDULE</h3>';
                $text = $text . '<table class="table table-hover table-bordered"><thead><th style="text-align:center;">THUMBNAIL</th><th style="text-align:center;">AD NAME</th><th style="text-align:center;">DURATION</th></thead><tbody>';
                
				foreach($scheduledAds as $ads)
				{
					$ad_Data = $this->Ad->edit_Ad_Data($ads['ad_id']);
                    $text=$text.'<tr>
                                <td width="20%">
                                    <video id="y'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_name'].$ads['ad_id'].'" width="100%" controls>
							  			<source src="'.base_url("assets/ads/".$ad_Data["ad_filename"]).'" type="video/mp4">
							  			Your browser does not support HTML5 video.
									</video>
                                </td>
                                <td style="text-align:center;font-size:20px;vertical-align: middle;">'.$ad_Data['ad_name'].'</td>
                                <td id="schedytd'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_name'].$ads['ad_id'].'" style="text-align:center;font-size:20px;vertical-align: middle;"></td>
                                </tr>
                                <script>	
                                        var schedvideo'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_name'].$ads['ad_id'].' = document.getElementById("y'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_name'].$ads['ad_id'].'");
                                        schedvideo'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_name'].$ads['ad_id'].'.addEventListener("durationchange", function() {
                                            $("#schedytd'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_name'].$ads['ad_id'].'").html(Math.ceil(schedvideo'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_name'].$ads['ad_id'].'.duration) + " seconds");
                                        });
                                </script>';
                                $ctr2++;
				}
                $ctr1++;
				$text = $text.'</tbody></table>';

				if($rows['schedule_type'] == 1)
				{
					$scheduleData = 'Regular';
				}
				else if($rows['schedule_type'] == 2)
				{
					$scheduleData = 'Scheduled';

					$text = $text.'<h3 style="text-align:center;background-color:#339440;color:white;padding:10px 0 10px 0;">SCHEDULE AIRTIME</h3>';
					$airtimeData = $this->Airtime->get_Airtime($rows['schedule_id']);
					$text = $text.'<table class="table table-hover table-bordered"><thead><th style="text-align:center;">TIME START</th></thead><tbody>';
					foreach($airtimeData as $at)
					{
						$text = $text.'<tr><td style="text-align:center;font-size:16px;">'.$at['time_start'].'</td></tr>';
					}
					$text = $text.'</tbody></table>';

				}
				else
				{
					$scheduleData = 'Block';

					$text = $text.'<h3 style="text-align:center;background-color:#339440;color:white;padding:10px 0 10px 0;">SCHEDULE AIRTIME</h3>';
					$airtimeData = $this->Airtime->get_Airtime($rows['schedule_id']);
					$text = $text.'<table class="table table-hover table-bordered"><thead><th style="text-align:center;">TIME START</th><th style="text-align:center;">TIME END</th></thead><tbody>';
					foreach($airtimeData as $at)
					{
                        $text = $text.'<tr><td style="text-align:center;font-size:16px;">'.$at['time_start'].'</td><td style="text-align:center;font-size:16px;">'.$at['time_end'].'</td></tr>';
					}
					$text = $text.'</tbody></table>';

				}
				array_push($pushdata,
					array(
						'

							<button class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#modalov'.$rows['schedule_id'].'">Summary</button>

							<div id="modalov'.$rows['schedule_id'].'" class="modal fade" role="dialog">

							  <div class="modal-dialog modal-lg">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title">SCHEDULE #'.$rows['schedule_id'].'</h4>
							      </div>
							      <div class="modal-body">
							        '.$text.'
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							      </div>
							    </div>
							  </div>
							</div>
						',
						$routeData['route_name'],
						$advertiserData['advertiser_name'],

						date('m/d/Y', strtotime($rows['date_start'])),
						date('m/d/Y', strtotime($rows['date_end'])),

					)
				);
			}
			return $pushdata;
		}
		public function advertisementShowPush($table, $advertiser)
		{
			$pushdata = array();
            $ctr1=0;
            $ctr2=0;
            $advertiserData = $this->Advertiser->edit_Advertiser_Data($advertiser);
			foreach ($table as $rows) {
				$routeData = $this->Route->edit_Route_Data($rows['route_id']);
				$scheduledAds = $this->Ad_Schedule->get_Ad_Schedule($rows['schedule_id']);
                $text = '';
                $text = $text . '<h3>ADVERTISER : '.$advertiserData["advertiser_name"].'</h3>';
                $text = $text . '<h3>ROUTE : '.$routeData["route_name"].'</h3>';
				$text = $text . '<h3 style="text-align:center;background-color:#339440;color:white;padding:10px 0 10px 0;">LIST OF ADS IN SCHEDULE</h3>';
                $text = $text . '<table class="table table-hover table-bordered"><thead><th style="text-align:center;">THUMBNAIL</th><th style="text-align:center;">AD NAME</th><th style="text-align:center;">DURATION</th></thead><tbody>';
				foreach($scheduledAds as $ads)
				{
					$ad_Data = $this->Ad->edit_Ad_Data($ads['ad_id']);
                    $text=$text.'<tr>
                                <td width="20%">
                                    <video id="v'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_name'].$rows['schedule_id'].'" width="100%" controls>
							  			<source src="'.base_url("assets/ads/".$ad_Data["ad_filename"]).'" type="video/mp4">
							  			Your browser does not support HTML5 video.
									</video>
                                </td>
                                <td style="text-align:center;font-size:20px;vertical-align: middle;">'.$ad_Data['ad_name'].'</td>
                                <td id="schedtd'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_name'].$rows['schedule_id'].'" style="text-align:center;font-size:20px;vertical-align: middle;"></td>
                                <script>	
                                        var schedvideo'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_name'].$rows['schedule_id'].' = document.getElementById("v'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_name'].$rows['schedule_id'].'");
                                        schedvideo'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_name'].$rows['schedule_id'].'.addEventListener("durationchange", function() {
                                            $("#schedtd'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_name'].$rows['schedule_id'].'").html(Math.ceil(schedvideo'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_name'].$rows['schedule_id'].'.duration) + " seconds");
                                        });
                                </script>
                                </tr>';
                    $ctr2++;
				}
                $ctr1++;
				$text = $text.'</tbody></table>';

				if($rows['schedule_type'] == 1)
				{
					$scheduleData = 'Regular';
				}
				else if($rows['schedule_type'] == 2)
				{
					$scheduleData = 'Scheduled';

					$text = $text.'<h3 style="text-align:center;background-color:#339440;color:white;padding:10px 0 10px 0;">SCHEDULE AIRTIME</h3>';
					$airtimeData = $this->Airtime->get_Airtime($rows['schedule_id']);
					$text = $text.'<table class="table table-hover table-bordered"><thead><th style="text-align:center;">TIME START</th></thead><tbody>';
					foreach($airtimeData as $at)
					{
						$text = $text.'<tr><td style="text-align:center;font-size:16px;">'.$at['time_start'].'</td></tr>';
					}
					$text = $text.'</tbody></table>';

				}
				else
				{
					$scheduleData = 'Block';

					$text = $text.'<h3 style="text-align:center;background-color:#339440;color:white;padding:10px 0 10px 0;">SCHEDULE AIRTIME</h3>';
					$airtimeData = $this->Airtime->get_Airtime($rows['schedule_id']);
					$text = $text.'<table class="table table-hover table-bordered"><thead><th style="text-align:center;">TIME START</th><th style="text-align:center;">TIME END</th></thead><tbody>';
					foreach($airtimeData as $at)
					{
                        $text = $text.'<tr><td style="text-align:center;font-size:16px;">'.$at['time_start'].'</td><td style="text-align:center;font-size:16px;">'.$at['time_end'].'</td></tr>';
					}
					$text = $text.'</tbody></table>';

				}
				array_push($pushdata,
					array(
						'

							<button class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#modaladv'.$rows['schedule_id'].'">Summary</button>

							<div id="modaladv'.$rows['schedule_id'].'" class="modal fade" role="dialog">

							  <div class="modal-dialog modal-lg">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>

							        <h4 class="modal-title"><i class="fa fa-calendar"></i>&nbsp;SCHEDULE ID:'.$rows['schedule_id'].'</h4>

							      </div>
							      <div class="modal-body">
							        '.$text.'
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							      </div>
							    </div>
							  </div>
							</div>
						',
						$routeData['route_name'],

						date('m/d/Y', strtotime($rows['date_start'])),
						date('m/d/Y', strtotime($rows['date_end'])),

						$scheduleData,
					)
				);
			}
			return $pushdata;
		}
		public function routeShowPush($table, $route)
		{
			$pushdata = array();
            $ctr1=0;
            $ctr2=0;
            $routeData = $this->Route->edit_Route_Data($route);

			foreach ($table as $rows) {
				$advertiserData = $this->Advertiser->edit_Advertiser_Data($rows['advertiser_id']);
				$scheduledAds = $this->Ad_Schedule->get_Ad_Schedule($rows['schedule_id']);

				$text = '';
                $text = $text . '<h3>ADVERTISER : '.$advertiserData["advertiser_name"].'</h3>';
                $text = $text . '<h3>ROUTE : '.$routeData["route_name"].'</h3>';
				$text = $text . '<h3 style="text-align:center;background-color:#339440;color:white;padding:10px 0 10px 0;">LIST OF ADS IN SCHEDULE</h3>';
                $text = $text . '<table class="table table-hover table-bordered"><thead><th style="text-align:center;">THUMBNAIL</th><th style="text-align:center;">AD NAME</th><th style="text-align:center;">DURATION</th></thead><tbody>';
                
				foreach($scheduledAds as $ads)
				{
					$ad_Data = $this->Ad->edit_Ad_Data($ads['ad_id']);
                    $text=$text.'<tr>
                                <td width="20%">
                                    <video id="s'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_name'].$rows['schedule_id'].'" width="100%" controls>
							  			<source src="'.base_url("assets/ads/".$ad_Data["ad_filename"]).'" type="video/mp4">
							  			Your browser does not support HTML5 video.
									</video>
                                </td>
                                <td style="text-align:center;font-size:20px;vertical-align: middle;">'.$ad_Data['ad_name'].'</td>
                                <td id="schedxtd'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_name'].$rows['schedule_id'].'" style="text-align:center;font-size:20px;vertical-align: middle;"></td>
                                <script>	
                                        var schedvideo'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_name'].$rows['schedule_id'].' = document.getElementById("s'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_name'].$rows['schedule_id'].'");
                                        schedvideo'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_name'].$rows['schedule_id'].'.addEventListener("durationchange", function() {
                                            $("#schedxtd'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_name'].$rows['schedule_id'].'").html(Math.ceil(schedvideo'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_name'].$rows['schedule_id'].'.duration) + " seconds");
                                        });
                                </script>
                                </tr>';
                                $ctr2++;
				}
                $ctr1++;
				$text = $text.'</tbody></table>';

				if($rows['schedule_type'] == 1)
				{
					$scheduleData = 'Regular';
				}
				else if($rows['schedule_type'] == 2)
				{
					$scheduleData = 'Scheduled';

					$text = $text.'<h3 style="text-align:center;background-color:#339440;color:white;padding:10px 0 10px 0;">SCHEDULE AIRTIME</h3>';
					$airtimeData = $this->Airtime->get_Airtime($rows['schedule_id']);
					$text = $text.'<table class="table table-hover table-bordered"><thead><th style="text-align:center;">TIME START</th></thead><tbody>';
					foreach($airtimeData as $at)
					{
						$text = $text.'<tr><td style="text-align:center;font-size:16px;">'.$at['time_start'].'</td></tr>';
					}
					$text = $text.'</tbody></table>';

				}
				else
				{
					$scheduleData = 'Block';

					$text = $text.'<h3 style="text-align:center;background-color:#339440;color:white;padding:10px 0 10px 0;">SCHEDULE AIRTIME</h3>';
					$airtimeData = $this->Airtime->get_Airtime($rows['schedule_id']);
					$text = $text.'<table class="table table-hover table-bordered"><thead><th style="text-align:center;">TIME START</th><th style="text-align:center;">TIME END</th></thead><tbody>';
					foreach($airtimeData as $at)
					{
                        $text = $text.'<tr><td style="text-align:center;font-size:16px;">'.$at['time_start'].'</td><td style="text-align:center;font-size:16px;">'.$at['time_end'].'</td></tr>';
					}
					$text = $text.'</tbody></table>';

				}
				array_push($pushdata,
					array(
						'

							<button class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#modalrou'.$rows['schedule_id'].'">Summary</button>

							<div id="modalrou'.$rows['schedule_id'].'" class="modal fade" role="dialog">

							  <div class="modal-dialog modal-lg">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title">SCHEDULE #'.$rows['schedule_id'].'</h4>
							      </div>
							      <div class="modal-body">
							        '.$text.'
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							      </div>
							    </div>
							  </div>
							</div>
						',
						$advertiserData['advertiser_name'],

						date('m/d/Y', strtotime($rows['date_start'])),
						date('m/d/Y', strtotime($rows['date_end'])),

						$scheduleData,
					)
				);
			}
			return $pushdata;
		}
		public function typeShowPush($table)
		{
			$pushdata = array();

            $ctr1=0;
            $ctr2=0;

			foreach ($table as $rows) {
				$advertiserData = $this->Advertiser->edit_Advertiser_Data($rows['advertiser_id']);
				$routeData = $this->Route->edit_Route_Data($rows['route_id']);
				$scheduledAds = $this->Ad_Schedule->get_Ad_Schedule($rows['schedule_id']);


				$text = '';
                $text = $text . '<h3>ADVERTISER : '.$advertiserData["advertiser_name"].'</h3>';
                $text = $text . '<h3>ROUTE : '.$routeData["route_name"].'</h3>';
				$text = $text . '<h3 style="text-align:center;background-color:#339440;color:white;padding:10px 0 10px 0;">LIST OF ADS IN SCHEDULE</h3>';
                $text = $text . '<table class="table table-hover table-bordered"><thead><th style="text-align:center;">THUMBNAIL</th><th style="text-align:center;">AD NAME</th><th style="text-align:center;">DURATION</th></thead><tbody>';
                
				foreach($scheduledAds as $ads)
				{
					$ad_Data = $this->Ad->edit_Ad_Data($ads['ad_id']);
                    $text=$text.'<tr>
                                <td width="20%">
                                    <video id="y'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_id'].$rows['schedule_id'].'" width="100%" controls>
							  			<source src="'.base_url("assets/ads/".$ad_Data["ad_filename"]).'" type="video/mp4">
							  			Your browser does not support HTML5 video.
									</video>
                                </td>
                                <td style="text-align:center;font-size:20px;vertical-align: middle;">'.$ad_Data['ad_name'].'</td>
                                <td id="schedytd'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_id'].$rows['schedule_id'].'" style="text-align:center;font-size:20px;vertical-align: middle;"></td>
                                <script>	
                                        var schedvideo'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_id'].$rows['schedule_id'].' = document.getElementById("y'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_id'].$rows['schedule_id'].'");
                                        schedvideo'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_id'].$rows['schedule_id'].'.addEventListener("durationchange", function() {
                                            $("#schedytd'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_id'].$rows['schedule_id'].'").html(Math.ceil(schedvideo'.$ctr1.$ctr2.$ads['ad_id'].$ads['ad_id'].$rows['schedule_id'].'.duration) + " seconds");
                                        });
                                </script>
                                </tr>';
                                $ctr2++;
				}
                $ctr1++;
				$text = $text.'</tbody></table>';

				if($rows['schedule_type'] == 1)
				{
					$scheduleData = 'Regular';
				}
				else if($rows['schedule_type'] == 2)
				{
					$scheduleData = 'Scheduled';

					$text = $text.'<h3 style="text-align:center;background-color:#339440;color:white;padding:10px 0 10px 0;">SCHEDULE AIRTIME</h3>';
					$airtimeData = $this->Airtime->get_Airtime($rows['schedule_id']);
					$text = $text.'<table class="table table-hover table-bordered"><thead><th style="text-align:center;">TIME START</th></thead><tbody>';
					foreach($airtimeData as $at)
					{
						$text = $text.'<tr><td style="text-align:center;font-size:16px;">'.$at['time_start'].'</td></tr>';
					}
					$text = $text.'</tbody></table>';

				}
				else
				{
					$scheduleData = 'Block';

					$text = $text.'<h3 style="text-align:center;background-color:#339440;color:white;padding:10px 0 10px 0;">SCHEDULE AIRTIME</h3>';
					$airtimeData = $this->Airtime->get_Airtime($rows['schedule_id']);
					$text = $text.'<table class="table table-hover table-bordered"><thead><th style="text-align:center;">TIME START</th><th style="text-align:center;">TIME END</th></thead><tbody>';
					foreach($airtimeData as $at)
					{
                        $text = $text.'<tr><td style="text-align:center;font-size:16px;">'.$at['time_start'].'</td><td style="text-align:center;font-size:16px;">'.$at['time_end'].'</td></tr>';
					}
					$text = $text.'</tbody></table>';

				}
				array_push($pushdata,
					array(
						'

							<button class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#modalty'.$rows['schedule_id'].'">Summary</button>

							<div id="modalty'.$rows['schedule_id'].'" class="modal fade" role="dialog">

							  <div class="modal-dialog modal-lg">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title">SCHEDULE #'.$rows['schedule_id'].'</h4>
							      </div>
							      <div class="modal-body">
							        '.$text.'
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							      </div>
							    </div>
							  </div>
							</div>
						',
						$routeData['route_name'],
						$advertiserData['advertiser_name'],

						date('m/d/Y', strtotime($rows['date_start'])),
						date('m/d/Y', strtotime($rows['date_end'])),

					)
				);
			}
			return $pushdata;
		}
	}

// END OF PROGRAM SCHEDULE CONTROLLER