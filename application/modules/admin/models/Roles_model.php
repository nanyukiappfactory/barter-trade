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
            "role_parent" => $this->input->post("role_parent"),
            "role_name" => $this->input->post("role_name"),
            "deleted" => 0,

        );

        if ($this->db->insert("role", $data)) {
            return true;
        } else {
            return false;
        }
    }

    //get role from the db
    public function get_role()
    {
        $this->db->where("deleted", 0);
        //$this->db->order_by("created_on", "DESC");
        return $result = $this->db->get("role");
    }

    public function get_single($role_id)
    {
        $this->db->where("role_id", $role_id);
        return $this->db->get("role");
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
            $remain = $this->get_role();
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
            $remain = $this->get_role();
            $this->session->set_flashdata("success", "You have activated" . $id);
            return $remain;
        } else {
            $this->session->set_flashdata("error", "Unable to activate" . $id);
            return false;
        }
    }

    public function edit_update_role($id)
    {
        $this->db->where("role_id", $id);
        $this->db->get("role");

        //Capture data to be updated
        $data = array(
            "role_parent" => $this->input->post("role_parent"),
            "role_name" => $this->input->post("role_name"),
            "deleted" => 0,
            "modified_on" => date("Y-m-d H:i:s"),
        );

        if ($this->db->update("role", $data)) {
            return true;
        } else {
            return false;
        }
    }
}
