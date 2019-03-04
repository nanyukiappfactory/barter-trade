<?php if (!defined('BASEPATH')) 
exit('No direct script access allowed');  ?>
<!DOCTYPE html>
<html>
<head>
<style>

</style>

</head>

<body>

	
	
<div class="row">
        <div class="col-md-6">
            
                <div class="form-row">
		
		<?php if (!empty($validation_errors)) {
    echo $validation_errors;
}
?>
			
		<?php echo form_open_multipart($this->uri->uri_string()); ?>
		<section>
		<div class="form-group">

			<label for="category"><b>Select Category</b></label>
			<select name="category_name" id="categories" class="form-control form-control-lg inputform">
			<?php 
                foreach($categories->result() as $row){
                  $category_name =  $row->category_name;
                  $category_id =  $row->category_id;
                  // echo $bank_name;
                
                ?>
				<option value="<?php echo $category_id; ?>">
					<?php echo $category_name; ?>
				</option>
				<?php } ?>			

			</select>
		</div>

		<div class="form-group">
			<label for='item_name'>Item Name: </label>
			<input class="form-control" type="text" name="item_name">
		</div>
		<div class="form-group">
			<textarea name="item_description" rows="10" cols="30">describe the item..</textarea>
		</div>
		<div class="form-group">
			<label for='item_cost'>Estimated Value: </label>
			<input class="form-control" type="text" name="item_cost">
		</div>
		<div class="form-group">
                 <label>Select Item Image</label>
                   <input type="file"  id="item_image" name="item_image_name">
                 
 
             
        </div>
				
</div>
</section>
<div class="form-group">
<h2>Desired item</h2>
<div class="row">
<div class="col-md-4 col-sm-12">
<div class="form-group">
<label>Item 1</label>
<input type="text" class="form-control" name="item1">
<label>Item 2</label>
<input type="text" class="form-control" name="item2">
<label>Item 3</label>
<input type="text" class="form-control" name="item3">

</div>
</div>
</div>
		
		<div>
			<input type="submit" value="Add" class="button1">
		</div>
		<?php echo form_close(); ?>
	
</div>

</div>
</div>

</div>

</body>

</html>
