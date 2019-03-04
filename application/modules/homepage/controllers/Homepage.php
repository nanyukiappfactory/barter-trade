<?php
if (!defined('BASEPATH')) 
exit('No direct script access allowed'); 
class Homepage extends MX_Controller
{
     function __construct(){
        parent:: __construct();
        //$this->load->model("Manage_user_type_role_model");
        $this->load->model("site/site_model");      
      
             
     }

    public function index()
    {
        $this->load->view("landingpage");
    }
}
        
?>