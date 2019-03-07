<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
if (!empty($validation_errors))
 {
    echo $validation_errors;
 } 
    echo form_open_multipart($this->uri->uri_string()); ?>
    <div class="shadow-lg p-3 mb-5 mt-5 bg-white rounded">
        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label>Category Parent</label>
                                <select name="category_parent" class="form-control">
                                <option value="0">no_parent</option>
                                    <option selected="selected">
                                  <?php
                                  if($category_parent==0)
                                  {
                                      echo "no_parent";
                                  }
                                  else
                                  {
                                  foreach ($category->result() as $row)
                                  {
                                      if($row->category_id==$category_parent)
                                      {
                                          echo $row->category_name;
                                          break; 
                                      }
                                  }
                                }
                                        foreach ($category->result() as $rows) {
                                            $category_id = $rows->category_id;
                                            $category_name = $rows->category_name;

                                            ?>

                                    <option value="<?php echo $category_id ?>">
                                        <?php echo $category_name ?>
                                    </option>
                                    <?php }
                                    ?>

                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Category Name</label>
                                <input type="text" class="form-control" name="category_name"
                                    placeholder="Enter category name" value="<?php echo $name?>">
                            </div>
                            <div class="form-group">
                                <label>Category Image</label>
                                <input type="file" id="category_image" name="category_image">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <a href="<?php echo site_url('categories/all-categories/'); ?>"
                                            class="btn btn-secondary">Back</a>
                                        <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
<?php echo form_close(); ?>