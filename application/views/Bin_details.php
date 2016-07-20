<?php
// echo "<pre>";
// print_r($details);
// die();
include 'header.php';
?>
<style>
    .table1 td{
        color: #000;
    }
</style>
<div class="container">
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <div class="panel panel-primary" >
                    <div class="panel-heading">
                        <h4 class="box-title text-center">Bin Name:&nbsp;&nbsp;&nbsp;<?php echo $bin->bin_number;?> &nbsp;(total item:<?php echo $item_count;?>) 
                    
                         &nbsp;</a></h4>
                    </div>
                    <div class="btn-toolbar button11">
                        <a class="btn btn-info pull-left" href="#" onclick="window.history.back();">Go back</a>
                        <?php if ($details->status == 1) { ?>
                        <a class="btn btn-default pull-right " href="<?php echo base_url();?>super_admin_c/item/<?php echo $bin->bin_id . '/' . $bin->bin_number ?>">
                            <span class="fa fa-plus"></span> &nbsp; Add New Item</a>
                        <?php } ?>
                    </div>
                    <div class="panel-body">
                        
      
                
            </div>
            <div class="box-body">
                <div class="table-responsive"style="width:100% !important">
                <table id="table tb1" class="table table1 table-bordered dataTable " cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th width="20%">Sl.</th>
                        <th width="60%">Item Name</th>
                        <th width="20%">Quantity</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach($item_bin as $c)
                    {
                        ?>
                        
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $c['item_number'];?></td>
                            <td><?php echo $c['it_no'];?></td>
                           
                        </tr>
                       
                        <?php
                        $i++;
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
<?php //echo $pagination; ?>
</div>
<script>
    $(document).ready(function() {
    $('#table').DataTable({
        "searching": false
    });
    
    $('.delete').click(function (){
   var answer = confirm("Are you sure you want to Delete?");
      if (answer) {
         return true;
      }else{
         return false;
      }
});
} );
</script>
<script>
    $(document).ready(function () {
        $('#tb1').dataTable({
            bFilter: false,
            bInfo: false,
            iDisplayLength: 25,
            bLengthChange: false
        });
    });
</script>
