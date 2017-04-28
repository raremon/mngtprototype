<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Features_model extends CI_Model
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
		// public function save_Feature($data)
		// {
		// 	$this->db->insert('features', $data);
		// 	return TRUE;
		// }

		// // R E A D
		// public function show_Feature()
		// {
		// 	$this->db->select("*");
		// 	$this->db->from('features');
		// 	$query=$this->db->get();
		// 	return $query->result_array();
		// }

		// // U P D A T E
		// public function edit_Feature_Data($ad_id)
		// {
		// 	$this->db->select("*");
		// 	$this->db->from('features');
		// 	$this->db->where('feature_id', $feature_id);
		// 	$query = $this->db->get();
		// 	return $query->row_array();
		// }

		// public function update_Feature_Data($data)
		// {
		// 	$this->db->where(array('feature_id'=>$data['feature_id']));
		// 	$this->db->update('features', $data);
		// 	return TRUE;
		// }

		// // D E L E T E
		// public function delete_Feature_Data($data)
		// {
		// 	$this->db->where(array('feature_id'=>$data['feature_id']));
		// 	$this->db->delete('features');
		// 	return TRUE;
		// }

		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////
		
	}

// END OF FEATURE MODEL