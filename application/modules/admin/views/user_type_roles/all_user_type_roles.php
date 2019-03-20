<?php
    $table_content='';
    $status_activation='';
    $modal_content='';
    $status ='';
    $edit ='';
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
            foreach($user_type_role->result() as $rows)
            {
                $role_id_PK = $rows->role_id;
                $role_name = $rows->role_name;
                if($role_id_PK==$role_id_FK)
                {
                    $table_content.='<td>'.$count.'</td>';
                    $table_content.='<td>'.$role_name.'</td>';
                    $modal_content .='<td>'.$role_name.'</td>';
                }
            }
            foreach($user_type_role->result() as $rows)
            {
                $user_type_id_PK = $rows->user_type_id;
                $user_type_name = $rows->user_type_name;
                if($user_type_id_PK==$user_type_id_FK)
                {
                    $table_content .='<td>'.$user_type_name.'</td>';
                    $modal_content .='<td>'.$user_type_name.'</td>';
                }
            }
            if ($check == 0)
            {
                $status_activation = "<button class='badge badge-danger'>deactivated</button>";
            }
            else 
            {
                $status_activation = "<button class= 'badge badge-success'>active</button>";
            }
            $table_content.='<td>'.$status_activation.'</td>';            
        }
    }
    $edit .= anchor("user-type-roles/edit-user-type-role/" . $id, "<i class='fas fa-edit'></i>");
    if ($check == 1) {
    $status .= anchor("user-type-roles/deactivate-user-type-role/" . $id, '<i class="far fa-thumbs-down"></i>', array("onclick" => "return confirm('Are you sure to deactivate?')", "class" => "btn btn-danger"));

    } else {
    $status .=  anchor("user-type-roles/activate-user-type-role/" . $id, '<i class="far fa-thumbs-up"></i>', array("onclick" => "return confirm('Are you sure to activate?')", "class" => "btn btn-success"));
    }
 ?> 
<div class="shadow-lg p-3 mb-5 mt-5 bg-white rounded">
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3"><?php echo anchor("user-type-roles/add-user-type-role/", "Assign role","class='btn btn-dark'"); ?>
        </div>
            <table class="table table-sm table-bordered table-responsive">
                <tr>
                    <th>#
                    </th>
                    <th><a href="<?php echo site_url()."user-type-roles/all-user-type-roles/user_type_role.role_id/". $order_method."/".$page;?>">Role </a>   
                    </th>
                    <th><a href="<?php echo site_url()."user-type-roles/all-user-type-roles/user_type_role.user_type_id/". $order_method."/".$page;?>">User Type </a>   
                    </th>
                    <th>Status
                    </th>
                    <th>Actions
                    </th>
                </tr>
                <tr>
                    <?php echo $table_content?>
                    <td>
                        <a href="#role<?php echo $id ?>" class="btn btn-primary" data-toggle="modal" data-target="#role<?php echo $id ?>"><i class="fas fa-eye"></i></a>
                        <div class="modal fade" id="role<?php echo $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">

                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <tr>
                                                <th>Role 
                                                </th>
                                                <th>User Type
                                                </th>
                                            </tr>
                                            <tr>
                                            <?php echo $modal_content; ?>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-warning">
                            <?php echo anchor("user-type-roles/edit-user-type-role/" . $id, "<i class='fas fa-edit'></i>"); ?></button>
                            <?php echo  $status; ?>
                        </button>
                        <button class="btn btn-danger" onclick="return confirm('Are you sure to delete?')">
                            <?php echo anchor("user-type-roles/delete-user-type-role/" . $id, "<i class='fas fa-trash-alt'></i>"); ?>
                        </button>
                    </td>
                </tr>
            </table>
            <?php echo $links ?>
        </div>
    </div>
</div>
