<?php
include 'header.php';
?>

<div class="container">
    <br>

    <div class="col-md-6 col-md-offset-3">

        <div class="panel panel-success" style="padding: 20px !important">
            <?php
            if(!empty($msg)){ echo $msg;
              
            }
            ?>
           
            <div class="panel-heading text-center lead">Edit Bin</div>
            <br>
            <form role="form" method="post" action="<?php echo base_url(); ?>super_admin_c/update_bin/<?php echo $bin->bin_id ?>">
                <div class="form-group">
                    <label for="name">Bin Name/Number*:</label>
                    <input type="text" name="bin_number" class="form-control" id="name" value="<?php echo $bin->bin_number ?>">
                </div>

                <div class="form-group">
                    <label for="name">Created Date:</label>
                    <input type="text" name="created_date" class="form-control" id="datepicker" value="<?php echo $bin->created_date ?>">
                </div>
                <div class="form-group">
                    <label for="email">Updated Date:</label>
                    <input type="text" name="updated_date" class="form-control" id="updatepicker" value="<?php echo $bin->updated_date ?>">
                </div>
                <div class="form-group">
                    <label for="email">status:</label>
                    <input type="text" name="status" class="form-control" id="email" value="<?php echo $bin->status ?>">
                </div>

                <div class="checkbox">
                    <input type="hidden" value="<?php echo $bin->project_id ?>" name="bin_id">
                </div>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>