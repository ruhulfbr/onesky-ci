<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/bootstrap-fileupload/bootstrap-fileupload.css'); ?>" />
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

        <section class="panel">
            <header class="panel-heading">
                Add <?php echo $this->_moduleName; ?>
                <span class="tools pull-right">
                    <a class="btn btn-info" href="<?php echo admin_url($this->_module); ?>"><span><i class="fa fa-sign-out"></i>  Manage</span></a>
                </span>
            </header>
            <div class="panel-body">
                <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Title<span class="req">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" name="title" value="<?php echo set_value('title'); ?>" placeholder="Title" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Choose Images (Multiple) <span class="req">*</span></label>
                        <div class="col-lg-10">
                            <input type="file" style="border:0px; height:auto; padding:0; background-color:unset; margin-bottom: 10px" name="gallery_images[]" multiple="multiple" value="" id="" onchange="readMultipleURL(this)">
                            <span class="label label-danger">NOTE!</span><span> For best view please upload image 600px X 500px.</span>
                            <br>
                            <div class="gallery photo_preview">
                                <div class="thumbview">
                                    <ul id="imageList"> </ul> 
                                    <div class="clear0"></div>
                                </div><!--gridview-->
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-8">
                            <button type="submit" class="btn btn-block btn-success" name="submit" value="1">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>

<script type="text/javascript">

    //For Multiple Image upload
    function readMultipleURL(input) {
        // show the loader
        $('#loader').show();
        var j = 0;
        // removed the existing li
        $('#imageList li').remove();
        for (var i = 0; i < input.files.length; i++) {
            if (input.files && input.files[i]) {
                var reader = new FileReader();
                reader.onload = function (e) {

                    var html = "<div style='width:100%; overflow: hidden; background: #fff; padding: 5px;'>";
                    html += "<div class='thumb' style='width:160px; overflow: hidden;float: left; background: #fff; padding: 5px; margin-right: 12px;'>";
                    html += "<img width='148' height='107' src=' " + e.target.result + " '>";
                    // html += "<p class='add_make_cover'><input type='radio' name='is_home' value='" + j + "'> Make Cover</p>";
                    html += "</div><!--thumb-->";
                    html += "<div class='infos' style='width :600px; float: left;'>";
                    html += "<p><input style='width: 100%; margin-top: 5px;' type='text' name='caption[]' placeholder='Caption' value=''></p>";
                    html += "</div><!--info-->";
                    html += "</div>";
                    $('#imageList').append(html);

                    j++;
                };
                reader.readAsDataURL(input.files[i]);
            }
        }

        $('#loader').show(0).delay(2000).hide(0);

    }
</script>