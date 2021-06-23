<!-- page start-->
<div class="row">
    <aside class="profile-nav col-lg-3">
        <section class="panel">
            <div class="user-heading round">
                <a id="photo">
                    <?php $photoSrc = !empty($photo) ? base_url('assets/media/admin_user/' . $photo) : base_url('assets/media/admin_user/nophoto.jpg'); ?>
                    <img src="<?php echo $photoSrc; ?>" alt="">
                </a>

                <h1><?php echo $first_name . ' ' . $last_name; ?></h1>
                <p><?php echo $email; ?></p>
            </div>
        </section>
    </aside>
    <aside class="profile-info col-lg-9">
        <?php if (!empty($error)) { ?>
            <div class="alert alert-block alert-danger fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="fa fa-times"></i>
                </button>
                <?php echo $error; ?>
            </div>
            <?php
        }
        if ($this->session->flashdata('success_msg')) {
            ?>
            <div class="alert alert-success fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="fa fa-times"></i>
                </button>
                <?php echo $this->session->flashdata('success_msg'); ?>
            </div>
        <?php } ?>

        <section class="panel">
            <div class="bio-graph-heading">
                Profile Modify
            </div>
            <div class="panel-body bio-graph-info">
                <h1> Profile Info</h1>

                <form class="form-horizontal" role="form" method="post" action="">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">First Name</label>

                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="f-name" name="first_name" placeholder=" " value="<?php echo $first_name ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Last Name</label>

                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="l-name" placeholder=" " name="last_name" value="<?php echo $last_name ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Email</label>

                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="email" placeholder=" " value="<?php echo $email ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Phone</label>

                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="mobile" placeholder=" " name="phone" value="<?php echo $phone ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-info" name="profileInfoSubmit" value="1">Save</button>
                            <button type="button" class="btn btn-default">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <section>
            <div class="panel panel-primary">
                <div class="panel-heading"> Change Avatar</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="">

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Change Avatar</label>

                            <div class="col-lg-6">
                                <input type="file" name="photo" class="file-pos" id="exampleInputFile" onchange="readURL(this, 'photo')">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-info" name="avatarSubmit" value="1">Save</button>
                                <button type="button" class="btn btn-default">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <section>
            <div class="panel panel-primary">
                <div class="panel-heading"> Sets New Password</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="post" action="">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Current Password</label>

                            <div class="col-lg-6">
                                <input type="password" class="form-control" id="c-pwd" name="old_password" placeholder=" ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">New Password</label>

                            <div class="col-lg-6">
                                <input type="password" class="form-control" id="n-pwd" name="password" placeholder=" ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Re-type New Password</label>

                            <div class="col-lg-6">
                                <input type="password" class="form-control" id="rt-pwd" name="confirm_new_password" placeholder=" ">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-info" name="passwordSubmit" value="1">Save</button>
                                <button type="button" class="btn btn-default">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </aside>
</div>

<script type="text/javascript">
    // function for view the image on the fly
    function readURL(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                jQuery('#' + id).html("<img src='" + e.target.result + "' width='140' >");
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>