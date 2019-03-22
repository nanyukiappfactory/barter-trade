<?php
if(!defined('BASEPATH')){ exit('No direct script access allowed');}

class User_types_model extends CI_Model
{
    public $table = "user_type";

    public function add_user_type()
    {
        $data = array(
            "user_type_name" => $this->input->post("user_type_name"),
            "deleted" => 0,
            "user_type_status" => 1,
        );
        if($this->db->insert("user_type", $data)) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

    public function get_user_type($table, $where, $limit, $page, $order, $order_method)
    {
        $search_user_type = $this->session->userdata('search_user_type');
        $this->db->select("*");
        $this->db->from($table);
        if(!empty($search_user_type))
        {
            $this->db->where("user_type_name", $search_user_type);
        }
        $this->db->where($where);
        $this->db->limit($limit, $page);
        $this->db->order_by($order, $order_method);
        $result = $this->db->get();
        return $result;
    }

    public function get_single($user_type_id)
    {
        $this->db->where("user_type_id", $user_type_id);
        return $this->db->get("user_type");
    }

    public function get_count($table, $where, $limit = null)
    {
        if($limit != null) 
        {
            $this->db->limit($limit);
        }
        $this->db->from($table);
        $this->db->where($where);
        return $this->db->count_all_results();
    }

    public function get_results()
    {
        $this->db->select('*');
        $this->db->where("deleted", 0);
        $this->db->from('user_type');
        $query = $this->db->get();
        return $query;
    }

    public function edit_update_user_type($user_type_id)
    {
        $this->db->where("user_type_id", $user_type_id);
        $this->db->get("user_type");       
        $data = array(
            "user_type_name" => $this->input->post("user_type_name"),
            "deleted" => 0,
            "modified_on" => date("Y-m-d H:i:s"),
        );
        if("user_type.user_type_id>0") 
        {
            $this->db->where("user_type_id", $user_type_id);
            $this->db->update("user_type", $data);
            return true;
        } 
        else 
        {
            return false;
        }
    }

    public function delete($user_type_id)
    {
        // Delete user types data
        $this->db->set("deleted", 1, "modified_on", date("Y-m-d H:i:s"), "deleted_on", date("Y-m-d H:i:s"));
        $this->db->where("user_type_id", $user_type_id, "deleted", 0);
        $this->db->update("user_type");
        $this->session->set_flashdata("success", "Deleted successfully ");
        return $this->db->get("user_type");
    }

    public function deactivate_user_type($user_type_id)
    {
        // deactivate member data
        $this->db->where("user_type_id", $user_type_id);
        $this->db->set("user_type_status", 0);

        if($this->db->update("user_type")) 
        {
            $this->session->set_flashdata("success", "user type deactivated successfully ");
            return $this->db->get("user_type");
        } 
        else 
        {
            $this->session->set_flashdata("error", "Unable to deactivate user type");
            return false;
        }
    }

    //activate
    public function activate_user_type($user_type_id)
    {
        //activate member data
        $this->db->where("user_type_id", $user_type_id);
        $this->db->set("user_type_status", 1);

        if($this->db->update("user_type")) 
        {
            $this->session->set_flashdata("success", "user type activated successfully");
            return $this->db->get("user_type");
        } 
        else 
        {
            $this->session->set_flashdata("error", "unable to activate user type");
            return false;
        }
    }
}
