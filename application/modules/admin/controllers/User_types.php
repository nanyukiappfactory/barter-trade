<?php
if(!defined('BASEPATH')){  exit('No direct script access allowed');}
//require_once "./application/modules/admin/controllers/Admin.php";

class User_types extends MX_Controller
{
    public $upload_path;
    public $upload_location;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("User_types_model");
        $this->load->model("site/site_model");
        $this->load->library('pagination');
        $this->upload_path = realpath(APPPATH . "../assets/uploads");
        $this->upload_location = base_url() . "assets/uploads";
        $this->load->library("image_lib");
        $this->load->model("file_model");
        $this->load->library('session');
        $table = 'user_type';
    }
    public function user_type_endpoint()
    {
        $all_user_types = $this->User_types_model->get_user_types();
        echo json_encode($all_user_types);
    }
    public function index($order = 'user_type.user_type_name', $order_method = 'ASC')
    {
        $search="user-types/search-user-type";        
        $search_user_type=$this->session->userdata("search_user_type");
        $close="user-types/close-search";
        //Pagination
        $segment = 5;
        $table = 'user_type';
        $where = 'deleted = 0';   
        
        $config['base_url'] = site_url() . 'user-types/all-user-types/' . $order . '/' . $order_method;
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
        $query = $this->User_types_model->get_user_type($table, $where, $config["per_page"], $page, $order, $order_method);      
       
        if($order_method == 'DESC') 
        {
            $order_method = 'ASC';
        }
        else 
        {
            $order_method = 'DESC';
        }
        $v_data = array(
            "all_user_types"=>$query,
            "order" => $order,
            "order_method" => $order_method,
            "page" => $page,
            "links" => $this->pagination->create_links(),
        );
        $data = array(
            "title" => "User Types",
            "search"=>$search,
            "close"=>$close,
            "content" => $this->load->view("admin/user_types/all_user_types", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);
    }//end index

    public function execute_search($search_user_type=null)
    {
        $search_user_type = $this->input->post('search');
        if(!empty($search_user_type) && $search_user_type != null) 
        {
            $this->session->set_userdata("search_user_type", $search_user_type); 
        }
        redirect("user-types/all-user-types"); 
    }

    public function unset_search()
    {
        $this->session->unset_userdata('search_user_type');
        redirect("user-types/all-user-types");
    }
    
    public function is_field_unique($field_to_check)
    {
        $where = array("user_type_name" => $field_to_check, "deleted" =>0);
        $query = $this->db->get_where("user_type", $where); 

        if($query->num_rows() > 0 )
        {
            $this->form_validation->set_message("is_field_unique", "that {field} already exists");
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function add_user_type()
    {
        //form validation
        $search="user-types/search-user-type";
        $close="user-types/close-search";
        $this->form_validation->set_rules("user_type_name", "user type", "required|callback_is_field_unique");
        
        if($this->form_validation->run($this)) 
        {
            if($this->User_types_model->add_user_type()) 
            {
                $this->session->set_flashdata('success', 'user type added successfully!!');
                redirect("user-types/all-user-types");
            } 
            else 
            {
                $this->session->set_flashdata('error', 'unable to add user_type. Try again!!');
            }
        } 
        if(!empty(validation_errors()))
        {
            $this->session->set_flashdata('error', validation_errors());
        }
        $data = array(
            "title" => $this->site_model->display_page_title(),
            "search"=>$search,
            "close"=>$close,
            "content" => $this->load->view("admin/user_types/add_user_type",array(), true),
        );
        $this->load->view("site/layouts/layout", $data);
    }

    public function delete_user_type($user_type_id)
    {
        $this->User_types_model->delete($user_type_id);
        redirect("user-types/all-user-types");
    }

    public function deactivate_user_type($id)
    {
        $this->User_types_model->deactivate_user_type($id);
        redirect("user-types/all-user-types");
    }

    public function activate_user_type($id)
    {
        $this->User_types_model->activate_user_type($id);
        redirect("user-types/all-user-types");
    }

    public function edit_user_type($id)
    {
        $user_types = $this->User_types_model->get_single($id);

        if($user_types->num_rows() > 0) 
        {
            $row = $user_types->row();
            $user_type_name = $row->user_type_name;
        }
        $search="user-types/search-user-type";
        $close="user-types/close-search";
        $this->form_validation->set_rules("user_type_name", 'User Type Name', "required|callback_is_field_unique");
       
        if($this->form_validation->run($this)) 
        {
            if($this->User_types_model->edit_update_user_type($id)) 
            {
                $this->session->set_flashdata('success', 'user type updated successfully!!');
                redirect("user-types/all-user-types");
            }
            else 
            {
                $this->session->set_flashdata('error', 'unable to edit user type. Try again!!');
            }
        } 
        if(!empty(validation_errors())) 
        {
            $this->session->set_flashdata('error', validation_errors());
        }
        $error_check = $this->session->flashdata('error');
        
        if(!empty($error_check) && $error_check != NULL)
        {
            $user_type_name = set_value("user_type_name");
        }   
        $v_data = array(
            "user_type_name" => $user_type_name,
        );
        $data = array(
            "title" => $this->site_model->display_page_title(),
            "search" => $search,
            "close" => $close,
            "content" => $this->load->view("admin/user_types/edit_user_types", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);
    }
}
