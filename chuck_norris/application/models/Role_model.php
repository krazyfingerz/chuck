<?php

class Role_model extends Base_model{
    
    function __construct(){
        parent::__construct();
        
        $this->table_name = "role";
    }
    
    public function get_type($type)
    {
        $this->db->select("*");
        $this->db->from($this->table_name);
        $this->db->where("type", $type);

        $query = $this->db->get();

        return $query->result_array();
    }
}