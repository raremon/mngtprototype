<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Programs_model extends CI_Model
	{
		//Constructor
		public function __construct()
		{
			parent::__construct();
		}

		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////

		// C R E A T E
		public function save_Program($data)
		{
			$this->db->insert('programs', $data);
			return TRUE;
		}

		// R E A D
		public function show_Program()
		{
			$this->db->select("*");
			$this->db->from('programs');
			$query=$this->db->get();
			return $query->result_array();
		}

		// U P D A T E
		public function edit_Program_Data($program_id)
		{
			$this->db->select("*");
			$this->db->from('programs');
			$this->db->where('program_id', $program_id);
			$query = $this->db->get();
			return $query->row_array();
		}

		public function update_Program_Data($data)
		{
			$this->db->where(array('program_id'=>$data['program_id']));
			$this->db->update('programs', $data);
			return TRUE;
		}

		// D E L E T E
		public function delete_Program_Data($data)
		{
			$this->db->where(array('program_id'=>$data['program_id']));
			$this->db->delete('programs');
			return TRUE;
		}

		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////
		
		////////////////////////////////////////////////////////////////
		//            A  P  I    F  U  N  C  T  I  O  N  S            //
		////////////////////////////////////////////////////////////////

		// U P D A T E
		public function get_Program($route_id)
		{
			$this->db->select("*");
			$this->db->from('programs');
			$this->db->where('route_id', $route_id);
			$query = $this->db->get();
			return $query->result_array();
		}

		////////////////////////////////////////////////////////////////
		//   E  N  D    O  F    A  P  I    F  U  N  C  T  I  O  N  S  //
		////////////////////////////////////////////////////////////////
	}

// END OF PROGRAM MODEL