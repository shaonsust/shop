<?php
include 'header.php';
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<div class="panel panel-primary">
												<div class="panel-heading">
							<h4 class="box-title text-center">Box Report</h4>
						</div>							
            
						<div class="box-body" align = "center">
							<div class="table-responsive" style="width: 100% !important">
								<table id="table"
									class="table table-bordered table-hover table-striped dataTable "
									cellspacing="0" width="100%">
									<thead>
										<tr>
											<th width="35%">Box Name</th>											
											<th width="35%">Barcode</th>
											<th width="15%">Item Scanned</th>
<!-- 											<th width="15%">Action</th>																					 -->
										</tr>
									</thead>
									<tbody>
                    <?php
																				$i = 1;
																				
																				foreach ( $list as $c ) 

																				{
																					
																					?>
                        
                        <tr>
											<td><?php  echo $c['box_name']; ?></td>
												<td><?php echo $c['barcode']; ?></td>
												<td><?php echo $c['cbarcode']; ?></td>
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

$(document).ready(function(){

	$(".box").change(function(){
		$("#newBoxForm").submit();
		});
});
</script>
