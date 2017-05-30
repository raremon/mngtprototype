<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_slots_model extends CI_Model
{
	// Constructor
	public function __construct()
	{
		parent::__construct();
	}

	private $table = "order_slots";
	private $query = "orderslot_id, order_id, tslot_id, display_type";
	private $id = "orderslot_id";

	public function get_by_id($orderslot_id){
		$this->db->select($this->query);
		$this->db->from($this->table);
		$this->db->where($id,$orderslot_id);
		$query=$this->db->get();
		return $query->result_array();
	}
	
	public function get_by_order_id($order_id){
		$this->db->select($this->query);
		$this->db->from($this->table);
		$this->db->where('order_id',$order_id);
		$query=$this->db->get();
		return $query->result_array();
	}
	
	public function getnormal(){
		$this->db->select($this->query);
		$this->db->from($this->table);
		$this->db->where('display_type',1);
		$query=$this->db->get();
		return $query->result_array();
	}
	
	public function getsplit(){
		$this->db->select($this->query);
		$this->db->from($this->table);
		$this->db->where('display_type',2);
		$query=$this->db->get();
		return $query->result_array();
	}
	
	public function getstar8(){
		$this->db->select($this->query);
		$this->db->from($this->table);
		$this->db->where('display_type',3);
		$query=$this->db->get();
		return $query->result_array();
	}
	////////////////////////////////////////////////////////////////
	//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
	////////////////////////////////////////////////////////////////
	public function create($data)
	{
		$this->db->insert($this->table, $data);
		return TRUE;
	}
	public function create_mobile($data)
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

// END OF ORDER SLOTS MODEL