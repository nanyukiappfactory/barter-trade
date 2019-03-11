<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

require_once "./application/modules/admin/controllers/Admin.php";

class Test extends admin
{
    public function __construct()
    {
        parent::__construct();

        //Load models
        $this->load->model("admin/test_model");
    }

    public function index($order = "user.first_name", $order_method = "ASC")
    {
        $where = "user.deleted = 0 ";
        $table = "user";
        $search = $this->session->userdata("user_search");

        if(!empty($search))
        {
            $where .= $search;
        }

        $total_items = $this->test_model->count_users($table, $where);

        //Pagination stuff

        $data['content'];
    }
}