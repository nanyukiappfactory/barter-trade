<div class="container">
  <div class="shadow-lg p-3 mb-5 bg-white rounded">
    <div class="card shadow mb-4 mt-4">
      <div class="card-header py-3">
        <div class="row">
          <div class="col-md-6">
            <div class="form-row">
              <?php echo form_open_multipart($this->uri->uri_string()); ?>
                <div class="col-md-6">
                  <label for='user_type_name'>User Type Name: </label>
                  <input class="form-control" type="text" name="user_type_name" value="<?php echo $user_type_name; ?>">
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
