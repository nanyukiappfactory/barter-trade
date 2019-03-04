<?php if (!defined('BASEPATH')) 
exit('No direct script access allowed');  ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>items</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>assets/themes/custom/styles.css">

</head>

<body >
	<div style="margin-top:250px;margin-left:250px;">
	<?php echo "There are ".$all_items->num_rows()." items."?>
</div>
</body>
</html>