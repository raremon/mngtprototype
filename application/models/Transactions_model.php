<?php

class Transactions_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    
    public function show_Logs(){
        $this->db->select("*");
        $this->db->from('transactions');
        $query=$this->db->get();
        return $query->result_array();
    }
}
