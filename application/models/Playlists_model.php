<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Playlists_model extends CI_Model
{
	// Constructor
	public function __construct()
	{
		parent::__construct();
	}

	private $table = "playlist";
	private $query = "play_id, id, content_type, content_id, date_start, date_end, timeslot, tslot_time, times_repeat, display_type, win_123, route_id, duration, filename, play_order, order_id";
	private $id = "play_id";
    
    public function getTimeslot($id)
    {
        $this->db->select($this->query);
		$this->db->from($this->table);
		$this->db->where('timeslot', $id);
		$query = $this->db->get();
        return $query->result_array();
    }
    public function updateSchedule($play_id, $play_order)
    {
    	$this->db->where(array('play_id'=>$play_id));
		$this->db->update($this->table, array('play_order'=>$play_order));
		return TRUE;
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

// END OF PLAYLIST MODEL