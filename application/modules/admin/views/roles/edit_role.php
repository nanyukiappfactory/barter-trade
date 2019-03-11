<?php if (!defined('BASEPATH')) {exit('No direct script access allowed'); } ?>
    <div class="shadow-lg p-3 mb-5 mt-5 bg-white rounded">
        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label>Role Parent</label>
                                <select name="role_parent" class="form-control">
                                    <!-- <option value="" disabled selected>Select Parent... -->
                                    <option value="0">no_parent</option>
                                    <option selected="selected">
                                  <?php
                                  if($parent==0)
                                  {
                                      echo "no_parent";
                                  }
                                  else
                                  {
                                  foreach ($role->result() as $row)
                                  {
                                      if($row->role_id==$parent)
                                      {
                                          echo $row->role_name;
                                          break; 
                                      }
                                  }
                                }
                                        foreach ($role->result() as $rows) {
                                            $role_id = $rows->role_id;
                                            $role_name = $rows->role_name;
                                            ?>
                                    <option value="<?php echo $role_id ?>">
                                        <?php echo $role_name ?>
                                    </option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Role Name</label>
                                <input type="text" class="form-control" value="<?php echo $role_name?>" name="role_name" placeholder="Enter role name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="<?php echo site_url('roles/all-roles/'); ?>"
                                    class="btn btn-secondary">View</a>
                                <input type="submit" name="submit" class="btn btn-success" value="Submit">
                            </div>
                        </div>
                    </div>
                </div>
 <?php echo form_close(); ?>