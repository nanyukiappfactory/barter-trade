<?php
if (!defined('BASEPATH')) 
{
    exit('No direct script access allowed');
}
 require_once "./application/modules/admin/controllers/Admin.php";
class Users extends Admin
{
    public $upload_path;
    public $upload_location;
   
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Users_model");
        $this->load->model("site/site_model");
        $this->load->library('pagination');
        $this->upload_path = realpath(APPPATH . "../assets/uploads");
        $this->upload_location = base_url() . "assets/uploads";
        $this->load->library("image_lib");
        $this->load->model("file_model");
        $this->load->library('session');
        $table = 'user';
       
    }
    public function index($order = 'user.first_name', $order_method = 'ASC')
    {
        $search="users/search-user";
        $close="users/close-search";
        $segment = 5;
        $table = 'user';
        $where = 'user.deleted=0';
        if (!empty($search_term) && $search_term != null) 
        {
            $where .= $search_term;
        }
        $search_term=$this->session->userdata("search_term");
        $config['base_url'] = site_url() . 'users/all-users/' . $order . '/' . $order_method;
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
        $query = $this->Users_model->get_user($table, $where, $config["per_page"], $page, $order, $order_method);      
       
        if ($order_method == 'DESC')
        {
            $order_method = 'ASC';
        } else
        {
            $order_method = 'DESC';
        }
       $v_data = array(
        "all_users"=>$query,
        "order" => $order,
        "order_method" => $order_method,
        "page" => $page,
        "links" => $this->pagination->create_links()
        );
        $data = array
       (
            "title" => "Users",
            "search"=>$search,
            "close"=>$close,
            "search_term"=>$search_term,
            "content" => $this->load->view("admin/users/all_users", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);

    }
    public function execute_search($search_term=null)
    {
        $search_term = $this->input->post('search');
        if (!empty($search_term) && $search_term != null) 
        {
            $this->session->set_userdata("search_term",$search_term);
        }           
        redirect("users/all-users");
    }
    public function unset_search()
        {
            $this->session->unset_userdata('search_term');
            redirect("users/all-users");
        }
    public function add_user()
    {
        $search="users/search-user";
        $close="users/close-search";
        $first_name = (empty(validation_errors())) ? $this->input->post("first_name") : set_value($this->input->post("first_name"));
        $last_name = (empty(validation_errors())) ? $this->input->post("last_name") : set_value($this->input->post("last_name"));
        $phone_number = (empty(validation_errors())) ? $this->input->post("phone_number") : set_value($this->input->post("phone_number"));
        $user_email = (empty(validation_errors())) ? $this->input->post("user_email") : set_value($this->input->post("user_email"));
        $username = (empty(validation_errors())) ? $this->input->post("username") : set_value($this->input->post("username"));
        $password = (empty(validation_errors())) ? $this->input->post("password") : set_value($this->input->post("password"));
        $this->form_validation->set_rules("first_name", 'First Name', "required");
        $this->form_validation->set_rules("last_name", 'Last Name', "required");
        $this->form_validation->set_rules("phone_number", 'Phone Number', "required|numeric");
        $this->form_validation->set_rules("username", 'Username', "required|is_unique[user.username]");
        $this->form_validation->set_rules("user_email", 'User Email', "required|is_unique[user.user_email]");
        $this->form_validation->set_rules("password", 'Password', "required");
        if ($this->form_validation->run()) 
        {
            $resize = array(
                "width" => 2000,
                "height" => 2000,
            );
            $upload_response = $this->file_model->upload_image($this->upload_path, "profile_icon", $resize);
            if ($upload_response['check'] == false) 
            {
                $this->Users_model->add_user($upload_response);
            } 
            else
            {
                if ($this->Users_model->add_user($upload_response))
                {
                    $this->session->set_flashdata('success', 'User Added successfully!!');
                    redirect('users/all-users');
                } 
                else
                {
                    $this->session->set_flashdata('error', 'unable to add user. Try again!!');
                }
            }
        } 
        else 
        {
            if (!empty(validation_errors()))
            {
                $this->session->set_flashdata('error', validation_errors());
            }
        }
        $v_data = array(
                "validation_errors" => validation_errors(),
                "first_name"=>$first_name,
                "last_name"=>$last_name, 
                "phone_number"=>$phone_number,   
                "user_email"=>$user_email,
                "username"=>$username,
                "password"=>$password
        );
        $data = array(
            "title" => $this->site_model->display_page_title(),
            "search"=>$search,
            "close"=>$close,
            "content" => $this->load->view("admin/users/add_user", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);
        
    }

    public function delete_user($user_id)
    {
        $this->Users_model->delete($user_id);

        redirect("users/all-users");
    }

    public function deactivate_user($id)
    {
        $search="users/search-user";
        $close="users/close-search";
        $load_deactivate = $this->Users_model->deactivate_user($id);
        $v_data = array(
            "all_users" => $load_deactivate,
        );
        $data = array(

            "title" => $this->site_model->display_page_title(),
            "search"=>$search,
            "close"=>$close,
            "content" => $this->load->view("admin/users/all_users", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);
        redirect("users/all-users");
    }
    //activate
    public function activate_user($id)
    {
        $search="users/search-user";
        $close="users/close-search";
        $load_activate = $this->Users_model->activate_user($id);
        $v_data = array(
            "all_users" => $load_activate,
        );
        $data = array(

            "title" => $this->site_model->display_page_title(),
            "search"=>$search,
            "close"=>$close,
            "content" => $this->load->view("admin/users/all_users", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);
        redirect("users/all-users");
    }
    public function edit_user($id)
    {
        $users = $this->Users_model->get_single($id);
        if ($users->num_rows() > 0) {
            $row = $users->row();
            $first_name = $row->first_name;
            $last_name = $row->last_name;
            $phone_number = $row->phone_number;
            $username = $row->username;
            $user_email = $row->user_email;
            $password = $row->password;
            //$location = $row->location;
            $profile_icon = $row->profile_icon;

        }
        
        $search="users/search-user";
        $close="users/close-search";
        $this->form_validation->set_rules("first_name", 'First Name', "required");
        $this->form_validation->set_rules("last_name", 'Last Name', "required");
        $this->form_validation->set_rules("phone_number", 'Phone Number', "required|numeric");
        $this->form_validation->set_rules("username", 'Username', "required");
        $this->form_validation->set_rules("user_email", 'User Email', "required");

        if ($this->form_validation->run()) {
            $resize = array(
                "width" => 2000,
                "height" => 2000,
            )
            ;
            $upload_response = $this->file_model->upload_image($this->upload_path, "profile_icon", $resize);
            if ($upload_response['check'] == false) 
            {
                $this->Users_model->add_user($upload_response);
            } 
            
            else {

                if ($this->Users_model->edit_update_user($id, $upload_response)) 
                {
                    $this->session->set_flashdata('success', 'User ,Added successfully!!');
                    redirect("users/all-users");
                } 
                else 
                {
                    $this->session->set_flashdata('error', 'unable to add user. Try again!!');
                }
            }

        } 
        else 
        {
            if (!empty(validation_errors())) 
            {
                $this->session->set_flashdata('error', validation_errors());
            }
        }

        $error_check = $this->session->flashdata('error');

        if(!empty($error_check) && $error_check != NULL)
        {
            $first_name = set_value("first_name");
            $last_name = set_value("last_name");
            $phone_number = set_value("phone_number");
            $username = set_value("username");
            $user_email = set_value("user_email");
            $profile_icon = set_value("profile_icon");
        }
        
        $v_data = array(
            "first_name" => $first_name,
            "last_name" => $last_name,
            "phone_number" => $phone_number,
            "username" => $username,
            "user_email" => $user_email,
            "password" => $password,
            //"location" => $location,
            "user_type" => $user_type,
        );
        $data = array(
            "title" => $this->site_model->display_page_title(),
            "search"=>$search,
            "close"=>$close,
            "content" => $this->load->view("admin/users/edit_users", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);
    }
}
