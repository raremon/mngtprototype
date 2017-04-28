<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Ads_model extends CI_Model
	{
		//Constructor
		public function __construct()
		{
			parent::__construct();
		}

		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////

		// // C R E A T E
		// public function save_Ad($data)
		// {
		// 	$this->db->insert('ads', $data);
		// 	return TRUE;
		// }

		// // R E A D
		// public function show_Ad()
		// {
		// 	$this->db->select("*");
		// 	$this->db->from('ads');
		// 	$query=$this->db->get();
		// 	return $query->result_array();
		// }

		// // U P D A T E
		// public function edit_Ad_Data($ad_id)
		// {
		// 	$this->db->select("*");
		// 	$this->db->from('ads');
		// 	$this->db->where('ad_id', $ad_id);
		// 	$query = $this->db->get();
		// 	return $query->row_array();
		// }

		// public function update_Ad_Data($data)
		// {
		// 	$this->db->where(array('ad_id'=>$data['ad_id']));
		// 	$this->db->update('ads', $data);
		// 	return TRUE;
		// }

		// // D E L E T E
		// public function delete_Ad_Data($data)
		// {
		// 	$this->db->where(array('ad_id'=>$data['ad_id']));
		// 	$this->db->delete('ads');
		// 	return TRUE;
		// }

		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////
		
	}

// END OF AD MODEL