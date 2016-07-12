<?php
include 'header.php';
?>
<style>

</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="box-title text-center">Full Amazon Box Report</h4>
                        </div>
                        <!--                        <a class="btn btn-default pull-right"-->
                        <!--                           href="--><?php //echo base_url();?><!--super_admin_c/create_projects"> <span-->
                        <!--                                class=""></span> &nbsp; Add New Projects-->
                        <!--                        </a>-->
                        <!--                        <a class="btn btn-default pull-right "-->
                        <!--                           href="--><?php //echo base_url() . 'super_admin_c/upload_pick_list/'?><!--"> <span-->
                        <!--                                class=""></span> &nbsp; Amazon Project-->
                        <!--                        </a>-->
                        <a class="btn btn-info pull-left" href="#" onclick="window.history.back();">Go back</a>
                        <a class="btn btn-default pull-right" href="<?php echo base_url() . 'amazon_c/amazon_full_item_report/'. $pid?>">
                            <span class=""></span> &nbsp; Full Item Report
                        </a>
                        <a class="btn btn-default pull-right" href="<?php echo base_url() . 'amazon_c/amazon_full_box_report/'. $pid?>">
                            <span class=""></span> &nbsp; Full Box Report
                        </a>
                        <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#amazon">Amazon Project</button>
                        <div class="panel-body">
                            <?php

                            if (! empty ( $msg )) {
                                echo $msg;
                            }
                            ?>

                        </div>
                        <div class="box-body" align="center">
                            <!--*******************************************Sub project Table Start Here************************************************-->
                            <div class="table-responsive" style="width: 100% !important">
                                <table id="tb1" class="table table-bordered dataTable "
                                       cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th width="40%">Sub Project Name</th>
                                        <th width="20%">Total Skus</th>
                                        <th width="20%">Total Units</th>
                                        <th width="20%">Created Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ( $sub_project as $c )
                                    {
                                        ?>
                                        <tr>
                                            <td><a href="<?php echo base_url().'amazon_c/item_list/'.$c->pid.'/'.$c->spid; ?>"><?php echo $c->sub_project_name; ?></a></td>
                                            <td><?php echo $c->total_sku; ?></td>
                                            <td><?php echo $c->total_units; ?></td>
                                            <td><?php echo $c->created_date;?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!--*******************************************Sub project Table Finished Here************************************************-->
                            <br>

                            <!--*******************************************Amazon Full Box project Report Start Here************************************************-->
                            <div class="table-responsive" style="width: 100% !important">
                                <table id="tb2" class="table table-bordered dataTable "
                                       cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th width="40%">Box Name</th>
                                        <th width="20%">SKU</th>
                                        <th width="20%">Barcode</th>
                                        <th width="20%">Quantity Scanned</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ( $report as $c )
                                    {
                                        ?>
                                        <tr>
                                            <td><?php echo $c->box_name; ?></td>
                                            <td><?php echo $c->sku; ?></td>
                                            <td><?php echo $c->barcode; ?></td>
                                            <td><?php echo $c->cbarcode;?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!--*******************************************Amazon Full project Report Finished Here************************************************-->
                        </div>
                    </div>
                </div>
            </div>

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
                                <input type="file" class="amazon2" name="read" height: 6vh; border-radius: 5px;">
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
                            <!--                            <input type="submit" class="btn btn-default" >-->
                            <!--                            <a class="btn btn-primary pull-right" href="--><?php //echo base_url().'amazon_c/check_format' ?><!--">submit</a>-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- *****************************************Finished Amazon Pick list project modal*********************************** -->

        </div>

    </div>
</div>
<div id="test"></div>

<script>
    $(document).ready(function(){
        $('#tb2').DataTable({
            bFilter: false,
            bInfo: false,
            info : false,
            ordering : false,
            aLengthMenu: [[25, 50, 75, 100, -1], [25, 50, 75, 100, "All"]],
            pageLength: 30,
            bLengthChange : false
        });
    });
</script>
