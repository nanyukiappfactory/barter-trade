<?php if (!defined('BASEPATH')) {exit('No direct script access allowed'); } 
echo form_open_multipart($this->uri->uri_string()); ?>
<div class="container">
	<div class="shadow-lg p-3 mb-5 bg-white rounded">
		<div class="card shadow mb-4 mt-4">
			<div class="card-header py-3">
				<div class="row">
					<div class="col-md-6">
						<div class="col-md-6 mb-3">
						<label>User Type</label>
							<select class="selectpicker form-control pl-5" data-style="btn-outline-primary"  name="user_type">
							<optgroup  data-max-options="2">
								<option <?php 
								if($users->result()>0)
								{
									foreach($users->result() as $row)
									{
										$user_type_id_FK=$row->user_type_id;
										foreach($user_type->result() as $rows)
										{
											$user_type_id_PK=$rows->user_type_id;
											$user_type_name=$rows->user_type_name;

											if($user_type_id_PK=$user_type_id_FK)
											{ ?>
												value="<?php echo $user_type_id_PK ?>" > 
											
										<?php 
											echo $user_type_name; 
											break;
											}                                
										}  
									}
									foreach ($user_type->result() as $rows) {
										$user_type_id = $rows->user_type_id;
										$user_type_name = $rows->user_type_name;
								?>
								</option>
								<option value="<?php echo $user_type_id ?>">
									<?php echo $user_type_name ?>
								</option>
							<?php } }?>
							</select>
						</div>
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
								<input type="text" class="form-control" name="username" value="<?php echo $username;?>">
							</div>
							<div class="col-md-6 mb-3">
								<label for='user_email'>Email: </label>
								<input class="form-control" ype="email" name="user_email" value="<?php echo $user_email;?>">
							</div>
							<div class="col-md-6 mb-3">
								<label for='username'>Location: </label>
								<!-- <//?php echo form_dropdown('location_id', $locations, '', 'class="form-control" name=location');?>  -->
							</div>
							<div class="form-group">
								<label>Image</label>
								<input type="file" id="profile_icon" value="<?php echo	$profile_icon;?>" name="profile_icon">
							</div>
							<div>
							<input class="btn btn-dark" type="submit" value="Update" style="margin-left:20px;">
							</div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>