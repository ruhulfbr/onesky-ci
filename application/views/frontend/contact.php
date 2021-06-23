    <section id="contact-info">
        <div class="center">                
            <h2>How to Reach Us?</h2>
           <!--  <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p> -->
        </div>
        <div class="gmap-area">
            <div class="container">
                <div class="row">



                    <div class="col-sm-5 text-center">
                        <div class="gmap">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.4117597264953!2d90.41745696444569!3d23.732691734598177!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b85b7f8529a1%3A0x137ad7d0c67e3a96!2z4KaP4Ka4IOCmjyDgpq3gpqzgpqgsIFRveWVuYmVlIENpcmN1bGFyIFJvYWQsIOCmouCmvuCmleCmvg!5e0!3m2!1sbn!2sbd!4v1489224070081" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe></iframe>
                        </div>
                    </div>

                    <div class="col-sm-7 map-content">
                        <ul class="row">
                            <li class="col-sm-6">
                                <address>
                                    <h5>Corporate Office</h5>
                                    <p>S.A Bhaban (6th floor),<br/> 115/23 Motijheel Circular Road<br/> Dhaka-1000, Bangladesh</p>
                                </address>

                                <address>
                                    <h5>For Corporate Internet :</h5>                             
                                    <p>&nbsp;&nbsp;+88 01980011577</p>
                                    <p> &nbsp;&nbsp;sales@onesky.com.bd</p>
                                    <h5>For Bandwidth :</h5>
                                    <p> &nbsp;&nbsp;+88 01980011577</p>
                                    <p> &nbsp;&nbsp;sales@onesky.com.bd</p>
                                    
                                </address>
                            </li>


                            <li class="col-sm-6">
                                <address>
                                    <h5>Support Department</h5>
                                    <p>Customer Support : +88 09666772772</p>
                                    <p>Email : support@onesky.com.bd</p>
                                </address>

                                <address>
                                    <h5>Website</h5>
                                    <p><a href="http://www.onesky.com.bd/" target="_blank">www.onesky.com.bd</a></p>
                                </address>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>  <!--/gmap_area -->

    <section id="contact-page">
        <div class="container">
            <div class="center">        
                <h2>Drop Your Message</h2>
                <!-- <p class="lead">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
            </div> 
            <div class="row contact-wrap"> 
                
                <form class="contact-form" method="post" action="">
                     <div class="col-sm-10 col-sm-offset-1">
                    <?php if($this->session->flashdata('error_msg')){ ?>
                    <div class="status alert alert-danger"><?php echo $this->session->flashdata('error_msg'); ?></div>
                    <?php } ?>
                    <?php if($this->session->flashdata('success_msg')){ ?>
                    <div class="status alert alert-success"><?php echo $this->session->flashdata('success_msg'); ?></div>
                    <?php } ?>
                    </div>

                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="form-group">
                            <label>Name *</label>
                            <input type="text" name="name" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" name="email" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="number" name="phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" name="company_name" class="form-control">
                        </div>                        
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Subject *</label>
                            <input type="text" name="subject" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Message *</label>
                            <textarea name="message" id="message" required="required" class="form-control" rows="8"></textarea>
                        </div>                        
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary btn-lg">Submit Message</button>
                        </div>
                    </div>
                </form> 
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#contact-page-->
