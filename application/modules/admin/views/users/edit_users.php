<?php if (!defined('BASEPATH')) 
exit('No direct script access allowed');  ?>
<!DOCTYPE html>
<html>
<body>
<div class="container">
	<div class="shadow-lg p-3 mb-5 bg-white rounded">
		<div class="card shadow mb-4 mt-4">
			<div class="card-header py-3">
				<div class="row">
					<div class="col-md-6">
						<div class="form-row">
							<?php if (!empty($validation_errors)) {
    echo $validation_errors;
}
?>
							<?php echo form_open_multipart($this->uri->uri_string()); ?>
							<div class="col-md-6 mb-3">
								<label for='first_name'>First Name: </label>
								<input class="form-control" type="text" name="first_name" value="<?php echo $first_name;?>">
							</div>
							<div class="col-md-6 mb-3">
								<label for='last_name'>Last Name: </label>
								<input class="form-control" type="text" name="last_name" value="<?php echo $last_name;?>">
							</div>
							<div class="col-md-6 mb-3">
								<label for='phone_number'>Phone Number: </label>
								<input class="form-control" type="text" name="phone_number" value="<?php echo $phone_number;?>">
							</div>
							<div class="col-md-6 mb-3">
								<label for='username'>Username: </label>
								<input type="text" name="username" value="<?php echo $username;?>">
							</div>
							<div class="col-md-6 mb-3">
								<label for='user_email'>Email: </label>
								<input type="email" name="user_email" value="<?php echo $user_email;?>">
							</div>

							<div class="col-md-6 mb-3">
								<label for='username'>Location: </label>
								<!-- <//?php echo form_dropdown('location_id', $locations, '', 'class="form-control" name=location');?>  -->
							</div>
							<div class="form-group">
								<label>Image</label>
								<input type="file" id="profile_icon" name="profile_icon" <?php echo $last_name;?>>
							</div>
							<div>
							<input class="btn btn-dark" type="submit" value="Add" style="margin-left:20px;">
							</div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
