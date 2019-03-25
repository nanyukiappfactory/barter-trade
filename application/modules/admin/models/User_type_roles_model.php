<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); } 
require_once "./application/modules/admin/controllers/Admin.php";

class User_type_roles_model extends Admin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function save_user_type_role()
    { 
        $role_id = $this->input->post("role_name");
        $user_type_id = $this->input->post("user_type_name");
        $data = array(
            "role_id" => $role_id,
            "user_type_id" =>  $user_type_id
        );
        $this->db->select("*");
        $this->db->from("user_type_role");
        $this->db
            ->where("user_type_role.role_id",$role_id)
            ->where("user_type_role.user_type_id",$user_type_id)
            ->where("user_type_role.deleted",0);
        $result = $this->db->get();
        if ($result->num_rows()>0)
        {
            $this->session->set_flashdata("error", "You had already assigned this role");
            return false;
        }
        else
        {
            $this->db->insert("user_type_role", $data);            
            return true; 
        }
    }
    
    public function get_single($user_type_role_id)
    {
        $this->db->where("user_type_role_id", $user_type_role_id);
        return $this->db->get("user_type_role");
    }
    
    public function get_results()
    {
        $this->db->where("user_type_role.deleted",0);
        return $this->db->get("user_type_role");
    }

    public function get_user_type_role($table=null, $where,$limit,$page,$order,$order_method)
    {
        $this->db->select('role.role_name, role.role_status, role.deleted, user_type.deleted, user_type.user_type_status, user_type.user_type_name,role.role_id,user_type.user_type_id, user_type_role.*');
        $this->db->from("role");
        $this->db->join("user_type_role","role.role_id=user_type_role.role_id");
        $this->db->join("user_type", "user_type_role.user_type_id=user_type.user_type_id");
        $this->db
                ->where($where)
                ->where("user_type.user_type_status",1)
                ->where("role.role_status",1)
                ->where("role.deleted",0)
                ->where("user_type.deleted",0);
        $this->db->limit($limit, $page);
        $this->db->order_by($order, $order_method);
        return $this->db->get();
    }

    public function delete($id)
    {
        $this->db->set("deleted", 1, "modified_on", date("Y-m-d H:i:s"), "deleted_on", date("Y-m-d H:i:s"));
        $this->db->where("user_type_role_id", $id);
        if ($this->db->update("user_type_role")) 
        {
            $this->session->set_flashdata("success", "You have deleted" . $id);
            return true;
        }
        else 
        {
            $this->session->set_flashdata("error", "Unable to delete" . $id);
            return false;
        }
    }

    public function deactivate_user_type_role($id)
    {
        $this->db->where("user_type_role_id", $id);
        $this->db->set("user_type_role_status", 0);
        if ($this->db->update("user_type_role"))
        {
            $this->session->set_flashdata("success", "You have deactivated" . $id);
            return $this->get_results();
        } 
        else
        {
            $this->session->set_flashdata("error", "Unable to deactivate" . $id);
            return false;
        }
    }

    public function activate_user_type_role($id)
    {
        $this->db->where("user_type_role_id", $id);
        $this->db->set("user_type_role_status", 1);
        if ($this->db->update("user_type_role")) 
        { 
            $this->session->set_flashdata("success", "You have activated" . $id);
            return $this->get_results();
        } 
        else
        {
            $this->session->set_flashdata("error", "Unable to activate" . $id);
            return false;
        }
    }

    public function edit_update_user_type_role($id)
    {
        $role_id = $this->input->post("role_name");
        $user_type_id = $this->input->post("user_type_name");
        $this->db->select("*");
        $this->db->from("user_type_role");
        $this->db
            ->where("user_type_role.role_id",$role_id)
            ->where("user_type_role.user_type_id",$user_type_id)
            ->where("user_type_role.user_type_role_id !=", $id)
            ->where("user_type_role.deleted",0);
        if($this->db->get()->num_rows()<=0)
        {
            $this->db->where("user_type_role_id", $id);
            $this->db->get("user_type_role");
            $data = array(
                "role_id" => $role_id,
                "user_type_id" => $user_type_id,
                "deleted" => 0,
                "modified_on" => date("Y-m-d H:i:s"),
            );
            if("user_type_role_id.user_type_role_id > 0")
            {
                $this->db->where("user_type_role_id", $id);
                $this->db->update("user_type_role", $data);
                return true;
            }
            else
            {
                $this->session->set_flashdata("error", "Could not assign this role.");
                return false;
            }
        } 
        else 
        {
            $this->session->set_flashdata("error", "You had already assigned this role");
            return false;             
        }
    }
}
