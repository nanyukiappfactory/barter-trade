<div class="modal fade" id="modalLoginAvatar<?php echo $id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img  src="<?php echo base_url(); ?>assets/uploads/<?php echo $profile_thumb; ?>" alt="avatar" class="rounded-circle img-responsive"/>
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
                <button type="button" class="btn btn-primary"data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>