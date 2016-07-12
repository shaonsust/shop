<?php
include 'header.php';
?>

<style>
td{
color:white;
}
 .icheckbox_minimal, .iradio_minimal {display: none !important}
div.table1
{
	height: 400px;
	min-width: 100px;
	margin: 0 auto;
	overflow-x: scroll;
	overflow-y: scroll;
}
.table1 td
{
	color: #000;
}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4 class="box-title text-center">Projects List &nbsp; (Total project : <?php echo $project_no; ?>)</h4>
						</div>
<!--						<a class="btn btn-default pull-right"-->
<!--							href="--><?php //echo base_url();?><!--super_admin_c/create_projects"> <span-->
<!--							class=""></span> &nbsp; Bin Projects-->
<!--						</a>-->
<!--						<a class="btn btn-default pull-right"-->
<!--						   href="--><?php //echo base_url();?><!--pick_list_c/create_projects"> <span-->
<!--								class=""></span> &nbsp; Pick List Projects-->
<!--						</a>-->

						<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#bin1">Bin Project</button>
						<button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#amazon">Amazon Project</button>
						<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#pick_list1">Pick List Project</button>
<!--						<a class="btn btn-default pull-right "-->
<!--						   href="--><?php //echo base_url() . 'super_admin_c/upload_pick_list/'?><!--"> <span-->
<!--								class=""></span> &nbsp; Amazon Project-->
<!--						</a>-->
						<div class="panel-body">
							<div class="col-md-2 col-xs-6 col-sm-3">
								<select class="form-control pfilter" id="" name="pfilter"
									style="margin-top: -14px; margin-left: -30px;">
									<option>Filter project</option>
									<option value="1">All</option>
									<option value="2">Ended</option>
									<option value="3">Running</option>
								</select>
							</div>
							<br> <br>
       <?php
							
							if (! empty ( $msg )) {
								echo $msg;
							}
							?>
                
            </div>
						<!-- *****************************************Start Pick list project modal*********************************** -->
						<div class="modal fade" id="pick_list1" role="dialog">
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Create Pick List Project</h4>
									</div>
									<div class="modal-body">
										<form id="pick_list" method="post" action="<?php echo base_url() . 'pick_list_c/project_calculation/'; ?>">
											<label><h3>Please Enter the Project Name:</h3></label>
											<input type="text" class="pick" name="project_name" autofocus="true" style="width: 100%; height: 6vh; border-radius: 5px;">
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>

							</div>
						</div>
						<!-- *****************************************Finish Pick list project modal*********************************** -->
						<!-- *****************************************Start Amazon project modal*********************************** -->
						<div class="modal fade" id="amazon" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Create Amazon Project</h4>
									</div>
									<div class="modal-body">
										<form id="amazon_form" method="post" action="<?php echo base_url().'amazon_c/check_format' ?>"
											  enctype="multipart/form-data">
											<label><h3>Please Upload Amazon Project List</h3></label>
											<input type="file" class="amazon" name="read" height: 6vh; border-radius: 5px;">
											<p style="color: red;margin-top:10px;"><a href="<?php echo base_url() . 'amazon_c/sample_amazon_excel'; ?>">Please download sample file from here.</a></p>
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
										<div class = "table1 table-responsive">
											<table class="table table-bordered table-condensed table-hover table-striped dataTable" width="100%">
												<tr>
													<td>Shipment ID</td>
													<td>FBA3NHCVCH</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
												</tr>
												<tr>
													<td>Name</td>
													<td>FBA (6/1/16 3:23 PM) - 2</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
												</tr>
												<tr>
													<td>Plan ID</td>
													<td>PLN9HY3YJ</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
												</tr>
												<tr>
													<td>Ship To</td>
													<td>Amazon.com, 705 Boulder Drive, Breinigsville, PA, US, 18031</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
												</tr>
												<tr>
													<td>Total SKUs</td>
													<td>24</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
												</tr>
												<tr>
													<td>Total Units</td>
													<td>36</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
												</tr>
												<tr>
													<td>Pack list</td>
													<td>1 of 1</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
												</tr>
												<tr>
													<td></td>
													<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
												</tr>
												<tr>
													<td>Merchant SKU</td>
													<td>Title</td><td>ASIN</td><td>FNSKU</td><td>external-id</td><td>Condition</td>
													<td>Who will prep?</td><td>Prep Type</td><td>Who will label?</td><td>Shipped</td>
												</tr>
												<tr>
													<td>1007-L-ST13</td>
													<td>Popana Print Tunic Top Large ST13 - Made In USA</td><td>B015DF8ETA</td><td>X000UT62HH</td>
													<td></td><td>New</td>
													<td>--?</td><td>--</td><td>Merchant</td><td>1</td>
												</tr>
												<tr>
													<td>1007-L-ST14</td>
													<td>Popana Print Tunic Top Large ST14 - Made In JAPAN</td><td>B015DF8ETA</td><td>X000UT62HH</td>
													<td></td><td>New</td>
													<td>--?</td><td>--</td><td>Merchant</td><td>2</td>
												</tr>
												<tr>
													<td>1007-L-ST15</td>
													<td>Popana Print Tunic Top Large ST15 - Made In CHINA</td><td>B015DF8ETA</td><td>X000UT62HH</td>
													<td></td><td>New</td>
													<td>--?</td><td>--</td><td>Merchant</td><td>4</td>
												</tr>
											</table>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
						<!-- *****************************************Finished Amazon project modal*********************************** -->
						<!-- *****************************************Start Bin project modal*********************************** -->
						<div class="modal fade" id="bin1" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content" >
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Create Bin Project</h4>
									</div>
									<div class="modal-body">
										<!-- <h4 class="modal-title"> -->
										<form id="newBinForm" method="post" action="<?php echo base_url() ?>super_admin_c/project_calculation">
											<label><h3>Please Enter/Scan the Bin Project Name/Number:</h3></label>
											<input type="text" class="bin" name="project" autofocus="true" style="width: 100%; height: 6vh; border-radius: 5px;">
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
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
						<!-- *****************************************Finished Bin project modal*********************************** -->
						<div class="box-body" align="center">
							<div class="table-responsive" style="width: 100% !important">
								<table id="tb1" class="table table-bordered dataTable "
									cellspacing="0" width="100%">
									<thead>
										<tr>
											<th width="75%">Project Name</th>
											<th width="25%">Created Date <span class="" style="margin-left:20px;"></span></th>
