<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Roles_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function save_role()
    {
        $data = array(
            "parent" => $this->input->post("role_parent"),
            "role_name" => $this->input->post("role_name"),
            "deleted" => 0,
            "role_status"=>0

        );

        if ($this->db->insert("role", $data)) {
            return true;
        } else {
            return false;
        }
    }

    //get role from the db
    public function get_role($table, $where,$limit,$page,$order,$order_method)
    {
        $where="deleted=0";
        $this->db->select("*");
        $this->db->from($table);    
        $this->db->where($where);
        $this->db->limit($limit, $page);
        $this->db->order_by($order, $order_method);
        $result= $this->db->get();
        return $result;
    }

    public function get_single($role_id)
    {
        $this->db->where("role_id", $role_id);
        return $this->db->get("role");
    }
    public function get_results()
    {
       
        $this->db->where("role.deleted=0");
// Execute the query.
        $query = $this->db->get("role");
        
        // var_dump($query);die();
// Return the results.
        return $query;
        
    }

    public function delete($id)
    {
        // Delete member data
        $this->db->set("deleted", 1, "modified_on", date("Y-m-d H:i:s"), "deleted_on", date("Y-m-d H:i:s"));
        $this->db->where("role_id", $id);

        if ($this->db->update("role")) {
            $this->session->set_flashdata("success", "You have deleted" . $id);
            return true;
        } else {
            $this->session->set_flashdata("error", "Unable to delete" . $id);
            return false;
        }
    }

    public function deactivate_role($id)
    {
        $this->db->where("role_id", $id);
        $this->db->set("role_status", 0);
        if ($this->db->update("role")) {
            $remain = $this->get_results();
            $this->session->set_flashdata("success", "You have deactivated" . $id);
            return $remain;
        } else {
            $this->session->set_flashdata("error", "Unable to deactivate" . $id);
            return false;
        }
    }

    //activate
    public function activate_role($id)
    {
        $this->db->where("role_id", $id);
        $this->db->set("role_status", 1);
        if ($this->db->update("role")) {
            $remain = $this->get_results();
            $this->session->set_flashdata("success", "You have activated" . $id);
            return $remain;
        } else {
            $this->session->set_flashdata("error", "Unable to activate" . $id);
            return false;
        }
    }

    public function edit_update_role($id)
    {
        $this->db->get("role");
        //Capture data to be updated
        $data = array(
            "parent" => $this->input->post("role_parent"),
            "role_name" => $this->input->post("role_name"),
            "deleted" => 0,
            "modified_on" => date("Y-m-d H:i:s"),
        );

        if ($this->db->where("role_id", $id))
        {
            $this->db->update("role", $data);
            return true;
        } else {
            return false;
        }
    }
}
