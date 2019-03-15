<?php
echo form_open_multipart($this->uri->uri_string()); ?>
<div class="shadow-lg p-3 mb-5 mt-5 bg-white rounded">
		<div class="card shadow mb-4 mt-4">
			<div class="card-header py-3">
				<div class="row">
					<div class="col-md-6">
							<div class="col-md-6 mb-3">
								<label for='first_name'>First Name: </label>
								<input class="form-control" type="text" value="<?php echo $first_name;?>"  name="first_name">
							</div>
							<div class="col-md-6 mb-3">
								<label for='last_name'>Last Name: </label>
								<input class="form-control" value="<?php echo $last_name;?>" type="text" name="last_name">
							</div>
							<div class="col-md-6 mb-3">
								<label> User Type</label>
								<select class="selectpicker form-control" data-style="btn-outline-primary"  name="user_type">
									<?php
										if($user_type->result()!=null)
										{
											foreach ($user_type->result() as $rows)
											{
												$user_type_id = $rows->user_type_id;
												$user_type_name = $rows->user_type_name;
												if($user_type_id==$user_types)
												{?>
													<option value="<?php echo $user_types;?>"><?php echo $user_type_name;?></option>
									<?php 
												}
											}
										}
									?>
									<?php
										if($user_type->result()!=null)
										{
											foreach ($user_type->result() as $rows)
											{
												$user_type_id = $rows->user_type_id;
												$user_type_name = $rows->user_type_name;?>
												<option value="<?php echo $user_type_id; ?>">
												<?php echo $user_type_name; ?>
									<?php 
											}
										}
									?>
										</option>
										
								</select>
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
							</div>
							<div class="form-group">
								<label>Image</label>
								<input type="file" id="profile_icon" name="profile_icon">
							</div>
								<input class="btn btn-dark" type="submit" value="Add" style="margin-left:20px;">
								<?php echo form_close(); ?>
								<a href="<?php echo site_url('users/all-users/'); ?>"
								class="btn btn-secondary">View</a>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>
