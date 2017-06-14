<?php
require(APPPATH.'libraries/REST_Controller.php');
class MRetrieve extends REST_Controller 
{
	
	public function __construct() 
	{
        parent::__construct();
		$this->load->model('Adowneraccounts_model', 'Owner_Accounts');
		$this->load->model('Advertisers_model'    , 'Owners');
		$this->load->model('Cities_model'         , 'Cities');
		$this->load->model('Locations_model'      , 'Locations');
		$this->load->model('Orders_model'         , 'Orders');
		$this->load->model('Order_slots_model'    , 'Order_slots');
		$this->load->model('Order_routes_model'   , 'Order_routes');
		$this->load->model('Regions_model'        , 'Regions');
		$this->load->model('Routes_model'         , 'Routes');
		$this->load->model('Timeslots_model'      , 'Timeslots');
		$this->load->model('Users_model'          , 'Users');
		$this->load->model('Vehicle_types_model'  , 'Vehicle_types');
	}
	
	public function getinfo_post()
	{
		/* JSON method to get ad owner or salesman info for Android app */
		// http://[::1]/star8/api/mobileapp/getinfo
		
		$data = $this->post();
		if( isset($data['owner_id']) && isset($data['user']) && isset($data['pass']) )
		{
			// Goes to model to validate credentials
			$response = $this->Owner_Accounts->validate_mobile($data);
			if(isset($response['owner_id']))
			{
				if($response['owner_id'] == $data['owner_id'])
				{
					// Goes to model to get ad owner data
					$result = $this->Owners->get_by_id($response['advertiser_id']);
				}
				else
				{
					// If direct user access
					$result = -1;
				}
			}
			else
			{
				// If failed to validate or user changes password
				$result = -1;
			}
		}
		else if( isset($data['user_id']) && isset($data['user']) && isset($data['pass']) )
		{
			// Goes to model to validate credentials
			$response = $this->Users->validate_mobile($data);
			if(isset($response['user_id']) && $response['user_id'] == $data['user_id'])
			{
				if($response['user_id'] == $data['user_id'])
				{
					// Goes to model to get salesman data (to be added)
					$result = $this->Users->validate_mobile($data);
				}
				else
				{
					// If direct user access
					$result = -1;
				}
			}
			else
			{
				// If failed to validate or user changes password
				$result = -1;
			}
		}
		else
		{
			// If direct controller access
			$result = -1;
		}
		// Returns an object or -1
		$this->response($result);
	}
	
	public function getschedavailability_get()
	{
		/* JSON method to get schedule availability */
		// http://[::1]/star8/api/mobileapp/getschedavailability/from/2017-02-03/to/2017-03-02
		
		$data=$this->get();
		$orders=$this->Orders->getapproved();
		$scheds=array();
		$date1=[];
		$date2=[];
		$availability=array();
		if( isset($data['from']) && isset($data['to']) )
		{
			$from = new DateTime($data['from']);
			$to = new DateTime($data['to']);
		}
		$interval=new DateInterval('P1D');
		$currentOrderDates=new DatePeriod($from,$interval,$to);
		foreach($currentOrderDates as $date)
		{
			$date1[]=$date->format('Y-m-d');
		}
		$a=0;
		foreach($currentOrderDates as $dates)
		{
			for($i=1;$i<19;$i++)
			{
				$scheds[$a][$i]=0;
			}
			$a++;
		}
		
		foreach($orders as $order)
		{
			$orderslots=$this->Order_slots->get_by_order_id($order['order_id']);
			$comparedOrderDates=new DatePeriod(new DateTime($order['date_start']),$interval,new DateTime($order['date_end']));
			foreach($comparedOrderDates as $date)
			{
				$date2[]=$date->format('Y-m-d');
			}
			$intersectDates=array_intersect($date1,$date2);
			foreach($intersectDates as $date)
			{
				foreach($orderslots as $slots)
				{
					$scheds[array_search($date,$date1)][$slots['tslot_id']]+=$order['ad_duration'];
				}
			}
		}
		for($i=1;$i<19;$i++)
			{
				$percent[$i]=0;
			}
		foreach($scheds as $schedule)
		{
			for($i=1;$i<19;$i++)
			{
				$percent[$i]+=((3600-$schedule[$i])/3600)*100;
			}
		}
		for($i=1;$i<19;$i++)
			{
				$percent[$i]/=count($scheds);
			}
		$availability=$percent;
		$this->response($availability);
		
	}
	public function getregions_get()
	{
		/* JSON method to get all regions for Android app */
		// http://[::1]/star8/api/mobileapp/getregions
		
		// Goes to model to query all regions
		$result = $this->Regions->show_region();
		
		// Returns an array of regions or []
		$this->response($result);
	}
	
	public function getcities_get()
	{
		/* JSON method to get all cities for Android app */
		// http://[::1]/star8/api/mobileapp/getcities
		
		// Goes to model to query all cities
		$result = $this->Cities->show_City();
		
		// Returns an array of cities or []
		$this->response($result);
	}
	
