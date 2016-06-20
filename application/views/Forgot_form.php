<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Shop | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/login.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">


            </div>

            <div class="container">
                <div class="card card-container">
                    <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
                    <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
                    <p id="profile-name" class="profile-name-card"></p>
                    <?php if(!empty($message)) echo $message; ?>
                    <form action="<?php echo base_url();?>login/forgot_password" method="post">
                        <span id="reauth-email" class="reauth-email"></span>
                        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Your Email address">
                        <br>
                        <p class="text-center">
                            <em>Please provide your email address. We will send you information about reseting your password.</em>
                        </p>
                        <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Send</button>
                    </form>
                </div><!-- /card-container -->
            </div><!-- /container -->

            <script src="<?php echo base_url() ?>assets/js/jquery-2.1.1.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
            <script src="<?php echo base_url(); ?>assets/js/login.js" type="text/javascript"></script>

    </body>
</html>
