<?php if (!defined('BASEPATH')) { exit('No direct script access allowed');}
class User_type_roles extends MX_Controller
{
    public $where;
    public function __construct()
    {
        parent::__construct();
        $this->load->model("User_type_roles_model");
        $this->load->model("User_types_model");
        $this->load->model("Roles_model");
        $this->load->model("site/site_model");
        $this->load->library("pagination");
    }
    public function index($order="user_type_role.user_type_id",$order_method="ASC",$id="user_type_role")
    {
        $where = 'user_type_role.deleted = 0';
        if($this->session->userdata("user_type_role_search_params"))
        {
            $search_parameters = $this->session->userdata("user_type_role_search_params");
            $where .= $search_parameters;
        }
        $segment = 5;
        $table = 'user_type_role';
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
        } else 
        {
            $order_method = 'DESC';
        }
        $single_user_type_roles=$this->User_type_roles_model->get_single($id);         
        $v_data = array(
            "all_user_type_roles"=>$query,
            "order" => $order,
            "order_method" => $order_method,
            "page" => $page,
            "links" => $this->pagination->create_links(),
            'single_user_type_roles'=> $single_user_type_roles, 
            'roles' => $this->Roles_model->get_results(),
            'user_types' => $this->User_types_model->get_results(),
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
        if ($this->form_validation->run())
        {
            $assigned_role_user = $this->User_type_roles_model->save_user_type_role();
            if ($assigned_role_user == false)
            {
                $this->session->set_flashdata('error', validation_errors());
            } 
            else
            {
                $this->session->set_flashdata("success. ", "You have assigned a role");
                redirect("user-type-roles/all-user-type-roles");
            }
            unset($this->form_validation);
        }  
        $data= array(  
            'roles' => $this->Roles_model->get_results(),
            'user_types' => $this->User_types_model->get_results()
        );
        $v_data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/user_type_roles/add_roles", $data, true),
        );
        $this->load->view('site/layouts/layout', $v_data);
    }

    public function edit_user_type_role($id)
    {
        $this->form_validation->set_rules("role_name", 'Role', "required");
        $this->form_validation->set_rules("user_type_name", 'User Type', "required");
        if ($this->form_validation->run())
        { 
            $edit_user_type_role = $this->User_type_roles_model->edit_update_user_type_role($id);
            if ($edit_user_type_role== false)
            {
                $this->session->set_flashdata("error. ", "unable to assign role . Try again!!");
            } 
            else 
            {
                $this->session->set_flashdata("success. ", "Assigned successfully!!");
                redirect("user-type-roles/all-user-type-roles");
            }
            unset($this->form_validation);
        }
        $single_user_type_roles=$this->User_type_roles_model->get_single($id);      
        $v_data= array(  
            'single_user_type_roles'=> $single_user_type_roles, 
            'roles' => $this->Roles_model->get_results(),
            'user_types' => $this->User_types_model->get_results()
        );
        $data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/user_type_roles/edit_user_type_role", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);
    }

    public function deactivate_user_type_role($id)
    {
        $this->User_type_roles_model->deactivate_user_type_role($id);
        redirect("user-type-roles/all-user-type-roles");
    }

    public function activate_user_type_role($id)
    {
        $this->User_type_roles_model->activate_user_type_role($id);
        redirect("user-type-roles/all-user-type-roles");
    }

    public function delete_user_type_role($user_type_role_id)
    {
        $this->User_type_roles_model->delete($user_type_role_id);
        redirect("user-type-roles/all-user-type-roles");
    }

    public function search_user_type_role($search_user_type_role=null)
    {
        $where ='';
        $search_role = $this->input->post("search_role");
        $search_user_type = $this->input->post("search_user_type");;
        if(!empty($search_role))
        {
        $where .= ' AND (user_type_role.role_id = '.$search_role.')';
        }
        if(!empty($search_user_type))
        {
        $where .= ' AND (user_type_role.user_type_id = '.$search_user_type.')';
        }
        $this->session->set_userdata("user_type_role_search_params", $where);
        redirect("user-type-roles/all-user-type-roles");
    }

    public function unset_user_type_role_search()
        { 
        $this->session->unset_userdata("user_type_role_search_params");
        redirect("user-type-roles/all-user-type-roles");
        }
}
