
<?php
  error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Connecting StartUps Bangladesh (for Growth Stage Startups) ">
        <meta name="author" content="">
        <meta name="keyword" content="">
        

        <title>Login To Admin Panel - <?php echo $this->config->item('PROJECT_TITLE') ?></title>
        <link rel="icon" href="<?php echo base_url('assets/frontend/images/favicon.ico'); ?>">
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
                    <div class="col-xs-12 col-md-12 col-lg-12 loginLogo" style="text-align: center; padding-bottom: 10px">
                        <img data-retina src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Logo" />
                    </div>
                </div>
                <h2 class="form-signin-heading">sign in now</h2>
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

                    <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo set_value('email'); ?>" required autofocus>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    <label class="checkbox">
                        <!--<input type="checkbox" value="remember-me"> Remember me-->
                        <span class="pull-right">
                            <a data-toggle="modal" href="#myModal"> Forgot Password?</a>
                        </span>
                    </label>
                    <button class="btn btn-lg btn-login btn-block" type="submit" value="Sign in" name="sign-in">Sign in</button>
                </div>
            </form>

            <form class="form-signin" id="forgetPass" name="formSingin" action="<?php echo admin_url('auth/forget_password') ?>" enctype="multipart/form-data" method="post">
                <!-- Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Forgot Password ?</h4>
                            </div>
                            <div class="modal-body">
                                <p>Enter your e-mail address below to reset your password.</p>
                                <div id="forgetPasswordResult"></div>
                                <input type="text" name="email" id="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix" style="margin-bottom: 5px">

                            </div>
                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                                <button class="btn btn-success" type="submit" name="forgetPassword" id="forgetPassword" value="Sumbit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->
            </form>
        </div>
        <!-- js placed at the end of the document so the pages load faster -->
        <script src="<?php echo base_url('assets/admin/js/jquery.js'); ?>"></script>
        <script src="<?php echo base_url('assets/admin/js/bootstrap.min.js'); ?>"></script>

        <script src="<?php echo base_url('assets/admin/js/jquery.validate.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/admin/js/jquery.form.js'); ?>"></script>

        <script type="text/javascript">
            jQuery(document).ready(function () {
                //////////// FORM VALIDATION /////////////////
                jQuery("#forgetPass").validate({
                    rules: {
                        email: {
                            required: true,
                            email: true
                        }
                    },
                    submitHandler: function (form) {
                        jQuery(form).ajaxSubmit({
                            target: "#forgetPasswordResult"
                        });
                    }
                });

            });
        </script>
        <style type="text/css">
            input.error{
                border: 1px solid red!important;
            }
            label.error{
                color:red!important;
            }
        </style>

    </body>
</html>