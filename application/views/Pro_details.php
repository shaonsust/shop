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
                    
                    <a class="btn btn-default pull-right "
							href="<?php echo base_url() . 'super_admin_c/upload_pick_list/' . $pid; ?>"> <span
							class="fa fa-plus"></span> &nbsp; Upload Pick List
						</a>
						<a class="btn btn-default pull-right "
						   href="<?php echo base_url() . 'download_excel_file/download_header/' . $pid; ?>"> <span
								class="fa fa-plus"></span> &nbsp; Download Sample File
						</a>
					
                    <a class="btn btn-default pull-right "
							href="<?php echo base_url();?>super_admin_c/newbin"> <span
							class="fa fa-plus"></span> &nbsp; Add New Bin
						</a>
                    <?php }
                    else if(($details->status == 1) && ($details->pick_list == 1))
                    { ?>
                    	<a class="btn btn-default pull-right "
							href="<?php echo base_url() . 'super_admin_c/pick_list/' . $pid; ?>"> <span
							class="fa fa-plus"></span> &nbsp; View Pick List
						</a>
                    <?php } 
                    ?>
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
</script>
