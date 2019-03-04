<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
?>
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
	<?php echo form_open($this->uri->uri_string()); ?>
	<div class="shadow-lg p-3 mb-5 mt-5 bg-white rounded">

			<div class="row">
				<div class="col-md-4 col-sm-12">
					<div class="form-group">

					<select class="selectpicker form-control pl-5" data-style="btn-outline-primary"  name="role_name">
					<optgroup label="Condiments" data-max-options="2">
					<option value="" disabled selected>Select Role Name...
						<?php

foreach ($roles->result() as $rows) {
    $role_id = $rows->role_id;
    $role_name = $rows->role_name;

    ?>
						<option value="<?php echo $role_id ?>">
							<?php echo $role_name ?>
						</option>

						<?php }

?>

					</select>
				
			<br>
					<select class="selectpicker form-control pl-5" data-style="btn-outline-primary" name="user_type_name">
					<optgroup label="Condiments" data-max-options="2">
					<option value="" disabled selected>Select User Type Name...
						<?php

foreach ($user_types->result() as $rows) {
    $user_type_id = $rows->user_type_id;
    $user_type_name = $rows->user_type_name;

    ?>
						<option value="<?php echo $user_type_id ?>">
							<?php echo $user_type_name ?>
						</option>
						<?php }

?>
					</select>
				</div>

			</div>
			</div>
		<input type="submit" name="submit" class="btn btn-success" value="Submit">
		</div>
	<?php echo form_close(); ?>
</body>

</html>
