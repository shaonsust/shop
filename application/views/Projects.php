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
							<h4 class="box-title text-center">Projects List &nbsp; (Total project : <?php echo $project_no; ?>)</h4>
						</div>
						<a class="btn btn-default pull-right"
							href="<?php echo base_url();?>super_admin_c/create_projects"> <span
							class="fa fa-plus"></span> &nbsp; Add New Projects
						</a>
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
						<div class="box-body" align="center">
							<div class="table-responsive" style="width: 100% !important">
								<table id="tb1" class="table table-bordered dataTable "
									cellspacing="0" width="100%">
									<thead>
										<tr>
											<th width="40%">Project Name</th>
											<th width="40%" class="btn btn-block" id="bt1">Created Date <span class="fa fa-angle-down" style="margin-left:20px;"></span></th>
											<th width="20%">Action</th>
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
											<td><a <?php if($c['status'] == 1) { ?> style="color: white;"
												<?php } else {?> style="color:white;" <?php }?>
												href="<?php echo base_url() . 'super_admin_c/show_details/' . $c['id'] ?>"
												title="Details"><?php
																					
echo $c ['project_name'];
																					?><?php

																					if ($c ['pick_list'] == 1)
																						echo " (Pick List Project)";
																					?></a></td>
											<td><?php echo $c['created_date'];?></td>
											<!-- <td><?php //if ($c['status']==1){ echo "Running";} else{ echo"Ended";}?><a href="<?php //echo base_url() . 'super_admin_c/change_project_status/' . $c['id'] ?>">(change)</a></td> -->
											<td>
                                <?php
																					if ($c ['status'] == 1) {
																						?>
                                    <a
												href="<?php echo base_url() . 'super_admin_c/change_project_status/' . $c['id'] ?>"
												class="btn btn-info btn-xs" title="End this project"><i
													class="fa fa-times"></i></a>
                                <?php
																					} else {
																						?>
                                    <a
												href="<?php echo base_url() . 'super_admin_c/change_project_status/' . $c['id'] ?>"
												class="btn btn-info btn-xs" title="Run this project"><i
													class="fa fa-check" style="font-size: 10px;"></i></a>
                                <?php
																					}
																					?>
                                <a
												href="<?php echo base_url() . 'super_admin_c/show_details/' . $c['id'] ?>"
												class="btn btn-info btn-xs" title="Show Details"><i
													class="fa fa-list"></i></a> <a
												href="<?php echo base_url() . 'super_admin_c/edit_pro/' . $c['id'] ?>"
												class="btn btn-warning btn-xs" title="Edit"><i
													class="fa fa-pencil"></i></a> <a
												href="<?php echo base_url() . 'super_admin_c/delete_projects/' . $c['id'] ?>"
												class="btn btn-danger btn-xs delete"
												onclick="return CheckDelete()" title="Delete"><i
													class="fa fa-remove"></i></a>
											</td>
										</tr>
                       
                        <?php
																					$i ++;
																				}
																				?>
                    </tbody>
								</table>

								<!-- ********************************************************************************** -->
								<table id="tb2" class="table table-bordered dataTable "
									cellspacing="0" width="100%">
									<thead>
										<tr>
											<th width="40%">Project Name</th>
											<th width="40%" class="btn btn-block" id="bt2">Created Date <span class="fa fa-angle-up" style="margin-left:20px;"></span></th>
											<th width="20%">Action</th>
										</tr>
									</thead>
									<tbody>
                    <?php
																				$i = 1;
																				
																				foreach ( $projects1 as $c ) 

																				{
																					
																					?>
                        
                        <tr <?php if($c['status'] == 1) { ?>
											bgcolor="#076403" <?php  } else { ?> bgcolor="#e60000"
											<?php } ?>>
											<td><a <?php if($c['status'] == 1) { ?> style="color: white;"
												<?php } else {?> style="color:white;" <?php }?>
												href="<?php echo base_url() . 'super_admin_c/show_details/' . $c['id'] ?>"
												title="Details"><?php
																					
echo $c ['project_name'];
																					?><?php

																					if ($c ['pick_list'] == 1)
																						echo " (Pick List Project)";
																					?></a></td>
											<td  style="color:white;"><span ><?php echo $c['created_date'];?></span></td>
											<!-- <td><?php //if ($c['status']==1){ echo "Running";} else{ echo"Ended";}?><a href="<?php //echo base_url() . 'super_admin_c/change_project_status/' . $c['id'] ?>">(change)</a></td> -->
											<td>
                                <?php
																					if ($c ['status'] == 1) {
																						?>
                                    <a
												href="<?php echo base_url() . 'super_admin_c/change_project_status/' . $c['id'] ?>"
												class="btn btn-info btn-xs" title="End this project"><i
													class="fa fa-times"></i></a>
                                <?php
																					} else {
																						?>
                                    <a
												href="<?php echo base_url() . 'super_admin_c/change_project_status/' . $c['id'] ?>"
												class="btn btn-info btn-xs" title="Run this project"><i
													class="fa fa-check" style="font-size: 10px;"></i></a>
                                <?php
																					}
																					?>
                                <a
												href="<?php echo base_url() . 'super_admin_c/show_details/' . $c['id'] ?>"
												class="btn btn-info btn-xs" title="Show Details"><i
													class="fa fa-list"></i></a> <a
												href="<?php echo base_url() . 'super_admin_c/edit_pro/' . $c['id'] ?>"
												class="btn btn-warning btn-xs" title="Edit"><i
													class="fa fa-pencil"></i></a> <a
												href="<?php echo base_url() . 'super_admin_c/delete_projects/' . $c['id'] ?>"
												class="btn btn-danger btn-xs delete"
												onclick="return CheckDelete()" title="Delete"><i
													class="fa fa-remove"></i></a>
											</td>
										</tr>
                       
                        <?php
																					$i ++;
																				}
																				?>
                    </tbody>
								</table>

								<!-- ********************************************************************************** -->

							</div>
							<?php echo $pagination; ?>							
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
