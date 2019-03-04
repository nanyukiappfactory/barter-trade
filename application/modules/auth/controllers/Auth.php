<?php
if (!defined('BASEPATH')) {
    exit("No direct script allowed");
}
require_once "./application/modules/admin/controllers/Users.php";

class Auth extends MX_Controller
{
    public function __Construct()
    {
        parent::__Construct();
        $this->load->model("auth/auth_model");
        $this->load->model("site/site_model");
    }
    public function index()
    {
        $this->load->view("auth/index");
    }
    public function login_admin()
    {
        //1. Validation rules
        $this->form_validation->set_rules("user", "Username", "required");
        $this->form_validation->set_rules("password", "Password", "required");
        //2. Check if validation rules pass
        if($this->form_validation->run()) {
            if($this->auth_model->validate_user()) {
                $this->session->set_userdata('login_status', true);
                redirect("users/all-users");
            }
        }
        //3. Condition if validation rules fail
        else {
            $validation_errors = validation_errors(); //echo $validation_errors; die();
            if (!empty($validation_errors)) {
                $this->session->set_flashdata("error", $validation_errors);
            }
            //4. Load login view
        }
        $data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("auth/login_admin", null, true),
            "login" => true,
        );
        $this->load->view("site/layouts/login", $data);
    }

    public function admin_logout()
    {

        $this->session->sess_destroy();
        redirect('admin/login');
    }
}
