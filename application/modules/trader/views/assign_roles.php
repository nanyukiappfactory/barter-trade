<?php if (!defined('BASEPATH')) 
exit('No direct script access allowed');  ?>
<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>assets/themes/custom/styles.css" />

</head>

<body>
<?php if (!empty($validation_errors)) {
    echo $validation_errors;
}
?>
<?php echo form_open($this->uri->uri_string());?>
	<div class="container-fluid" style="margin-top:10px">



		<div class="form-row">

			<div class="col">
			

				<div class="form-control">
        <label for="role_name">Role Name</label>
					<select name="role_name">
          <?php

    foreach ($roles->result() as $rows) {
        $role_id = $rows->role_id;
        $role_name = $rows->role_name;

        ?>
						<option value="<?php echo $role_id?>" >
							<?php echo $role_name ?>
						</option>
            
				<?php }

?>

					</select>
				</div>
			

			</div>

			<div class="col">
				
				<div class="form-control">
        <label for="item_type_name">item type name</label>
					<select name="item_type_name">
          <?php

    foreach ($item_types->result() as $rows) {
        $item_type_id = $rows->item_type_id;
        $item_type_name = $rows->item_type_name;

        ?>
						<option value="<?php echo $item_type_id?>" >
							<?php echo $item_type_name ?>
						</option>
            <?php }

?>
					</select>
				</div>

			</div>
				<input type="submit" name="submit" class="btn btn-success" value="Submit">

			</div>

		</div>
<?php echo form_close();?>
</body>

</html>
