<?php if (!defined('BASEPATH')) 
exit('No direct script access allowed');  ?>
<?php
// List up all results.
foreach ($results as $val)
{
echo $val['itemname'];
}
?>
</div> -->
 <html>
 <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- <script src="main.js"></script> -->
</head>
<body>
    <div class="container">
 
        <h1>Search Results </h1>
 
        <table>
            <tr>
                <!-- <th>#</th> -->
                <th>First Name</th>
                <th>Last Name</th>
                <th>itemname</th>
                <th>Email</th>
            </tr>
            <?php
foreach ($results as $row) {
?>
<tr>
<td>
<?php echo $row['first_name']; ?>
</td>
<td>
<?php echo $row['last_name']; ?>
</td>
<td>
<?php echo $row['itemname']; ?>
</td>
<td>
<?php echo $row['item_email']; ?>
</td>
</tr>
<?php
}
 
?>
        </table>
 
    </div>
</body>
</html>