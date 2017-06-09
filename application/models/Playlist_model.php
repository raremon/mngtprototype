<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Playlist_model extends CI_Model
{
	private $table = 'playlist';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////

	// C R E A T E
	public function create($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();				
	}

	// R E A D
	public function read($date=null,$where=null,$orwhere=null){
	
		$this->db->select('*')
				->from($this->table);	

		if( isset($where) )
			$this->db->where($where);
		
		if( isset($orwhere) )
			$this->db->or_where($orwhere,FALSE);

		if( isset($date) ){
			$this->db->where("date_start <= \"$date\"",NULL,FALSE);
			$this->db->where("date_end >= \"$date\"",NULL,FALSE);
		}
		
		$query = $this->db->get();
		
		// echo "<br />".$this->db->last_query();
		// exit;
		
		return $query->result_array();
	
	}	

	public function getList($where=null,$orwhere=null){
	
		$this->db->select('*')
				->from($this->table)
				->join('orders',$this->table.'.order_id=orders.order_id','inner')	
				->join('ads',$this->table.'.content_id=ads.ad_id','inner')
				->join('advertisers','ads.advertiser_id=advertisers.advertiser_id','inner');	

		if( isset($where) )
			$this->db->where($where);
		
		if( isset($orwhere) )
			$this->db->or_where($orwhere,FALSE);

		if( isset($date) ){
			$this->db->where("date_start <= \"$date\"",NULL,FALSE);
			$this->db->where("date_end >= \"$date\"",NULL,FALSE);
		}
		
		$query = $this->db->get();
		
		// echo "<br />".$this->db->last_query();
		// exit;
		
		return $query->result_array();
	
	}
	
	// U P D A T E
	public function update($data,$where)
	{
		$this->db->where($where);
		$this->db->update($this->table, $data);
		
		return $this->db->affected_rows();

		// echo $this->db->last_query();
		// exit;
		// return TRUE;
	}	

	// D E L E T E
	public function delete_($date=null, $where)
	{

		$this->db->where($where);
		
		if( isset($date) ){
			$this->db->where("date_start <= \"$date\"",NULL,FALSE);
			$this->db->where("date_end >= \"$date\"",NULL,FALSE);
		}
		
		$this->db->delete($this->table);
		// echo $this->db->last_query();	
		
		return TRUE;
	}	

	

	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////

}

// END OF MODEL