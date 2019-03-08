<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
?>
    <div class="shadow-lg p-3 mb-5 mt-5 bg-white rounded">

        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">
                <!-- <button type="button" class="btn btn-success">Add Partner</button> -->
                <?php echo anchor("user-types/add-user-type/", "add user type", array('class' => "btn btn-secondary")); ?>
            </div>
        </div>
        <table class="table table-sm table-bordered">
            <tr>
                <th>Count
                </th>
                <th><a
                        href="<?php echo site_url() . "user-types/all-user-types/user_type_name/" . $order_method . "/" . $page; ?>">User
                        Type Name</a>
                </th>
                <th><a
                        href="<?php echo site_url() . "user-types/all-user-types/user_type_status/" . $order_method . "/" . $page; ?>">Status</a>
                </th>
                <th>Actions
                </th>
            </tr>
            <?php
if ($all_user_types->num_rows() > 0) {
    $count = $page;
    foreach ($all_user_types->result() as $row) {
        {
            $count++;
            $id = $row->user_type_id;
            $user_type_name = $row->user_type_name;
            $check = $row->user_type_status;
            ?>
            <tr>
                <td>
                    <?php echo $count; ?>
                </td>

                <td>
                    <?php echo $user_type_name; ?>
                </td>

                <td>
                    <?php if ($check == 0) {
                echo "<button class='badge badge-danger' data-toggle='modal'>deactivated</button>";
            } else {
                echo "<button class= 'badge badge-success' data-toggle='modal'>activated  </button>";
            }
            ?>
                </td>
                <td>
                    <a href="#modalLoginAvatar<?php echo $id ?>" class="btn btn-primary" data-toggle="modal"
                        data-target="#modalLoginAvatar<?php echo $id ?>"><i class="fas fa-eye"></i></a>
                    <button
                        class="btn btn-warning"><?php echo anchor("user-types/edit-user-type/" . $id, '<i class="fas fa-edit"></i>'); ?></button>
                    <?php
if ($check == 0) {
                echo anchor("user-types/activate-user-type/" . $id, '<i class="far fa-thumbs-up"></i>', array("onclick" => "return confirm('Are you sure to activate?')", "class" => "btn btn-success"));

            } else {
                echo anchor("user-types/deactivate-user-type/" . $id, '<i class="far fa-thumbs-down"></i>', array("onclick" => "return confirm('Are you sure to deactivate?')", "class" => "btn btn-danger", 'data-toggle' => 'modal'));
            }
            ?>
                    <button class="btn btn-danger" data-toggle='modal'
                        onclick="return confirm('Are you sure to delete?')">
                        <?php echo anchor("user-types/delete-user-type/" . $id, "<i class='fas fa-trash-alt'></i>"); ?></button>

                </td> <!-- Button trigger modal -->
                <div class="modal fade" id="modalLoginAvatar<?php echo $id ?>" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
                        <div class="modal-content">
                            
                            <div class="modal-body  mb-1">
                                <div class="md-form">
                                    <b>User Type Name:</b> <label data-error="wrong" data-success="right" for="form29"
                                        class="ml-0"><?php echo $user_type_name; ?></label>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </tr><?php }}}?>
        </table>
        <?php echo $links; ?>
    </div>