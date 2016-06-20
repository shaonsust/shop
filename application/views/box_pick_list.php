<?php
include 'header.php';
?>
<style>
td{
color:white;
}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<div class="panel panel-primary">
												<div class="panel-heading">
							<h4 class="box-title text-center">Item List From Excel File &nbsp;</h4>
						</div>
<!-- 						<a class="btn btn-default pull-right" href="<?php echo base_url();?>super_admin_c/show_details"> <span class="fa fa-plus"></span> &nbsp; View Report -->
<!-- 						</a> -->					
						
			
            
			    <div class="modal-dialog">
			    
			        <div class="modal-body" style="margin-top:-30px; !important">
			          <form id="newBoxForm" method="post" action="<?php echo base_url() . 'super_admin_c/barcode_calculation/'. $pid . '/' . $bdetails->box_id;?>">
        			<h3 style="text-align: center;"><?php echo $bdetails->box_name; ?></h3>   				            
        				<input type="text" class="box" id="box" name="barcode" autofocus="true" style="width: 100%; height: 6vh; border-radius: 5px;">
        				<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal" style="margin-top:10px;">Close Box</button>
        			  </form>
        			   <?php							
						if (! empty ( $msg )) {
							echo $msg;
						}
						?> 
			        </div>			       
			      </div>
            
            <div class="modal fade" id="myModal" role="dialog">
			    <div class="modal-dialog">
			    
			      <!-- Modal content-->
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title">Close Box</h4>
			        </div>
			        <div class="modal-body">
			        <button type="button" class="btn btn-default snb" data-toggle="modal" data-target="#myModal">Start New Box</button> 
			          <div class="col-md-5 col-xs-6 col-sm-3">
								<select class="form-control pfilter" id="" name="pfilter"
									style="margin-top: 0px; margin-left: 0px;">
									<option>Select Existing Box</option>
									<?php 
										foreach ($box_list as $box)
										{
									?>
									<option value="<?php echo $box['box_id'];?>"><?php echo $box['box_name'];?></option>
									<?php } ?>
								</select>
							</div>
					<button type="button" class="btn btn-default csb" data-toggle="modal" data-target="#myModal">Close & Save Box</button> 
			        </div>
			        <div class="modal-footer">
			          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        </div>
			      </div>
			      
			    </div>
  			</div>
            
         		<div class="panel-body">
       					               
            	</div>
            
						<div class="box-body" align = "center">
							<div class="table-responsive" style="width: 100% !important">
								<table id="table"
									class="table table-bordered table-hover dataTable "
									cellspacing="0" width="100%">
									<thead>
										<tr>
											<th width="35%">SKU</th>											
											<th width="35%">Barcode</th>
											<th width="15%">Item Scanned</th>
											<th width = "15%">Quantity</th>
										</tr>
									</thead>
									<tbody>
                    <?php
																				$i = 1;
																				
																				foreach ( $list as $c ) 

																				{
																					
																					?>
                        
                        <tr <?php if($c['qty'] === $c['qty_scaned']) { ?> bgcolor = "#076403" <?php  } else { ?> bgcolor = "#e60000" <?php }?>>
											<td><?php  echo $c['sku']; ?></td>
												<td><?php echo $c['barcode']; ?></td>
												<td><?php echo $c['qty_scaned']; ?></td>
												<td><?php echo $c['qty']; ?></td>
											<!-- <td><?php //if ($c['status']==1){ echo "Running";} else{ echo"Ended";}?><a href="<?php //echo base_url() . 'super_admin_c/change_project_status/' . $c['id'] ?>">(change)</a></td> -->																			
										</tr>
                       
                        <?php
																					$i ++;
																				}
																				?>
                    </tbody>
								</table>								
							</div>
														
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
</div>
<script>
function CheckDelete()
{
	var answer = confirm("Are you sure you want to Delete?");
  	if (answer) {
    	 return true;
  	}else{
    	 return false;
	}
}
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#box").change(function (event) {
            $("#newBoxForm").submit();
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        var flag = <?php echo $flag; ?>;
//         alert(flag1);
        if(flag == 1)
        {
            alert("Barcode is not matched");
        }
        else if(flag == 2)
        {
            alert("Too much data is inserted");
        }
    });
</script>
<script type="text/javascript">

$(document).ready(function(){
	$('.pfilter').change(function(){
		var bid = $('.pfilter').val();
		var pid = <?php echo $pid;?>;
// 		alert(value);
		window.location.replace("<?php echo base_url() ?>super_admin_c/box_calculation1/" + pid + "/" + bid);
	});

	$('.snb').click(function(){
		var pid = <?php echo $pid;?>;
		window.location.replace("<?php echo base_url() ?>Super_admin_c/pick_list/" + pid);
	});

	$('.csb').click(function(){
		var pid = <?php echo $pid;?>;
		window.location.replace("<?php echo base_url() ?>Super_admin_c/pick_list/" + pid);
	});
});
</script>