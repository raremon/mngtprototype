<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ads_model extends CI_Model
{
	private $table = 'ads';
	
	// Constructor
	public function __construct()
	{
		parent::__construct();
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
	
	
	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////

	// C R E A T E
	public function save_Terminal($data)
	{
		$this->db->insert('terminals', $data);
		return TRUE;
	}

	// R E A D
	public function show_Terminal()
	{
		$this->db->select("*");
		$this->db->from('terminals');
		$query=$this->db->get();
		return $query->result_array();
	}

	// U P D A T E
	public function edit_Terminal_Data($terminal_id)
	{
		$this->db->select("*");
		$this->db->from('terminals');
		$this->db->where('terminal_id', $terminal_id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function update_Terminal_Data($data)
	{
		$this->db->where(array('terminal_id'=>$data['terminal_id']));
		$this->db->update('terminals', $data);
		return TRUE;
	}

	// D E L E T E
	public function delete_Terminal_Data($data)
	{
		$this->db->where(array('terminal_id'=>$data['terminal_id']));
		$this->db->delete('terminals');
		return TRUE;
	}

	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////

}

// END OF TERMINAL MODEL