<?php
include 'header.php';
?>
<style>
    @media only screen and (max-width: 550px) {
        #back, #vpl, #vbl, #expt, #vr {
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
                            <h4 class="box-title text-center">Project Report
                            </h4>
                        </div>

                        <div class="btn-toolbar">
                            <a class="btn btn-info pull-left" id="back" href="#" onclick="window.history.back();">Go back</a>
                            <a class="btn btn-success pull-right " id="vpl"
                               href="<?php echo base_url() . 'super_admin_c/pick_list/' . $pid; ?>"> <span
                                    class=""></span> &nbsp; View Pick List
                            </a>
                            <a class="btn btn-success pull-right " id="vbl"
                               href="<?php echo base_url() . 'super_admin_c/box_list/' . $pid; ?>"> <span
                                    class=""></span> &nbsp; View Box List
                            </a>
                            <a class="btn btn-primary pull-right " id="expt"
                               href="<?php echo base_url() . 'report_c/project_report_excel/' . $pid; ?>"> <span
                                    class=""></span> &nbsp; Export
                            </a>
                            <a class="btn btn-primary pull-right " id="vr"
                               href="<?php echo base_url() . 'report_c/project_report/' . $pid; ?>"> <span
                                    class=""></span> &nbsp; View Report
                            </a>
                        </div>
                        <div class="panel-body"></div>
                        <div class="box-body">
                            <div class="table-responsive" style="width: 100% !important">
                                <table id="table"
                                       class="table table-bordered table-hover table-striped dataTable "
                                       cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th width="35%">Box Name</th>
                                        <th width="35%">SKU</th>
                                        <th width="15%">Barcode</th>
                                        <th width = "15%">Quantity Scanned</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;

                                    foreach ( $report as $c )

                                    {

                                        ?>

                                        <tr>
                                            <td>
                                                <a
                                                    href=""
                                                    title="Details"><?php  echo $c->box_name; ?></a></td>
                                            <td>
                                                <a
                                                    href=""
                                                    title="Details"><?php echo $c->sku; ?></a></td>
                                            <td><?php echo $c->barcode; ?></td>
                                            <td><?php echo $c->cbarcode; ?></td>
                                            <!-- <td><?php //if ($c['status']==1){ echo "Running";} else{ echo"Ended";}?><a href="<?php //echo base_url() . 'super_admin_c/change_project_status/' . $c['id'] ?>">(change)</a></td> -->
                                        </tr>

                                        <?php
                                        $i ++;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php  ?>
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
