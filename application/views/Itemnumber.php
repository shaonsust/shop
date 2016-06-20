<?php

include 'header.php';
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
                        <label><h3>Please Enter/Scan the Item Name/Number:  <br><small>You are inserting item to bin: <?php echo $bin_number; ?></small></h3></label>
                        <p id="message" style="color: black;">Please scan an item to insert</p>
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
                                item(s) inserted under bin 
                                <?php 
                                    echo $bin_number; 
                                ?>                                
                        </div>
                        <div class="col-md-6">
                        	<a href="<?php echo base_url(); ?>super_admin_c/show_details/<?php echo $pro_id; ?>" class="btn btn-success pull-" role="button">Finish & Start New  Bin</a>
                            <a href="<?php echo base_url(); ?>super_admin_c/Finish_Start_new_project/<?php echo $bin_id ;?>" class="btn btn-danger pull-" role="button">Finish Project</a>
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
            var item_num = $(this).val();
            var bin_id = $(".bin").val();
//            if(item_num.length > 10)
//            {                
                $.ajax({
                method: "POST",
                url: "<?php echo base_url(); ?>super_admin_c/item_calculation/",
                data: {item: item_num, bin_id: <?php echo $bin_id; ?>}
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