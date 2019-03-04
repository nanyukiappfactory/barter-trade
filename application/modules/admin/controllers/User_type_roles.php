<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User_type_roles extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("User_type_roles_model");
        $this->load->model("site/site_model");
    }

    public function index()
    {
        $this->form_validation->set_rules("role_name", "Select role", "required");
        $this->form_validation->set_rules("user_type_name", "Select user type", "required");

        if ($this->form_validation->run()) {
            $assigned_role_user = $this->User_type_roles_model->save_user_type_role();

            if ($assigned_role_user == false) {
                $this->session->set_flashdata("error. ", "Error when assigning a role");
            } else {
                $this->session->set_flashdata("success. ", "You have assigned a role");
            }
            redirect("admin/user_type_roles");
        }

        //fetch data from Users_model
        $data = array('roles' => $this->User_type_roles_model->get_roles(),
            'user_types' => $this->User_type_roles_model->get_user_types(),
            "validation_errors" => validation_errors(),
        );

        //pass data to view
        $v_data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("user_type_roles/assign_roles", $data, true),
        );

        $this->load->view('site/layouts/layout', $v_data);
    }
}
