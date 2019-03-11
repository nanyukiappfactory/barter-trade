<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_types_model extends CI_Model
{
    public $table = "user_type";
    
    public function add_user_type()
    {
        $data = array(
            "user_type_name" => $this->input->post("user_type_name"),
            "deleted"=>0,
            "user_type_status"=>1,
        );
        
        if( $this->db->insert("user_type", $data)){
           return true;
        }
        else{
           return false;
        }
    }

    public function get_user_type($table, $where,$limit,$page,  $order, $order_method)
    {
        $search_user_type = $this->session->userdata('search_user_type');
        
        $this->db->select("*");
        $this->db->from($table);    
        $this->db->where($where);
        $this->db->like("user_type_name", $search_user_type);
        $this->db->limit($limit, $page);
        $this->db->order_by($order, $order_method);
        
        $result= $this->db->get();
        
        return $result;
    }

    public function get_single($user_type_id)
    {
        $this->db->where("user_type_id", $user_type_id);
        return $this->db->get("user_type");
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
        $search_user_type = $this->input->post('search');

        $this->db->select('*');
        $this->db->where("deleted",0);
        $this->db->from('user_type');
        $this->db->like('user_type_name', $search_user_type);
        
        // Execute the query.
        $query = $this->db->get();
        return $query;
    }

    public function delete($id){
        // Delete user types data
        $this->db->set("deleted",1 ,"modified_on",date("Y-m-d H:i:s"), "deleted_on", date("Y-m-d H:i:s"));
        $this->db->where("user_type_id",$id,"deleted",0);       
        $this->db->update("user_type");
        
        $this->session->set_flashdata("success","Deleted successfully ");
        
        return $this->db->get("user_type");
    }

    public function deactivate_user_type($id)
    {        
        // deactivate member data      
        $this->db->where("user_type_id",$id); 
        $this->db->set("user_type_status", 0);       
        
        if($this->db->update("user_type"))
        {
            $this->session->set_flashdata("success","activated successfully ");
            return $this->db->get("user_type");
        }
        else
        {
            $this->session->set_flashdata("error","Unable to activate");
            return FALSE;
        }
    }    

    //activate
    public function activate_user_type($id)
    {  
        //activate member data       
        $this->db->where("user_type_id",$id); 
        $this->db->set("user_type_status", 1);       

        if($this->db->update("user_type"))
        {
            $this->session->set_flashdata("success","activated successfully ");
            return $this->db->get("user_type");
        }
        else
        {
            $this->session->set_flashdata("error","Unable to activate");
            return FALSE;
        }
    }

    public function edit_update_user_type($id)
    {       
        $this->db->where("user_type_id",$id);
        $this->db->get("user_type");

        //Capture data to be updated
        $data = array(
            "user_type_name" => $this->input->post("user_type_name"),
            "deleted"=>0,
            "modified_on"=>date("Y-m-d H:i:s")
        );  
        
        if("user_type.user_type_id>0"){
            $this->db->where("user_type_id",$id);
            $this->db->update("user_type", $data);

            return true;
        }
         else{
            return false;
         }
    }

}
