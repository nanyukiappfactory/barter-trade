<?php
class Site_model extends CI_Model{
    public function display_page_title()
    {
        $page = explode("/",uri_string());
        $total = count($page);
        $last = $total - 1;
        $name = $this->site_model->decode_web_name($page[$last]);
        
        if(is_numeric($name))
        {
            $last = $last - 1;
            $name = $this->site_model->decode_web_name($page[$last]);
        }
        $page_url = ucwords(strtolower($name));
        return $page_url;
    }

    public function decode_web_name($web_name)
    {
        $field_name = str_replace("-", " ", $web_name);    
        return $field_name;
    }

    public function get_count($table, $where, $limit = NULL)
    {
        if($limit != NULL)
        {
            $this->db->limit($limit);
        }
        $this->db->select('role.role_name, role.role_status, role.deleted, user_type.deleted, user_type.user_type_status, user_type.user_type_name,role.role_id,user_type.user_type_id, user_type_role.*');
        $this->db->from("role");
        $this->db->join("user_type_role","role.role_id=user_type_role.role_id");
        $this->db->join("user_type", "user_type_role.user_type_id=user_type.user_type_id");
        $this->db
                ->where($where)
                ->where("user_type.user_type_status",1)
                ->where("role.role_status",1)
                ->where("user_type.deleted",0)
                ->where("role.deleted",0);
        return $this->db->count_all_results();
  }
}
?>