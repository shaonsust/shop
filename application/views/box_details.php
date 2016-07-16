<?php
include 'header.php';
?>
<style>
	td{
		color:white;
	}
	td a{
		color:white;
	}
	.table-hover>tbody>tr:hover>td, .table-hover>tbody>tr:hover>th {
		background-color: #550055;
		color:#eeeeee;
	}
	@media only screen and (max-width: 995px) {
		#back, #erp, #ep, #dp, #vpl, #vbl, #vr, #expt {
			width: 99%;
			font-size: 13px;
		}
		table {
			font-size: 13px;
		}
	}
</style>
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

					<div class="btn-toolbar">
						<a class="btn btn-info pull-left" id="back" href="#" onclick="window.history.back();">Go back</a>
						<?php if($details->status == 1) { ?>
							<a class="btn btn-danger pull-left" id="erp" href="<?php echo base_url() . 'super_admin_c/change_project_status/' . $pid ?>">End Project</a>
						<?php } else { ?>
							<a class="btn btn-success pull-left" id="erp" href="<?php echo base_url() . 'super_admin_c/change_project_status/' . $pid ?>">Run Project</a>
						<?php } ?>
						<a class="btn btn-primary pull-left" id="ep" href="<?php echo base_url() . 'super_admin_c/edit_pro/' . $pid ?>">Edit Project</a>
						<a class="btn btn-danger pull-left" id="dp" href="<?php echo base_url() . 'super_admin_c/delete_projects/' . $pid ?>" onclick="return CheckDelete()">Delete Project</a>
                    	<a class="btn btn-primary pull-right " id="vpl"
							href="<?php echo base_url() . 'super_admin_c/pick_list/' . $pid; ?>"> <span
							class=""></span> &nbsp; View Pick List
						</a>
						<a class="btn btn-success pull-right " id="vbl"
							href="<?php echo base_url() . 'super_admin_c/box_list/' . $pid; ?>"> <span
							class=""></span> &nbsp; View Box List
						</a>
						<a class="btn btn-danger pull-right " id="expt"
						   href="<?php echo base_url() . 'report_c/project_report_excel/' . $pid; ?>"> <span
								class=""></span> &nbsp; Export
						</a>
						<a class="btn btn-info pull-right " id="vr"
						   href="<?php echo base_url() . 'report_c/project_report/' . $pid; ?>"> <span
								class=""></span> &nbsp; View Report
						</a>
					</div>
                    <div class="panel-body"></div>
						<div class="box-body">
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

