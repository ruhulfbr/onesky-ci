
<div class="row">
    <div class="col-lg-12">
        <?php if (!empty($error)): ?>
            <div class="alert alert-block alert-danger fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="fa fa-times"></i>
                </button>
                <strong>Error!</strong> <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('success_msg')): ?>
            <div class="alert alert-block alert-success fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="fa fa-trash"></i>
                </button>
                <strong>Success!</strong><br> <?php echo $this->session->flashdata('success_msg'); ?>
            </div>
        <?php endif; ?>

        <section class="panel">
            <header class="panel-heading">
                <?php echo $this->_moduleName; ?>
            </header>
            <div class="panel-body">
                <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">

                    <!-Bangladesh Contact Address-->
                    <section class="panel">

                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Address </label>
                                <div class="col-lg-10">
                                    <textarea class="form-control mceEditor" name="address_bd" id="address_bd" ><?php echo set_value('address_bd', get_settings_value('address_bd', '')); ?></textarea>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Contact Number(Phone) </label>
                                <div class="col-lg-7">
                                    <input type="text" name="phone_bd" value="<?php echo set_value('phone_bd', get_settings_value('Phone_bd', '')); ?>" placeholder="Contact Number(Phone)" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Contact Number(T&T) </label>
                                <div class="col-lg-7">
                                    <input type="text" name="tt_bd" value="<?php echo set_value('tt_bd', get_settings_value('tt_bd', '')); ?>" placeholder="Contact Number(T&T)" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Email One</label>
                                <div class="col-lg-7">
                                    <input type="text" name="emailone_bd" value="<?php echo set_value('emailone_bd', get_settings_value('emailone_bd', '')); ?>" placeholder=" Email Address" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Email Two</label>
                                <div class="col-lg-7">
                                    <input type="text" name="emailtwo_bd" value="<?php echo set_value('emailtwo_bd', get_settings_value('emailtwo_bd', '')); ?>" placeholder=" Email Address" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Web Site </label>
                                <div class="col-lg-7">
                                    <input type="text" name="web_bd" value="<?php echo set_value('web_bd', get_settings_value('web_bd', '')); ?>" placeholder=" web Site Address" class="form-control" />

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Facebook </label>
                                <div class="col-lg-7">
                                    <input type="text" name="facebook_url" value="<?php echo set_value('facebook_url', get_settings_value('facebook_url', '')); ?>" placeholder=" Fecebook Address" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Twitter </label>
                                <div class="col-lg-7">
                                    <input type="text" name="twitter_url" value="<?php echo set_value('twitter_url', get_settings_value('twitter_url', '')); ?>" placeholder=" Twitter Address" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Google+ </label>
                                <div class="col-lg-7">
                                    <input type="text" name="google_plus_url" value="<?php echo set_value('google_plus_url', get_settings_value('google_plus_url', '')); ?>" placeholder=" Google+ Address" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">LinkedIn </label>
                                <div class="col-lg-7">
                                    <input type="text" name="linked_in_url" value="<?php echo set_value('linked_in_url', get_settings_value('linked_in_url', '')); ?>" placeholder="LinkedIn  Address" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Latitude </label>
                                <div class="col-lg-7">
                                    <input type="text" name="latitude" value="<?php echo set_value('latitude', get_settings_value('latitude', '')); ?>" placeholder="latitude" class="form-control" />
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Longitude </label>
                                <div class="col-lg-7">
                                    <input type="text" name="longitude" value="<?php echo set_value('longitude', get_settings_value('longitude', '')); ?>" placeholder="longitude" class="form-control" />
                                </div>
                            </div>
                        </div>


                    </section>


                    <div class="clearfix"></div>

                    <div class="form-group col-lg-12">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>

