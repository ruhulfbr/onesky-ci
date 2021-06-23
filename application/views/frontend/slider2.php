    <section id="main-slider" class="no-margin">
        <div class="carousel slide">
            <ol class="carousel-indicators">
                <li data-target="#main-slider" data-slide-to="0"></li>
                <li data-target="#main-slider" data-slide-to="1"></li>
                <li data-target="#main-slider" data-slide-to="2" class="active"></li>
                <li data-target="#main-slider" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">

                <?php if(!empty($banners)){ foreach ($banners as $key => $item) { ?>

                <div class="item active" style="background-image: url(<?php echo base_url('assets/frontend/'); ?>images/slider/bg10.jpg)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div style="color: black" class="carousel-content">
                                    <h1 style="color: black" class="animation animated-item-1">Everything Needs !</h1>
                                    <h2 style="color: black" class="animation animated-item-2">Start Your InterNet Business With OneSky</h2>
                                    <li style="color: black"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp; Corporate Internet</li>
                                    <li style="color: black"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp; Bandwidth</li>
                                    <li style="color: black"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp; Network Solution</li>
                                    <li style="color: black"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp; Customer Support</li>
                                    <a class="btn-slide animation animated-item-3" href="contact-us.php">Contact Us</a>
                                </div>
                            </div>

                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="slider-img">
                                    <img src="<?php echo base_url('assets/frontend/'); ?>images/slider/img2.png" class="img-responsive">
                                </div>
                            </div>

                        </div>
                    </div>
                </div><!--/.item-->

                <div class="item" style="background-image: url(<?php echo base_url('assets/frontend/'); ?>images/slider/bg2.jpg)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1">Ready to get started</h1>
                                    <h2 class="animation animated-item-2">Corporate Sales : +88 01980011578</h2>
                                    <h2 class="animation animated-item-2">Bandwidth : +88 01980011577</h2>
                                    <a class="btn-slide animation animated-item-3" href="about-us.php">Learn More</a>
                                </div>
                            </div>

                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="slider-img">
                                    <img src="<?php echo base_url('assets/frontend/'); ?>images/slider/img1.png" class="img-responsive">
                                </div>
                            </div>

                        </div>
                    </div>
                </div><!--/.item-->

                <div class="item active" style="background-image: url(<?php echo base_url('assets/frontend/'); ?>images/slider/bg1.jpg)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1">24/7/365 Days Support </h1>
                                    <h2 class="animation animated-item-2">+88 09666772772, +88 09611344344</h2>
                                    <a class="btn-slide animation animated-item-3" href="contact-us.php">Contact Us</a>
                                </div>
                            </div>
                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="slider-img">
                                    <img src="<?php echo base_url('assets/frontend/'); ?>images/slider/img3.png" class="img-responsive">
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.item-->
                <div class="item" style="background-image: url(<?php echo base_url('assets/frontend/'); ?>images/slider/bg11.jpg)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 style="color:black" class="animation animated-item-1">Features of Sky Tracker !</h1>
                                    <li style="color: #ff9900"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp; Live Tracking</li>
                                    <li style="color: #ff9900"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp; Geo-fence/ Parking Alerts</li>
                                    <li style="color: #ff9900"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp; Remote Engine Shutdown Feature</li>
                                    <li style="color: #ff9900"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp; Over Speed Alert</li>
                                    <li style="color: #ff9900"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp; SOS Emergency Button</li>
                                    <li style="color: #ff9900"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp; Real Time Push Alerts</li>
                                    <li style="color: #ff9900"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp; Live Audio Record</li>
                                    <li style="color: #ff9900"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp; Low/ Disconnection Alert</li>
                                    <li style="color: #ff9900"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp; Mileage Report</li>
                                    <li style="color: #ff9900"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp; 365/24/7 Customer Service</li>

                                    <a class="btn-slide animation animated-item-3" href="http://skytracker.onesky.com.bd/" target="_blank">Visit Here To know More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.item-->

            <?php }} ?>

            </div><!--/.carousel-inner-->
        </div><!--/.carousel-->
        <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
            <i class="fa fa-chevron-left"></i>
        </a>
        <a class="next hidden-xs" href="#main-slider" data-slide="next">
            <i class="fa fa-chevron-right"></i>
        </a>
    </section><!--/#main-slider-->