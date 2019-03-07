<?php
if (!defined('BASEPATH')) 
{
    exit('No direct script access allowed');
}
class Admin extends MX_Controller
{    
         public function __construct()
         {
            parent::__construct();
            $this->load->model("auth/auth_model");
            $this->load->library('session');
            if(!$this->auth_model->validate_session())
            {
               redirect('admin/login');
            }
        }
        public function index()
        {
            redirect('users/all-users');
        }        
}