<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Orders_model extends CI_Model
{
	// Constructor
	public function __construct()
	{
		parent::__construct();
	}

	private $table = "orders";
	private $query = "order_id, order_date, sales_id, ad_duration, advertiser_id, ad_id, order_status, status_date, date_start, date_end, created_at";
	private $id = "order_id";
  
	public function find_Salesman($id)
	{
		$this->db->select("sales_id");
		$this->db->from($this->table);
		$this->db->where('sales_id', $id);
		$query=$this->db->get();
		if ($query->num_rows() > 0){
	        return true;
	    }
	    else{
	        return false;
	    }
	}

	public function cancelOrder($id)
	{
		$date = new DateTime(null, new DateTimeZone('Asia/Hong_Kong'));
		$this->db->where(array($this->id=>$id));
		$this->db->update($this->table, array('order_status'=>2, 'status_date'=>$date->format('Y-m-d H:i:s')));
		return TRUE;
	}

	public function acceptOrder($data)
	{
		$this->db->where(array($this->id=>$data['order_id']));
		$this->db->update($this->table, $data);
		return TRUE;
	}

	public function get_Time($id)
	{
		$this->db->select('ad_duration');
		$this->db->from($this->table);
		$this->db->where($this->id, $id);
		$query = $this->db->get();
		$row = $query->row_array();
		return $row['ad_duration'];
	}
	
	public function getpending(){
		$this->db->select($this->query);
		$this->db->from($this->table);
		$this->db->where('order_status',0);
		$query=$this->db->get();
		return $query->result_array();
	}

	public function getapproved(){
		$this->db->select($this->query);
		$this->db->from($this->table);
		$this->db->where('order_status',1);
		$query=$this->db->get();
		return $query->result_array();
	}
	
	public function getcancelled(){
		$this->db->select($this->query);
		$this->db->from($this->table);
		$this->db->where('order_status',2);
		$query=$this->db->get();
		return $query->result_array();
	}
	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////
	public function create($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	public function read()
	{
		$this->db->select($this->query);
		$this->db->from($this->table);
		$query=$this->db->get();
		return $query->result_array();
	}
	public function edit($id)
	{
		$this->db->select($this->query);
		$this->db->from($this->table);
		$this->db->where($this->id, $id);
		$query = $this->db->get();
		return $query->row_array();
	}
	public function update($data)
	{
		$this->db->where(array($this->id=>$data[$this->id]));
		$this->db->update($this->table, $data);
		return TRUE;
	}
	public function delete($data)
	{
		$this->db->where(array($this->id=>$data[$this->id]));
		$this->db->delete($this->table);
		return TRUE;
	}
	////////////////////////////////////////////////////////////////
	// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
	////////////////////////////////////////////////////////////////
}

// END OF ORDERS MODEL