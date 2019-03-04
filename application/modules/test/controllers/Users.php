<?php 
 
if (!defined('BASEPATH')) 
    exit('No direct script access allowed'); 
 
class Users extends CI_Controller { 
    function __construct() { 
        parent::__construct(); 
        //load model 
        $this->load-> model('Users_model'); 
    } 
    public function index() { 
        //fetch data from Users_model 
        $data['users'] = $this->Users_model->get_users(); 
        //pass data to view 
        $this->load->view('users_view', $data); 
    } 

}
?>