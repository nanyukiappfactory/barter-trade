<?php
class sites extends MX_Controller
{
     function __construct(){
        parent:: __construct();
        $this->load->model("admin/Admin_portal_model");
        $this->load->model("auth/auth_model");
        // $this->load->view("hello_world");
    }

    public function index()
    {
        $data = array(
            "all_friends" => $this->friends_model->get_friend(),
        );
        $this->load->view("friends/hello_world", $data);
    }
public function welcome($friend_id)
    {
        $my_friend = $this->friends_model->get_single($friend_id);
        //form validation
        if ($my_friend->num_rows() > 0) {
            $row = $my_friend->row();
            $friend = $row->friend_name;
            $age = $row->friend_age;
            $gender = $row->friend_gender;
            $hobby = $row->friend_hobby;
            $validation_errors='';
            $data = array(
                "friend_name" => $friend,
                "friend_age" => $age,
                "friend_gender" => $gender,
                "friend_hobby" => $hobby,
                "validation_errors" => $validation_errors,
            );

            $this->load->view('friends/welcome_here', $data);
        } else {
            $this->session->set_flashdata
                ("error_message");
        }
    }
    public function new_friend()
    {
        //form validation
        $this->form_validation->set_rules("first_name", 'First Name', "required");
        $this->form_validation->set_rules("age", 'Age', "required|numeric");
        $this->form_validation->set_rules("gender", 'Gender', "required");
        $this->form_validation->set_rules("hobby", 'Hobby', "required");
        $validation_errors = '';
        if ($this->form_validation->run()) {
            $friend_id =
            $this->friends_model->add_friend();
            if ($friend_id > 0) {
                $this->session->set_flashdata("success_message", " New friend ID". $friend_id ."has been added");
                redirect("friends/hello");
            }
            else{
                $this->session->set_flashdata("error_message","unable to add friend");
            }
        }
        $data["validation_errors"] = validation_errors();
        $this->load->view("friends/add_friend", $data);
       
    }
}


?>