<?php 
	$result = '';
	if($all_users->num_rows() > 0)
	{
		$count=$page;
		foreach($all_users->result() as $row)
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
			$modal_data = array(
				"id" => $id,
				"first_name" => $first_name,
				"last_name" => $last_name,
				"phone_number" => $phone_number,
				"username" => $username,
				"user_email" => $user_email,
				"profile_icon" => $profile_icon,
				"profile_thumb" => $profile_thumb,
				"check" => $check,					
			);
			if($check == 0)
			{
				$status = anchor("users/activate-user/".$id,'<i class="far fa-thumbs-up"></i>', array("onclick"=>"return confirm('Are you sure to activate?')", "class"=>"btn btn-success"));
			}
			else
			{
				$status = anchor("users/deactivate-user/".$id,'<i class="far fa-thumbs-down"></i>', array("onclick"=>"return confirm('Are you sure to deactivate?')","class"=>"btn btn-danger", 'data-toggle'=>'modal'));
			}
			if($check == 0)
			{
				$status_activation= "<button class='badge badge-danger' data-toggle='modal'>deactivated</button>";
			}
			else
			{
				$status_activation="<button class= 'badge badge-success' data-toggle='modal'>active</button>";
			}
			$result .= '<tr>
				<td>'.$count.'</td>
				<td><img class="thumbnail" style="height: 100px; width: 100px;" src="'.base_url().'assets/uploads/'. $row->profile_thumb.'" /></td>
				<td>'.$first_name.'</td>
				<td>'.$last_name.'</td>
				<td>'.$phone_number.'</td>
				<td>'. $username.'</td>
				<td>'.$user_email.'</td>
				<td>'.$status_activation.'</td>
			';
			
			$edit_url = "users/edit-user/". $id;
			$delete_url = "users/delete-user/".$id;

			$edit_icon = '<i class="fas fa-edit"></i>';
			$delete_icon = '<i class="fas fa-trash-alt"></i>';

			$delete_alert = 'Are you sure to delete?';
			$result .='
				<td>
					<a href="#modalLoginAvatar'.$id.'" class="btn btn-primary" data-toggle="modal" data-target="#modalLoginAvatar'.$id.'">
						<i class="fas fa-eye"></i>
					</a>
					<button class="btn btn-warning">' . anchor($edit_url, $edit_icon) . '</button>' . $status . 
					'<button class="btn btn-danger" data-toggle="modal" onclick="return confirm(' . $delete_alert . ')">' .anchor($delete_url, $delete_icon) . 
					'</button>
				</td> 
			</tr>
			';
			$this->load->view("admin/users/user_modal", $modal_data);
		}
	}		
?>		
<div class="shadow-lg p-3 mb-5 mt-5 bg-white rounded">
	<div class="card-header py-3">
		<div class="form-row">
			<?php echo anchor ("users/add-user/", "add user", array('class'=>"btn btn-primary col-md-2 mb-2")). " "; ?>
			<button class="fas fa-search btn btn-secondary col-md-2 mb-2" id="search_icon" name="search_icon" style="display:block" ></button>
			<?php
				if($this->session->userdata("user_search_params"))
				{
					echo anchor("users/close-search",'close search session',array('class'=>"btn btn-info col-md-2 mb-2", 'style'=>"display:block"));
				}
				else
				{
					echo anchor("users/close-search",'close search session',array('class'=>"btn btn-info col-md-2 mb-2", 'style'=>"display:none"));
				}
			?>
		</div>
	</div>
	<?php echo form_open("users/search-user"); ?>
		<div class="form-row">
			<div id="search_items" name="search_parameters" class="form-group search" style="display:none">
				<input placeholder="Enter User Name" id="first_name" name="first_name">
				<input placeholder="Enter Last Name" id="last_name" name="last_name">
				<input placeholder="Enter Email" id="email" name="user_email">
				<input placeholder="Enter Phone No." id="phone_number" name="phone_number">
				<button class ="col-md-2 mb-2 btn btn-secondary" name="Submit" type="submit">Submit</button> 
			</div> 
		</div>  
	<?php echo form_close(); ?>
	<script>
		document.getElementById("search_icon").addEventListener("click", execute_search);

		function execute_search()
		{
			if(document.getElementById("search_icon").clicked!=true)
			{
				document.getElementById("search_items").style.display="block";
			}
		}
	</script>
</div>
<table class="table table-sm table-bordered table-responsive">
	<tr>
		<th>Count</th>
		<th>Image</th>
		<th><a href="<?php echo site_url()."users/all-users/first_name/". $order_method."/".$page;?>">FirstName</a></th>
		<th><a href="<?php echo site_url()."users/all-users/last_name/". $order_method."/".$page;?>">Last Name</a></th>
		<th><a href="<?php echo site_url()."users/all-users/phone_number/". $order_method."/".$page;?>">Phone Number</a></th>
		<th><a href="<?php echo site_url()."users/all-users/username/".$order_method."/".$page;?>">Username</a></th>
		<th><a href="<?php echo site_url()."users/all-users/user_email/". $order_method."/".$page;?>">Email</a></th>
		<th><a href="<?php echo site_url()."users/all-users/user_status/". $order_method."/".$page;?>">Status</a></th>
		<th>Actions</th>
	</tr>
	<?php echo $result;?>
</table>
<?php echo $links;?>

