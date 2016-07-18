<?php
include 'header.php';
?>
<style>
	td{
		color : #000000;
	}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<div class="panel panel-primary">
												<div class="panel-heading">
							<h4 class="box-title text-center">Box List ( Total Box : <?php echo $box_no;?> )</h4>
						</div>
						<a class="btn btn-info pull-left" href="#" onclick="window.history.back();">Go back</a>
						<button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#myModal">Create New Box</button>
						<div class="panel-body">
       						<?php
							if (! empty ( $msg )) {
								echo $msg;
							}
							?>
            			</div>
            
            <div class="modal fade" id="myModal" role="dialog">
			    <div class="modal-dialog">
			    
			      <!-- Modal content-->
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title">Create New Box</h4>
			        </div>
			        <div class="modal-body">
			          <form id="newBoxForm" method="post" action="<?php echo base_url() . 'amazon_c/box_calculation/'. $pid . '/' . $spid ?>">
        				<label><h3>Please Enter the Box Name:</h3></label>            
        				<input type="text" class="box" name="box_name" autofocus="true" style="width: 100%; height: 6vh; border-radius: 5px;">
        			  </form>
			        </div>
			        <div class="modal-footer">
			          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        </div>
			      </div>
			      
			    </div>
  			</div>
            
            
						<div class="box-body" align = "center">
							<div class="table-responsive" style="width: 100% !important">
								<table id="table"
									class="table table-bordered table-hover table-striped dataTable "
									cellspacing="0" width="100%">
									<thead>
										<tr>
											<th width="35%">Box Name</th>											
											<th width="35%">Different Items</th>
											<th width="15%">Item Scanned</th>
											<th width="15%">Action</th>																					
										</tr>
									</thead>
									<tbody>
                    <?php
																				$i = 1;
																				
																				foreach ( $list as $c ) 

																				{
																					
																					?>
                        
                        <tr>
											<td><a
												href="<?php echo base_url() . 'amazon_c/box_calculation1/' .  $pid . '/' . $c['box_id'] . '/' . $spid ?>"
												title="Details"><?php  echo $c['box_name']; ?></a></td>
												<td><a
												href="<?php echo base_url() . 'amazon_c/select_box_report/'. $pid . '/' . $c['box_id'] . '/' . $spid ?>"
												title="Details"><?php if(!empty($c['dtype'])) echo $c['dtype']; else echo "0"; ?></a></td>
												<td><?php echo $c['scanned']; ?></td>
												<td>
													<a
												href="<?php echo base_url() . 'amazon_c/box_calculation1/' . $pid . '/' . $c['box_id'] . '/' . $spid ?>"
												class="btn btn-info btn-xs" title="Show Information"><i
													class="fa fa-info"></i></a> <a
												href="<?php echo base_url() . 'amazon_c/select_box_report/' . $pid . '/' . $c['box_id'] . '/' . $spid ?>"
												class="btn btn-warning btn-xs" title="Show Details"><i
													class="fa fa-list"></i></a>
												</td>																										
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
