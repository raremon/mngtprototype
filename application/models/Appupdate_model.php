<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Appupdate_model extends CI_Model
{
	private $table = 'tbappupdate';
	
	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	
	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////

	// C R E A T E
	public function save_Appupdate($data)
	{
		$this->db->insert($this->table, $data);
		// return $this->db->affected_rows() ? true : false;
		return $this->db->insert_id();				
		// return TRUE;
	}

	// U P D A T E
	public function update_Appupdate($data,$where)
	{
		$this->db->where($where);
		$this->db->update($this->table, $data);
		
		return $this->db->affected_rows();

		// echo $this->db->last_query();
		// exit;
		// return TRUE;
	}	

	// R E A D
	public function get_Appupdate($where=null,$orwhere=null){
	
		$this->db->select('*')
				->from($this->table);
	

		if( isset($where) ){
			$this->db->where($where);
		}

		if( isset($orwhere) )
			$this->db->or_where($orwhere,FALSE);
			
		$query = $this->db->get();

		// echo $this->db->last_query();
		// exit;
		
		return $query->result_array();
	
	}
	
	// R E A D
	public function getAppupdates($where=null,$orwhere=null){
	
		$this->db->select('*')
				->from($this->table)
				->join('tbappexec',$this->table.'.Appid=tbappexec.Appid','inner');
				// ->group_by('');		

		if( isset($where) ){
			$this->db->where($where);
		}

		if( isset($orwhere) )
			$this->db->or_where($orwhere,FALSE);
			
		$query = $this->db->get();
		
		// echo $this->db->last_query();
		// exit;
		
		return $query->result_array();
	
	}	

	public function getAppupdatesNojoin($where=null,$orwhere=null){
	
		$this->db->select('*')
				->from($this->table)
				->join('tbappexec',$this->table.'.Appid=tbappexec.Appid','inner');
				// ->group_by('');		

		if( isset($where) ){
			$this->db->where($where);
		}

		if( isset($orwhere) )
			$this->db->or_where($orwhere,FALSE);
			
		$query = $this->db->get();
		
		// echo $this->db->last_query();
		// exit;
		
		return $query->result_array();
	
	}	

	public function getAdLogsTotal($where=null,$orwhere=null,$custom=null){

		// SELECT *
		// FROM `ad_logs`
		// INNER JOIN `ads` ON `ad_logs`.`ad_id`=`ads`.`ad_id`
		// WHERE `advertiser_id` = '2'
		// AND (`date_log` = '2017-04-20'
		// OR `date_log` <= '2017-04-30')
	
		$this->db->select('routes.route_id,routes.route_name,ads.ad_id,ads.ad_name,
						SUM(amCount) AS am,SUM(pmCount) AS pm,SUM(eveCount) AS eve')
				->from($this->table)
				->join('ads','ad_logs.ad_id=ads.ad_id','inner')
				->join('routes','ad_logs.route_id=routes.route_id','inner')
				->group_by('ad_logs.ad_id')	
				->group_by('ad_logs.route_id');		

		if( isset($where) )
			$this->db->where($where);
		
		if( isset($orwhere) )
			$this->db->or_where($orwhere,FALSE);

		if( isset($custom) )
			$this->db->where("$custom");
				
		$query = $this->db->get();
		
		// echo $this->db->last_query();
		// exit;
		
		return $query->result_array();
	
	}	

	public function get_logs(){
		$this->db->select('amCount,pmCount,eveCount');
		// $this->db->select('*');
		$this->db->from('ad_logs');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function get_full_logs(){
		$this->db->select('*');
		// $this->db->select('*');
		$this->db->from('ad_logs');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function get_logs_company($ad_id, $route_id)	{
		$this->db->select('amCount,pmCount,eveCount');
		// $this->db->select('*');
		$this->db->from('ad_logs');
		$this->db->where('ad_id', $ad_id);
		$this->db->where('route_id', $route_id);
		$query=$this->db->get();
		return $query->result_array();
	}

	public function get_full_logs_company($ad_id, $route_id)	{
		$this->db->select('*');
		// $this->db->select('*');
		$this->db->from('ad_logs');
		$this->db->where('ad_id', $ad_id);
		$this->db->where('route_id', $route_id);
		$query=$this->db->get();
		return $query->result_array();
	}
	
	// D E L E T E
	public function delete_AdLogs_Data($data)	{
		$this->db->where(array('log_id'=>$data['log_id']));
		$this->db->delete($this->table);
		return TRUE;
	}

	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////

}

// END OF ADLOGS MODEL