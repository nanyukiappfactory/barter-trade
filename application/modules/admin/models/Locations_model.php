<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class Locations_model extends CI_Model
{
        public function __construct()
        {
            parent::__construct();
        }
    public function get_locations()
    {
        $this->db->select("constituency.*,county.*,nearby_location.*");
        $this->db->from("county");
        $this->db->join("constituency", "county.county_id=constituency.county_id", "left");
        $this->db->join("nearby_location", "nearby_location.constituency_id=constituency.constituency_id", 'left');
        $this->db
                ->where("county.county_status", 1)
                ->where("constituency.constituency_status", 1)
               
                ->where("nearby_location.nearby_location_status",1);
        $my_locations=json_encode($this->db->get()->result()); 
        var_dump($my_locations);//die();
        return true;
    }
    public function insertCounties($insert_data)
    {
        if($this->db->insert("county", $insert_data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function insertConstituencies($insert_data)
    {
        if($this->db->insert("constituency", $insert_data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function insertNearbyLocations($insert_data)
    {
        if($this->db->insert("nearby_location", $insert_data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}