<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen"
        href="<?php echo base_url() ?>assets/themes/custom/styles.css" />

</head>

<body>
    <?php if (!empty($validation_errors)) {
    		echo $validation_errors;
		}?>
    <?php echo form_open_multipart($this->uri->uri_string()); ?>
    <div class="shadow-lg p-3 mb-5 mt-5 bg-white rounded">
        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label>Category Parent</label>
                                <select name="category_parent" class="form-control">
                                    <option selected="selected">no_parent</option>
                                    <?php
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
                                    placeholder="Enter category name">

                            </div>


                            <div class="form-group">
                                <label>Category Image</label>
                                <input type="file" id="category_image" name="category_image">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <a href="<?php echo site_url('categories/add-category/'); ?>"
                                            class="btn btn-secondary">Back</a>
                                        <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
</body>
</html>