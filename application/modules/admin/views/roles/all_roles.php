<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?php echo $title; ?>
    </title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen"
        href="<?php echo base_url() ?>assets/themes/custom/styles.css" />
    <!-- <script src="main.js"></script> -->
</head>

<body>

    <div class="shadow-lg p-3 mb-5 mt-5 bg-white rounded">
        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3"><?php echo anchor("roles/add-role/", "add role","class='btn btn-dark'"); ?>
            </div>
            <table class="table table-sm table-bordered table-responsive">
                <tr>
                    <th>#
                    </th>
                    <th><a href="<?php echo site_url()."roles/all-roles/role_name/". $order_method."/".$page;?>">Role Name</a>   
				    </th>
                    <th><a href="<?php echo site_url()."roles/all-roles/parent/". $order_method."/".$page;?>">Parent </a>   
				    </th>
                    <th>Status
                    </th>
                    <th>Actions
                    </th>
                </tr>
                <?php

                    if ($all_roles->num_rows() > 0) {
                        $count = $page;
                        foreach ($all_roles->result() as $row) {
                            {
                                $count++;
                                $id = $row->role_id;
                                $role_name = $row->role_name;
                                $parent = $row->parent;
                                $check = $row->role_status;

                                ?>
                <tr>
                    <td>
                        <?php echo $count; ?>
                    </td>
                    <td>
                        <?php echo $role_name; ?>
                    </td>
                    <td>
                        <?php
                        if($parent == 0)
                        {
                            echo " ";
                        }
                        else
                        {

                            foreach ($results->result() as $rows)
                            {
                                if($rows->role_id==$parent)
                                {
                                    echo $rows->role_name;
                                    break; 
                                }
                                
                            }
                        
                        }   ?>                       
                        
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
                                            <?php echo $role_name; ?>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <tr>
                                                <th>Role Parent
                                                </th>
                                                <th>Role Name
                                                </th>
                                                <th>Actions
                                                </th>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <?php echo $count; ?>
                                                </td>
                                                <td>
                                                <?php
                                                    if($parent == 0)
                                                    {
                                                        echo " ";
                                                    }
                                                    else
                                                    {

                                                        foreach ($results->result() as $rows)
                                                        {
                                                            if($rows->role_id==$parent)
                                                            {
                                                                echo $rows->role_name;
                                                                break; 
                                                            }
                                                            
                                                        }
                                                    
                                                    }   ?>                       
                        
                                                </td>
                                                <td>
                                                    <?php echo $role_name; ?>
                                                </td>
                                                <td>
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
                            <?php echo anchor("roles/edit-role/" . $id, "<i class='fas fa-edit'></i>"); ?></button>
                        <?php
                    if ($check == 1) 
                    {
                        echo anchor("roles/deactivate-role/" . $id, '<i class="far fa-thumbs-down"></i>', array("onclick" => "return confirm('Are you sure to deactivate?')", "class" => "btn btn-danger"));

                    } 
                    else 
                    {
                        echo anchor("roles/activate-role/" . $id, '<i class="far fa-thumbs-up"></i>', array("onclick" => "return confirm('Are you sure to activate?')", "class" => "btn btn-success"));
                    }

            ?></button>
                        <button class="btn btn-danger" onclick="return confirm('Are you sure to delete?')">
                            <?php echo anchor("roles/delete-role/" . $id, "<i class='fas fa-trash-alt'></i>"); ?></button>
                    </td>
                </tr>
                <?php }}}?>
            </table>
<?php echo $links ?>
        </div>
    </div>
    </div>
</body>

</html>