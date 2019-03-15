<nav class="navbar navbar-dark fixed-top  flex-md-nowrap p-0 shadow">

    <a class="navbar-brand col-md-2 d-none d-md-block  mt-50" href="#">
        <img src="<?php echo base_url(); ?>assets/images/admin.png" width="50" height="50"
            class="d-inline-block align-top" alt="">
        <span style="font-family: 'Signika', sans-serif;font-size:35px;">Admin</span>
    </a>
    <?php
    echo form_open($search, array('class' => "btn btn-secondary")); ?>
    <input type="search" placeholder="Search" name="search">
    <button name="Submit" type="submit">Submit</button>    
    <?php
    echo anchor($close,'<i class="far fa-times-circle"></i>',array('class'=>"btn btn-secondary"));
    echo form_close(); ?>
     <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <?php echo anchor("auth/auth/admin_logout", "Logout", "class='btn btn-dark'"); ?>
        </li>
    </ul>
</nav>