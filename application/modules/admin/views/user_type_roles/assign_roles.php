<?php if (!defined('BASEPATH')) 
{
    exit('No direct script access allowed');
} if (!empty($validation_errors)) {
    echo $validation_errors;
}
 echo form_open($this->uri->uri_string()); ?>
<div class="shadow-lg p-3 mb-5 mt-5 bg-white rounded">
	<div class="row">
		<div class="col-md-4 col-sm-12">
			<div class="form-group">
				<select class="selectpicker form-control pl-5" data-style="btn-outline-primary"  name="role_name">
					<optgroup  data-max-options="2">
					<option value="" disabled selected>Select Role Name...
						<?php
							foreach ($user_type_role->result() as $rows) {
								$role_id = $rows->role_id;
								$role_name = $rows->role_name;
						?>
					<option value="<?php echo $role_id ?>">
							<?php echo $role_name ?>
					</option>
						<?php }?>
				</select>
					<br>
				<select class="selectpicker form-control pl-5" data-style="btn-outline-primary" name="user_type_name">
					<optgroup  data-max-options="2">
					<option value="" disabled selected>Select User Type Name...
						<?php
							foreach ($user_type_role->result() as $rows) {
								$user_type_id = $rows->user_type_id;
								$user_type_name = $rows->user_type_name;
    					?>
						<option value="<?php echo $user_type_id ?>">
							<?php echo $user_type_name ?>
						</option>
						<?php }?>
					</select>
				</div>
			</div>
		</div>
		<input type="submit" name="submit" class="btn btn-success" value="Submit">
	</div>
<?php echo form_close(); ?>
