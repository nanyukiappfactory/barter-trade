<?php
	$option='';
	$user_type='';
	foreach ($roles->result() as $new)
	{
		$role_id = $new->role_id;
		$role_name = $new->role_name;
		$option .='<option value="'.$role_id.'">'.$role_name.'</option>';
	}
	if($user_types->result()!=null)
	{
		foreach ($user_types->result() as $rows)
		{
			$user_type_id = $rows->user_type_id;
			$user_type_name = $rows->user_type_name;
			$user_type .='<option value="'.$user_type_id.'">'.$user_type_name.'</option>';
		 }
	}?>
<?php echo form_open_multipart($this->uri->uri_string()); ?>
	<div class="shadow-lg p-3 mb-5 mt-5 bg-white rounded">
		<div class="row">
			<div class="col-md-4 col-sm-12">
				<div class="form-group">
					<select class="selectpicker form-control pl-5" data-style="btn-outline-primary"  name="role_name">
							<option value="" disabled selected>Select Role Name...
							<?php echo $option ?>
					</select>
						<br>
					<select class="selectpicker form-control pl-5" data-style="btn-outline-primary" name="user_type_name">
						<option value="" disabled selected>Select User Type Name...
							<?php echo $user_type?>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-6 mb-3">
			<a href="<?php echo site_url('user-type-roles/all-user-type-roles/'); ?>"
				class="btn btn-secondary">View</a>
			<input type="submit" name="submit" class="btn btn-success" value="Submit">
    	</div>
	</div>
<?php echo form_close(); ?>
