<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/bootstrap-fileupload/bootstrap-fileupload.css'); ?>" />

<style type="text/css">

    #videosList {
        max-width: 600px; 
        overflow: hidden;
    }

    .video {
        background-image: url('https://img.youtube.com/vi/nZcejtAwxz4/maxresdefault.jpg');
        height: 330px;
        width: 600px;
        margin-bottom: 50px;
    }

    /* Hide Play button + controls on iOS */
    video::-webkit-media-controls {
        display:none !important;
    }

</style>

<script type="text/javascript">

    var figure = $(".video").hover(hoverVideo, hideVideo);
    function hoverVideo(e) {
        $('video', this).get(0).play();
    }

    function hideVideo(e) {
        $('video', this).get(0).pause();
    }
</script>

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
                Update <?php echo $this->_moduleName; ?>
                <span class="tools pull-right">
                    <a class="btn btn-info" href="<?php echo admin_url($this->_module); ?>"><span>Manage</span></a>
                </span>
            </header>
            <div class="panel-body">
                <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
                   
                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Title<span class="req"> * </span></label>
                        <div class="col-lg-8">
                            <input type="text" name="title" value="<?php echo!empty($allData->title) ? $allData->title : ""; ?>" placeholder="Title" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">YouTube URL<span class="req"> * </span></label>
                        <div class="col-lg-8">
                            <input type="url" name="youtube_url" value="<?php echo!empty($allData->youtube_url) ? $allData->youtube_url : ""; ?>" placeholder="YouTube URL" class="form-control" />
                        </div>
                    </div>
                 

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-danger" name="submit" value="1">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>