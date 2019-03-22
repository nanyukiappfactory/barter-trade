<?php 
    $result = '';
    if ($all_user_types->num_rows() > 0) 
    {
        $count = $page;
        foreach ($all_user_types->result() as $row) 
        {
            $count++;
            $id = $row->user_type_id;
            $user_type_name = $row->user_type_name;
            $check = $row->user_type_status;
            $edit_url = "user-types/edit-user-type/" . $id;
            $edit_icon = '<i class="fas fa-edit"></i>';            
            $delete_url = "user-types/delete-user-type/".$id;
            $delete_icon = '<i class="fas fa-trash-alt"></i>';
            $delete_prompt = 'Are you sure to delete user type?';
            $modal_data = array(
				"id" => $id,
				"user_type_name" => $user_type_name,
				"check" => $check,				
			);

            if ($check == 0) 
            {
                $status_activation ="<button class='badge badge-danger' data-toggle='modal'>deactivated</button>";
            }
            else 
            {
                $status_activation = "<button class= 'badge badge-success' data-toggle='modal'>activated  </button>";
            }
            if ($check == 0) 
            {
                $status = anchor("user-types/activate-user-type/" . $id, '<i class="far fa-thumbs-up"></i>', array("onclick" => "return confirm('are you sure to activate user type?')", "class" => "btn btn-success"));
            } else 
            {
                $status = anchor("user-types/deactivate-user-type/" . $id, '<i class="far fa-thumbs-down"></i>', array("onclick" => "return confirm('Are you sure to deactivate user type?')", "class" => "btn btn-danger", 'data-toggle' => 'modal'));
            }

            $result .= '
                <tr>
                    <td>'.$count.'</td>
                    <td>'.$user_type_name.'</td>
                    <td>'.$status_activation.'</td>
                    <td> 
                        <a href="#modalLoginAvatar' .$id.'" class="btn btn-primary" data-toggle="modal"
                        data-target="#modalLoginAvatar'.$id.'">
                            <i class="fas fa-eye"></i>
                        </a>
                        <button class="btn btn-warning">'.anchor($edit_url, $edit_icon).'</button>
                        ' . $status .'<button class="btn btn-danger" data-toggle="modal" onclick="return confirm(' . $delete_prompt . ')">' .anchor($delete_url, $delete_icon) . '</button>
                    </td>
                </tr>
            ';
            $this->load->view("admin/user_types/view_user_type",$modal_data);
        }
    }
?>
<div class="shadow-lg p-3 mb-5 mt-5 bg-white rounded">
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <?php echo form_open("user-types/search-user-type", array('class' => "form-control form-control-dark w-100 bg-white")); ?>
                <input type="search" placeholder="search by user type" name="search">
                <button name="Submit" type="submit">search</button>
            <?php echo form_close(); ?>
            <?php echo anchor("user-types/close-search/", "clear search", array('class' => "btn btn-secondary")); ?>
            <?php echo anchor("user-types/add-user-type/", "add user type", array('class' => "btn btn-secondary")); ?>
        </div>
    </div>
    <table class="table table-sm table-bordered">
        <tr>
            <th>Count</th>
            <th><a href="<?php echo site_url() . "user-types/all-user-types/user_type_name/" . $order_method . "/" . $page; ?>">UserType Name</a></th>
            <th><a href="<?php echo site_url() . "user-types/all-user-types/user_type_status/" . $order_method . "/" . $page; ?>">Status</a></th>
            <th>Actions</th>
        </tr>
        <?php echo $result;?>            
    </table>
    <?php echo $links; ?>
</div>