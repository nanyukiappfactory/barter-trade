    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title><?php echo $title;?></title>
   
    <!-- Bootstrap core CSS -->
    
    <?php if(isset($login)){?>
        <link href="<?php echo base_url();?>assets/themes/custom/login.css" rel="stylesheet"/>
<?php }  else {?>
<link href="<?php echo base_url();?>assets/themes/custom/styles.css" rel="stylesheet"/>
<?php } ?>
<link href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<link href="<?php echo base_url();?>assets/vendor/fontawesome/css/all.css" rel="stylesheet">