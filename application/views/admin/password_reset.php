<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Sayeed">
        <meta name="keyword" content="Login, Dashboard, Admin">
        <link rel="shortcut icon" href="<?php echo base_url('assets/admin/img/favicon.png'); ?>">

        <title>FlatLab - Flat & Responsive Bootstrap Admin Template - Password Recovery</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url('assets/admin/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/admin/css/bootstrap-reset.css'); ?>" rel="stylesheet">
        <!--external css-->
        <link href="<?php echo base_url('assets/admin/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="<?php echo base_url('assets/admin/css/style.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/admin/css/style-responsive.css'); ?>" rel="stylesheet" />

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
        <script src="<?php echo base_url('assets/admin/js/html5shiv.js'); ?>"></script>
        <script src="<?php echo base_url('assets/admin/js/respond.min.js'); ?>"></script>
        <![endif]-->
    </head>

    <body class="login-body">

        <div class="container">

            <form class="form-signin" name="formSingin" action="" enctype="multipart/form-data" method="post">
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;">
                        <img src="<?php echo base_url('assets/admin/img/jeancelestephotography-logo.png'); ?>" alt="" title="">
                    </div>
                </div>

                <h2 class="form-signin-heading">Password Reset</h2>

                <div class="login-wrap">
                    <?php if (!empty($error)) { ?>
                        <div class="alert alert-block alert-danger fade in">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            <?php echo $error; ?>
                        </div>
                    <?php } elseif ($this->session->flashdata('password_reset')) { ?>
                        <div class="alert alert-success fade in">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            <?php echo $this->session->flashdata('password_reset'); ?>
                        </div>
                    <?php } ?>                    
                    <input type="password" class="form-control" name="password" id="password" placeholder="New Password" autofocus>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm New Password">
                    <label class="checkbox">
                        <span class="pull-right">
                            <a href="<?php echo base_url('adminoffice'); ?>"> Back To Login</a>
                        </span>
                    </label>
                    <button class="btn btn-lg btn-login btn-block" type="submit" value="Submit" name="submit">Submit</button>                    
                </div>
            </form>
        </div>
        <!-- js placed at the end of the document so the pages load faster -->
        <script src="<?php echo base_url('assets/admin/js/jquery.js'); ?>"></script>
        <script src="<?php echo base_url('assets/admin/js/bootstrap.min.js'); ?>"></script>
    </body>
</html>
