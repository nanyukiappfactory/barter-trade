<?php if (!defined('BASEPATH')) 
exit('No direct script access allowed');  ?>
<!DOCTYPE html>
<html>
<body>
	<div class="shadow-lg p-3 mb-5 mt-5 bg-white rounded">
		<div class="card shadow mb-4 mt-4">
			<div class="card-header py-3">
				<div class="row">
					<div class="col-md-6">
							<?php if (!empty($validation_errors)) {
    echo $validation_errors;
}
?>
							<?php echo form_open_multipart($this->uri->uri_string()); ?>
							<div class="col-md-6 mb-3">
								<label for='user_type_name'>User Type Name: </label><input class="form-control" type="text" name="user_type_name">
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
</body>
</html>
