<?php if (!defined('BASEPATH')) { exit('No direct script access allowed');}
class Locations extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("site/site_model");
        $this->load->model("Locations_model");
        $this->load->library("csvimport");
    }
    public function index()
    {
        $all_locations = $this->Locations_model->get_locations();
    }
    
public function importResult() { 
  
    $config['field_name']=$this->input->post("county");
    $config['upload_path'] = './assets/uploads/';
    $config['allowed_types'] = 'text/plain|text/anytext|csv|text/x-comma-separated-values|text/comma-separated-values|application/octet-stream|application/vnd.ms-excel|application/x-csv|text/x-csv|text/csv|application/csv|application/excel|application/vnd.msexcel';
    
    $this->load->library('upload', $config);
    $parse = $this->upload->initialize($config);
    if ($this->upload->do_upload("county")) {
        $file_data = $this->upload->data();
        $file_path = '.assets/uploads/' . $file_data['file_name'];
        $csv_array = $this->csvimport->get_array($file_data["full_path"]);
        if($csv_array)
        {
            foreach ($csv_array as $row) {
                $insert_data = array(
                    'county_name' => $row['county_name'],
                    'county_id' => $row['county_id'],
                    'created_by' => $row['created_by'],
                );
                // inser data into database
                $save_data = $this->Locations_model->insertCounties($insert_data);
            }
            if($save_data == true)
            {
                echo("successful"); 
            }
            else
            {
                echo("insertion failed");
            }
        }
    }
    else
    {
        echo $this->upload->display_errors();
    }
    $config['field_name']=$this->input->post("constituency");
    $config['upload_path'] = './assets/uploads/';
    $config['allowed_types'] = 'text/plain|text/anytext|csv|text/x-comma-separated-values|text/comma-separated-values|application/octet-stream|application/vnd.ms-excel|application/x-csv|text/x-csv|text/csv|application/csv|application/excel|application/vnd.msexcel';
    
    $this->load->library('upload', $config);
    $parse = $this->upload->initialize($config);
    if ($this->upload->do_upload("constituency")) {
        //$this->load->library('csvimport');
        $file_data = $this->upload->data();
        $file_path = '.assets/uploads/' . $file_data['file_name'];
        $csv_array = $this->csvimport->get_array($file_data["full_path"]);
        if($csv_array)
        {
            foreach ($csv_array as $row) {
                $insert_data = array(
                    'constituency_id' => $row['constituency_id'],
                    "county_id" => $row["county_id"],
                    'constituency_name' => $row['constituency_name'],
                    'created_by' => $row['created_by'],
                );
                // inser data into database
                $save_data = $this->Locations_model->insertConstituencies($insert_data);
            }
            if($save_data == true)
            {
                echo("successful"); 
            }
            else
            {
                echo("insertion failed");
            }
        }
    }
    else
    {
        echo $this->upload->display_errors();
    }
    $config['field_name']=$this->input->post("nearby_location");
    $config['upload_path'] = './assets/uploads/';
    $config['allowed_types'] = 'text/plain|text/anytext|csv|text/x-comma-separated-values|text/comma-separated-values|application/octet-stream|application/vnd.ms-excel|application/x-csv|text/x-csv|text/csv|application/csv|application/excel|application/vnd.msexcel';
  
    $this->load->library('upload', $config);
    $parse = $this->upload->initialize($config);
    if ($this->upload->do_upload("nearby_location")) {
        //echo($this->upload->do_upload("nearby_location"));die();
        $file_data = $this->upload->data();
        //print_r($file_data);
        $file_path = '.assets/uploads/' . $file_data['file_name'];
        $csv_array = $this->csvimport->get_array($file_data["full_path"]);
        //print_r($csv_array);
        if($csv_array)
        {
            foreach ($csv_array as $row) {

                $insert_data = array(
                    'location_id' => $row['location_id'],
                    'location_name' => $row['location_name'],
                    'constituency_id' => $row['constituency_id'],
                    'created_by' => $row['created_by'],
                );
                // inser data into database
                $save_data = $this->Locations_model->insertNearbyLocations($insert_data);
            }
            if($save_data == true)
            {
                echo("successful"); 
            }
            else
            {
                echo("insertion failed");
            }
        }
    }
    else
    {
        echo $this->upload->display_errors();
    }
    $v_data = array(
        "title" => $this->site_model->display_page_title(),
        "content" =>  $this->load->view('admin/locations/csv_import'),
    );
    $this->load->view('site/layouts/layout', $v_data);
 }
} 