<?php
if (!defined('BASEPATH')) 
exit('No direct script access allowed'); 
class Manage_users_model extends CI_Model
{
    protected $table = "user";
    //public function add_user($user_image)
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
            "deleted"=>0
        );

        
        if( $this->db->insert("user", $data)){
           return true;
        }
        else{
           return false;
        }
    }
   
    public function get_user($limit, $start)
    {
        $this->db->where("deleted",0);
        $this->db->order_by("created_on", "DESC");
        $this->db->limit($limit, $start);
        return $this->db->get('user');
    }
    public function get_all_users()
    {
        $this->db->where("deleted",0);
        $this->db->order_by("created_on", "DESC");

        return $this->db->get('user');
    }
    public function get_single($user_id)
    {
        $this->db->where("user_id", $user_id);
        return $this->db->get("user");
    }
    public function get_results($search_term = 'default')
    {
// Use the Active Record class for safer queries.
        $this->db->select('*');
        $this->db->where("deleted",0);
        $this->db->from('user');
        $this->db->like('first_name', $search_term);

// Execute the query.
        $query = $this->db->get();

// Return the results.
        return $query->result_array();
    }
//pagination
    public function get_count()
    {
        return $this->db->count_all($this->table);
    }
    //delete
    public function delete($id){
        // Delete member data
        $this->db->set("deleted", 1,"modified_on",date("Y-m-d H:i:s"),"deleted_on",date("Y-m-d H:i:s"));
        $this->db->where("user_id",$id);
       
        if($this->db->update("user"))
        {
            $this->session->set_flashdata("success","You have deleted".$id);
            return TRUE;
        }
        else
        {
            $this->session->set_flashdata("error","Unable to delete".$id);
            return FALSE;
        }
        
    }
    public function deactivate_user($id, $limit,$start)
    {
        
        $this->db->where("user_id",$id);
       $this->db->set("user_status",0);
       if($this->db->update("user"))
       {
            $remain=$this->get_user($limit, $start);
            $this->session->set_flashdata("success","You have deactivated".$id);
            return $remain;
       }
       else 
       {
        $this->session->set_flashdata("error","Unable to deactivate".$id);
        return FALSE;
       }
    }
    //activate
    public function activate_user($id, $limit,$start)
    {
        
        $this->db->where("user_id",$id);
       $this->db->set("user_status",1);
       if($this->db->update("user"))
       {
            $remain=$this->get_user($limit, $start);
            $this->session->set_flashdata("success","You have activated".$id);
            return $remain;
       }
       else 
       {
        $this->session->set_flashdata("error","Unable to activate".$id);
        return FALSE;
       }
    }
    public function edit_update_user($id,$upload_response)
    {
        $file_name = $upload_response['file_name'];
        $thumb_name = $upload_response['thumb_name'];
        $this->db->where("user_id",$id);
        $this->db->get("user");
        //Capture data to be updated
        $data = array(
            "first_name" => $this->input->post("first_name"),
            "last_name" => $this->input->post("last_name"),
            "phone_number" => $this->input->post("phone_number"),
            "username" => $this->input->post("username"),
            "user_email" => $this->input->post("user_email"),
            "profile_icon"=> $file_name,
            "profile_thumb"=> $thumb_name,
            "deleted"=>0,
            "modified_on"=>date("Y-m-d H:i:s")
        );
         
        if( $this->db->update("user", $data)){
            return true;
         }
         else{
            return false;
         }
    }

}
