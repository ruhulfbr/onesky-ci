<link href="<?php echo base_url('assets/admin/css/gallery.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/admin/css/slidebars.css'); ?>" rel="stylesheet">

<script src="<?php echo base_url('assets/frontend/js/jquery.fancybox.pack.js'); ?>"></script>
<script src="<?php echo base_url('assets/frontend/js/jquery.fancybox.js'); ?>"></script>
<script src="<?php echo base_url('assets/frontend/js/jquery.fancybox-media.js'); ?>"></script>

<script>
    $(document).ready(function () {
        $(".fancybox-media").fancybox({
            openEffect: 'none',
            closeEffect: 'none',
            helpers: {
                media: {}
            }
        });
    });
</script>

<style type="text/css">
    .grid li {
        width: 24%;
    }

    figcaption{
        text-align: center;

    }
    .cs-style-3 figcaption a {
        position: relative !important;
        bottom: inherit;
        right: inherit;
        margin: 0 2px;
    }
    .grid figcaption a.green{
        background: #5cb85c !important;

    }
    .grid figcaption a.red{
        background: #d9534f !important;

    }
</style>

<?php if ($this->session->flashdata('success_msg')) { ?>
    <div class="alert alert-success fade in">
        <button data-dismiss="alert" class="close close-sm" type="button">
            <i class="fa fa-times"></i>
        </button>
        <?php echo $this->session->flashdata('success_msg'); ?>
    </div>
<?php } ?>

<!--state overview start-->
<div class="row state-overview" style="display: none !important;">

    <div class="col-lg-3 col-sm-6">
        <a href="<?php echo admin_url('committee_member'); ?>">
            <section class="panel">
                <div class="symbol blue">
                    <i class="fa fa-building "></i>
                </div>
                <div class="value">
                    <h1 class=" count4">
                        <?php echo $totalMember; ?>
                    </h1>
                    <p>Member</p>
                </div>
            </section>
        </a>
    </div>

    <div class="col-lg-3 col-sm-6">
        <a href="<?php echo admin_url('video'); ?>">
            <section class="panel">
                <div class="symbol terques">
                    <i class="fa fa-video-camera"></i>
                </div>
                <div class="value">
                    <h1 class=" count4">
                        <?php echo $totalVideo; ?>
                    </h1>
                    <p> Video</p>
                </div>
            </section>
        </a>
    </div>

    <div class="col-lg-3 col-sm-6">
        <a href="<?php echo admin_url('banner'); ?>">
            <section class="panel">
                <div class="symbol red">
                    <i class="fa fa-flag-checkered"></i>
                </div>
                <div class="value">
                    <h1 class=" count4">
                        <?php echo $totalBanners; ?>
                    </h1>
                    <p>Banners</p>
                </div>
            </section>
        </a>
    </div>

    <div class="col-lg-3 col-sm-6">
        <a href="<?php echo admin_url('gallery'); ?>">
            <section class="panel">
                <div class="symbol yellow">
                    <i class="fa fa-picture-o"></i>
                </div>
                <div class="value">
                    <h1 class="count4">
                        <?php echo $totalGallery; ?>
                    </h1>
                    <p>Photo Gallery</p>
                </div>
            </section>
        </a>
    </div>

</div>
<!--state overview end-->


<!--Latest Online Registration and Video Gallery Start-->
<!--<div class="row">

    <div class="col-md-6">
        <section class="panel news_section">

            <header class="panel-heading">
                <a href="<?php echo site_url('requests'); ?>">New Order Request</a> (<?php echo $totalProductRequests; ?>)
            </header>

            <div class="panel-body">
                <div class="tab-content tasi-tab">
                    <div class="tab-pane active">
<?php
if (!empty($productRequests) && count($productRequests) > 0) {
    foreach ($productRequests as $key => $data) {
        ?>
                                                <article class="">
                                                    <div class="media-body" style="margin-bottom: 20px;">
                                                        <a class="p-head" href="<?php echo admin_url('requests/processRequests/' . $data->id) ?>"><?php echo!empty($data->requested_user_name) ? $data->requested_user_name : ""; ?></a>
                                                        <p class="news_date_create"><i class="fa fa-clock-o"></i> <?php echo!empty($data->created) ? longDateHuman($data->created, 'date_time') : ""; ?></p>
                                                        <p class="news_date_create"><i class="fa fa-phone-square"></i> <?php echo!empty($data->requested_user_phone) ? $data->requested_user_phone : ""; ?> <i class="fa fa-envelope"></i> <?php echo!empty($data->requested_user_email) ? $data->requested_user_email : ""; ?></p>
                                                    </div>
                                                </article>
        <?php
    }
}
?>

                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="col-md-6">
        <section class="panel news_section">
            <header class="panel-heading">
                Latest User Registered
            </header>

            <div class="panel-body">
                <div class="tab-content tasi-tab">
                    <div class="tab-pane active">
