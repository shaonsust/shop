<?php
    include 'header.php';
?>
<div class="container">

	<div class="col-md-8 col-md-offset-2" style="margin-top: 10%">
		<div class="modal-content" >
            <a class="btn btn-info pull-left" href="#" onclick="window.history.back();">Go back</a>
        
        <div class="modal-body">
        <!-- <h4 class="modal-title"> -->
        <form id="newBinForm" method="post" action="<?php echo base_url() ?>super_admin_c/bin_calculation">
        	<label><h3>Please Enter/Scan the BIN Name/Number:</h3></label>            
        	<input type="text" class="bin" name="bin" autofocus="true" style="width: 100%; height: 6vh; border-radius: 5px;">
            <?php 
                $message = $this->session->userdata('message');
                if(isset($message) && !empty($message))
                {
                    echo '<p>'.$message.'</p>';
                    $this->session->unset_userdata('message');
                }
            ?>
        </form>
        <br><br>
        </div>
      </div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$(".bin").change(function(event) {
			$("#newBinForm").submit();
		});
            //alert("hello");
// 		$(".bin").change(function(event) {
// 			var inputText = $(this).val();
//                         //alert(inputText);
// 			$.ajax({
// 			  method: "POST",
// 			  url: "<?php echo base_url() ?>super_admin_c/bin_calculation",
// 			  data: { name: inputText}
// //			  datatype: json
// 			}).done(function( msg ) {
// 				if(msg.length != 0)
// 				{
// 					window.location.replace("<?php echo base_url() ?>super_admin_c/item/" + msg);
// 				}
// 			   // $("#output").html(msg);
// 			  });
// 		});
	});
</script>		
<?php 
include 'footer.php';
?>