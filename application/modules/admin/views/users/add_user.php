<?php if (!defined('BASEPATH')) {exit('No direct script access allowed'); } 
echo form_open_multipart($this->uri->uri_string()); ?>
	<div class="shadow-lg p-3 mb-5 mt-5 bg-white rounded">
		<div class="card shadow mb-4 mt-4">
			<div class="card-header py-3">
				<div class="row">
					<div class="col-md-6">
							<div class="col-md-6 mb-3">
							<div>
								<?php $row=$user_type_rows->row();
								//echo json_encode();die();
								if(isset($row)){
								?>								
								<input class="form-control" value="<?php echo $row->user_type_name; }?>" type="hidden" name="user_type">
							</div>
								<label for='first_name'>First Name: </label><input class="form-control" type="text" value="<?php echo $first_name;?>"  name="first_name">
							</div>
							<div class="col-md-6 mb-3">
								<label for='last_name'>Last Name: </label>
								<input class="form-control" value="<?php echo $last_name;?>" type="text" name="last_name">
							</div>
							<div class="col-md-6 mb-3">
								<label for='phone_number'>Phone Number: </label>
								<input class="form-control" type="text" value="<?php echo $phone_number;?>" name="phone_number">
							</div>
							<div class="col-md-6 mb-3">
								<label for='username'>Username: </label>
								<input type="text" class="form-control" value="<?php echo $username;?>" name="username">
							</div>
							<div class="col-md-6 mb-3">
								<label for='user_email'>Email: </label>
								<input type="email" class="form-control" value="<?php echo $user_email;?>" name="user_email">
							</div>
							<div class="col-md-6 mb-3">
								<label for='password'>Password: </label>
								<input type="password" class="form-control" value="<?php echo $password;?>" name="password">
							</div>
							<div class="col-md-6 mb-3">
								<label for='username'>Location: </label>
								<!-- <//?php echo form_dropdown('location_id', $locations, '', 'class="form-control" name=location');?>  -->
							</div>
							<div class="form-group">
								<label>Image</label>
								<input type="file" id="profile_icon" name="profile_icon">
								<!-- <input type="submit" class="btn btn-primary" value="upload"> -->
							</div>
								<input class="btn btn-dark" type="submit" value="Add" style="margin-left:20px;">
							<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>
