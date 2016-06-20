<?php
include 'header.php';
?>
<div class="container">
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <div class="panel panel-primary" >
                    <div class="panel-heading">
                        <h4 class="box-title text-center">Users List &nbsp; 
                    <a class="btn btn-default pull-right" href="<?php echo base_url();?>users/create_users">
                        <span class="fa fa-plus"></span> &nbsp; Add New Users</a></h4>
                    </div>
                    <div class="panel-body">
                        
      
                
            </div>
            <div class="box-body">
                <div class="table-responsive"style="width:100% !important">
                <table id="table" class="table table-bordered table-hover table-striped dataTable " cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th width="20%">Sl.</th>
                        <th width="50%">User Name</th>
                        <th width="30%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach($users as $c)
                    {
                        ?>
                        <?php if($c['role'] != 1) { ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><a href="<?php echo base_url() . 'users/myaccount/' . $c['id'] ?>" title="Details"><?php echo $c['username'];?></a></td>
                            <td align="center">
                                <a href="<?php echo base_url() . 'users/change_password/' . $c['id'] ?>" class="btn btn-info btn-xs" title="Change Password"><i class="fa fa-list"></i></a>
                                <a href="<?php echo base_url() . 'users/myaccount/' . $c['id'] ?>" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
                                <a href="<?php echo base_url() . 'users/delete_users/' . $c['id'] ?>" class="btn btn-danger btn-xs delete" onclick="return CheckDelete()" title="Delete"><i class="fa fa-remove"></i></a>
                            </td>
                        </tr>
                       <?php  } ?>
                        <?php
                        $i++;
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
    $(document).ready(function() {
    $('#table').DataTable({
        "searching": false
    });
    
    $('.delete').click(function (){
   var answer = confirm("Are you sure?");
      if (answer) {
         return true;
      }else{
         return false;
      }
});
} );
</script>
