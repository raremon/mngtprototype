<?php
require(APPPATH.'libraries/REST_Controller.php');

class Ads extends REST_Controller {
	
	public function __construct() {
        parent::__construct();

        $this->load->model('buses_model', 'Bus');
        $this->load->model('programs_model', 'Program');
        $this->load->model('ads_model', 'Ad');
    }
		
	public function bus_get()
	{
        $id = $this->get('id');
        if ($id === NULL)
        {
        	$programs = $this->Program->show_Program();
        	$ads = $this->Ad->show_Ad();
            if ($programs)
            {
                $data[] = array($programs, $ads);
                $this->response($data, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                    'status' => FALSE,
                    'message' => 'No data were found'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
        $id = (int) $id;
        if ($id <= 0)
        {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }
        $buses = $this->Bus->edit_Bus_Data($id);
        $progs = $this->Program->get_Program($buses['route_id']);
        $ad = array();
        foreach( $progs as $row )
        {
        	array_push($ad, $this->Ad->edit_Ad_Data($row['ad_id']));
        }

        if (!empty($progs))
        {
        	$datap[] = array($buses, $progs, $ad);
            $this->set_response($ad, REST_Controller::HTTP_OK);
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Program could not be found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
	}
}