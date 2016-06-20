<?php

include 'header.php';
$numberOfItem = $total_item1->qty_scaned;
?>

<div class="container">

    <div class="col-md-offset-2 col-sm-4 col-md-8" style="margin-top: 10%">
        <div class="modal-content" >

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">                        
                        <?php 
                            $message = $this->session->userdata('message');
                            if(isset($message) && !empty($message))
                            {
                                echo '<p id="sessionMessage">'.$message.'</p>';
                                $this->session->unset_userdata('message');
                            }
                        ?>
                        <label><h3>Please Enter/Scan the Item's Barcode Number:  <br><small>You are scanning <?php echo $total_item1->barcode;  ?> barcode</small></h3></label>
                       
                        <input type="text" id = "item_num" name = "item" autofocus="true" style="width: 100%; height: 40px; border-radius: 5px;">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">                    	
                        <div class="col-md-6">                                
                                <span id="itemCount">
                                <?php                                
                                     echo $numberOfItem;
                                ?>
                                </span> 
                                product(s) scanned against  
                                <?php 
                                     echo $total_item1->qty;
                                ?>                                
                        </div>
                        <div class="col-md-6">
                        	
                            <a href="<?php echo base_url() . 'super_admin_c/box_list/' . $pid . '/' . $barcode . '/' . 1 ?>" class="btn btn-danger pull-" role="button">New Box</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#item_num").change(function (event) {
            $("#sessionMessage").remove();
            $("#message").css({color:'orange'});
            $("#message").text('Processing Your Request');
            var bar_num = $(this).val();
            var bin_id = $(".bin").val();
            
            var pid = <?php echo $pid;?>;
            if(bar_num != <?php echo $barcode;?>)
            {
                alert("Barcode is not matched");
                return false;
            }
//            if(item_num.length > 10)
//            {                
                $.ajax({
                method: "POST",
                url: "<?php echo base_url(); ?>super_admin_c/barcode_calculation/",
                data: {pid: <?php echo $pid; ?>, barcode: <?php echo $barcode; ?>, box_id: <?php echo $box_id; ?>, bar_no : bar_num}
                }).done(function (msg) {
                    if (msg != 0)
                    {
                        $("#itemCount").text(msg);
                        $("#message").css({color:'green'});
                        $("#message").text("Item Inserted Successfully");
                        $("#item_num").val('');
                        $("#item_num").focus();
                    }
                    else {
                        alert("Too many items inserted.");
                    	window.location.replace("<?php echo base_url() ?>super_admin_c/pick_list/" + pid);
                        $("#message").css({color:'red'});
                        $("#message").text("Something Went Wrong Please Try again!!");
                        $("#item_num").val('');
                        $("#item_num").focus();
                    }
                });
//            }
//            else {
//                $("#message").css({color:'red'});
//                $("#message").text('Barcode Length is below standard!! Please Try again.');
//                $("#item_num").val('');
//                $("#item_num").focus();
//            }
            
        });
    });
</script>

<?php
include 'footer.php';
?>