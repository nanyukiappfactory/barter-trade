<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class Users_model extends CI_Model
{
    public $table = "user";
    public function add_user($upload_response)
    {
        $file_name = $upload_response['file_name'];
        $thumb_name = $upload_response['thumb_name'];
        $data = array(
            "first_name" => $this->input->post("first_name"),
            "last_name" => $this->input->post("last_name"),
            "phone_number" => $this->input->post("phone_number"),
            "username" => $this->input->post("username"),
            "user_email" => $this->input->post("user_email"),
            "password" => md5($this->input->post("password")),
            "profile_icon"=> $file_name,
            "profile_thumb"=> $thumb_name,
            "deleted"=>0,
            "user_status"=>1,
            "user_type_id"=>$this->input->post("user_type"),
        ); 
        if( $this->db->insert("user", $data))
        {
           return true;
        }
        else
        {
           return false;
        }
    }

    public function get_user($table, $where,$limit,$page,  $order, $order_method)
    {
        $this->db->select("*");
        $this->db->from($table);    
        $this->db->where($where);;
        $this->db->limit($limit, $page);
        $this->db->order_by($order, $order_method);
        $result= $this->db->get();
        return $result;
    }

    public function get_single($user_id)
    {
        $this->db->where("user_id", $user_id);
        return $this->db->get("user");
    }

    public function get_count($table, $where, $limit = NULL)
    {
        if($limit != NULL)
        {
            $this->db->limit($limit);
        }
        $this->db->from($table);
        $this->db->where($where);
        var_dump( $where);die();
        return $this->db->count_all_results();
    } 
    public function delete($user_id){
        $deleted = array(
                "deleted" => 1,
                "username"=>"deleted",
                "user_email"=>"deleted",
                "modified_on" => date("Y-m-d H:i:s"),
                "deleted_on" => date("Y-m-d H:i:s")
        );
        $this->db->set($deleted);
        $this->db->where("user_id",$user_id);        
        if($this->db->update("user"))
        {
            $this->session->set_flashdata("success","User deleted successfully ");
            return TRUE;
        }
        else
        {
            $this->session->set_flashdata("error","Unable to delete user");
            return FALSE;
        }
    }

    public function deactivate_user($user_id)
    {
        $this->db->set("user_status",0);
        $this->db->where("user_id",$user_id);
        if($this->db->update("user"))
        {
            $this->session->set_flashdata("success","Successfully deactivated a user");//implode($username));
            return $remain;
       }
       else 
       {
        $this->session->set_flashdata("error","Unable to deactivate a user"); //echo implode($username);
        return FALSE;
       }
    }  

    public function activate_user($user_id)
    {
        $this->db->set("user_status",1);
        $this->db->where("user_id",$user_id);
        if($this->db->update("user"))
        {
            $this->session->set_flashdata("success","User activated successfully");
            return TRUE;
        }
        else 
        {
            $this->session->set_flashdata("error","Unable to activate the user");
            return FALSE;
        }
    }

    public function edit_update_user($user_id,$upload_response)
    {
        $file_name = $upload_response['file_name'];
        $thumb_name = $upload_response['thumb_name'];
        $this->db->where("user_id",$user_id);
        $this->db->get("user");
        $data = array(
            "first_name" => $this->input->post("first_name"),
            "last_name" => $this->input->post("last_name"),
            "phone_number" => $this->input->post("phone_number"),
            "username" => $this->input->post("username"),
            "user_email" => $this->input->post("user_email"),
            "profile_icon"=> $file_name,
            "profile_thumb"=> $thumb_name,
            "deleted"=>0,
            "modified_on"=>date("Y-m-d H:i:s"),
            "user_type_id"=>$this->input->post("user_type"),
        );  
        
        if("user.user_id>0")
        {
        $this->db->where("user_id",$user_id);
        $this->db->update("user", $data);
            return true;
        }
        else
        {
            return false;
        }
    }

}
