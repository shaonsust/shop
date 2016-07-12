<?php
include 'header.php';
?>

<div class="container">
    <br>

    <div class="col-md-6 col-md-offset-3">

        <div class="panel panel-success" style="padding: 20px !important">
            <?php
            if(!empty($msg)){ echo $msg;}
            ?>
            <div class="panel-heading text-center lead">Edit Project</div>
            <br>
            <form role="form" method="post" action="<?php echo base_url(); ?>super_admin_c/update_projects/<?php echo $pro->id ?>">
                <div class="form-group">
                    <label for="name">Project Name*:</label>
                    <input type="text" name="project_name" class="form-control" id="name" value="<?php echo $pro->project_name ?>">
                </div>

                <div class="form-group">
                    <label for="name">Created Date:</label>
                    <input type="text" name="created_date" class="form-control" id="datepicker" value="<?php echo $pro->created_date ?>">
                </div>
                <div class="form-group">
                    <label for="email">Updated Date:</label>
                    <input type="text" name="updated_date" class="form-control" id="updatepicker" value="<?php echo $pro->updated_date ?>">
                </div>
                
                
                <button type="submit" class="btn btn-success">Update</button>
                <a class="btn btn-info" href="#" onclick="window.history.back();">Go back</a>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>