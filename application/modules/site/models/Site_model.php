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
    
    $search_term=$this->session->userdata("search_term");
      if($limit != NULL)
      {
          $this->db->limit($limit);
      }
      $this->db->from($table);
      $this->db->where($where);
      $this->db->like('first_name', $search_term);
      $this->db->or_like('user_email',$search_term);
      $this->db->or_like('username',$search_term);
      $this->db->or_like('phone_number',$search_term);
      $this->db->or_like('last_name',$search_term);
      return $this->db->count_all_results();
}
}

?>