	public function getcity_get()
	{
		/* JSON method to get all cities from a specific region for Android app */
		// http://[::1]/star8/api/mobileapp/getcity/region/*
		
		$data = $this->get();
		if( isset($data['region']) )
		{
			// Goes to model to query all cities according to the region specified
			$result = $this->Cities->get_by_region($data['region']);
		}
		else
		{
			// If direct controller access
			$result = -1;
		}
		
		// Returns an array of cities, [] or -1
			$this->response($result);
	} 
	
	public function getlocations_get()
	{
		/* JSON method to get all locations for Android app */
		// http://[::1]/star8/api/mobileapp/getlocations
		
		// Goes to model to query all locations
		$result = $this->Locations->read();
		
		// Returns an array of locations or []
		$this->response($result);
	}
	
	public function getlocation_get()
	{
		/* JSON method to get all locations from a specific city for Android app */
		// http://[::1]/star8/api/mobileapp/getlocation/city/*
		
		$data = $this->get();
		if( isset($data['city']) )
		{
			// Goes to model to query all location according to the city specified
			$result = $this->Locations->get_by_city($data['city']);	
		}
		else
		{
			// If direct controller access
			$result = -1;
		}
		
		// Returns an array of locations, [] or -1
		$this->response($result);
	}
	
	public function getvehicletypes_get()
	{
		/* JSON method to get all vehicle types for Android app */
		// http://[::1]/star8/api/mobileapp/getvehicletype
		
		// Goes to model to query all vehicle types
		$result = $this->Vehicle_types->show_Vehicle_type();
		
		// Returns an array of vehicle types or []
		$this->response($result);
	}
	
	public function getroute_get()
	{
		/* JSON method to get all routes from a specific city for Android app */
		// http://[::1]/star8/api/mobileapp/getroute/city/*
		
		$data = $this->get();
		if( isset($data['location']) )
		{
			// Goes to model to query all routes according to the city specified
			$result = $this->Routes->get_by_location($data['location']);	
		}
		else
		{
			// If direct controller access
			$result = -1;
		}
		
		// Returns an array of routes, [] or -1
		$this->response($result);
	}
	
	public function getroutes_get()
	{
		/* JSON method to get all routes for Android app */
		// http://[::1]/star8/api/mobileapp/getroutes
		
		// Goes to model to query all routes
		$result = $this->Routes->show_Route();
		
		// Returns an array of routes or []
		$this->response($result);
	}
	
	public function gettimeslots_get()
	{
		/* JSON method to get all time slots for Android app */
		// http://[::1]/star8/api/mobileapp/gettimeslots
		
		// Goes to model to query all time slots
		$result = $this->Timeslots->read();
		
		// Returns an array of time slots or []
		$this->response($result);
	}
	
	public function getsalesorders_get()
	{
		/* JSON method to get all orders from a specified salesman for Android app */
		// http://[::1]/star8/api/mobileapp/getsalesorders/id/*
		$data = $this->get();
		
		if(isset($data['id']))
		{
			// Goes to model to get all orders specified in ordertype
			$result = $this->Orders->get_by_salesman($data['id']);
			if( $result != -1 )
			{
				foreach($result as &$value)
				{
					// Goes to model to add corresponding order slots and routes
					$value['order_slots'] = $this->Order_slots->get_by_order_id($value['order_id']);
					$value['order_routes'] = $this->Order_routes->get_by_order_id($value['order_id']);
				}
			}
			else
			{
				// If no data is retrieved
				$result = -1;
			}
		}
		else
		{
			// If direct controller access
			$result = -1;
		}
		// Returns an array of orders or -1
		$this->response($result);
	}
	
	public function getorders_get()
	{
		/* JSON method to get all orders for Android app */
		// http://[::1]/star8/api/mobileapp/getorders/ordertype/*
		$data = $this->get();
		
		if(isset($data['ordertype']))
		{
			// Goes to model to get all orders specified in ordertype
			switch($data['ordertype'])
			{
				case "all":
				$result = $this->Orders->read();
				break;
				
				case "pending":
				$result = $this->Orders->getpending();
				break;
				
				case "approved":
				$result = $this->Orders->getapproved();
				break;
				
				case "cancelled":
				$result = $this->Orders->getcancelled();
				break;
				
				default: $result = -1;
			}
			if( $result != -1 )
			{
				foreach($result as &$value)
				{
					// Goes to model to add corresponding order slots and routes
					$value['order_slots'] = $this->Order_slots->get_by_order_id($value['order_id']);
					$value['order_routes'] = $this->Order_routes->get_by_order_id($value['order_id']);
				}
			}
			else
			{
				// If no data is retrieved
				$result = -1;
			}
		}
		else
		{
			// If direct controller access
			$result = -1;
		}
		// Returns an array of slots or -1
		$this->response($result);
	}
	
	public function getadvertisers_get()
	{
		/* JSON method to get all advertisers for Android app */
		// http://[::1]/star8/api/mobileapp/getadvertisers
		
		// Goes to model to get all order slots
		$result = $this->Owners->show_Advertiser();
		
		// Returns an array of advertisers or []
		$this->response($result);
	}
}