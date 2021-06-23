<link href="<?php echo base_url('assets/admin/css/gallery.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/admin/css/slidebars.css'); ?>" rel="stylesheet">

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

<section class="panel">
    <header class="panel-heading">
        <?php echo $this->_moduleName; ?>
        <span class="tools pull-right">
            <a class="btn btn-info" href="<?php echo admin_url($this->_module . '/add'); ?>"><span><i class="fa fa-plus-circle"></i> Add New</span></a>
        </span>
    </header>

    <div class="panel-body">
        <ul class="grid cs-style-3">
            <?php
            if (!empty($allData) && count($allData) > 0) {
                foreach ($allData as $key => $data) {
                    $naturalImage = getGalleryCoverPhoto($this->_module, 'small', $data->gallery_id);
                    $originalImage = getGalleryCoverPhoto($this->_module, 'original', $data->gallery_id);
                    $image = !empty($naturalImage) ? $naturalImage : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
                    ?>
                    <li>
                        <figure>
                            <img src="<?php echo $image; ?>" alt="<?php echo !empty($data->title)?$data->title:""; ?>">
                            <figcaption>
                                <a class="fancybox" title="<?php echo $data->title; ?>" rel="group" href="<?php echo $originalImage; ?>">Take a look</a>
                                <a class="green" rel="group" href="<?php echo admin_url($this->_module . '/update/' . $data->gallery_id) ?>">Edit</a>
                                <a class="red" rel="group" onclick="return confirm('Do you really want to delete this item?!');" href="<?php echo admin_url($this->_module . '/delete/' . $data->gallery_id) ?>">Delete</a>
                            </figcaption>
                        </figure>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>

        <div class="col-md-12">
            <div class="" style="padding-right: 15px; text-align: right;">
                <?php echo $this->pagination->create_links(); ?>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
</section>

<script src="<?php echo base_url('assets/admin/js/modernizr.custom.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/toucheffects.js'); ?>"></script>