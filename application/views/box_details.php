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
							<h4 class="box-title text-center">Report of &nbsp;&nbsp;<?php echo $details->project_name?> Project
                    </h4>
						</div>
                    
                    	<a class="btn btn-default pull-right "
							href="<?php echo base_url() . 'super_admin_c/pick_list/' . $pid; ?>"> <span
							class="fa fa-plus"></span> &nbsp; View Pick List
						</a>
						<a class="btn btn-default pull-right "
							href="<?php echo base_url() . 'super_admin_c/box_list/' . $pid; ?>"> <span
							class="fa fa-plus"></span> &nbsp; View Box List
						</a>
						<a class="btn btn-default pull-right "
						   href="<?php echo base_url() . 'report_c/project_report/' . $pid; ?>"> <span
								class="fa fa-plus"></span> &nbsp; Report
						</a>
                    <div class="panel-body"></div>
						<div class="box-body">
							<div class="table-responsive" style="width: 100% !important">
								<table id="table"
									class="table table-bordered table-hover table-striped dataTable "
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
                        
                        <tr>
											<td>
											<a
												href="<?php echo base_url() . 'super_admin_c/box_list/' . $c['pid'] .'/'. $c['barcode'].'/'.$c['id']?>"
												title="Details"><?php  echo $c['sku']; ?></a></td>
												<td>
												<a
												href="<?php echo base_url() . 'super_admin_c/box_list/' . $c['pid'] .'/'. $c['barcode'].'/'.$c['id']?>"
												title="Details"><?php echo $c['barcode']; ?></a></td>
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
							<?php echo $pagination; ?>
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
