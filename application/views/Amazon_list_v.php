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
    @media only screen and (max-width: 500px) {
        #back, #vbl, #vil, #vr {
            width: 99%;
            font-size: 13px;
        }
        table {
            font-size: 13px;
        }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="box-title text-center">Amazon Item List
                            </h4>
                        </div>

                        <div class="btn-toolbar">
                            <a class="btn btn-info pull-left" id="back" href="#" onclick="window.history.back();">Go back</a>
                            <a class="btn btn-primary pull-right " id="vil"
                               href="<?php echo base_url() . 'amazon_c/pick_list/' . $pid . '/' . $spid; ?>"> <span
                                    class=""></span> &nbsp; View Item List
                            </a>
                            <a class="btn btn-success pull-right " id="vbl"
                               href="<?php echo base_url() . 'amazon_c/box_list/' . $pid . '/' . $spid; ?>"> <span
                                    class=""></span> &nbsp; View Box List
                            </a>
<!--                            <a class="btn btn-primary pull-right "-->
<!--                               href="--><?php //echo base_url() . 'report_c/project_report_excel/' . $pid; ?><!--"> <span-->
<!--                                    class=""></span> &nbsp; Export-->
<!--                            </a>-->
                            <a class="btn btn-info pull-right " id="vr"
                               href="<?php echo base_url() . 'report_c/amazon_sub_report/' . $pid . '/' . $spid; ?>"> <span
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
                                                    href="<?php echo base_url() . 'amazon_c/box_list/' . $c['pid']. '/' . $c['spid'] .'/'. $c['barcode'].'/'.$c['id'] ?>"
                                                    title="Details"><?php  echo $c['sku']; ?></a></td>
                                            <td>
                                                <a
                                                    href="<?php echo base_url() . 'amazon_c/box_list/' . $c['pid']. '/' . $c['spid'] .'/'. $c['barcode'].'/'.$c['id'] ?>"
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
