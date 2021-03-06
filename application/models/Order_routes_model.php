<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_routes_model extends CI_Model
{
	// Constructor
	public function __construct()
	{
		parent::__construct();
	}

	private $table = "order_routes";
	private $query = "orderroutes_id, order_id, route_id, created_at";
	private $id = "orderroutes_id";

	public function getRoutes($id)
	{
		$this->db->select($this->query);
		$this->db->from($this->table);
		$this->db->where('order_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function deleteOrder($order_id, $orderroutes_id)
	{
		$this->db->where(array($this->id=>$orderroutes_id));
		$this->db->where(array('order_id'=>$order_id));
		$this->db->delete($this->table);
		return TRUE;
	}
	public function get_by_order_id($order_id){
		$this->db->select($this->query);
		$this->db->from($this->table);
		$this->db->where('order_id',$order_id);
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

// END OF ORDER ROUTES MODEL