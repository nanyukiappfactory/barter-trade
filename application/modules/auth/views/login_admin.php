<?php echo form_open($this->uri->uri_string(), array("class" => "form-signin")); ?>
<img class="mb-4" src="<?php echo base_url(); ?>assets/images/lock.png" alt="" width="72" height="72">
<h1 class="h3 mb-3 font-weight-normal">Admin Login</h1>
<label for="inputEmail" class="sr-only">Email address</label>
<input type="text" name="user" id="user" class="form-control" placeholder="Email address" autofocus>
<label for="inputPassword" class="sr-only">Password</label>
<input type="password" name="password" id="password" class="form-control" placeholder="Password">

<button class="btn btn-lg btn-primary btn-block" type="submit">login</button>

<?php echo form_close(); ?>
<title>
<?php echo $title; ?>
</title>
