<?php 

class Users_model extends CI_Model{ 
    function __construct() { 
        parent::__construct(); 
    } 
    //get users from the db 
    public function get_users() { 
        $result = $this->db->select('user_id, first_name')->get('user')->result_array(); 
 
        $users = array(); 
        foreach($result as $r) { 
            $users[$r['user_id']] = $r['first_name']; 
        } 
        $users[''] = 'Select User...'; 
        return $users; 
    } 
}