<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User_type_roles_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function save_user_type_role()
    {
        $data = array(

            "role_id" => $this->input->post("role_name"),
            "user_type_id" => $this->input->post("user_type_name"),
        );

        if ($this->db->insert("user_type_role", $data)) {
            return true;
        } else {
            return false;
        }

    }
    
    //get users from the db
    public function get_roles()
    {
        $this->db->where("deleted", 0);
        return $result = $this->db->get("role");

    }

    public function get_user_types()
    {
        $this->db->where("deleted", 0);
        return $result = $this->db->get("user_type");
    }
}
