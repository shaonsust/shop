<?php
    include 'header.php';
?>
<div class="container">

	<div class="col-md-8 col-md-offset-2" style="margin-top: 10%">
		<div class="modal-content" >
        
        <div class="modal-body">
        <!-- <h4 class="modal-title"> -->
        <form id="newBinForm" method="post" action="<?php echo base_url() . 'super_admin_c/check_format/' . $pid?>" enctype="multipart/form-data">
        	<label><h3>Please Upload the Picklist</h3></label>            
        	<input type="file" class="bin" name="read" height: 6vh; border-radius: 5px;">
        	<p style="color: red;margin-top:10px;">Please upload only ODS, XLSX, XLS or CSV file format.</p>
            <?php 
//                 $message = $this->session->userdata('message');
//                 if(isset($message) && !empty($message))
//                 {
//                     echo '<p>'.$message.'</p>';
//                     $this->session->unset_userdata('message');
//                 }
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