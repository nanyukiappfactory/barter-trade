<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class Users_model extends CI_Model
{
    public $table = "user";
    public function add_user($upload_response)
    {
        if(!$this->input->post("profile_icon"))
        {
            $file_name = "no_image.PNG";
            $thumb_name = "6cb8392a0f015455b60834952307d7fe.PNG";
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
                "user_type"=>$this->input->post("user_type"),
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
        else
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
                "user_type"=>$this->input->post("user_type"),
            );        
        if( $this->db->insert("user", $data)){
           return true;
        }
        else{
           return false;
        }
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
        return $this->db->count_all_results();
    }  
    
    public function get_user_type()
    {
        $trader="Trader";
        $this->db->where('user_type_name',$trader);
        $query = $this->db->get('user_type');
        if ($query->num_rows() < 1)
        {
            throw new exception("You do not have a user type");
        }
        elseif($query->num_rows() > 0)
        {
        try
        {
            return ($query);
        }
        
        catch(Exception $e) 
        {
            echo 'Please add a user type first';
          }
        }
    } 

    public function delete($user_id){
        $deleted = array(
                "deleted" => 1,
                "modified_on" => date("Y-m-d H:i:s"),
                "deleted_on" => date("Y-m-d H:i:s")
        );
        $this->db->set($deleted);
        $this->db->where("user_id",$user_id);        
        if($this->db->update("user"))
        {
            $this->session->set_flashdata("success","Deleted successfully ");
            return TRUE;
        }
        else
        {
            $this->session->set_flashdata("error","Unable to delete");
            return FALSE;
        }
    }

    public function deactivate_user($user_id)
    {
        $this->db->set("user_status",0);
        $this->db->where("user_id",$user_id);
        if($this->db->update("user"))
        {
            $this->session->set_flashdata("success","Successfully deactivated");//implode($username));
            return $remain;
       }
       else 
       {
        $this->session->set_flashdata("error","Unable to deactivate "); //echo implode($username);
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
            "user_type"=>$this->input->post("user_type"),
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
