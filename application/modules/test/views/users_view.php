<!DOCTYPE html> 
<html> 
<title>CI DB Dropdown input</title> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
 
<body> 
    <div class="col-sm-4"> 
        <br> 
        <br> 
        <h2>Our Dropdown input Demo</h2> 
        <br> 
        <br> 
        <div class="panel panel-default"> 
            <div class="panel-heading">The form</div> 
            <div class="panel-body"> 
                <!--dropdown input--> 
                <label class="title">Job position: </label> 
                <?php echo form_dropdown('user_id', $users, '', 'class="form-control"');?> 
                    <br> 
                    <br> 
                    <button type="submit" class="btn btn-info">Submit</button> 
            </div> 
        </div> 
    </div> 
</body> 
 
</html>