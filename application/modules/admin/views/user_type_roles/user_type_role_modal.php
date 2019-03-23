<?php
    $modal='';
    $modal .='<tr>';
    foreach($roles->result() as $rows)
    {
        $role_id_PK = $rows->role_id;
        $role_name = $rows->role_name;
        if($role_id_PK==$role_id_FK)
        {
            $modal .='<td>'.$role_name.'</td>';
            break;
        }
    }
    foreach($user_types->result() as $rows)
    {
        $user_type_id_PK = $rows->user_type_id;
        $user_type_name = $rows->user_type_name;
        if($user_type_id_PK==$user_type_id_FK)
        {
            $modal .='<td>'.$user_type_name.'</td>';
            break;
        }
    } 
    $modal .='</tr>';
?>
<div class="modal fade" id="role<?php echo $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <th>Role</th>
                        <th>User Type</th>
                    </tr>
                    <?php echo $modal ?>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>