<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Advertisers_model extends CI_Model
	{
		//Constructor
		public function __construct()
		{
			parent::__construct();
		}

		private $query = "advertiser_name, advertiser_address, advertiser_contact, advertiser_email, advertiser_website, advertiser_description, created_at";
		private $table = "advertisers";
		private $id = "advertiser_id";
		
		public function count_Advertiser()
		{
			$this->db->select('advertiser_id');
			$this->db->from('advertisers');
			return $this->db->count_all_results();
		}

		public function get_by_id($advertiser_id)
		{
			$this->db->select($this->query);
			$this->db->from($this->table);
			$this->db->where($this->id, $advertiser_id);
			$account = $this->db->get();
			return $account->row_array();
		}
		
		public function get_email($advertiser_id){
			$this->db->select('advertiser_email');
			$this->db->from($this->table);
			$this->db->where($this->id, $advertiser_id);
			$account = $this->db->get();
			return $account->row_array();
		}
		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////

		// C R E A T E
		public function save_Advertiser($data)
		{
			$this->db->insert('advertisers', $data);
			return TRUE;
		}

		// R E A D
		public function show_Advertiser()
		{
			$this->db->select("*,SUBSTRING_INDEX(advertiser_description,' ',15) AS info");
			$this->db->from('advertisers');
			$query=$this->db->get();
			return $query->result_array();
		}

		// U P D A T E
		public function edit_Advertiser_Data($advertiser_id)
		{
			$this->db->select("*");
			$this->db->from('advertisers');
			$this->db->where('advertiser_id', $advertiser_id);
			$query = $this->db->get();
			return $query->row_array();
		}

		public function update_Advertiser_Data($data)
		{
			$this->db->where(array('advertiser_id'=>$data['advertiser_id']));
			$this->db->update('advertisers', $data);
			return TRUE;
		}

		// D E L E T E
		public function delete_Advertiser_Data($data)
		{
			$this->db->where(array('advertiser_id'=>$data['advertiser_id']));
			$this->db->delete('advertisers');
			return TRUE;
		}

		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////
		
	}

// END OF ADVERTISER MODEL
