<?php
include 'header.php';
?>


<div class="container">
	<br>

	<div class="col-md-6 col-md-offset-3">

		<div class="panel panel-success" style="padding: 20px !important">
   <?php
			if (!empty ( $msg ))
				echo $msg;
			?>
    <div class="panel-heading text-center lead">Change Password</div>
			<br>
			<form role="form"
				action="<?php echo base_url(); ?>users/update_password/<?php echo $id; ?>"
				method="post">

				<div class="form-group">
					<label for="pass">Old Password*</label>
      <input type="password" name="old_password" class="form-control"
						id="pass" placeholder="Old Password">
				</div>

				<div class="form-group">
					<label for="pwd">New Password*:</label>
      <?php echo form_error('new_password'); ?>
      <input type="password" name="new_password" class="form-control"
						id="pwd" placeholder="New password">
				</div>
				<div class="form-group">
					<label for="pwd">Confirm Password*:</label>
      <?php echo form_error('con_password'); ?>
      <input type="password" name="con_password" class="form-control"
						id="cpwd" placeholder="Confirm Password">
				</div>

				<button type="submit" class="btn btn-success">Change</button>
			</form>
		</div>
	</div>
</div>


<?php include 'footer.php'; ?>

