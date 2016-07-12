<?php
include 'header.php';
?>

<div class="container">
    <br>

    <div class="col-md-6 col-md-offset-3">

        <div class="panel panel-success" style="padding: 20px !important">
            <div class="panel-heading text-center lead">Edit User </div>
            <br>
            <form role="form" method="post" action="<?php echo base_url(); ?>users/update_users/<?php echo $user->id ?>">
                <div class="form-group">
                    <label for="name">Full Name*:</label>
                    <input type="text" name="full_name" class="form-control" id="name" value="<?php echo $user->full_name ?>">
                </div>

                <div class="form-group">
                    <label for="name">User Name*:</label>
                    <input type="text" name="user_name" class="form-control" id="name" value="<?php echo $user->username ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email*:</label>
                    <input type="email" name="email" class="form-control" id="email" value="<?php echo $user->email ?>">
                </div>

                <div class="checkbox">
                    <input type="hidden" value="3" name="role">
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a class="btn btn-info" href="#" onclick="window.history.back();">Go back</a>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>