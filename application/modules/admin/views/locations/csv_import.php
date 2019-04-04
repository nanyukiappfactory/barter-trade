 <?php echo form_open_multipart($this->uri->uri_string());?>
    <div class="col-md-9 ml-sm-auto col-lg-10 px-4 pt-5">
		<div class="card shadow mb-4 mt-4">
			<div class="card-header py-3">
				<div class="row">
                    <!-- <label>County:</label>
                    <input type="file" name="county"  id="csv_file" required accept=".csv" /><br>
                    </div> -->
                     <!-- <div class="col-md-6 mb-3">
                        <label>Constituency:</label><input type="file" name="constituency"  id="csv_file" required accept=".csv" /> <br>
                    </div> --> 
                <div class="col-md-6 mb-3">
                <label>Nearby Location:</label>
                <input type="file" name="nearby_location"  id="nearby_location" required accept=".csv" /> <br>
                </div> 
                </div> 
                    <button type="submit" name="import_csv" class="btn btn-info" id="import_csv_btn">Import CSV </button>
				</div>
                <div id="imported_csv_data"></div> 
			</div>
		</div>
	</div>	
<?php echo form_close(); ?>
<!-- <script>
$(document).ready(function()
{
    function load_data()
    {
        $.ajax({
            url:'<?php echo base_url() ?> assets/uploads', method:"POST",
            //success:function(data)
            {
                $("#imported_csv_data").html(data);
            }
        })
    }
    $('#import_csv').on('submit', function(event))
    {
        event.preventDefault();
        $.ajax({
            url:"<//?php echo base_url(); ?> csv_import/import",
            method:"POST",
            data:new FormData(this),
            contentType:false,
            cache:false,
            processData:false,
            beforeSend:function(){
                $('#import_csv_btn').html('Importing...');
            }, success:function(data) 
            {
               $('#import_csv')[0].reset();
               $('#import_csv_btn').attr('disabed',false);
               $('#import_csv_btn').html('import Done');
               load_data();
            }
        })
    });
});
</script>  -->
