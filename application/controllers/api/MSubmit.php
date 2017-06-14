<?php
require(APPPATH.'libraries/REST_Controller.php');
class MSubmit extends REST_Controller 
{
	
	public function __construct() 
	{
        parent::__construct();
		$this->load->model('Adowneraccounts_model', 'Owner_Accounts');
		$this->load->model('Advertisers_model'    , 'Owners');
		$this->load->model('Orders_model'         , 'Orders');
		$this->load->model('Order_routes_model'   , 'Order_routes');
		$this->load->model('Order_slots_model'    , 'Order_slots');
		$this->load->model('Users_model'          , 'Users');
	}
	
	public function changepass_post()
	{
		/* JSON method to change ad owner password in Android app */
		// http://[::1]/star8/api/mobileapp/changepass
		
		$data = $this->post();
		if( isset($data['user']) && isset($data['pass']) && isset($data['newpass']) )
		{
			// Goes to model to validate username and password and change password if successful
			$response = $this->Owner_Accounts->change_pass($data);
		}
		else
		{
			// If direct controller access
			$response = -1;
		}
		// Returns 1 or -1
		$this->response($response);	
	}
	
	public function requestresetpass_post()
	{
		/* JSON method to request reset of ad owner password in Android app */
		// http://[::1]/star8/api/mobileapp/requestresetpass
		
		$data = $this->post();
		if( isset($data['user']) )
		{
			// Gets advertiser id from username
			$query = $this->Owner_Accounts->request_reset_pass($data);
			if($query > 0)
			{
				// Gets advertiser email from advertiser id
				$result = $this->Owners->get_email($query);
			}
			else
			{
				// Account not found
				$result = -1;
			}
		}
		else
		{
			// If direct controller access
			$result = -1;
		}
		// Returns advertiser email or -1
		$this->response($result);	
	}
	
	public function resetpass_post()
	{
		/* JSON method reset ad owner password in Android app */
		// http://[::1]/star8/api/mobileapp/requestresetpass
		
		$data = $this->post();
		if( isset($data['user'])&& isset($data['ticket']) )
		{
			// Generates a new password based on md5
			$data['newpass'] = substr(md5(uniqid(rand(), true)),0,12);
			
			// Goes to model to reset user password
			$result = $this->Owner_Accounts->reset_pass($data);
			
			if($result == 1)
			{
				// Returns reset password
				$result = $data['newpass'];
			}
			else
			{
				// If server error
				$result = -1;
			}
		}
		else
		{
			// If direct controller access
			$result = -1;
		}
		
		// Returns a password or -1
		$this->response($result);	
			
	}
	public function putrequestschedule_post()
	{
		/* JSON method to submit a schedule request from Android app */
		// http://[::1]/star8/api/mobileapp/putrequestschedule
		
		$data = $this->post();
		
		// Splits $data to three parts
		$data1['sales_id']      = $data['sales_id'];
		$data1['ad_duration']   = $data['ad_duration'];
		$data1['advertiser_id'] = $data['advertiser_id'];
		$data1['order_status']  = 0;
		$data1['date_start']    = $data['date_start'];
		$data1['date_end']      = $data['date_end'];
		
		$data2['route_id'] = $data['route_id'];
		
		$tslot_array           = explode(",",$data['tslot_id']);
		$tslot_array_count     = count($tslot_array);
		$data3['display_type'] = $data['display_type'];
		$data3['times_repeat'] = $data['times_repeat'];
		
		if( isset($data['sales_id']) || isset($data['advertiser_id']) )
		{	
			// Submits first part of data to orders_model and returns order id
			$order_id = $this->Orders->create($data1);
			$data2['order_id']=$order_id;
			if( $order_id > 0 )
			{
				// Submits second part of data to order_routes model and returns orderroutes id
				$data2['order_id'] = $order_id;
				$orderroutes_id = $this->Order_routes->create($data2);
				if( $orderroutes_id > 0 )
				{
					// Submits third part of data to order slots model and returns orderslot id
					$data3['order_id'] = $order_id;
					for($i = 0; $i < $tslot_array_count;$i++)
					{
						$data3['tslot_id'] = $tslot_array[$i];
						$orderslot_id[$i] = $this->Order_slots->create($data3);
					}
					if($orderslot_id[0] > 0)
					{
						// If entries are successful
						$response = 1;
					}
					else
					{
						// If failure to insert data, deletes previous entries from order_model and order_routes_model
						$delete['order_id'] = $order_id;
						$delete2['orderroutes_id'] = $orderroutes_id;
						$this->Orders->delete($delete);
						$this->Order_routes->delete($delete2);
						$response = -1;
					}
				}
				else
				{
					// If failure to insert data, deletes previous entry from order_model
					$delete['order_id'] = $order_id;
					$this->Orders->delete($delete);
					$response = -1;
				}
			}
			else
			{
				// If failure to insert data
				$response = -1;
			}
		}
		else
		{
			// If direct controller access
			$response = -1;
		}
		// Returns 1 or -1
		$this->response($response);
	}
}