<?php
include 'header.php';
?>

<div class="container">
    <br>

    <div class="col-md-6 col-md-offset-3">

        <div class="row">
            <div class="panel panel-success" style="padding: 20px !important">
            <?php 
                if(!empty($msg)) echo $msg ;
            ?>
            <div class="panel-heading text-center lead">Create User </div>
            
            <br>
            <form role="form" action="<?php echo base_url(); ?>users/insert_users" method="post">
                <div class="form-group col-xs-12">
                    <label for="name">Full Name*:</label>
                    <?php echo form_error('full_name'); ?>
                    <input type="text" name="full_name" class="form-control" id="name" placeholder="Enter Name">
                </div>

                <div class="form-group col-xs-12">
                    <label for="name">User Name*:</label>
                    <?php echo form_error('user_name'); ?>
                    <input type="text" name="user_name" class="form-control" id="name" placeholder="Enter Name">
                </div>
                <div class="form-group col-xs-12">
                    <label for="email">Email*:</label>
                    <?php echo form_error('email'); ?>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                </div>

                <div class="form-group col-xs-12">
                    <label for="pwd">Password*:</label>
                    <?php echo form_error('password'); ?>
                    <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password">
                </div>
                <div class="form-group col-xs-12">
                    <label for="pwd">Confirm Password*:</label>
                    <?php echo form_error('con_password'); ?>
                    <input type="password" name="con_password" class="form-control col-xs-12" id="pwd" placeholder="Enter password">
                </div>
                <div class="checkbox col-xs-12">
                    <input type="hidden" value="3" name="role">
                </div>
                <button type="submit" class="btn btn-success">Create User</button>
            </form>
        </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>