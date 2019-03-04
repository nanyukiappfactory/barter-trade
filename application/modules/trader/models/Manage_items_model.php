<?php
if (!defined('BASEPATH')) 
exit('No direct script access allowed'); 
class Manage_items_model extends CI_Model
{
    protected $table = "item";
    //public function add_item($item_image)
    public function add_item()
    {
        $data = array(
            "item_name" => $this->input->post("item_name"),
            "item_description" => $this->input->post("item_description"),
            "item_cost" => $this->input->post("item_cost"),
            //TODO make the user ID dynamic
            "user_id" => 1,
            "category_id" => $this->input->post("category_name"),
            "deleted"=>0
        );

        
        if( $this->db->insert("item", $data)){
           return true;
        }
        else{
           return false;
        }
    }
   public function add_desired_item(){
    $data = array(
        array(
        "desired_item_name" => $this->input->post("item1"),
        "category_id" => $this->input->post("category_name"),
        "user_id" => 1,
        "deleted"=>0
    ),
    array(
        "desired_item_name" => $this->input->post("item2"),
        "category_id" => $this->input->post("category_name"),
        "user_id" => 1,
        "deleted"=>0
    ),
    array(
        "desired_item_name" => $this->input->post("item3"),
        "category_id" => $this->input->post("category_name"),
        "user_id" => 1,
        "deleted"=>0
    )
    );

    
    if( $this->db->insert_batch("desired_item", $data)){
       return true;
    }
    else{
       return false;
    }
   }

   public function add_item_image($upload_response){


    $file_name = $upload_response['file_name'];
    $thumb_name = $upload_response['thumb_name'];

    $data = array(
        "item_image_name"=> $file_name,
        "profile_thumb"=> $thumb_name,
        //TO DO make user_id dynamic
        "user_id" => 1,
        "deleted"=>0        
    );

    
    if( $this->db->insert("image", $data)){
       return true;
    }
    else{
       return false;
    }
   }
    
    //get categories
    public function get_all_categories() { 
        $this->db->select("*");
        $this->db->from("category");
        $this->db->where("deleted",0);
       
        return $result=$this->db->get();

        
    } 

}
