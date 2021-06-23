    <style type="text/css">
        h3{
            line-height: 25px;
            font-size: 15px;
        }
        h2{
            margin-bottom: -14px;
        }
    </style>

    <section id="feature" class="transparent-bg">
        <div class="container">
           <div class="center wow fadeInDown">
                <h2>Branches Inside Dhaka</h2>
                <!-- <p class="lead">Lorem Ipsum is simply dummy text of the printing and typeseting industry Lorem in text Ipsum has been the industry standar dummyy text ever since the when an iunesi known printer of took a galley of type and scrambled it to make a typea specimen book There are many variations of the paes sages the Lorem Ipsum.</p>
                <p class="lead">Lorem Ipsum is simply dummy text of the printing and typeseting industry Lorem in text Ipsum has been the industry standar dummyy text ever since the when an iunesi known printer of took a galley of type and scrambled it to make a typea specimen book There are many variations of the paes sages the Lorem Ipsum.</p>
             -->
            </div>

            <div class="row">
                <?php if(!empty($items_in_dhaka)){ ?>
                    <div class="features">

                        <?php foreach ($items_in_dhaka as $key => $item) {?>

                        <div class="col-md-6 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                            <div class="feature-wrap">
                                <i class="fa fa-area-chart"></i>
                                <h2><?php echo $item->name; ?></h2>
                                <h3><?php echo $item->address; ?><br><?php echo $item->phone; ?></h3>
                                <iframe src="<?php echo $item->map; ?>" width="100%" height="200" frameborder="0" style="border:5px solid #f2f2f2;" allowfullscreen></iframe>
                            </div>
                        </div><!--/.col-md-4-->

                    <?php } ?>
                        

                    </div><!--/.services-->
                <?php }else{ ?>


                <div class="features">
                    <!--<div class="col-md-6 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">-->
                    <!--    <div class="feature-wrap">-->
                    <!--        <i class="fa fa-area-chart"></i>-->
                    <!--        <h2>Wari Branch   </h2>-->
                    <!--        <h3>12 Larmini Street,Wari,Dhaka</h3>-->
                    <!--        <h3>8801980011710</h3>-->
                    <!--        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.825309092989!2d90.41524201435787!3d23.717931595934083!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8537ebc53bf%3A0xf3f054b07bfa6a5f!2s12+Larmini+St%2C+Dhaka!5e0!3m2!1sbn!2sbd!4v1524742755391" width="100%" height="200" frameborder="0" style="border:5px solid #f2f2f2;" allowfullscreen></iframe>-->
                    <!--    </div>-->
                    <!--</div>-->
                    
                    <!--/.col-md-4-->

                    <!-- <div class="col-md-6 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-area-chart"></i>
                            <h2> Keranigonj Branch    </h2>
                            <h3>73 Kodomtoli Paka Ghat Road,Keranigonj</h3>
                            <h3>8801980011712</h3>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14613.230851957262!2d90.38967222038079!3d23.700703001812887!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjPCsDQyJzAyLjUiTiA5MMKwMjMnNTQuMyJF!5e0!3m2!1sen!2sbd!4v1524745485594" width="100%" height="200" frameborder="0" style="border:5px solid #f2f2f2;" allowfullscreen></iframe>

                        </div>
                    </div> --><!--/.col-md-4-->

                    <div class="col-md-6 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-area-chart"></i>
                            <h2> Gendariya Branch    </h2>
                            <h3>49 Begumgonj Lane,Gendariya</h3>
                            <h3>8801980011711</h3>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3653.047772425491!2d90.42011841435776!3d23.709987996237217!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b9b20f0109cd%3A0x954b71417bf2600b!2z4Kas4KeH4KaX4Kau4KaX4Kae4KeN4KacIOCmsuCnh-CmqCwg4Kai4Ka-4KaV4Ka-!5e0!3m2!1sbn!2sbd!4v1524743617148" width="100%" height="200" frameborder="0" style="border:5px solid #f2f2f2;" allowfullscreen></iframe>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-6 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-area-chart"></i>
                            <h2> Kalabagan Branch      </h2>
                            <h3>152/2B Green Road,Kalabagan,Dhaka</h3>
                            <h3>8801980011588</h3>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.8970516072295!2d90.38359081435851!3d23.751050294669763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8a532599f19%3A0x99c443e52deda733!2zMTUyLCAxNTEvMi9LLzEg4KaX4KeN4Kaw4KeA4KaoIOCmsOCni-CmoSwg4Kai4Ka-4KaV4Ka-IDEyMDU!5e0!3m2!1sbn!2sbd!4v1524743713710" width="100%" height="200" frameborder="0" style="border:5px solid #f2f2f2;" allowfullscreen></iframe>
                        </div>
                    </div><!--/.col-md-4-->
                    
                     <div class="col-md-6 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-area-chart"></i>
                            <h2> Dhalpur Branch      </h2>
                            <h3>60/13/C Dhalpur,Jatrabari,Dhaka</h3>
                            <h3>8801980011713</h3>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d913.2149162397345!2d90.43296082918009!3d23.716704999037884!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjPCsDQzJzAwLjEiTiA5MMKwMjYnMDAuNiJF!5e0!3m2!1sen!2sus!4v1528350039312" width="100%" height="200" frameborder="0" style="border:5px solid #f2f2f2;" allowfullscreen></iframe>
                            
                        </div>
                    </div><!--/.col-md-4-->
                    
                   <!--  <div class="col-md-6 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-area-chart"></i>
                            <h2> Bongshal Branch      </h2>
                            <h3>48/1 K P Ghosh Street, Babu Bazar,Kotowali,Dhaka.</h3>
                            <h3>8801980011714</h3>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d913.2146674699666!2d90.4048810292081!3d23.71674052687994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8fd0a969b47%3A0x14793fd68b1999ce!2sKassabtuly%2FKasaituly+Ln%2C+Dhaka!5e0!3m2!1sen!2sbd!4v1533398253377" width="100%" height="200" frameborder="0" style="border:5px solid #f2f2f2;" allowfullscreen></iframe>
                            
                        </div>
                    </div> -->

                    <!--/.col-md-4-->

                </div>
                <?php } ?>
            </div><!--/.row--> 

            <br>

            <?php if(!empty($items_out_dhaka)){ ?>

            <div class="center wow fadeInDown">
                <h2>Branches Out of Dhaka</h2>
            </div>

            <div class="row">
                <div class="features">
                    <?php foreach ($items_out_dhaka as $key => $item) {?>
                    <div class="col-md-6 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-area-chart"></i>
                            <h2><?php echo $item->name; ?></h2>
                            <h3><?php echo $item->address; ?><br><?php echo $item->phone; ?></h3>
                            <iframe src="<?php echo $item->map; ?>" width="100%" height="200" frameborder="0" style="border:5px solid #f2f2f2;" allowfullscreen></iframe>
                        </div>
                    </div><!--/.col-md-4-->

                    <?php } ?>
                </div><!--/.services-->      
            </div><!--/.row--> 

            <?php } ?>


            <div class="get-started center wow fadeInDown">
                <h2>Ready to get started</h2>
                <div class="request">
                    <h4><a href="<?php echo base_url('main/contact'); ?>">Contact Us</a></h4>
                </div>
            </div><!--/.get-started-->
        </div><!--/.container-->
    </section><!--/#feature-->

