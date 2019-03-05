<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

//require_once "./application/modules/admin/controllers/Admin.php";

//class categories extends admin
class Categories extends MX_Controller
{
    public $upload_path;
    public $upload_location;
    public $per_page = 1000;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Categories_model");
        $this->load->model("site/site_model");
        $this->upload_path = realpath(APPPATH . "../assets/uploads");
        $this->upload_location = base_url() . "assets/uploads";
        $this->load->library("image_lib");
        $this->load->model("file_model");

    }

    public function index()
    {
        $v_data = array(
            "all_categories" => $this->Categories_model->get_category(),
        );

        $data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/categories/all_categories", $v_data, true),

        );
        $this->load->view("site/layouts/layout", $data);

    }

    public function add_category()
    {
        //form validation
        $this->form_validation->set_rules("category_parent", 'Category Parent', "required");
        $this->form_validation->set_rules("category_name", 'Category Name', "required");

        if ($this->form_validation->run()) {
            $resize = array(
                "width" => 2000,
                "height" => 2000,
            );

            $upload_response = $this->file_model->upload_image($this->upload_path, "category_image", $resize);

            if ($upload_response['check'] == false) {
                $this->session->set_flashdata('error', $upload_response['message']);
            } else {

                if ($this->Categories_model->save_category($upload_response)) {
                    $this->session->set_flashdata('success', 'category Added successfully!!');
                    redirect("categories/all-categories");
                } else {
                    $this->session->set_flashdata('error', 'unable to add category. Try again!!');
                }
            }

        } else {
            if (!empty(validation_errors())) {
                $this->session->set_flashdata('error', validation_errors());
            }
        }

        $v_data = array("validation_errors" => validation_errors(),
            "category" => $this->Categories_model->get_category(),
        );

        $data = array(

            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/categories/add_category", $v_data, true),
        );

        $this->load->view("site/layouts/layout", $data);
    }

    public function execute_search()
    {
        // Retrieve the posted search term.
        $search_term = $this->input->post('search');

        $v_data = array("results" => $this->Categories_model->get_category($search_term));

        $data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/execute_search", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);
    }

    public function delete_category($category_id)
    {
        $this->Categories_model->delete($category_id);
        redirect("categories/all-categories");
    }

    //deactivate
    public function deactivate_category($id)
    {
        $load_deactivate = $this->Categories_model->deactivate_category($id);
        $v_data = array(
            "all_categories" => $load_deactivate,
        );

        $data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/categories/all_categories", $v_data, true),
        );

        $this->load->view("site/layouts/layout", $data);
        redirect("categories/all-categories");
    }

    //activate
    public function activate_category($id)
    {
        $load_activate = $this->Categories_model->activate_category($id);
        $v_data = array(
            "all_categories" => $load_activate,
        );

        $data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/Categories/all_categories", $v_data, true),
        );

        $this->load->view("site/layouts/layout", $data);
        redirect("categories/all-categories");
    }

    //edit update
    public function edit_category($id)
    {
        $this->form_validation->set_rules("category_parent", 'Category Parent', "required");
        $this->form_validation->set_rules("category_name", 'Category Name', "required");

        if ($this->form_validation->run()) {
            $resize = array(
                "width" => 2000,
                "height" => 2000,
            );
            $upload_response = $this->file_model->upload_image($this->upload_path, "category_image", $resize);

            if ($upload_response['check'] == false) {
                $this->session->set_flashdata('error', $upload_response['message']);
            } else {

                if ($this->Categories_model->edit_update_category($id, $upload_response)) {
                    $this->session->set_flashdata('success', 'category ,Added successfully!!');
                    redirect("categories/all-categories");
                } else {
                    $this->session->set_flashdata('error', 'unable to add category. Try again!!');
                }
            }

        } else {
            if (!empty(validation_errors())) {
                $this->session->set_flashdata('error', validation_errors());
            }
        }

        $category = $this->Categories_model->get_single($id);

        if ($category->num_rows() > 0) {
            $row = $category->row();
            $category_parent = $row->category_parent;
            $category_name = $row->category_name;
            $category_image = $row->category_image;

        }

        $v_data = array(

            "category" => $this->Categories_model->get_category(),
            "name"=>$category_name

        );

        $data = array(

            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/categories/edit_category", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);
    }
}
