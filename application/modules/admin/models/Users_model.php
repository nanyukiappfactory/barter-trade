<?php
if (!defined('BASEPATH')) 
exit('No direct script access allowed'); 
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
        );

        
        if( $this->db->insert("user", $data)){
           return true;
        }
        else{
           return false;
        }
    }
    public function get_user($table, $where,$limit,$page,  $order, $order_method)
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
    public function get_results()
    {
        $search_term = $this->input->post('search');
       // $this->session->set_userdata("search_user", $search_term);
        $this->db->select('*');
        $this->db->where("deleted",0);
        $this->db->from('user');
        $this->db->like('first_name', $search_term);
        $this->db->or_like('user_email',$search_term);
        $this->db->or_like('username',$search_term);
        $this->db->or_like('phone_number',$search_term);
        $this->db->or_like('last_name',$search_term);
// Execute the query.
        $query = $this->db->get();
        


// Return the results.
        return $query->result_array();
        
    }
    public function delete($id){
        // Delete member data
        $this->db->set("deleted", 1,"modified_on",date("Y-m-d H:i:s"),"deleted_on",date("Y-m-d H:i:s"));
        $this->db->where("user_id",$id);        
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
    public function deactivate_user($id)
    {
        
        $this->db->select('username');
        $this->db->from('user');
        $this->db->where("user_id",$id);
        $result = $this->db->get();
        $username=$result->result_array();
    //    var_dump($username);die();
       
       $this->db->set("user_status",0);
       if($this->db->update("user"))
       {       
            $remain=$this->get_single($id);
           $this->session->set_flashdata("success","Successfully deactivated");//implode($username));
            return $remain;
       }
       else 
       {
        $this->session->set_flashdata("error","Unable to deactivate "); //echo implode($username);
        return FALSE;
       }
    }    
    //activate
    public function activate_user($id)
    {
        $this->db->select('username');
        $this->db->from('user');
        $this->db->where("user_id",$id);
        $result = $this->db->get();
        $username=$result->result_array();
        $this->db->set("user_status",1);
       if($this->db->update("user"))
       {
            $remain=$this->get_single($id);
            $this->session->set_flashdata("success","Activated successfully "); //echo implode($username);
            return $remain;
       }
       else 
       {
        $this->session->set_flashdata("error","Unable to activate "); //echo implode($username);
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
