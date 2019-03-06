<?php
if (!defined('BASEPATH')) 
{
    exit('No direct script access allowed');
}
 require_once "./application/modules/admin/controllers/Admin.php";
class User_types extends Admin
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
    public function index($order = 'user_type.user_type_name', $order_method = 'ASC')
    {
        
        //Pagination
        
        $segment = 5;
        $table = 'user_type';
        $where = 'deleted = 0';
        //$where="user_type.user_type_id > 0 AND user_type.deleted=0";  
        // var_dump($search_user_type);die();
        
        $search_user_type=$this->session->userdata("search_user_types");
        if (!empty($search_user_type) && $search_user_type != null) {
            $where .= $search_user_type;
            }
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
       
        if ($order_method == 'DESC') {
            $order_method = 'ASC';
        } else {
            $order_method = 'DESC';
        }
      
       $v_data = array(
        "all_user_types"=>$query,
        "order" => $order,
        "order_method" => $order_method,
        "page" => $page,
        "links" => $this->pagination->create_links(),
        //"search_user"=>$all_user_types,
        "results"=>$this->User_types_model->get_results($search_user_type)
    );
        $data = array
       (
            "title" => "User Types",
            "content" => $this->load->view("admin/user_types/all_user_types", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);

    }
    public function execute_search()
    {
        // Retrieve the posted search term. 
        $search_term = $this->input->post('search');
        if (!empty($search_term)) {
          $search_term= ' AND user_type.user_type_name = "' . $search_term . '"';
        //   $last_name= ' AND user_type.last_name = "' . $search_term . '"';
        // $user_data=$search_term;
        $this->session->set_userdata('search_user_type',  $search_term);
        $data =$this->session->set_userdata('search_user_type');
          var_dump($data);die();
        redirect("user-types/all-user-types");
    }
}
    
    public function add_user_type()
    {
        //form validation
        $this->form_validation->set_rules("user_type_name", 'User Type Name', "required");
       // $this->form_validation->set_rules("last_name", 'Last Name', "required");
        
        if ($this->form_validation->run()) 
        {
            if ($this->User_types_model->add_user_type()) {
                $this->session->set_flashdata('success', 'User Added successfully!!');
                redirect("user-types/all-user-types");
            } else {
                $this->session->set_flashdata('error', 'unable to add user_type. Try again!!');
            }
        } 
        else 
        {
            if (!empty(validation_errors()))
            {
                $this->session->set_flashdata('error', validation_errors());
            }
        }
        $v_data = array("validation_errors" => validation_errors());
        $data = array(

            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/user_types/add_user_type", $v_data, true),
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
        $load_deactivate = $this->User_types_model->deactivate_user_type($id);
        $v_data = array(
            "all_user_types" => $load_deactivate,
        );
        $data = array(

            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/user_types/all_user_types", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);
        redirect("user-types/all-user-types");
    }
    //activate
    public function activate_user_type($id)
    {
        $load_activate = $this->User_types_model->activate_user_type($id);
        $v_data = array(
            "all_user_types" => $load_activate,
        );
        $data = array(

            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/user_types/all_user_types", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);
        redirect("user-types/all-user-types");
    }
    public function edit_user_type($id)
    {
        $this->form_validation->set_rules("user_type_name", 'User Type Name', "required");
        //$this->form_validation->set_rules("last_name", 'Last Name', "required");
        

        if ($this->form_validation->run()) {

            if ($this->User_types_model->edit_update_user($id)) {
                $this->session->set_flashdata('success', 'user type ,Added successfully!!');
                redirect("user-types/all-user-types");
            } else {
                $this->session->set_flashdata('error', 'unable to edit user type. Try again!!');
            }

        } else {
            if (!empty(validation_errors())) {
                $this->session->set_flashdata('error', validation_errors());
            }
        }
        $user_types = $this->User_types_model->get_single($id);

        if ($user_types->num_rows() > 0) {
            $row = $user_types->row();
            $user_type_name = $row->user_type_name;

        }
        $v_data = array(
            "user_type_name" => $user_type_name,
        );
        $data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/user_types/edit_user_types", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);
    }
}
