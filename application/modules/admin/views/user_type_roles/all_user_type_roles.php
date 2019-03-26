<?php
    $table_content='';
    $search_role='';
    $search_user_type='';
    $header='';
    if ($all_user_type_roles->num_rows() > 0)
    {
        $count = $page;
        foreach ($all_user_type_roles->result() as $row) 
        {
            $count++;
            $id = $row->user_type_role_id;
            $role_id_FK = $row->role_id;
            $user_type_id_FK = $row->user_type_id;
            $check = $row->user_type_role_status;
            $table_content .='<tr><td>'.$count.'</td>';
            $modal_data= array(
                "id" => $id, 
                "role_id_FK" => $role_id_FK,
                "user_type_id_FK" => $user_type_id_FK, 
                "check" => $check 
            );
            foreach($roles->result() as $rows)
            {
                $role_id_PK = $rows->role_id;
                $role_name = $rows->role_name;
                if($role_id_PK == $role_id_FK)
                {
                    $table_content .='<td>'.$role_name.'</td>';
                    break;
                }
            }
            foreach($user_types->result() as $rows)
            {
                $user_type_id_PK = $rows->user_type_id;
                $user_type_name = $rows->user_type_name;
                if($user_type_id_PK==$user_type_id_FK)
                {
                    $table_content .='<td>'.$user_type_name.'</td>';
                    break;
                }
            } 
            if ($check == 0)
            {
                $status = "<button class='badge badge-danger'>deactivated</button>";
            }
            else 
            {
                $status = "<button class='badge badge-success'>active</button>";
            }
                
            if ($check == 1) 
            {
                $status_activation = anchor("user-type-roles/deactivate-user-type-role/" . $id, '<i class="far fa-thumbs-down"></i>', array("onclick" => "return confirm('Are you sure to deactivate?')", "class" => "btn btn-danger"));

            } 
            else 
            {
                $status_activation = anchor("user-type-roles/activate-user-type-role/" . $id, '<i class="far fa-thumbs-up"></i>', array("onclick" => "return confirm('Are you sure to activate?')", "class" => "btn btn-success"));
            }
            $view= '<a href="#role'.$id.'" class="btn btn-primary" data-toggle="modal" data-target="#role'.$id.'"><i class="fas fa-eye"></i></a>';
            $edit ='<button class="btn btn-warning">'.anchor("user-type-roles/edit-user-type-role/" . $id, "<i class='fas fa-edit'></i>").'</button>';
            $delete_alert = 'Are you sure to delete?';
            $delete='<button class="btn btn-danger" onclick="return confirm('.$delete_alert.')">'.anchor("user-type-roles/delete-user-type-role/" . $id, "<i class='fas fa-trash-alt'></i>").'</button>';
            $table_content .='<td>'.$status.'</td>';
            $table_content .='<td>'.$view." ".$edit." ". $status_activation." ".$delete.'</td>';
            $table_content .='</tr>';
            $search_role .='<option value="'. $role_id_FK.'">'. $role_name.'</option>';
            $search_user_type .='<option value="'. $user_type_id_FK.'">'. $user_type_name.'</option>';
            $this->load->view("admin/user_type_roles/user_type_role_modal", $modal_data);
        }
    }  
     $header .= anchor("user-type-roles/add-user-type-role/", "Assign role","class='col-md-2 mb-2 btn btn-dark'"); 
     $header .= '<button class="fas fa-search btn btn-secondary col-md-2 mb-2" id="search_icon" name="search_icon" style="display:block" ></button>';
     $header .=  anchor("user-type-roles/close-search/",'close search session',array('class'=>"btn btn-info col-md-2 mb-2"));
?> 
<div class="shadow-lg p-3 mb-5 mt-5 bg-white rounded">
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <div class="form-row">
                <?php echo $header; ?>
            </div>
            <?php echo form_open("user-type-roles/search-user-type-role/");?>
                <div class="form-row">
                    <div id="search_items" name="search_params" class="form-group search" style="display:none">
                        <select class="selectpicker form-control  pl-2" data-style="btn-outline-primary" name="search_role">
                            <option value="" disabled selected>Select Role...
                            <?php echo $search_role ?>
                        </select>
                        <select class="selectpicker form-control  pl-2" data-style="btn-outline-primary" name="search_user_type">
                            <option value="" disabled selected>Select User Type...
                            <?php echo $search_user_type ?>
                        </select>
                        <button class ="col-md-6 mt-2 btn btn-secondary" name="Submit" type="submit">Submit</button>   
                    </div> 
                </div>
	        <?php echo form_close(); ?> 
        </div> 
        <script>
            document.getElementById("search_icon").addEventListener("click", execute_search);
            function execute_search()
            {
                if(document.getElementById("search_icon").clicked!=true)
                {
                    document.getElementById("search_items").style.display="block";
                }
            }
        </script>
        <table class="table table-md table-bordered ">
            <tr>
                <th>#</th>
                <th><a href="<?php echo site_url()."user-type-roles/all-user-type-roles/user_type_role.role_id/". $order_method."/".$page;?>">Role </a></th>
                <th><a href="<?php echo site_url()."user-type-roles/all-user-type-roles/user_type_role.user_type_id/". $order_method."/".$page;?>">User Type </a> </th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php echo $table_content; ?>
        </table>
        <?php echo $links ?>
    </div>
</div>
