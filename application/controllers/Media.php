<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends MY_Controller {

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'User');
		$this->load->model('roles_model', 'Role');

		$this->load->model('mediaboxes_model', 'Box');
		$this->load->model('tvs_model', 'Tv');
		$this->load->model('card_readers_model', 'Card');
		$this->load->model('gps_model', 'Gps');
		$this->load->model('cctvs_model', 'Cctv');
		$this->load->model('ipcams_model', 'Ipcam');
		$this->load->model('pos_model', 'Pos');

		$this->load->model('vehicles_model', 'Vehicle');
		$this->load->model('vehicle_types_model', 'Vehicle_Type');

		$this->load->model('deployment_model', 'Media');
		// $this->load->model('active_vehicles_model', 'Active');
	}
			
	public function assign()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='Assign Media';
		$data['breadcrumbs']=array
		(
			array('View Assigned Tv and Mediabox','Media/browse'),
			array('Assign Media','Media/assign'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);
		$data['page_description']='Assign Mediabox and TV to Vehicle';

		$vehicle_type_data = $this->Vehicle_Type->read();
		$data['types'] = array();
		foreach ($vehicle_type_data as $rows) {
			array_push($data['types'],
				array(
					$rows['vehicle_type_id'],
					$rows['vehicle_type_name'],
				)
			);
		}

		$vehicle_data = $this->Vehicle->find_Vehicle();
		$data['vehicles'] = array();
		foreach ($vehicle_data as $rows) {
			array_push($data['vehicles'],
				array(
					$rows['vehicle_id'],
					$rows['vehicle_name'],
					$rows['vehicle_type'],
				)
			);
		}

		$box_data = $this->Box->find_Mediabox();
		$data['boxes'] = array();
		foreach ($box_data as $rows) {
			array_push($data['boxes'],
				array(
					$rows['box_id'],
					$rows['box_tag'],
				)
			);
		}

		$tv_data = $this->Tv->find();
		$data['tvs'] = array();
		foreach ($tv_data as $rows) {
			array_push($data['tvs'],
				array(
					$rows['tv_id'],
					$rows['tv_serial'],
				)
			);
		}

		$gps_data = $this->Gps->find();
		$data['gps'] = array();
		foreach ($gps_data as $rows) {
			array_push($data['gps'],
				array(
					$rows['gps_id'],
					$rows['gps_serial'],
				)
			);
		}

		$card_data = $this->Card->find();
		$data['cards'] = array();
		foreach ($card_data as $rows) {
			array_push($data['cards'],
				array(
					$rows['card_id'],
					$rows['card_serial'],
				)
			);
		}

		$cctv_data = $this->Cctv->find();
		$data['cctvs'] = array();
		foreach ($cctv_data as $rows) {
			array_push($data['cctvs'],
				array(
					$rows['cctv_id'],
					$rows['cctv_serial'],
				)
			);
		}

		$ipcam_data = $this->Ipcam->find();
		$data['ipcams'] = array();
		foreach ($ipcam_data as $rows) {
			array_push($data['ipcams'],
				array(
					$rows['ipcam_id'],
					$rows['ipcam_serial'],
				)
			);
		}

		$pos_data = $this->Pos->find();
		$data['poss'] = array();
		foreach ($pos_data as $rows) {
			array_push($data['poss'],
				array(
					$rows['pos_id'],
					$rows['pos_serial'],
				)
			);
		}

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'browse_assignment' ;

		$this->load->view("template/header", $data);
		$this->load->view("vehicles/media_assign", $data);
		$this->load->view("template/footer", $data);
	}

	public function browse()
	{
		$data = array();
		$data['role'] = $this->logged_out_check();
		$data['title']='View Assigned Tv and Mediabox';
		$data['breadcrumbs']=array
		(
			array('View Assigned Tv and Mediabox','Media/browse'),
		);
		$data['css']=array
		(
			
		);
		$data['script']=array
		(
			
		);
		$data['page_description']='View Assigned Devices';

		$vehicle_type_data = $this->Vehicle_Type->read();
		$data['types'] = array();
		foreach ($vehicle_type_data as $rows) {
			array_push($data['types'],
				array(
					$rows['vehicle_type_id'],
					$rows['vehicle_type_name'],
				)
			);
		}

		$vehicle_data = $this->Vehicle->read();
		$data['vehicles'] = array();
		foreach ($vehicle_data as $rows) {
			array_push($data['vehicles'],
				array(
					$rows['vehicle_id'],
					$rows['vehicle_name'],
					$rows['vehicle_type'],
				)
			);
		}

		$box_data = $this->Box->show_Mediabox();
		$data['boxes'] = array();
		foreach ($box_data as $rows) {
			array_push($data['boxes'],
				array(
					$rows['box_id'],
					$rows['box_tag'],
				)
			);
		}

		$tv_data = $this->Tv->read();
		$data['tvs'] = array();
		foreach ($tv_data as $rows) {
			array_push($data['tvs'],
				array(
					$rows['tv_id'],
					$rows['tv_serial'],
				)
			);
		}

		$data['treeActive'] = 'settings';
		$data['childActive'] = 'browse_assignment' ;

		$this->load->view("template/header", $data);
		$this->load->view("vehicles/media_browse", $data);
		$this->load->view("template/footer", $data);
	}

	public function getVehicleInfo($vehicle_id)
	{
		$table = $this->Media->get_Info($vehicle_id);

		$box = $this->Box->edit_Mediabox($table['box_id']);
		$tv = $this->Tv->edit($table['tv_id']);
		$gps = $this->Gps->edit($table['gps_id']);
		$card = $this->Card->edit($table['card_id']);
		$cctv = $this->Cctv->edit($table['cctv_id']);
		$ipcam = $this->Ipcam->edit($table['ipcam_id']);
		$pos = $this->Pos->edit($table['pos_id']);

		$data = array(
			$table['deploy_id'],
			array($box['box_id'],$box['box_tag']),
			array($tv['tv_id'],$tv['tv_serial']),
			array($gps['gps_id'],$gps['gps_serial']),
			array($card['card_id'],$card['card_serial']),
			array($cctv['cctv_id'],$cctv['cctv_serial']),
			array($ipcam['ipcam_id'],$ipcam['ipcam_serial']),
			array($pos['pos_id'],$pos['pos_serial']),
		);
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////

	// C R E A T E
	public function saveMedia()
	{
		// VALIDATE
		// SAVE TO DEPLOYMENT THEN GET DEPLOY_ID
		// UPDATE VEHICLE['ASSIGNED TO'] == DEPLOY_ID
		// UPDATE TV['ASSIGNED TO'] == DEPLOY_ID
		// UPDATE BOX['ASSIGNED TO'] == DEPLOY_ID
		// UPDATE GPS['ASSIGNED TO'] == DEPLOY_ID
		// UPDATE CARD READER['ASSIGNED TO'] == DEPLOY_ID
		// UPDATE CCTV['ASSIGNED TO'] == DEPLOY_ID
		// UPDATE IP CAMERA['ASSIGNED TO'] == DEPLOY_ID
		// UPDATE POS['ASSIGNED TO'] == DEPLOY_ID
		$validate = array (
			array('field'=>'vehicle_id','label'=>'Vehicle','rules'=>'required|is_unique[deployment.vehicle_id]'),
			array('field'=>'box_id','label'=>'Mediabox','rules'=>'required|is_unique[deployment.box_id]'),
			array('field'=>'tv_id','label'=>'Tv','rules'=>'required|is_unique[deployment.tv_id]'),
			array('field'=>'gps_id','label'=>'GPS','rules'=>'required|is_unique[deployment.gps_id]'),
			array('field'=>'card_id','label'=>'Card Reader','rules'=>'required|is_unique[deployment.card_id]'),
			array('field'=>'cctv_id','label'=>'CCTV','rules'=>'required|is_unique[deployment.cctv_id]'),
			array('field'=>'ipcam_id','label'=>'IP Camera','rules'=>'required|is_unique[deployment.ipcam_id]'),
			array('field'=>'pos_id','label'=>'POS','rules'=>'required|is_unique[deployment.pos_id]'),
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
			$box = null;
			if($this->input->post('box_id') != 0)
			{
				$box = $this->input->post('box_id');
			}
			$tv = null;
			if($this->input->post('tv_id') != 0)
			{
				$tv = $this->input->post('tv_id');
			}
			$gps = null;
			if($this->input->post('gps_id') != 0)
			{
				$gps = $this->input->post('gps_id');
			}
			$card = null;
			if($this->input->post('card_id') != 0)
			{
				$card = $this->input->post('card_id');
			}
			$cctv = null;
			if($this->input->post('cctv_id') != 0)
			{
				$cctv = $this->input->post('cctv_id');
			}
			$ipcam = null;
			if($this->input->post('ipcam_id') != 0)
			{
				$ipcam = $this->input->post('ipcam_id');
			}
			$pos = null;
			if($this->input->post('pos_id') != 0)
			{
				$pos = $this->input->post('pos_id');
			}
			$data=array(
				'vehicle_id'=>$this->input->post('vehicle_id'),
				'box_id'=>$box,
				'tv_id'=>$tv,
				'gps_id'=>$gps,
				'card_id'=>$card,
				'cctv_id'=>$cctv,
				'ipcam_id'=>$ipcam,
				'pos_id'=>$pos,
			);
			$media_id = $this->Media->save_Media($data);
			$this->Vehicle->assign_Media($media_id, $data['vehicle_id']);
			$this->Box->assign_Media($media_id, $data['box_id']);
			$this->Tv->assign($media_id, $data['tv_id']);
			$this->Gps->assign($media_id, $data['gps_id']);
			$this->Card->assign($media_id, $data['card_id']);
			$this->Cctv->assign($media_id, $data['cctv_id']);
			$this->Ipcam->assign($media_id, $data['ipcam_id']);
			$this->Pos->assign($media_id, $data['pos_id']);
			$info['message']="<p class='success-message'>You have successfully assigned devices to Vehicle id #<span class='message-name'>".$data['vehicle_id']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// R E A D
	public function showMedia()
	{
		$table = $this->Media->show_Media();
		$data = array();
		foreach ($table as $rows) {
			$creation = new DateTime($rows['created_at']);
			$vehicle = $this->Vehicle->edit_Vehicle($rows['vehicle_id']);
			$box = $this->Box->edit_Mediabox($rows['box_id']);
			$tv = $this->TV->edit_Tv($rows['tv_id']);
			$gps = $this->GPS->edit($rows['gps_id']);
			$card = $this->Card->edit($rows['card_id']);

			array_push($data,
				array(
					$vehicle['vehicle_name'],
					$box['box_tag'],
					$tv['tv_serial'],
					$gps['gps_serial'],
					$card['card_serial'],
					$creation->format('M / d / Y'),
					'<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="delete_media('."'".$rows['ready_vehicle_id']."'".')">Delete</a>'
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}

	// U P D A T E
	public function editMedia()
	{
		$id=$this->input->post('ready_vehicle_id');
		$data=$this->Media->edit_Media($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function updateMedia()
	{

		$validate = array (
			array('field'=>'vehicle_id','label'=>'Vehicle','rules'=>'required'),
			array('field'=>'box_id','label'=>'Mediabox','rules'=>'required'),
			array('field'=>'tv_id','label'=>'Tv','rules'=>'required'),
			array('field'=>'gps_id','label'=>'GPS','rules'=>'required'),
			array('field'=>'card_id','label'=>'Card Reader','rules'=>'required'),
			array('field'=>'cctv_id','label'=>'CCTV','rules'=>'required'),
			array('field'=>'ipcam_id','label'=>'IP Camera','rules'=>'required'),
			array('field'=>'pos_id','label'=>'POS','rules'=>'required'),
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
			$box = null;
			if($this->input->post('box_id') != 0)
			{
				$box = $this->input->post('box_id');
			}
			$tv = null;
			if($this->input->post('tv_id') != 0)
			{
				$tv = $this->input->post('tv_id');
			}
			$gps = null;
			if($this->input->post('gps_id') != 0)
			{
				$gps = $this->input->post('gps_id');
			}
			$card = null;
			if($this->input->post('card_id') != 0)
			{
				$card = $this->input->post('card_id');
			}
			$cctv = null;
			if($this->input->post('cctv_id') != 0)
			{
				$cctv = $this->input->post('cctv_id');
			}
			$ipcam = null;
			if($this->input->post('ipcam_id') != 0)
			{
				$ipcam = $this->input->post('ipcam_id');
			}
			$pos = null;
			if($this->input->post('pos_id') != 0)
			{
				$pos = $this->input->post('pos_id');
			}
			$data=array(
				'deploy_id'=>$this->input->post('ready_vehicle_id'),
				'vehicle_id'=>$this->input->post('vehicle_id'),
				'box_id'=>$box,
				'tv_id'=>$tv,
				'gps_id'=>$gps,
				'card_id'=>$card,
				'cctv_id'=>$cctv,
				'ipcam_id'=>$ipcam,
				'pos_id'=>$pos,
			);

			$media=$this->Media->edit_Media($this->input->post('ready_vehicle_id'));

			$this->Vehicle->unassign_Media($media['deploy_id'], $media['vehicle_id']);
			$this->Box->unassign_Media($media['deploy_id'], $media['box_id']);
			$this->Tv->unassign($media['deploy_id'], $media['tv_id']);
			$this->Gps->unassign($media['deploy_id'], $media['gps_id']);
			$this->Card->unassign($media['deploy_id'], $media['card_id']);
			$this->Cctv->unassign($media['deploy_id'], $media['cctv_id']);
			$this->Ipcam->unassign($media['deploy_id'], $media['ipcam_id']);
			$this->Pos->unassign($media['deploy_id'], $media['pos_id']);

			$this->Media->update_Media($data);

			$this->Vehicle->assign_Media($data['deploy_id'], $data['vehicle_id']);
			$this->Box->assign_Media($data['deploy_id'], $data['box_id']);
			$this->Tv->assign($data['deploy_id'], $data['tv_id']);
			$this->Gps->assign($data['deploy_id'], $data['gps_id']);
			$this->Card->assign($data['deploy_id'], $data['card_id']);
			$this->Cctv->assign($data['deploy_id'], $data['cctv_id']);
			$this->Ipcam->assign($data['deploy_id'], $data['ipcam_id']);
			$this->Pos->assign($data['deploy_id'], $data['pos_id']);

			$info['message']="<p class='success-message'>You have successfully updated assigned devices to Vehicle id #<span class='message-name'>".$data['vehicle_id']."</span>!</p>";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	// D E L E T E
	public function delete_Media()
	{
		$validate=array(
			array('field'=>'ready_vehicle_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			if($this->Media->find_Route($this->input->post('ready_vehicle_id')))
			{
				$info['success']=FALSE;
				$info['errors']="Cannot Empty Media Deployed on Route!";
			}
			else
			{
				$info['success']=TRUE;
				$data=array(
					'deploy_id'=>$this->input->post('ready_vehicle_id')
				);

				$media=$this->Media->edit_Media($this->input->post('ready_vehicle_id'));

				$this->Vehicle->unassign_Media($media['deploy_id'], $media['vehicle_id']);
				$this->Box->unassign_Media($media['deploy_id'], $media['box_id']);
				$this->Tv->unassign($media['deploy_id'], $media['tv_id']);
				$this->Gps->unassign($media['deploy_id'], $media['gps_id']);
				$this->Card->unassign($media['deploy_id'], $media['card_id']);
				$this->Cctv->unassign($media['deploy_id'], $media['cctv_id']);
				$this->Ipcam->unassign($media['deploy_id'], $media['ipcam_id']);
				$this->Pos->unassign($media['deploy_id'], $media['pos_id']);

				$this->Media->delete_Media($data);
				$info['message']="<p class='success-message'>You have successfully emptied assigned devices to Vehicle id #<span class='message-name'>".$media['vehicle_id']."</span>!</p>";
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////

}

// END OF MEDIA ASSIGNMENT CONTROLLER