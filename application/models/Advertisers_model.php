<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Advertisers_model extends CI_Model
	{
		//Constructor
		public function __construct()
		{
			parent::__construct();
		}

		private $table = "advertisers";
		private $query = "advertiser_id, advertiser_name, advertiser_address, advertiser_contact, advertiser_email, advertiser_website, advertiser_description, agency_id, created_at";
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

		// FIND AGENCIES ON ADVERTISER
		public function findAgency($id)
		{
			$this->db->select("agency_id");
			$this->db->from($this->table);
			$this->db->where('agency_id', $id);
			$query=$this->db->get();
			if ($query->num_rows() > 0){
		        return true;
		    }
		    else{
		        return false;
		    }
		}

		public function getAgency($id)
		{
			$this->db->select($this->query.",SUBSTRING_INDEX(advertiser_description,' ',15) AS info");
			$this->db->from($this->table);
			$this->db->where('agency_id', $id);
			$query=$this->db->get();
			return $query->result_array();
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
			$this->db->select($this->query.",SUBSTRING_INDEX(advertiser_description,' ',15) AS info");
			$this->db->from($this->table);
			$query=$this->db->get();
			return $query->result_array();
		}

		// U P D A T E
		public function edit_Advertiser_Data($advertiser_id)
		{
			$this->db->select($this->query);
			$this->db->from($this->table);
			$this->db->where($this->id, $advertiser_id);
			$query = $this->db->get();
			return $query->row_array();
		}

		public function update_Advertiser_Data($data)
		{
			$this->db->where(array($this->id=>$data['advertiser_id']));
			$this->db->update($this->table, $data);
			return TRUE;
		}

		// D E L E T E
		public function delete_Advertiser_Data($data)
		{
			$this->db->where(array($this->id=>$data['advertiser_id']));
			$this->db->delete($this->table);
			return TRUE;
		}

		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////
		
	}

// END OF ADVERTISER MODEL