<!--											<th width="20%">Action</th>-->
										</tr>
									</thead>
									<tbody>
                    <?php
																				$i = 1;
																				
																				foreach ( $projects as $c ) 

																				{
																					
																					?>
                        
                        <tr <?php if($c['status'] == 1) { ?>
											bgcolor="#076403" <?php  } else { ?> bgcolor="#e60000"
											<?php } ?>>
											<td>
												<a <?php if($c['status'] == 1) { ?> style="color: white;"
												<?php } else {?> style="color:white;" <?php }?>
												href="<?php if($c['pick_list'] == 2) echo base_url() . 'amazon_c/sub_project/' . $c['id']; else echo base_url() . 'super_admin_c/show_details/' . $c['id'];  ?>"
												title="Details"><?php
																					
echo $c ['project_name'];
																					?><?php

																					if ($c ['pick_list'] == 1)
																					{
																					?>&nbsp;&nbsp;&nbsp;(Pick List project)
													<?php }
														else if($c['pick_list'] == 2){
															?>&nbsp;&nbsp;&nbsp;(Amazon project)
													<?php	} else { ?>&nbsp;&nbsp;&nbsp;(Bin project) <?php } ?>
												</a></td>
											<td><?php echo $c['created_date'];?></td>
											<!-- <td><?php //if ($c['status']==1){ echo "Running";} else{ echo"Ended";}?><a href="<?php //echo base_url() . 'super_admin_c/change_project_status/' . $c['id'] ?>">(change)</a></td> -->
<!--											<td>-->
<!--                                --><?php
//																					if ($c ['status'] == 1) {
//																						?>
<!--                                    <a-->
<!--												href="--><?php //echo base_url() . 'super_admin_c/change_project_status/' . $c['id'] ?><!--"-->
<!--												class="btn btn-info btn-xs" title="End this project"><i-->
<!--													class="fa fa-times"></i></a>-->
<!--                                --><?php
//																					} else {
//																						?>
<!--                                    <a-->
<!--												href="--><?php //echo base_url() . 'super_admin_c/change_project_status/' . $c['id'] ?><!--"-->
<!--												class="btn btn-info btn-xs" title="Run this project"><i-->
<!--													class="fa fa-check" style="font-size: 10px;"></i></a>-->
<!--                                --><?php
//																					}
//																					?>
<!--                                <a-->
<!--												href="--><?php //echo base_url() . 'super_admin_c/show_details/' . $c['id'] ?><!--"-->
<!--												class="btn btn-info btn-xs" title="Show Details"><i-->
<!--													class="fa fa-list"></i></a> <a-->
<!--												href="--><?php //echo base_url() . 'super_admin_c/edit_pro/' . $c['id'] ?><!--"-->
<!--												class="btn btn-warning btn-xs" title="Edit"><i-->
<!--													class="fa fa-pencil"></i></a> <a-->
<!--												href="--><?php //echo base_url() . 'super_admin_c/delete_projects/' . $c['id'] ?><!--"-->
<!--												class="btn btn-danger btn-xs delete"-->
<!--												onclick="return CheckDelete()" title="Delete"><i-->
<!--													class="fa fa-remove"></i></a>-->
<!--											</td>-->
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
<div id="test"></div>
<script>

$(document).ready(function(){
	$('.pfilter').change(function(){
		var value = $('.pfilter').val();
// 		alert(value);
		window.location.replace("<?php echo base_url() ?>super_admin_c/projects/" + 0 + "/" + value);
	});
});

$(document).ready(function () {
	$('#tb1').dataTable({
			bFilter: false,
			bInfo: false,
			iDisplayLength: 25,
			bLengthChange: false
	});
});

$(document).ready(function(){
	$("#tb2").hide();
	$("tb1").show();
	$('#bt1').click(function(){
		$("#tb1").hide();
		$("#tb2").show();
		});
	$('#bt2').click(function(){
		$("#tb2").hide();
		$("#tb1").show();
		});
});

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
		$(".pick").change(function (event) {
			$("#pick_list").submit();
		});

		$(".amazon").change(function (event) {
			$("#amazon_form").submit();
		});

		$(".bin").change(function (event) {
			$("#newBinForm").submit();
		});
	});
</script>
