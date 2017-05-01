<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Privileges_model extends CI_Model
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
		// public function save_Privilege($data)
		// {
		// 	$this->db->insert('privileges', $data);
		// 	return TRUE;
		// }

		// // R E A D
		// public function show_Privilege()
		// {
		// 	$this->db->select("*");
		// 	$this->db->from('privileges');
		// 	$query=$this->db->get();
		// 	return $query->result_array();
		// }

		// // U P D A T E
		// public function edit_Privilege_Data($ad_id)
		// {
		// 	$this->db->select("*");
		// 	$this->db->from('privileges');
		// 	$this->db->where('privilege_id', $privilege_id);
		// 	$query = $this->db->get();
		// 	return $query->row_array();
		// }

		// public function update_Privilege_Data($data)
		// {
		// 	$this->db->where(array('privilege_id'=>$data['privilege_id']));
		// 	$this->db->update('privileges', $data);
		// 	return TRUE;
		// }

		// // D E L E T E
		// public function delete_Privilege_Data($data)
		// {
		// 	$this->db->where(array('privilege_id'=>$data['privilege_id']));
		// 	$this->db->delete('privileges');
		// 	return TRUE;
		// }

		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////
		
	}

// END OF AD MODEL