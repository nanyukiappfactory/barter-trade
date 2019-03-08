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
    public function index($order="user_type_role.user_type_id",$order_method="ASC",$id="user_type_role")
    {
        $segment = 5;
        $table = 'user_type_role';
        $where = 'deleted = 0';      
        $search_user_type_role=$this->session->userdata("search_user");
        if (!empty($search_user_type_role) && $search_user_type_role != null) 
        {
            $where .= $search_user_type_role;
        }
        $config['base_url'] = site_url() . 'user-type-roles/all-user-type-roles/' . $order . '/' . $order_method;
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
        $query = $this->User_type_roles_model->get_user_type_role($table, $where, $config["per_page"], $page, $order, $order_method);      
        if ($order_method == 'DESC')
        {
            $order_method = 'ASC';
        } else {
            $order_method = 'DESC';
        }
        $all_user_type_roles=$this->User_type_roles_model->get_single($id);
        if ($all_user_type_roles->num_rows() > 0)
        {
            $row = $all_user_type_roles->row();
            $role_id = $row->role_id;
            $user_type_id = $row->user_type_id;
        }
        $user_type_role=$this->User_type_roles_model->retrieve_roles_and_user_types();           
        $v_data = array(
        "all_user_type_roles"=>$query,
        "order" => $order,
        "order_method" => $order_method,
        "page" => $page,
        "links" => $this->pagination->create_links(),
        "user_type_role" =>$user_type_role
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

        $user_type_role=$this->User_type_roles_model->retrieve_roles_and_user_types();
        $data = array(
            //'roles' => $this->User_type_roles_model->get_roles(),
            'user_type_role' =>  $user_type_role,
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
        $role_and_user_type=$this->User_type_roles_model->retrieve_roles_and_user_types();
        $v_data = array(
            "all_user_type_roles" => $load_deactivate,
            "user_type_role" => $this->User_type_roles_model->retrieve_roles_and_user_types(),
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
            "user_type_role" => $this->User_type_roles_model->retrieve_roles_and_user_types(),
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
        //echo "hello";
        $this->form_validation->set_rules("role", 'Role', "required");
        $this->form_validation->set_rules("user_type", 'User Type', "required");
        if ($this->form_validation->run())
        { 
            $single_user_type_role = $this->User_type_roles_model->edit_update_user_type_role($id);

            if ($single_user_type_role== false) {
                $this->session->set_flashdata("error. ", "unable to assign role . Try again!!");
            } else {
                $this->session->set_flashdata("success. ", "Assigned successfully!!");
            }
    }
        $all_user_type_roles=$this->User_type_roles_model->get_single($id);
        $user_type_role=$this->User_type_roles_model->retrieve_roles_and_user_types();        
        $v_data= array(
            //"role_name_"=>$role_name,
            //"user_type_name_"=>$user_type_name,                     
            'user_type_role' =>  $user_type_role,
            'all_user_type_roles'=>$all_user_type_roles,
            "validation_errors" => validation_errors(),
        );
        $data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/user_type_roles/edit_user_type_role", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);
        
    }
}
