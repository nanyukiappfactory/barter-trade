<?php if (!defined('BASEPATH')){ exit('No direct script access allowed');}
require_once "./application/modules/admin/controllers/Admin.php";
class Users extends Admin
{
    public $upload_path;
    public $upload_location;
    public $g_user_id;
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Users_model");
        $this->load->model("User_types_model");
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
        $where = 'user.deleted=0';
        $first_name=$this->session->userdata("first_name");
        $last_name=$this->session->userdata("last_name");
        if(!empty($first_name) && !empty($last_name))
        {
            $where .= 'AND (first_name="'.$first_name.'" AND (last_name="'.$last_name.'")'; 
            
        }
        elseif(!empty($first_name) && $first_name != null)
        {
            //var_dump($last_name);die();
            $where .= ' AND (first_name="'.$first_name.'")';  
           
        }
        elseif((!empty($last_name) && $last_name != null))
        {
            $where .= ' AND (last_name="'.$last_name.'")'; 
        }
        else
        { 
            $where = 'user.deleted=0';
        }
       
        $close="users/close-search";
        $segment = 5;
        $table = 'user';
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
        } 
        else
        {
            $order_method = 'DESC';
        }
       $v_data = array(
            "all_users"=>$query,
            "order" => $order,
            "order_method" => $order_method,
            "page" => $page,
            "close"=>$close,
            "links" => $this->pagination->create_links()
        );
        $data = array(
            "title" => "Users",
            "content" => $this->load->view("admin/users/all_users", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);
    }
    public function username_exists($username_exists)
    {
        $where = array("username" => $username_exists, "deleted" =>0);
        $query = $this->db->get_where("user", $where);
        if ($query->num_rows() > 0)
        {
            $this->form_validation->set_message("username_exists", "that {field} already exists");
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    
    public function user_email_exists($user_email_exists)
    {
        $where = array(
            "user_email" => $user_email_exists,
            "deleted" =>0
        );
        $query = $this->db->get_where("user", $where);
        if ($query->num_rows() > 0)
        {
            $this->form_validation->set_message("user_email_exists", "that {field} already exists");
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function add_user()
    {
        $search="users/search-user";
        $close="users/close-search";
        if((empty(validation_errors())))
        {
            $first_name = set_value("first_name");
            $last_name = set_value("last_name");
            $phone_number = set_value("phone_number");
            $username = set_value("username");
            $user_email = set_value("user_email");
            $user_types = set_value("user_type");
            $password = set_value("password");
            $profile_icon = set_value("profile_icon");
        }
        $this->form_validation->set_rules("first_name", 'First Name', "required");
        $this->form_validation->set_rules("last_name", 'Last Name', "required");
        $this->form_validation->set_rules("phone_number", 'Phone Number', "required|numeric");
        $this->form_validation->set_rules("user_type", 'User Type', "required");
        $this->form_validation->set_rules("username", 'Username', "required|callback_username_exists");
        $this->form_validation->set_rules("user_email", 'User Email', "required|callback_user_email_exists");
        $this->form_validation->set_rules("password", 'Password', "required");
        if ($this->form_validation->run($this) == FALSE) 
        {
             $this->session->set_flashdata('error', validation_errors());
        }
        else
        {
            $resize = array(
                "width" => 2000,
                "height" => 2000,
            );
            $upload_response = $this->file_model->upload_image($this->upload_path, "profile_icon", $resize);
            if ($upload_response['check'] == false) 
            { 
                $upload_response=array(
                    "file_name" => "no_image.PNG",
                    "thumb_name" => "6cb8392a0f015455b60834952307d7fe.PNG",
                    );
                    
                $this->Users_model->add_user($upload_response);
                $this->session->set_flashdata('success', 'User Added successfully!!');
                redirect("users/all-users");
                
            } 
            else
            {
                if ($this->Users_model->add_user($upload_response))
                {
                    $this->session->set_flashdata('success', 'User Added successfully!!');
                    redirect("users/all-users");
                } 
            }
            unset($this->form_validation);
        } 
        try
        {
        $user_type=$this->User_types_model->get_results();
        }
        catch(Exception $e)
        {
            echo("Please add a user type first.");
            redirect("user-types/add-user-type");die();
        }
        $v_data = array(
                "first_name"=>$first_name,
                "last_name"=>$last_name, 
                "phone_number"=>$phone_number,   
                "user_email"=>$user_email,
                "username"=>$username,
                "password"=>$password,
                "user_types"=>$user_types,
                "user_type"=>$user_type
        );
        
        $data = array(
            "title" => $this->site_model->display_page_title(),
            "search"=>$search,
            "close"=>$close,
            "content" => $this->load->view("admin/users/add_user", $v_data, true),
        );
        
        $this->load->view("site/layouts/layout", $data);
    }
    public function user_email_is_unique($user_email_is_unique)
    {
        $user_id = ($this->g_user_id);
        $where = "user_id !=".$user_id;
        $where .= ' AND (user_email="'.$user_email_is_unique.'" AND deleted=0)';
        $query = $this->db->get_where("user", $where);
        $result =$query->num_rows();
        if ($result > 0 )
        {
            $this->form_validation->set_message("user_email_is_unique", "that {field} already exists");
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    public function username_is_unique($username_is_unique)
    {
        $user_id = ($this->g_user_id);
        $where = "user_id !=".$user_id;
        $where .= ' AND (username="'.$username_is_unique.'" AND deleted=0)';
        $query = $this->db->get_where("user", $where);
        $result =$query->num_rows();
        if ($result > 0 )
        {
            $this->form_validation->set_message("username_is_unique", "that {field} already exists");
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function edit_user($user_id)
    {
        $this->g_user_id = $user_id;
        $users = $this->Users_model->get_single($user_id);
        if ($users->num_rows() > 0) {
            $row = $users->row();
            $first_name = $row->first_name;
            $last_name = $row->last_name;
            $phone_number = $row->phone_number;
            $username = $row->username;
            $user_email = $row->user_email;
            $password = $row->password;
            $profile_icon = $row->profile_icon;
            $profile_thumb = $row->profile_thumb;
            $user_types =$row->user_type_id;
        }
        $search="users/search-user";
        $close="users/close-search";
        $this->form_validation->set_rules("first_name", 'First Name', "required");
        $this->form_validation->set_rules("last_name", 'Last Name', "required");
        $this->form_validation->set_rules("phone_number", 'Phone Number', "required|numeric");
        $this->form_validation->set_rules("user_type", 'User Type', "required");
        $this->form_validation->set_rules("username", 'User Name', 'required|callback_username_is_unique');
        $this->form_validation->set_rules("user_email", 'User Email', "required|callback_user_email_is_unique");
        $this->form_validation->set_rules("profile_icon", ' ', " ");
        if ($this->form_validation->run($this) == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
        }
        else
        
        {
            $resize = array(
                "width" => 2000,
                "height" => 2000,
            );
            $upload_response = $this->file_model->upload_image($this->upload_path, "profile_icon", $resize);
            if ($upload_response['check'] == false) 
            {
                $upload_response=array(
                    "file_name" =>  $profile_icon ,
                    "thumb_name" => $profile_thumb,
                );
            $this->Users_model->edit_update_user($user_id, $upload_response);
            $this->session->set_flashdata('success', 'User Updated successfully!!');
            redirect("users/all-users");
            } 
            else 
            {
                if ($this->Users_model->edit_update_user($user_id, $upload_response)) 
                {
                    $this->session->set_flashdata('success', 'User Updated successfully!!');
                    redirect("users/all-users");
                } 
                else 
                {
                    $this->session->set_flashdata('error', 'unable to update user. Try again!!');
                }
            }
            unset($this->form_validation);
        }
        $error_check = $this->session->flashdata('error');
        if(!empty($error_check) && $error_check != NULL)
        {
            $first_name = set_value("first_name");
            $last_name = set_value("last_name");
            $phone_number = set_value("phone_number");
            $username = set_value("username");
            $user_email = set_value("user_email");
            $user_types = set_value("user_type");
            $profile_icon = set_value($profile_icon);
        }
        $user_type=$this->User_types_model->get_results();
        $v_data = array(
            "first_name" => $first_name,
            "last_name" => $last_name,
            "phone_number" => $phone_number,
            "username" => $username,
            "user_email" => $user_email,
            "password" => $password,
            "users" =>$users,
            "profile_icon" => $profile_icon,
            "user_types"=>$user_types,
            "user_type" => $user_type
        );
        $data = array(
            "title" => $this->site_model->display_page_title(),
            "search"=>$search,
            "close"=>$close,
            "content" => $this->load->view("admin/users/edit_users", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);
    }

    public function delete_user($user_id)
    {
        $this->Users_model->delete($user_id);

        redirect("users/all-users");
    }
    
    public function activate_user($user_id)
    {
        $this->Users_model->activate_user($user_id);
        redirect("users/all-users");
    }

    public function deactivate_user($user_id)
    {
        $this->Users_model->deactivate_user($user_id);
        redirect("users/all-users");
    }

    public function execute_search($first_name=null,$last_name=null)
    {
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        if (!empty($first_name) && $first_name != null) 
        {
            $this->session->set_userdata("first_name",$first_name);
        }  
        elseif(!empty($last_name) && $last_name != null)  
        {
            $this->session->set_userdata("last_name",$last_name);
        } 
        redirect("users/all-users");
    }

    // public function unset_search()
    //     {
    //         $this->session->unset_userdata('search_term');
    //         redirect("users/all-users");
    //     }
}
