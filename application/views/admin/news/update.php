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
                Edit 
                <span class="tools pull-right">
                    <a class="btn btn-info" href="<?php echo admin_url($this->_module); ?>"><span>Manage</span></a>
                </span>
            </header>
            <div class="panel-body">
                <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">

                    <div class="clearfix"></div>
                    <div class="form-group col-lg-12">
                        <label class="control-label col-md-3">Image<span class="req">*</span></label>
                        <?php
                        $image = !empty($allData->image_name) ? getMediaUrl('news', 'thumbs', $allData->image_name) : "";
                        ?>
                        <div class="col-md-9">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="<?php echo $image; ?>" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select Image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="image_name"/>
                                    </span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                                <br>
                                <span class="label label-danger">NOTE!</span><span> For best view please choose image size w: 1000px X h: 1100px.</span>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="form-group col-lg-12">
                        <label class="col-lg-3 col-sm-3 control-label">News Title<span class="req"> * </span></label>
                        <div class="col-lg-9">
                            <input type="text" name="title" value="<?php echo set_value('title', $allData->title); ?>" placeholder="News Title" class="form-control" />
                        </div>
                    </div>


                    <div class="clearfix"></div>
                    <div class="form-group col-lg-12">
                        <label class="col-lg-3 col-sm-3 control-label">News Details<span class="req"> * </span></label>
                        <div class="col-lg-9">
                            <textarea name="description" placeholder="News Details" class="form-control mceEditor"><?php echo set_value('description', $allData->description); ?></textarea>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                     <div class="form-group col-lg-6">
                        <label class="col-lg-12 col-sm-12 control-label">News Author<span class="req"> </span></label>
                        <div class="col-lg-9">
                            <input type="text" name="news_author" value="<?php echo set_value('news_author', $allData->news_author); ?>" placeholder="News Author" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="col-lg-3 col-sm-3 control-label">News Date<span class="req"> * </span></label>
                        <div class="col-lg-9">
                            <input type="text" name="news_date" value="<?php echo set_value('news_date', $allData->news_date); ?>" placeholder="News Date" class="form-control default-date-picker" />

                        </div>
                    </div>


                    <div class="clearfix"></div>
                    <div class="form-group col-lg-12">
                        <label class="col-lg-3 col-sm-3 control-label">Status</label>
                        <div class="col-lg-6">
                            <label class="checkbox-inline">
                                <input type="radio" name="status" value="active" <?php echo!empty($allData) && $allData->status == 'active' ? 'checked' : set_radio('status', 'active'); ?>> Active
                            </label>
                            <label class="checkbox-inline">
                                <input type="radio" name="status" value="inactive" <?php echo!empty($allData) && $allData->status == 'inactive' ? 'checked' : set_radio('status', 'inactive'); ?>> Inactive
                            </label>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="form-group col-lg-12">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-danger" name="submit" value="1">Update</button>
                        </div>
                    </div>

                </form>
            </div>
        </section>
    </div>
</div>

<script type="text/javascript">

    var baseurl = "<?php echo base_url(); ?>";
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
                    var html = "<div class='col-md-2' style='overflow: hidden; background: #fff; margin-bottom:10px;'>";
                    html += "<div class ='thumb' style='width:100%; overflow: hidden;float: left; background: #fff; padding: 5px; margin-right: 12px;'>";
                    html += "<img width='148' height='107' src=' " + e.target.result + " '>";
                    html += "</div><!--thumb-->";
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


<script type="text/javascript">

    $(document).ready(function () {

        /*$("#address").blur(function() {
         address = $('#address').val();
         getAddress(address);
         });*/

        $("#address").keyup(function () {
            var address = $('#address').val();
            getAddress(address);
        });
    });
    function getAddress(address) {

        $('.show_loader').show(); // show loader

        $('#lat').val('');
        $("#lon").val('');
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: baseUrl + "doreenadmin/news/getLatLongByAddress", // replace with your php file or class method
            data: {
                address: address
            },
            success: function (data) {

                if (data.status == 1) {
                    $('.show_loader').hide(); // hide loader
                    $('.ajax_err').hide(); // hide error

                    $('#lat').val(data.latitude);
                    $("#lon").val(data.longitude);
                } else {

                    $('.show_loader').hide(); // hide loader
                    //$('.ajax_err').hide(); // hide error

                    $('#lat').val('');
                    $("#lon").val('');
                    var errMsg = errorMsg(data.message);
                    $(".ajax_err").html(errMsg);
                }
            },
            error: function (data) {
                $('.show_loader').hide(); // hide loader
                //var errMsg = errorMsg("Unable get Lat or Long.");
                $(".ajax_err").html(data.message);
            }
        });
    }

    function errorMsg(message) {
        return '<span class="label label-danger">' + message + '</span>';
    }

</script>