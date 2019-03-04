<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen"
        href="<?php echo base_url() ?>assets/themes/custom/styles.css" />

</head>

<body>
    <?php if (!empty($validation_errors)) {
    echo $validation_errors;
}?>
    <?php echo form_open_multipart($this->uri->uri_string()); ?>
    <div class="shadow-lg p-3 mb-5 mt-5 bg-white rounded">
        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label>Role Parent</label>
                                <select name="role_parent" class="form-control">
                                    <!-- <option value="" disabled selected>Select Parent... -->
                                    <option selected="selected">no_parent</option>
                                    <?php
foreach ($role->result() as $rows) {
    $role_id = $rows->role_id;
    $role_name = $rows->role_name;

    ?>

                                    <option value="<?php echo $role_id ?>">
                                        <?php echo $role_name ?>
                                    </option>
                                    <?php }
?>

                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Role Name</label>
                                <input type="text" class="form-control" name="role_name" placeholder="Enter role name">

                            </div>




                            <div class="col-md-6 mb-3">
                                <a href="<?php echo site_url('admin/roles/add_role'); ?>"
                                    class="btn btn-secondary">Back</a>
                                <input type="submit" name="submit" class="btn btn-success" value="Submit">
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
</body>

</html>