<div class="shadow-lg p-3 mb-5 mt-5 bg-white rounded">
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3"><?php echo anchor("roles/add-role/", "add role","class='btn btn-dark'"); ?>
            </div>
                <table class="table table-sm table-bordered table-responsive">
                    <tr>
                        <th>#
                        </th>
                        <th><a href="<?php echo site_url()."user-type-roles/all-user-type-roles/role_id/". $order_method."/".$page;?>">Role </a>   
                        </th>
                        <th><a href="<?php echo site_url()."user-type-roles/all-user-type-roles/user_type_id/". $order_method."/".$page;?>">User Type </a>   
                        </th>
                        <th>Status
                        </th>
                        <th>Actions
                        </th>
                    </tr>
                    <?php

                        if ($all_user_type_roles->num_rows() > 0) {
                            $count = $page;
                            foreach ($all_user_type_roles->result() as $row) {
                                {
                                    $count++;
                                    $id = $row->user_type_role_id;
                                    $role_id = $row->role_id;
                                    $user_type_id = $row->user_type_id;
                                    $check = $row->user_type_role_status;
                     ?>
                    <tr>
                        <td>
                            <?php echo $count; ?>
                        </td>
                        <td>
                            <?php echo $role_id; ?>
                        </td>
                        <td>
                            <?php
                            // if($parent == 0)
                            // {
                            //     echo " ";
                            // }
                            // else
                            // {
                            //     foreach ($role->result() as $rows)
                            //     {
                            //         if($rows->role_id==$parent)
                            //         {
                                        echo $user_type_id;
                                //         break; 
                                //     }
                                // }                            
                            //}   
                            ?>                       
                            
                        </td>
                        <td>
                            <?php 
                            if ($check == 0)
                            {
                                echo "<button class='badge badge-danger'> deactivated</button>";
                            }
                            else 
                            {
                                echo "<button class= 'badge badge-success'>active</button>";
                            }
                            ?>
                        </td>
                        <td>
                            <a href="#role<?php echo $id ?>" class="btn btn-primary" data-toggle="modal"
                                data-target="#role<?php echo $id ?>"><i class="fas fa-eye"></i></a>
                            <!-- Button trigger modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="role<?php echo $id ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <td>
                                                    <?php
                                                        // if($parent == 0)
                                                        // {
                                                        //     echo " ";
                                                        // }
                                                        // else
                                                        // {

                                                        //     foreach ($role->result() as $rows)
                                                        //     {
                                                        //         if($rows->role_id==$parent)
                                                        //         {
                                                                    echo $role_id;
                                                        //             break; 
                                                        //         }
                                                        //     }
                                                        
                                                        // }  
                                                        ?>  
                                                    </td>
                                                    <td>
                                                        <?php echo $user_type_id; ?>
                                                    </td>
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
                        <?php
                            if ($check == 1) 
                            {
                                echo anchor("user-type-roles/deactivate-user-type-role/" . $id, '<i class="far fa-thumbs-down"></i>', array("onclick" => "return confirm('Are you sure to deactivate?')", "class" => "btn btn-danger"));

                            } 
                            else 
                            {
                                echo anchor("user-type-roles/activate-user-type-role/" . $id, '<i class="far fa-thumbs-up"></i>', array("onclick" => "return confirm('Are you sure to activate?')", "class" => "btn btn-success"));
                            }

                        ?></button>
                        <button class="btn btn-danger" onclick="return confirm('Are you sure to delete?')">
                            <?php echo anchor("user-type-roles/delete-user-type-role/" . $id, "<i class='fas fa-trash-alt'></i>"); ?></button>
                    </td>
                </tr>
                <?php }}}?>
            </table>
                <?php echo $links ?>
        </div>
    </div>
</div>