<?php
if (!empty($registeredUser) && count($registeredUser) > 0) {
    foreach ($registeredUser as $key => $data) {
        ?>
                                                <article class="">
                                                    <div class="media-body" style="margin-bottom: 20px;">
                                                        <a class="p-head" href="<?php echo admin_url('registered_user/view/' . $data->id) ?>"><?php echo!empty($data->user_name) ? $data->user_name : ""; ?></a>
                                                        <p class="news_date_create"><i class="fa fa-clock-o"></i> <?php echo!empty($data->created) ? longDateHuman($data->created, 'datetime') : ""; ?></p>
                                                        <p class="news_date_create"><i class="fa fa-phone-square"></i> <?php echo!empty($data->user_phone) ? $data->user_phone : ""; ?> <i class="fa fa-envelope"></i> <?php echo!empty($data->user_email) ? $data->user_email : ""; ?></p>
                                                    </div>
                                                </article>
        <?php
    }
}
?>

                    </div>
                </div>
            </div>

        </section>
    </div>

</div>-->

<!--gallery start-->
<section class="panel gallery_new" style="display: none !important;">
    <header class="panel-heading">
        Latest Product
    </header>

    <div class="panel-body">
        <ul class="grid cs-style-3">
            <?php
            if (!empty($projectGallery) && count($projectGallery) > 0) {
                foreach ($projectGallery as $key => $data) {

                    $projectOriginalImage = !empty($data->images) ? getMediaUrl('projects', 'original', $data->images) : "";
                    $projectNaturalImage = !empty($data->images) ? getMediaUrl('projects', 'thumbs', $data->images) : "";
                    ?>
                    <li>
                        <figure>
                            <img src="<?php echo $projectNaturalImage; ?>" alt="">
                            <figcaption>
                                <a class="fancybox" title="" rel="group" href="<?php echo $projectOriginalImage; ?>">Take a look</a>
                                <a class="green" rel="group" href="<?php echo admin_url('projects/update/' . $data->type_id) ?>">Edit</a>                                
                            </figcaption>
                        </figure>
                    </li>
                    <?php
                }
            }
            ?>

        </ul>
    </div>
</section>
<!--gallery end-->

<!--gallery start-->
<section class="panel gallery_new" style="display: none !important;">
    <header class="panel-heading">
        Photo Gallery
    </header>

    <div class="panel-body">
        <ul class="grid cs-style-3">
            <?php
            if (!empty($photoGallery) && count($photoGallery) > 0) {
                foreach ($photoGallery as $key => $data) {
                    $photoOriginalImage = !empty($data->images) ? getMediaUrl('gallery', 'original', $data->images) : "";
                    $photoNaturalImage = !empty($data->images) ? getMediaUrl('gallery', 'small', $data->images) : "";
                    
                    ?>
                    <li>
                        <figure>
                            <img src="<?php echo $photoNaturalImage; ?>" alt="">
                            <figcaption>
                                <a class="fancybox" title="" rel="group" href="<?php echo $photoOriginalImage; ?>">Take a look</a>
                                <a class="green" rel="group" href="<?php echo admin_url('gallery/update/' . $data->type_id) ?>">Edit</a>                                
                            </figcaption>
                        </figure>
                    </li>
                    <?php
                }
            }
            ?>

        </ul>
    </div>
</section>
<!--gallery end-->


<!--Banner gallery start-->
<section class="panel gallery_new">
    <header class="panel-heading">
        Latest Banner
    </header>

    <div class="panel-body">
        <ul class="grid cs-style-3">
            <?php
            if (!empty($bannerGallery) && count($bannerGallery) > 0) {
                foreach ($bannerGallery as $key => $data) {
                    $originalImage = !empty($data->image_name) ? getMediaUrl('banners', 'original', $data->image_name) : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
                    $smallImage = !empty($data->image_name) ? getMediaUrl('banners', 'thumbs', $data->image_name) : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
                    ?>
                    <li>
                        <figure>
                            <img src="<?php echo $originalImage; ?>" alt="<?php echo!empty($data->title) ? $data->title : ""; ?>">
                            <figcaption>
                                <a class="fancybox" title="<?php echo!empty($data->title) ? $data->title : ""; ?>" rel="group" href="<?php echo $originalImage; ?>">Take a look</a>
                                <a class="green" rel="group" href="<?php echo admin_url('banner/index/' . $data->id) ?>">Edit</a>
                            </figcaption>
                        </figure>
                    </li>
                    <?php
                }
            }
            ?>

        </ul>
    </div>
</section>
<!--Banner gallery end-->


<script src="<?php echo base_url('assets/admin/js/modernizr.custom.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/toucheffects.js'); ?>"></script>