<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class Locations_model extends CI_Model
{
        public function __construct()
        {
            parent::__construct();
            if (isset($_SERVER['HTTP_ORIGIN'])) {

                header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
                
                header('Access-Control-Allow-Credentials: true');
                
                header('Access-Control-Max-Age: 86400'); // cache for 1 day
                
                 }
                // Access-Control headers are received during OPTIONS requests
                if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
                if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
                    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
                 }
                if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
                    header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
                
                 }
                exit(0);
                
                 }
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
        $my_locations = $this->db->get()->result();

        return $my_locations;
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