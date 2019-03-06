<?php if (!defined('BASEPATH')) 
exit('No direct script access allowed');  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>
		<?php echo $title;?>
	</title>
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>assets/themes/custom/styles.css" />
	<!-- <script src="main.js"></script> -->
</head>
<body>
	<div class="shadow-lg p-3 mb-5 mt-5 bg-white rounded">
		
		<div class="card shadow mb-4 mt-4">
		<div class="card-header py-3">
		<!-- <button type="button" class="btn btn-success">Add Partner</button> -->
		<button class="basic"  ><?php echo anchor ("users/add-user/", "add user", array('style'=>"font-color:black;")); ?></button>
		</div>
		</div>		
		<table class="table table-sm table-bordered table-responsive">
			<tr>
				<th>Count
				</th>
				<th>Image
				</th>
				<th><a href="<?php echo site_url()."users/all-users/first_name/". $order_method."/".$page;?>">First Name</a>   
				</th>
				<th><a href="<?php echo site_url()."users/all-users/last_name/". $order_method."/".$page;?>">Last Name</a>   
				</th>
				<th><a href="<?php echo site_url()."users/all-users/phone_number/". $order_method."/".$page;?>">Phone Number</a>  
				</th>
				<th><a href="<?php echo site_url()."users/all-users/username/". $order_method."/".$page;?>">Username</a>  
				</th>
				<th><a href="<?php echo site_url()."users/all-users/user_email/". $order_method."/".$page;?>">Email</a>  
				</th>
				<th><a href="<?php echo site_url()."users/all-users/user_status/". $order_method."/".$page;?>">Status</a>  
				</th>
				<th>Actions
				</th>
			</tr>
			<?php
            if($all_users->num_rows() > 0){
                $count=$page;
                foreach($all_users->result()
                 as $row){
                    {
                        $count++;
                        $id=$row->user_id;
                        $first_name=$row->first_name;
                        $last_name=$row->last_name;
                        $phone_number=$row->phone_number;
                        $username=$row->username;
                        $user_email=$row->user_email;
						$profile_icon=$row->profile_icon;
						$profile_thumb=$row->profile_thumb;
						$check=$row->user_status;
                        ?>
			<tr>
				<td>
					<?php echo $count;?>
				</td>
				<td><img class="thumbnail" style="height: 100px; width: 100px;" src="<?php echo base_url(); ?>assets/uploads/<?php echo $row->profile_thumb; ?>" /></td>
				<td>
					<?php echo $first_name;?>
				</td>
				<td>
					<?php echo $last_name;?>
				</td>
				<td>
					<?php echo $phone_number;?>
				</td>
				<td>
					<?php echo $username;?>
				</td>
				<td>
					<?php echo $user_email;?>
				</td>
				<td>
					<?php if($check==0)
					{
						echo "<button class='badge badge-danger' data-toggle='modal'> deactivated</button>";
					}
					else
					{
						echo "<button class= 'badge badge-success' data-toggle='modal'>active</button>";
					}
					?>
				</td>
				<td>
				<a href="#modalLoginAvatar<?php echo $id?>"  class="btn btn-primary" data-toggle="modal" data-target="#modalLoginAvatar<?php echo $id?>"><i class="fas fa-eye"></i></a>
				<button class="btn btn-warning"><?php echo anchor("users/edit-user/".$id,'<i class="fas fa-edit"></i>');?></button>
					 <?php
					 if($check==0){
						echo anchor("users/activate-user/".$id,'<i class="far fa-thumbs-up"></i>', array("onclick"=>"return confirm('Are you sure to activate?')", "class"=>"btn btn-success"));
					
					 }
					 else
					 {
						echo anchor("users/deactivate-user/".$id,'<i class="far fa-thumbs-down"></i>', array("onclick"=>"return confirm('Are you sure to deactivate?')","class"=>"btn btn-danger", 'data-toggle'=>'modal'));
					 }
					 ?>
                    <button class="btn btn-danger" data-toggle='modal' onclick="return confirm('Are you sure to delete?')"> <?php echo anchor("users/delete-user/".$id,"<i class='fas fa-trash-alt'></i>");?></button>
                     
				</td> <!-- Button trigger modal -->
					<div class="modal fade" id="modalLoginAvatar<?php echo $id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
					 aria-hidden="true">
						<div  class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
							<div class="modal-content">
								<div class="modal-header">
								<img  src="<?php echo base_url(); ?>assets/uploads/<?php echo $row->profile_thumb; ?>" alt="avatar" class="rounded-circle img-responsive"/>
											
								</div>
											<div class="modal-body  mb-1">
											<div class="md-form">
											<b>First Name:</b> <label data-error="wrong" data-success="right" for="form29" class="ml-0"><?php echo $first_name;?></label>
											</div>
								
											<div class="md-form ml-0 mr-0">
											<b>Last Name:</b> <label data-error="wrong" data-success="right" for="form29" class="ml-0"><?php echo $last_name;?></label>
											</div>
											<div class="md-form ml-0 mr-0">
											<b>Phone Number:</b> <label data-error="wrong" data-success="right" for="form29" class="ml-0"><?php echo $phone_number;?></label>
											</div>
											<div class="md-form ml-0 mr-0">
											<b>Username: </b><label data-error="wrong" data-success="right" for="form29" class="ml-0"><?php echo $username;?></label>
											</div>
											<div class="md-form ml-0 mr-0">
											<b>Email: </b><label data-error="wrong" data-success="right" for="form29" class="ml-0"><?php echo $user_email;?></label>
											</div>	
								</div>
								<div class="modal-footer">
									<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
									<button type="button" class="btn btn-primary"data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					</tr><?php }}} ?>
					</table>
		<?php echo $links;?>
	</div>
</body>
</html>
