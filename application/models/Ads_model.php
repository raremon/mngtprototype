<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Ads_model extends CI_Model
	{
		private $table = 'ads';
		private $query = 'ad_id, ad_name, ad_filename, ad_duration, advertiser_id, created_at';
		private $id = 'ad_id';

		//Constructor
		public function __construct()
		{
			parent::__construct();
		}

		public function count_Ad()
		{
			$this->db->select('ad_id');
			$this->db->from('ads');
			return $this->db->count_all_results();
		}

		public function getAds($where=null){

			$this->db->select('*')
				->from($this->table)
				->join('advertisers','ads.advertiser_id=advertisers.advertiser_id','inner');				

			if( isset($where) )
				$this->db->where($where);

			if( isset($orwhere) )
				$this->db->or_where($orwhere);
				
			$query = $this->db->get();
			
			// echo $this->db->last_query();
			// exit;
			
			return $query->result_array();
		
		}

		// FIND ADVERTISER ON ADS
		public function findAds($id)
		{
			$this->db->select("advertiser_id");
			$this->db->from($this->table);
			$this->db->where('advertiser_id', $id);
			$query=$this->db->get();
			if ($query->num_rows() > 0){
		        return true;
		    }
		    else{
		        return false;
		    }
		}

		////////////////////////////////////////////////////////////////
		//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
		////////////////////////////////////////////////////////////////

		// C R E A T E
		public function save_Ad($data)
		{
			$this->db->insert($this->table, $data);
			return TRUE;
		}

		// R E A D
		public function show_Ad()
		{
			$this->db->select($this->query);
			$this->db->from($this->table);
			$query=$this->db->get();
			return $query->result_array();
		}

		// U P D A T E
		public function edit_Ad_Data($ad_id)
		{
			$this->db->select($this->query);
			$this->db->from($this->table);
			$this->db->where('ad_id', $ad_id);
			$query = $this->db->get();
			return $query->row_array();
		}

		// G E T
		public function get_Ad_Data($advertiser_id)
		{
			$this->db->select($this->query);
			$this->db->from($this->table);
			$this->db->where('advertiser_id', $advertiser_id);
			$query = $this->db->get();
			return $query->result_array();
		}
		
		public function find_Ad_Data($ad_id)
		{
			$this->db->select($this->query);
			$this->db->from($this->table);
			$this->db->where('ad_id', $ad_id);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function update_Ad_Data($data)
		{
			$this->db->where(array('ad_id'=>$data['ad_id']));
			$this->db->update($this->table, $data);
			return TRUE;
		}

		// D E L E T E
		public function delete_Ad_Data($data)
		{
			$this->db->where(array('ad_id'=>$data['ad_id']));
			$this->db->delete($this->table);
			return TRUE;
		}
		////////////////////////////////////////////////////////////////
		// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
		////////////////////////////////////////////////////////////////
	}

// END OF AD MODEL