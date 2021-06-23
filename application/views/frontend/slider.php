    <section id="main-slider" class="no-margin">
        <div class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php if(!empty($banners)){ foreach ($banners as $key => $item) { ?>
                <li data-target="#main-slider" data-slide-to="<?php echo $key; ?>" class="<?php echo $key==0 ? 'active' : ""; ?>"></li>
            <?php }} ?>

            </ol>
            <div class="carousel-inner">

                <?php if(!empty($banners)){ foreach ($banners as $key => $item) { ?>

                <div class="item <?php echo $key==0 ? 'active' : ""; ?>" style="background-image: url(<?php echo base_url($banner_path.$item->image_name); ?>)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div style="color: black" class="carousel-content">
                                    <?php if(!empty($item->title_one)){ ?>
                                    <h1 style="color: black" class="animation animated-item-1"><?php echo $item->title_one; ?></h1>
                                    <?php } ?>

                                    <?php if(!empty($item->title_two)){ ?>
                                    <h2 style="color: black" class="animation animated-item-2"><?php echo $item->title_two; ?></h2>
                                    <?php } ?>

                                    <?php if(!empty($item->title_three)){ ?>
                                    <h2 style="color: black" class="animation animated-item-2"><?php echo $item->title_three; ?></h2>
                                    <?php } ?>

                                    <?php if(!empty($item->description)){ echo $item->description; } ?>

                                    <?php if(!empty($item->button_name)){ ?>
                                    <a class="btn-slide animation animated-item-3" href="<?php echo $item->hyperlink ? $item->hyperlink : "#"; ?>"><?php echo $item->button_name; ?></a>
                                    <?php } ?>
                                </div>
                            </div>

                            <?php if(!empty($item->image_2)){ ?>

                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="slider-img">
                                    <img src="<?php echo base_url($banner_path.$item->image_2); ?>" class="img-responsive">
                                </div>
                            </div>
                        <?php } ?>

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