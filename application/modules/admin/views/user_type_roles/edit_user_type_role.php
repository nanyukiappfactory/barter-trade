<?php if (!defined('BASEPATH')) {exit('No direct script access allowed'); } 
echo form_open_multipart($this->uri->uri_string()); ?>
<div class="shadow-lg p-3 mb-5 mt-5 bg-white rounded">
	<div class="row">
		<div class="col-md-4 col-sm-12">
			<div class="form-group">
				<select class="selectpicker form-control pl-5" data-style="btn-outline-primary"  name="role">
                    <option value="" disabled selected><?php 
                    if($all_user_type_roles->result()>0)
                    {
                        foreach($all_user_type_roles->result() as $row){
                            $role_id_FK=$row->role_id;
                            foreach($user_type_role->result() as $rows){
                                $role_id_PK=$rows->role_id;
                                $role_name=$rows->role_name;
                                if($role_id_PK=$role_id_FK)
                                {   
                                   echo $role_name; 
                                   break;
                                }
                                
                            }  
                        }
                    }
                    
							foreach ($user_type_role->result() as $rows) {
								$role_id = $rows->role_id;
								$role_name = $rows->role_name;
						?>
					<option value="<?php echo $role_id ?>">
							<?php echo $role_name ?>
					</option>
						<?php }?>
				</select>
					<br>
				<select class="selectpicker form-control pl-5" data-style="btn-outline-primary" name="user_type">					
					<option value="" disabled selected>                    
                    <?php
                     if($all_user_type_roles->result()>0)
                     {
                         foreach($all_user_type_roles->result() as $row){
                             $user_type_id_FK=$row->user_type_id;
                             foreach($user_type_role->result() as $rows){
                                 $user_type_id_PK = $rows->user_type_id;
                                 $user_type_name = $rows->user_type_name;
                                 if($user_type_id_PK==$user_type_id_FK)
                                 {                                      
                                    echo $user_type_name;   
                                    break;                                                         
                                 }
                                 
                             }  
                         }
                     }
							foreach ($user_type_role->result() as $rows) {
								$user_type_id = $rows->user_type_id;
								$user_type_name = $rows->user_type_name;
    					?>
						<option value="<?php echo $user_type_id ?>">
							<?php echo $user_type_name ?>
						</option>
						<?php }?>
					</select>
				</div>
			</div>
		</div>
		<input type="submit" name="submit" class="btn btn-success" value="Update">
        <a href="<?php echo site_url('user-type-roles/all-user-type-roles/'); ?>"
        class="btn btn-secondary">View</a>
	</div>
<?php echo form_close(); ?>
