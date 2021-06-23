<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo !empty($pageTitle) ? $pageTitle . " | " : ""; ?> OneSky</title>
	<!-- core CSS -->
    <link href="<?php echo base_url('assets/frontend/'); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/frontend/'); ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/frontend/'); ?>css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/frontend/'); ?>css/prettyPhoto.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/'); ?>style.css">
    <link href="<?php echo base_url('assets/frontend/'); ?>css/main.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/frontend/'); ?>css/responsive.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo base_url('assets/frontend/'); ?>images/favicon.png">
    
</head><!--/head-->

<style>
    .navbar-nav>li {
        margin-left: 5px;
    }
</style>


<body class="homepage">
    <header id="header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <div class="top-bar">

            <div class="container">

                <div class="row">

                    <div class="col-sm-6 col-xs-7">
                        <div class="top-number"><p><i class="fa fa-phone-square"></i>&nbsp; Sales : +88 01980011577  &nbsp;|&nbsp; Support : +88 09666772772</p></div>

                    </div>

                    <div class="col-sm-6 col-xs-5">

                       <div class="social">

                            <ul class="social-share">

                                <li><a target="_blank" href="https://www.facebook.com/OneSky.ISP/"><i class="fa fa-facebook"></i></a></li>

                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>

                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li> 

                                <li><a href="#"><i class="fa fa-skype"></i></a></li>

                            </ul>

<!--                             <div class="search">

                                <form role="form">

                                    <input type="text" class="search-form" autocomplete="off" placeholder="Search">

                                    <i class="fa fa-search"></i>

                                </form>

                           </div> -->

                       </div>

                    </div>

                </div>

            </div><!--/.container-->

        </div><!--/.top-bar-->

        <style type="text/css">            
            .navbar-toggle{
                background: #222 !important;
            }
        </style>

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/frontend/'); ?>images/logo.png" alt="logo"></a>

                </div> 

                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="<?php echo !empty($tabActive) && $tabActive == 'home' ? 'active' : ""; ?>"><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="<?php echo !empty($tabActive) && $tabActive == 'about' ? 'active' : ""; ?>"><a href="<?php echo base_url('main/about'); ?>">About</a></li>
                        <li class="<?php echo !empty($tabActive) && $tabActive == 'service' ? 'active' : ""; ?>"><a href="<?php echo base_url('main/service'); ?>">Services</a></li>
                        <li class="<?php echo !empty($tabActive) && $tabActive == 'package' ? 'active' : ""; ?>" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Packages <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <?php
                                    $categories = ['Home', 'SME', 'Corporate', 'Out Of Dhaka'];
                                    foreach ($categories as $category) {
                                ?>
                                <li><a href="<?php echo base_url('main/packages?category='.$category); ?>"><?php echo $category; ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <!-- <li><a href="#">Bandwidth</a></li> -->

                        <li class="<?php echo !empty($tabActive) && $tabActive == 'branch' ? 'active' : ""; ?>"><a href="<?php echo base_url('main/branches'); ?>">Branches</a></li>
                        <li><a href="http://skytracker.onesky.com.bd/" target="_blank">Sky Tracker</a></li> 
                        <li><a href="<?php echo base_url(); ?>training" target="_blank">Training</a></li> 
                        <li class="<?php echo !empty($tabActive) && $tabActive == 'payment' ? 'active' : ""; ?>" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Payment <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url('main/bkashPayment'); ?>">bKash Billing Syatem</a></li>
                                <li><a href="<?php echo base_url('main/onlinePayment'); ?>">Online Payment</a></li>
                            </ul>
                        </li>
                        <li class="<?php echo !empty($tabActive) && $tabActive == 'contact' ? 'active' : ""; ?>"><a href="<?php echo base_url('main/contact'); ?>">Contact</a></li>                        

                    </ul>

                </div>

                <div class="collapse navbar-collapse navbar-right" style="display: none !important;">
                    <ul class="nav navbar-nav">
                        <li class="<?php echo !empty($tabActive) && $tabActive == 'home' ? 'active' : ""; ?>"><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="<?php echo !empty($tabActive) && $tabActive == 'about' ? 'active' : ""; ?>"><a href="<?php echo base_url('about-us'); ?>">About</a></li>
                        <li class="<?php echo !empty($tabActive) && $tabActive == 'service' ? 'active' : ""; ?>"><a href="<?php echo base_url('service'); ?>">Services</a></li>
                        <li <?php echo !empty($tabActive) && $tabActive == 'package' ? 'active' : ""; ?>><a href="<?php echo base_url('packages'); ?>">Packages</a></li>
                        <!-- <li><a href="#">Bandwidth</a></li> -->

                        <li class="<?php echo !empty($tabActive) && $tabActive == 'package' ? 'active' : ""; ?>" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Packages <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <?php
                                    $categories = ['Home', 'SME', 'Corporate', 'Out Of Dhaka'];
                                    foreach ($categories as $category) {
                                ?>
                                <li><a href="<?php echo base_url('packages/'.$category); ?>"><?php echo $category; ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>

                        <li class="<?php echo !empty($tabActive) && $tabActive == 'branch' ? 'active' : ""; ?>"><a href="<?php echo base_url('branches'); ?>">Branches</a></li>
                        <li><a href="http://skytracker.onesky.com.bd/" target="_blank">Sky Tracker</a></li> 
                        <li><a href="<?php echo base_url(); ?>training" target="_blank">Training</a></li>

                        <li class="<?php echo !empty($tabActive) && $tabActive == 'payment' ? 'active' : ""; ?>" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Payment <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url('bKash-payment'); ?>">bKash Billing Syatem</a></li>
                                <li><a href="<?php echo base_url('online-payment'); ?>">Online Payment</a></li>
                            </ul>
                        </li>

                        <li class="<?php echo !empty($tabActive) && $tabActive == 'contact' ? 'active' : ""; ?>"><a href="<?php echo base_url('contact'); ?>">Contact</a></li>                        

                    </ul>

                </div>

            </div><!--/.container-->

        </nav><!--/nav-->

        <hr style="margin-bottom: 0px; margin-top: 0px; padding-top: 0px; padding-bottom: 0px;">

		

    </header><!--/header-->