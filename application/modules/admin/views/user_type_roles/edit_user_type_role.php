 <?php
    $option='';
    $role_option='';
    if($single_user_type_roles->result()>0)
    {
        foreach($single_user_type_roles->result() as $row)
        {
            $user_type_id_FK=$row->user_type_id;
            $role_id_FK=$row->role_id;

            foreach($user_types->result() as $rows)
            {
                $user_type_id_PK = $rows->user_type_id;
                $user_type_name = $rows->user_type_name;
                
                if($this->session->flashdata('error'))
                {
                    if($user_type_id_PK == $user_type_name_validate)
                    {
                        $selected = "selected";
                    }
                    else
                    {
                        $selected = "";
                    } 
                }
                else
                {
                    if($user_type_id_PK == $user_type_id_FK)
                    {
                        $selected = "selected";
                    } 
                    else{
                        $selected = "";
                    } 
                }
                  
                $option .='<option value="'.$user_type_id_PK.'"' .  $selected .'>'.$user_type_name.'</option>';        
            }
            foreach($roles->result() as $rows)
            {
                $role_id_PK = $rows->role_id;
                $role_name = $rows->role_name;

                if($this->session->flashdata('error'))
                {
                    if($role_id_PK == $role_name_validate)
                    {
                        $selected = "selected";
                    }
                    else
                    {
                        $selected = "";
                    } 
                }
                else
                {
                    if($role_id_PK == $role_id_FK)
                    {
                        $selected = "selected";
                    } 
                    else{
                        $selected = "";
                    } 
                }
                  
                $role_option .='<option value="'.$role_id_PK.'"' .  $selected .'>'.$role_name.'</option>';   
            }  
            
        } 
    }
?>
<?php echo form_open_multipart($this->uri->uri_string()); ?>
    <div class="shadow-lg p-3 mb-5 mt-5 bg-white rounded">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                <label for='role_name'>Role Name: </label>
                    <select class="selectpicker form-control pl-2" data-style="btn-outline-primary"  name="role_name">
                        <?php echo $role_option?>
                    </select >
                        <br>
                    <label for='user_type_name'>User Type Name: </label>
                    <select class="selectpicker form-control pl-2" data-style="btn-outline-primary" name="user_type_name">					
                        <?php echo $option?>
                    </select>
                </div>
            </div>
        </div>
        <input type="submit" name="submit" class="btn btn-success" value="Update">
        <a href="<?php echo site_url('user-type-roles/all-user-type-roles/'); ?>"
        class="btn btn-secondary">View</a>
    </div>
<?php echo form_close(); ?>
