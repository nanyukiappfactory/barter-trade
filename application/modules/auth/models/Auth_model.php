<?php
if (!defined('BASEPATH')) {
    exit("No direct script allowed");
}

class Auth_model extends CI_Model
{
    public function validate_user()
    {
        $admin=$this->input->post("user");
        $password=$this->input->post("password");

        if($admin="admin" && $password=123456)
        {
            $where=array(
                "login_status"=>true,

            );
             
           $this->session->set_userdata("user_data",$where);
           return true;
        }
        else{

        //Validating for existing users
        $where = array(
            "user_email" => $this->input->post("user"),
            "password" => md5($this->input->post("password")),
        );

        $this->db->where($where);
       
        $query = $this->db->get("user");
        if ($query->num_rows() == 1) {
            $row = $query->row();
            $user = array(
                "first_name" => $row->first_name,
                "last_name" => $row->last_name,
                "phone_number" => $row->phone_number,
                "email" => $row->user_email,
                "id" => $row->user_id,
                "login_status" => true,
            );
            $this->session->set_userdata('user_data', $user);

            $this->session->set_flashdata("success", "welcome back " . $row->first_name);
            return true;
        } 
        else {
            $this->session->set_flashdata("error", "email or password is incorrect");
            return false;
        }
    }
    }
    
    public function validate_session()
    {
        $login_status = $this->session->userdata("login_status");

        if($login_status == TRUE)
        {
            return TRUE;
        }

        else
        {
            return FALSE;
        }
    }
}
