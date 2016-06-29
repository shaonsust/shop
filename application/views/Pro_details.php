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
							<h4 class="box-title text-center">Project Name:&nbsp;&nbsp;<?php echo $details->project_name?> (Total bin : <?php echo $bin_count;?>)
                    </h4>
						</div>
                    <?php if (($details->status == 1) && ($details->pick_list == 0)) { ?>
                    
<!--                    <a class="btn btn-default pull-right "-->
<!--							href="--><?php //echo base_url() . 'super_admin_c/upload_pick_list/' . $pid . '/' . 1 ?><!--"> <span-->
<!--							class=""></span> &nbsp; Upload Pick List-->
<!--						</a>-->
					
<!--                    <a class="btn btn-default pull-right "-->
<!--							href="--><?php //echo base_url();?><!--super_admin_c/newbin"> <span-->
<!--							class=""></span> &nbsp; Add New Bin-->
<!--						</a>-->
						<button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#new_bin">Add New Bin</button>
                    <?php }
                    else if(($details->status == 1) && ($details->pick_list == 1))
                    { ?>
                    	<a class="btn btn-default pull-right "
							href="<?php echo base_url() . 'super_admin_c/pick_list/' . $pid; ?>"> <span
							class=""></span> &nbsp; View Pick List
						</a>
                    <?php } 
                    ?>
						<!--************************************Start New Bin modal***********************************************-->
						<div class="modal fade" id="new_bin" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content" >
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Create New Bin</h4>
									</div>
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
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
						<!--************************************Finish New Bin modal***********************************************-->
                    <div class="panel-body"></div>
						<div class="box-body">
							<div class="table-responsive" style="width: 100% !important">
								<table id="table"
									class="table table-bordered table-hover table-striped dataTable "
									cellspacing="0" width="100%">
									<thead>
										<tr>									
											<th width="60%">Bin Name</th>
											<th width="40%">Action</th>
										</tr>
									</thead>
									<tbody>
                    <?php
																				$i = 1;
																				foreach ( $pro_bin as $c ) {
																					?>
                        
                        <tr>											
											<td><a
												href="<?php echo base_url() . 'super_admin_c/show_bin_details/' . $c['bin_id'] .'/' . $details->id ?>"
												title="Details"><?php echo $c['bin_number'];?></a></td>
											<td align="center"><a
												href="<?php echo base_url() . 'super_admin_c/show_bin_details/' . $c['bin_id'] . '/' . $details->id ?>"
												class="btn btn-info btn-xs" title="Show Details"><i
													class="fa fa-list"></i></a> <a
												href="<?php echo base_url() . 'super_admin_c/edit_bin/' . $c['bin_id'] ?>"
												class="btn btn-warning btn-xs" title="Edit"><i
													class="fa fa-pencil"></i></a> <a
												href="<?php echo base_url() . 'super_admin_c/delete_bin/' . $c['bin_id'] ?>"
												class="btn btn-danger btn-xs delete"
												onclick="return CheckDelete()" title="Delete"><i
													class="fa fa-remove"></i></a></td>
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
	$(document).ready(function () {
		$(".bin").change(function (event) {
			$("#newBinForm").submit();
		});
	});
</script>
