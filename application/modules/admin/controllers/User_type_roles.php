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
        $this->load->library("pagination");
    }
    public function index($order="user_type_role.user_type_id",$order_method="ASC")
    {
        $segment = 5;
        $table = 'user_type_role';
        $where = 'deleted = 0';      
        $search_user_type_role=$this->session->userdata("search_user");
        if (!empty($search_user_type_role) && $search_user_type_role != null) 
        {
            $where .= $search_user_type_role;
        }
        $config['base_url'] = site_url() . 'user_type_roles/all-user_type_roles/' . $order . '/' . $order_method;
        $config['total_rows'] = $this->site_model->get_count($table, $where);
        $config['uri_segment'] = $segment;
        $config["per_page"] = 5;
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
        $query = $this->User_type_roles_model->get_user_type_role($table, $where, $config["per_page"], $page, $order, $order_method);      
        if ($order_method == 'DESC')
        {
            $order_method = 'ASC';
        } else {
            $order_method = 'DESC';
        }
      
       $v_data = array(
        "all_user_type_roles"=>$query,
        "order" => $order,
        "order_method" => $order_method,
        "page" => $page,
        "links" => $this->pagination->create_links(),
        //"search_user_type_role"=>$all_user_type_roles,
        "user_type_role" => $this->User_type_roles_model->get_results(),
        );
        $data = array(
            "title" => "user_type_roles",
            "content" => $this->load->view("admin/user_type_roles/all_user_type_roles", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);
    }

    public function add_user_type_role()
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
            redirect("user-type-roles/all-user-type-roles");
        }

        //fetch data from Users_model
        $data = array(
            'roles' => $this->User_type_roles_model->get_roles(),
            'user_types' => $this->User_type_roles_model->get_user_types(),
            "validation_errors" => validation_errors(),
        );

        //pass data to view
        $v_data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/user_type_roles/assign_roles", $data, true),
        );

        $this->load->view('site/layouts/layout', $v_data);
    }
    public function delete_user_type_role($user_type_role_id)
    {
        $this->User_type_roles_model->delete($user_type_role_id);

        redirect("user-type-roles/all-user-type-roles");
    }
    
    //deactivate
    public function deactivate_user_type_role($id)
    {
        $load_deactivate = $this->User_type_roles_model->deactivate_user_type_role($id);
        $v_data = array(
            "all_user_type_roles" => $load_deactivate,
            "role" => $this->User_type_roles_model->get_results(),
        );
        $data = array(

            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/user_type_roles/all_user_type_roles", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);
        redirect("user-type-roles/all-user-type-roles");
    }

    //activate
    public function activate_user_type_role($id)
    {
        $segment=5;
        $page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $load_activate = $this->User_type_roles_model->activate_user_type_role($id);
        $v_data = array(
            "all_user_type_roles" => $load_activate,
            //"role" => $this->User_type_roles_model->get_results(),
            "page"=>$page
        );

        $data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/user_type_roles/all_user_type_roles", $v_data, true),
        );

        $this->load->view("site/layouts/layout", $data);
        redirect("user-type-roles/all-user-type-roles");
    }

    //edit update
    public function edit_user_type_role($id)
    {
        
        $this->form_validation->set_rules("role_parent", 'role Parent', "required");
        $this->form_validation->set_rules("role_name", 'role Name', "required");
        if ($this->form_validation->run())
        { 
        
            $roles = $this->User_type_roles_model->edit_update_user_type_role($id);

            if ($roles == false) {
                $this->session->set_flashdata("error. ", "unable to add role. Try again!!");
            } else {
                $this->session->set_flashdata("success. ", "role ,Added successfully!!");
            }
    }
        $all_roles=$this->User_type_roles_model->get_single($id);
        if ($all_roles->num_rows() > 0)
        {
            $row = $all_roles->row();
            $parent = $row->parent;
            $role_name = $row->role_name;
        }
        $v_data = array(
            "role_name"=>$role_name,    
            "parent"=>$parent,        
           "role" => $this->User_type_roles_model->get_results(),
        );
        $data = array(

            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/user_type_roles/edit_type_roles", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);
        redirect("user-type-roles/all-user-type-roles");
    }
}
