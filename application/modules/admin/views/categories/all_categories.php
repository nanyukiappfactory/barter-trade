<div class="shadow-lg p-3 mb-5  mt-5 bg-white rounded">
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <?php echo form_open("categories/search-category", array('class' => "form-control form-control-dark w-100 bg-white")); ?>
                <input type="search" placeholder="search by category" name="search">
                <button name="Submit" type="submit">search</button>
            <?php echo form_close(); ?>
            <?php echo anchor("categories/close-search/", "clear search", array('class' => "btn btn-secondary")); ?>
            <?php echo anchor("categories/add-category/", "add category",array('class'=>"btn btn-secondary")); ?>
                <table class="table table-sm">
                    <tr>
                        <th>#</th>
                        <th>
                        <a href="<?php echo site_url()."categories/all-categories/category_name/". $order_method."/".$page;?>">Category Name</a> 
                        </th>
                        <th>Parent</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        if ($all_categories->num_rows() > 0) {
                            $count = $page;
                            foreach ($all_categories->result() as $row) {
                                {
                                    $count++;
                                    $id = $row->category_id;
                                    $category_name = $row->category_name;
                                    $category_parent = $row->category_parent;
                                    $category_image = $row->category_image;
                                    $check = $row->category_status;

                    ?>
                    <tr>
                        <td>
                            <?php echo $count; ?>
                        </td>
                        <td>
                            <?php echo $category_name; ?>
                        </td>
                        <td>
                        <?php
                        if($category_parent == 0)
                        {
                            echo "no parent ";
                        }
                        else
                        {
                            foreach ($categories->result() as $rows)
                            {
                                if($category_parent == $rows->category_id){
                                    echo $rows->category_name;
                                } 
                            }   
                        }   ?>                       
                        
                        </td>

                        <td><img class="thumbnail" style="height: 100px; width: 100px;"
                                src="<?php echo base_url(); ?>assets/uploads/<?php echo $row->category_image; ?>" />
                        </td>
                        <td>

                            <?php 
                            if ($check == 0) 
                            {
                                    echo "<button class='badge badge-danger'> deactivated</button>";
                            } else 
                            {
                                echo "<button class= 'badge badge-success'>active</button>";
                            }
                            ?>
                        </td>
                        <td>
                            <a href="#category<?php echo $id ?>" class="btn btn-primary" data-toggle="modal"
                                data-target="#category<?php echo $id ?>"><i class="fas fa-eye"></i></a>
                            <!-- Button trigger modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="category<?php echo $id ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                <?php echo $category_name; ?>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table">
                                                <tr>
                                                    <th>#
                                                    </th>
                                                    <th>Category Parent
                                                    </th>
                                                    <th>Category Name
                                                    </th>
                                                    <th>Image
                                                    </th>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <?php echo $count; ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                        if($category_parent == 0)
                                                        {
                                                            echo " ";
                                                        }
                                                        else
                                                        {
                                                            foreach ($all_categories->result() as $rows)
                                                            {
                                                                if($rows->category_id==$category_parent)
                                                                {
                                                                    echo $rows->category_name;
                                                                    break; 
                                                                }
                                                            }
                                                        }                                                         
                                                        ?> 
                                                    </td>
                                                    <td>
                                                        <?php echo $category_name; ?>
                                                    </td>
                                                    <td><img class="thumbnail" style="height: 100px; width: 100px;"
                                                            src="<?php echo base_url(); ?>assets/uploads/<?php 
                                                            if($row->category_image !== NULL){
                                                                echo $row->category_image;
                                                            }else{
                                                                echo "default_image.JPG";
                                                            }
                                                             ?>" />
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-warning">
                                <?php echo anchor("categories/edit-category/" . $id, "<i class='fas fa-edit'></i>"); ?></button>
                            <?php
                                if ($check == 1) {
                                    echo anchor("categories/deactivate-category/" . $id, '<i class="far fa-thumbs-down"></i>', array("onclick" => "return confirm('Are you sure to deactivate?')", "class" => "btn btn-danger"));

                                } else {
                                    echo anchor("categories/activate-category/" . $id, '<i class="far fa-thumbs-up"></i>', array("onclick" => "return confirm('Are you sure to activate?')", "class" => "btn btn-success"));
                                }
                            ?>
                            </button>
                            <button class="btn btn-danger" onclick="return confirm('Are you sure to delete?')">
                                <?php echo anchor("categories/delete-category/" . $id, "<i class='fas fa-trash-alt'></i>"); ?></button>
                        </td>
                    </tr>
                            <?php 
                        }
                    }
                        
                }?>
                </table>
            </div>
        </div>        
    <?php echo $links ?>
</div>