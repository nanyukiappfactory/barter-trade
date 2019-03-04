<?php
if (!defined('BASEPATH')) 
exit('No direct script access allowed'); 
class File_model extends CI_Model
{
public function upload_image($upload_path, $field_name, $resize)
{
//Configuration used when upload images
$config = array(
"allowed_types" => "JPG|JPEG|jpg|jpeg|png|PNG",
"upload_path" => $upload_path,
"quality" => "100%",
"max_size" => "0", 
"min_width" => "100",
"min_height" => "100",
"file_name" => md5(date("Y-m-d H:i:s"))
);
 
$response = [];
 
//load library with this configs
$this->load->library("upload", $config);
 
if(!$this->upload->do_upload($field_name))
{
//If upload fail
$response['check'] = FALSE;
$response['message'] = $this->upload->display_errors();
}
 
else
{
//get response on a successful upload
$image_upload_data = $this->upload->data();
 
$file_name = $image_upload_data['file_name'];
$file_path = $image_upload_data['file_path'];
 
//Resize uploaded image
$resize_upload = $this->resize_image($image_upload_data["full_path"], $resize);
 
if($resize_upload == TRUE)
{
//create thumbnail
//Thumbnail size
$resize_thumb = array(
'width' => 100,
'height' => 100
);
 
//Thumbnail properties
$thumb_name = "thumbnail_" . $file_name;
$thumb_array = array(
"thumb_path" => $file_path . $thumb_name
);
 
//Create thumbnail
$create_thumb = $this->resize_image($image_upload_data["full_path"], $resize_thumb, $thumb_array);
 
if($create_thumb == TRUE)
{
$response['check'] = TRUE;
$response['file_name'] = $file_name;
$response['thumb_name'] = $thumb_name;
}
else
{
//If thumbnail creation faile
$response['check'] = FALSE;
$response['message'] = $create_thumb;
}
}
else
{
//If resize fail
$response['check'] = FALSE;
$response['message'] = $resize_upload;
}
}
 
return $response;
}
 
//Creating a thumbnail
//Resize the image using image_lib library
private function resize_image($source_image, $resize, $thumbnail = FALSE)
{
$resize_config = array(
"source_image" => $source_image,
"width" => $resize['width'],
"height" => $resize['height'],
"master_dim" => "width",
"maintain_ratio" => TRUE
);
 
if($thumbnail != FALSE)
{
$resize_config["new_image"] = $thumbnail["thumb_path"];
$resize_config["create_thumb"] = FALSE;
}
 
$this->image_lib->initialize($resize_config);
if(!$this->image_lib->resize())
{
//If resize fails
return $this->image_lib->display_errors();
}
else
{
//if it resize successfully
return TRUE;
}
}
}
 
?>