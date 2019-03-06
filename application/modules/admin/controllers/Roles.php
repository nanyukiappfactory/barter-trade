<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once "./application/modules/admin/controllers/Admin.php";

class Roles extends admin
{
    public $upload_path;
    public $upload_location;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Roles_model");
        $this->load->model("site/site_model");
        $this->upload_path = realpath(APPPATH . "../assets/uploads");
        $this->upload_location = base_url() . "assets/uploads";
        $this->load->library("image_lib");
        $this->load->model("file_model");
        $this->load->library("pagination");
    }

    public function index($order="role.role_name",$order_method="ASC")
    {
        $segment = 5;
        $table = 'role';
        $where = 'deleted = 0';
        //$where="user.user_id > 0 AND user.deleted=0";  
        // var_dump($search_user);die();
        
        $search_role=$this->session->userdata("search_user");
        if (!empty($search_role) && $search_role != null) {
            $where .= $search_role;
            }
        $config['base_url'] = site_url() . 'roles/all-roles/' . $order . '/' . $order_method;
        $config['total_rows'] = $this->site_model->get_count($table, $where);
        $config['uri_segment'] = $segment;
        $config["per_page"] = 2;
        $config['num_links'] = 5;
        $config['full_tag_open'] = '<div class="pagging text-center"><nav aria-label="Page navigation example"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close'] = '</span></li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close'] = '</span></li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $query = $this->Roles_model->get_role($table, $where, $config["per_page"], $page, $order, $order_method);      
       
        if ($order_method == 'DESC') {
            $order_method = 'ASC';
        } else {
            $order_method = 'DESC';
        }
      
       $v_data = array(
        "all_roles"=>$query,
        "order" => $order,
        "order_method" => $order_method,
        "page" => $page,
        "links" => $this->pagination->create_links(),
        //"search_role"=>$all_roles,
        "results"=>$this->Roles_model->get_results($search_role)
    );
        $data = array
       (
            "title" => "roles",
            "content" => $this->load->view("admin/roles/all_roles", $v_data, true),
        );
        //
        // $v_data = array(
        //     "all_roles" => $this->Roles_model->get_role(),
        // );

        // $data = array(
        //     "title" => $this->site_model->display_page_title(),
        //     "content" => $this->load->view("admin/Roles/all_roles", $v_data, true),
        // );
        $this->load->view("site/layouts/layout", $data);
    }

    public function add_role()
    {
        //form validation
        $this->form_validation->set_rules("role_parent", 'role Parent', "required");
        $this->form_validation->set_rules("role_name", 'role Name', "required");

        if ($this->form_validation->run()) 
        {
            
            $this->Roles_model->save_role();           
            $this->session->set_flashdata('success', 'role Added successfully!!');
            redirect("roles/all-roles");
        } 
        else
        {
            if (!empty(validation_errors())) 
            {
            $this->session->set_flashdata('error', 'unable to add role. Try again!!');
            $this->session->set_flashdata('error', validation_errors());        
            }
        }

        $v_data = array("validation_errors" => validation_errors(),
            "role" => $this->Roles_model->get_results(),
        );

        $data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/Roles/add_role", $v_data, true),
        );

        $this->load->view("site/layouts/layout", $data);
    }

    // public function execute_search()
    // {
    //     // Retrieve the posted search term.
    //     $search_term = $this->input->post('search');
    //     $v_data = array("results" => $this->Roles_model->get_role($search_term));

    //     $data = array(
    //         "title" => $this->site_model->display_page_title(),
    //         "content" => $this->load->view("admin/roles/execute_search", $v_data, true),
    //     );
    //     $this->load->view("site/layouts/layout", $data);
    // }

    public function delete_role($role_id)
    {
        $this->Roles_model->delete($role_id);

        redirect("roles/all-roles");
    }
    
    //deactivate
    public function deactivate_role($id)
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
        redirect("roles/all-roles");
    }
    //activate
    public function activate_role($id)
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
    public function edit_role($id)
    {
        $this->form_validation->set_rules("role_parent", 'role Parent', "required");
        $this->form_validation->set_rules("role_name", 'role Name', "required");

        if ($this->form_validation->run())
         {
            $this->Roles_model->edit_update_role($id);
            
            if (!empty(validation_errors()))
            {
            $this->session->set_flashdata('success', 'role ,Added successfully!!');
                redirect("roles/all-roles/");
            } else
            {
                $this->session->set_flashdata('error', 'unable to add role. Try again!!');
            }            
        }
        $v_data = array(
            "role" => $this->Roles_model->get_results(),
        );

        $data = array(

            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/Roles/add_role", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);
    }
}
