<?php

class Model_variabel extends CI_Model
{
    public function __construct()
    {
    }
    public function ReadVariabel()
    {
        $query = $this->db->query("select * from variabel");
        
        
        return $query->result_array();
    }
    public function ReadVariabelById($input)
    {
        $query = $this->db->query("select * from variabel where RecId=?",array($input));
        
        
        return $query->result_array()[0];
    }
}
