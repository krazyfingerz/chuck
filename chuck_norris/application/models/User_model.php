<?php

class User_model extends Base_model{
    
    function __construct(){
        parent::__construct();
        
        $this->table_name = "user";
    }

    public function get_all()
    {
        $this->db->select("user.*");
        $this->db->from("user");
        $this->db->where("user.deleted", 0);

        return $this->db->get()->result_array();
    }

    public function get_where($where)
    {
        $this->db->select("user.*");
        $this->db->from("user");
        $this->db->where("user.deleted", 0);
        $this->db->where($where);

        return $this->db->get()->result_array();
    }
     
}