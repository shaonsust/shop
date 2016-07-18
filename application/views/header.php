<?php

$user_id = $this->session->userdata('user_id');
$user_role = $this->session->userdata('user_role');
$user_name = $this->session->userdata('user_name');

if (empty($user_id) || empty($user_role))
    redirect('login');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Bin counting app</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/Amazon_pick_list.css">
        

        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-2.2.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
          <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
          <script src="//code.jquery.com/jquery-1.10.2.js"></script>
          <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
          <link rel="stylesheet" href="/resources/demos/style.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
          <script>
//          $(function() {
//
//            $( "#datepicker" ).datepicker({dateFormat: "yy-mm-dd"});
//            $( "#updatepicker" ).datepicker({dateFormat: "yy-mm-dd"});
//          });
//          $(function() {
//
//            $( "#updatepicker" ).datepicker({dateFormat: "yy-mm-dd"});
//          });
          </script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dataTables.responsive.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/responsive.bootstrap.min.js"></script>
    </head>
    <body>

        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>super_admin_c">Home</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav pull-right">
                        <li><a href="<?php echo base_url(); ?>super_admin_c/projects/0">Projects</a></li>
                        
                        <!-- <li><a href="<?php echo base_url(); ?>super_admin_c/projects">Start New Count Page</a></li> -->
                        <?php if ($user_role == 1) { ?>
                            <li><a href="<?php echo base_url(); ?>users/users_list">Users</a></li>
                            <li><a href="<?php echo base_url(); ?>users/create_users">Create Users</a></li>         
                        <?php } ?>                        
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo base_url(); ?>super_admin_c">Hi, <?php echo $user_name; ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">                                
                                <li><a href="<?php echo base_url(); ?>users/myaccount/<?php echo $user_id; ?>">My Account</a></li>
                                <li><a href="<?php echo base_url(); ?>login/logout">Logout</a></li>
                            </ul>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>