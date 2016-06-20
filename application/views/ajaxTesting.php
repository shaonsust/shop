<!DOCTYPE html>
<html>
<head>
	<title>Ajax Testing</title>
</head>
<body>
<form action="<?php echo base_url(); ?>welcome/ajaxResult" method="post" accept-charset="utf-8">
	<label>Name</label> <br>
	<input id="input" type="text" name="name" placeholder="Write your name and see the magic" style="width: 40%">
	<input type="submit" name="" value="">
</form>
<h1>Status: <span id="output"><?php if(isset($output)){echo $output;} ?></span></h1>
<script src="<?php echo base_url()?>js/jquery-2.1.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#input").keyup(function(event) {
			var inputText = $(this).val();
			$.ajax({
			  method: "POST",
			  url: "ajaxResult.php",
			  data: { name: inputText},
			  datatype: json
			}).done(function( msg ) {
				if(msg.length != 0)
				{
					window.redirect("<?php echo base_url() ?>welcome/insertItem/" + msg);
				}
			    $("#output").html(msg);
			  });
		});
	});
</script>		
</body>
</html>