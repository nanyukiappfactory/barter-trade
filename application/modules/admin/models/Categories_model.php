<?php if (!defined('BASEPATH')) { exit('No direct script access allowed');}
class Categories_model extends CI_Model
{
    
    public $table="category";
    public function __construct()
    {
        parent::__construct();
    }
    public function save_category($upload_response)
    {
        $file_name = $upload_response['file_name'];
        $thumb_name = $upload_response['thumb_name'];
        $data = array(
            "category_parent" => $this->input->post("category_parent"),
            "category_name" => $this->input->post("category_name"),
            "category_image" => $file_name,
            "profile_thumb" => $thumb_name,
            "deleted" => 0,

        );

        if ($this->db->insert("category", $data)) 
        {
            return true;
        } else 
        {
            return false;
        }
    }
    public function get_category($table, $where,$limit,$page,$order,$order_method)
    {
        $this->db->select("*");
        $this->db->from($table);    
        $this->db->where($where);
        $this->db->limit($limit, $page);
        $this->db->order_by($order, $order_method);
        $result= $this->db->get();
        return $result;
    }
    public function get_results()
    {
        $this->db->where("category.deleted=0");
        $query = $this->db->get("category");
        return $query;
    }
    
    public function get_single($category_id)
    {
        $this->db->where("category_id", $category_id);
        return $this->db->get("category");
    }

    public function delete($id)
    {
        $this->db->set("deleted", 1, "modified_on", date("Y-m-d H:i:s"), "deleted_on", date("Y-m-d H:i:s"));
        $this->db->where("category_id", $id);
        if ($this->db->update("category"))
        {
            $this->session->set_flashdata("success", "You have deleted" . $id);
            return true;
        } else 
        {
            $this->session->set_flashdata("error", "Unable to delete" . $id);
            return false;
        }
    }

    public function deactivate_category($id)
    {
        $this->db->where("category_id", $id);
        $this->db->set("category_status", 0);
        if ($this->db->update("category")) {
            $remain = $this->get_results();
            $this->session->set_flashdata("success", "You have deactivated" . $id);
            return $remain;
        } else {
            $this->session->set_flashdata("error", "Unable to deactivate" . $id);
            return false;
        }
    }

    //activate
    public function activate_category($id)
    {
        $this->db->where("category_id", $id);
        $this->db->set("category_status", 1);
        if ($this->db->update("category")) {
            $remain = $this->get_results();
            $this->session->set_flashdata("success", "You have activated" . $id);
            return $remain;
        } else {
            $this->session->set_flashdata("error", "Unable to activate" . $id);
            return false;
        }
    }

    public function edit_update_category($id, $upload_response)
    {
        $file_name = $upload_response['file_name'];
        $thumb_name = $upload_response['thumb_name'];
        $this->db->where("category_id", $id);
        $this->db->get("category");
        //Capture data to be updated
        $data = array(
            "category_parent" => $this->input->post("category_parent"),
            "category_name" => $this->input->post("category_name"),
            "category_image" => $file_name,
            "profile_thumb" => $thumb_name,
            "deleted" => 0,
            "modified_on" => date("Y-m-d H:i:s"),
        );

        if ("category.category_id>0"){
            $this->db->where("category_id", $id);
            $this->db->update("category", $data);
            return true;
        } else {
            return false;
        }
    }
}
