<?php
    include 'header.php';
?>
<div class="container">

	<div class="col-md-8 col-md-offset-2" style="margin-top: 10%">
		<?php

		//****************************************************** PICK LIST **************************************************************
		if ($flag == 1)
		{
		?>
		<div class="modal-content" >
        <div class="modal-body">
        <!-- <h4 class="modal-title"> -->
        <form id="newBinForm" method="post" action="<?php echo base_url() . 'super_admin_c/check_format/' . $pid. '/'. 1?>" enctype="multipart/form-data">
        	<label><h3>Please Upload the Picklist</h3></label>            
        	<input type="file" class="bin" name="read" height: 6vh; border-radius: 5px;">
			<p style="color: red;margin-top:10px;"><a href="<?php echo base_url() . 'download_excel_file/download_header/' . $pid; ?>">Please download sample file from here.</a></p>
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
			<div class="table-responsive modal-body">
				<table id="sample" class="table table-bordered table-condensed dataTable" style="background: #fffdfe">
					<thead>
					<tr>
						<td>SKU</td>
						<td>Barcode</td>
						<td>Quantity</td>
					</tr>
					</thead>

					<tbody>
					<tr>
						<td>Sku1</td>
						<td>123456</td>
						<td>100</td>
					</tr>
					<tr>
						<td>Sku2</td>
						<td>34532</td>
						<td>240</td>
					</tr>
					<tr>
						<td>Sku3</td>
						<td>XZAS123</td>
						<td>170</td>
					</tr>
					<tr>
						<td>Sku4</td>
						<td>MKJUIOL</td>
						<td>430</td>
					</tr>
					<tr>
						<td>Sku5</td>
						<td>XCVBNM</td>
						<td>280</td>
					</tr>
					<tr>
						<td>Sku6</td>
						<td>ZASDFG</td>
						<td>320</td>
					</tr>
					<tr>
						<td>Sku7</td>
						<td>XZCVBN</td>
						<td>560</td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
      </div>
		<?php
		//****************************************************** FINISH PICK LIST **************************************************************
		}
		//****************************************************** START AMAZON PROJECT **************************************************************
		else if ($flag == 0)
		{
		?>
	<div class="modal-content">
		<div class="modal-body">
			<!-- <h4 class="modal-title"> -->
			<form id="newBinForm" method="post" action="<?php echo base_url().'amazon_c/check_format' ?>"
				  enctype="multipart/form-data">
				<label><h3>Please Upload Amazon Project List</h3></label>
				<input type="file" class="bin" name="read" height: 6vh; border-radius: 5px;">
<!--				<p style="color: red;margin-top:10px;"><a href="--><?php //echo base_url() . 'download_excel_file/download_header/' . $pid; ?><!--">Please download sample file from here.</a></p>-->
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
	<?php
}
//********************************************************** FINISH AMAZON PROJECT ******************************************************************************
	?>

	</div>
</div>
<br><br><br><br><br><br>

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