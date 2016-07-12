<?php  include 'header.php';
?>

<div class="container">
    <br>
    <div class="row">
    <div class="col-md-6 col-md-offset-3">

        <div class="panel panel-success" style="padding: 20px !important">
            <?php
            if(!empty($msg)) echo $msg;
            ?>
            <div class="panel-heading text-center lead">
                <?php 
                    if($user->id === $this->session->userdata('user_id'))
                    {
                        echo 'My Account';
                    }
                    else if ($user->id !== $this->session->userdata('user_id') && $this->session->userdata('role') != 1)
                    {
                        echo 'Edit User';
                    }
                ?>
            </div>
            <br>
            <form role="form" method="post" action="<?php echo base_url(); ?>users/update_users/<?php echo $user->id ?>">
                <div class="form-group">
                    <label for="name">Full Name:</label>
                    <?php echo form_error('full_name'); ?>
                    <input type="text" name="full_name" class="form-control" id="name" value="<?php echo $user->full_name ?>">
                </div>

                <div class="form-group">
                    <label for="name">User Name:</label>
                    <?php echo form_error('user_name'); ?>
                    <input type="text" name="user_name" class="form-control" id="name" value="<?php echo $user->username ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <?php echo form_error('email'); ?>
                    <input type="email" name="email" class="form-control" id="email" value="<?php echo $user->email ?>">
                </div>
                <div class="form-group">
                    <label><a href="<?php echo base_url(); ?>users/change_password/<?php echo $user->id ?>"> change password</a></label>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a class="btn btn-info" href="#" onclick="window.history.back();">Go back</a>
            </form>
        </div>
    </div>
    </div>
</div>

<?php
include 'footer.php';
?>
