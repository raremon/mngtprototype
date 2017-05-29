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
	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////
	public function create($data)
	{
		$this->db->insert($this->table, $data);
		return TRUE;
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