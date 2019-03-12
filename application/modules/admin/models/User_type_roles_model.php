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

        if ($this->db->insert("user_type_role", $data))
        {
            return true;
        } else
        {
            return false;
        }

    }
    
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
    public function get_single($user_type_role_id)
    {
        $this->db->where("user_type_role_id", $user_type_role_id);
        return $this->db->get("user_type_role");
    }
    public function get_user_type_role($table=null, $where,$limit,$page,$order,$order_method)
    {
        $this->db->select('role.role_name, user_type.user_type_name,role.role_id,user_type.user_type_id, user_type_role.*');
        $this->db->from("role");
        $this->db->join("user_type_role","role.role_id=user_type_role.role_id");
        $this->db->join("user_type", "user_type_role.user_type_id=user_type.user_type_id");
        $this->db->where("user_type_role.deleted", 0);
        $this->db->where($where);
        $this->db->limit($limit, $page);
        $this->db->order_by($order, $order_method);
        $result= $this->db->get();
        return $result;
   
    }

    public function get_results()
    {
        $this->db->where("user_type_role.deleted=0");
        $query = $this->db->get("user_type_role");
        return $query;
    }

    public function delete($id)
    {
        $this->db->set("deleted", 1, "modified_on", date("Y-m-d H:i:s"), "deleted_on", date("Y-m-d H:i:s"));
        $this->db->where("user_type_role_id", $id);

        if ($this->db->update("user_type_role")) {
            $this->session->set_flashdata("success", "You have deleted" . $id);
            return true;
        } else {
            $this->session->set_flashdata("error", "Unable to delete" . $id);
            return false;
        }
    }

    public function deactivate_user_type_role($id)
    {
        $this->db->where("user_type_role_id", $id);
        $this->db->set("user_type_role_status", 0);
        if ($this->db->update("user_type_role")) {
            $remain = $this->get_results();
            $this->session->set_flashdata("success", "You have deactivated" . $id);
            return $remain;
        } else {
            $this->session->set_flashdata("error", "Unable to deactivate" . $id);
            return false;
        }
    }

    public function activate_user_type_role($id)
    {
        $this->db->where("user_type_role_id", $id);
        $this->db->set("user_type_role_status", 1);
        if ($this->db->update("user_type_role")) {
            $remain = $this->get_results();
            $this->session->set_flashdata("success", "You have activated" . $id);
            return $remain;
        } else {
            $this->session->set_flashdata("error", "Unable to activate" . $id);
            return false;
        }
    }

    public function edit_update_user_type_role($id)
    {
        $this->db->get("user_type_role");
        $data = array(
            "role_id" => $this->input->post("role"),
            "user_type_id" => $this->input->post("user_type"),
            "deleted" => 0,
            "modified_on" => date("Y-m-d H:i:s"),
        );
        if ($this->db->where("user_type_role_id", $id))
        {
            $this->db->update("user_type_role", $data);
            return true;
        } else {
            return false;
        }
    }
    
    public function retrieve_roles_and_user_types()
    {
        $this->db->select('role.role_name, user_type.user_type_name,role.role_id,user_type.user_type_id AS user_type_PK_id,user_type_role.user_type_id');
        $this->db->from("role");
        $this->db->join("user_type_role","role.role_id=user_type_role.role_id");
        $this->db->join("user_type", "user_type_role.user_type_id=user_type.user_type_id");
        $this->db->where("user_type_role.deleted", 0);
        $query = $this->db->get();
        return $query;
    }
}
