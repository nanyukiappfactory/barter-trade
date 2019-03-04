<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Roles extends MX_Controller
{
    public $upload_path;
    public $upload_location;
    public $per_page = 1000;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Roles_model");
        $this->load->model("site/site_model");
        $this->upload_path = realpath(APPPATH . "../assets/uploads");
        $this->upload_location = base_url() . "assets/uploads";
        $this->load->library("image_lib");
        $this->load->model("file_model");
    }

    public function index()
    {
        $v_data = array(
            "all_roles" => $this->Roles_model->get_role(),
        );

        $data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/Roles/all_roles", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);
    }

    public function add_role()
    {
        //form validation
        $this->form_validation->set_rules("role_parent", 'role Parent', "required");
        $this->form_validation->set_rules("role_name", 'role Name', "required");

        if ($this->form_validation->run()) {
            echo "hello";
            $resize = array(
                "width" => 2000,
                "height" => 2000,
            );

            $upload_response = $this->file_model->upload_image($this->upload_path, "role_image", $resize);

            if ($upload_response['check'] == false) {
                $this->session->set_flashdata('error', $upload_response['message']);
            } else {
                if ($this->Roles_model->save_role($upload_response)) {
                    $this->session->set_flashdata('success', 'role Added successfully!!');
                    redirect("admin/Roles");
                } else {
                    $this->session->set_flashdata('error', 'unable to add role. Try again!!');
                }
            }
        } else {
            if (!empty(validation_errors())) {
                $this->session->set_flashdata('error', validation_errors());
            }
        }

        $v_data = array("validation_errors" => validation_errors(),
            "role" => $this->Roles_model->get_role(),
        );

        $data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/Roles/add_role", $v_data, true),
        );

        $this->load->view("site/layouts/layout", $data);
    }

    public function execute_search()
    {
        // Retrieve the posted search term.
        $search_term = $this->input->post('search');
        $v_data = array("results" => $this->Roles_model->get_role($search_term));

        $data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/execute_search", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);
    }

    public function delete($role_id)
    {
        $this->Roles_model->delete($role_id);

        redirect("admin/Roles");
    }
    
    //deactivate
    public function deactivate($id)
    {
        $load_deactivate = $this->Roles_model->deactivate_role($id);
        $v_data = array(
            "all_roles" => $load_deactivate,

        );

        $data = array(

            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/Roles/all_roles", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);
        redirect("admin/Roles");
    }
    //activate
    public function activate($id)
    {
        $load_activate = $this->Roles_model->activate_role($id);
        $v_data = array(
            "all_roles" => $load_activate,
        );

        $data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/Roles/all_roles", $v_data, true),
        );

        $this->load->view("site/layouts/layout", $data);
        redirect("admin/Roles");
    }

    //edit update
    public function edit_update($id)
    {
        $this->form_validation->set_rules("role_parent", 'role Parent', "required");
        $this->form_validation->set_rules("role_name", 'role Name', "required");

        if ($this->form_validation->run()) {
            $resize = array(
                "width" => 2000,
                "height" => 2000,
            )
            ;
            $upload_response = $this->file_model->upload_image($this->upload_path, "role_image", $resize);

            if ($upload_response['check'] == false) {
                $this->session->set_flashdata('error', $upload_response['message']);
            } else {
                if ($this->Roles_model->edit_update_role($id, $upload_response)) {
                    $this->session->set_flashdata('success', 'role ,Added successfully!!');
                    redirect("admin/Roles/");
                } else {
                    $this->session->set_flashdata('error', 'unable to add role. Try again!!');
                }
            }
        } else {
            if (!empty(validation_errors())) {
                $this->session->set_flashdata('error', validation_errors());
            }
        }

        $role = $this->Roles_model->get_single($id);

        if ($role->num_rows() > 0) {
            $row = $role->row();
            $parent = $row->parent;
            $role_name = $row->role_name;
        }

        $v_data = array(

            "role" => $this->Roles_model->get_role(),

        );

        $data = array(

            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/Roles/add_role", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);
    }
}
