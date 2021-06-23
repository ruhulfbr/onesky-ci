<!--dynamic table-->
<link href="<?php echo base_url('assets/admin/advanced-datatable/media/css/demo_page.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/admin/advanced-datatable/media/css/demo_table.css'); ?>" rel="stylesheet" />

<div class="row">
    <div class="col-sm-12">
        <?php if ($this->session->flashdata('success_msg')) { ?>
            <div class="alert alert-success fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="icon-remove"></i>
                </button>
                <?php echo $this->session->flashdata('success_msg'); ?>
            </div>
        <?php } ?>
        <section class="panel">
            <header class="panel-heading">
                Manage <?php echo $this->_moduleName; ?>
                <span class="tools pull-right">
                    <a class="btn btn-info" href="<?php echo admin_url($this->_module . '/add'); ?>"><span><i class="fa fa-plus-circle"></i> Add New</span></a>
                </span>
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <table class="display table table-bordered" id="hidden-table-info">
                        <thead>
                            <tr>
                                <th width="5%">SL#</th>
                                <th class="" width="10%">Photo</th>
                                <th class="" width="20%">Title</th>
                                <th class="" width="8%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($allData) && count($allData) > 0) {
                                foreach ($allData as $key => $data) {
                                    ?>
                                    <tr class="gradeX">
                                        <td class=""><?php echo $key + 1; ?></td>
                                        <td class="">
                                            <?php
                                            $photos = getAllMedia('media', $data->id, $this->_module);
                                            if (!empty($photos) && count($photos) > 0) {
                                                ?>                                  
                                                <?php foreach ($photos as $key => $photo) { ?>
                                                    <div class='thumb' style="">
                                                        <a title="<?php echo $photo->title; ?>" class="fancybox" href="<?php echo base_url($this->_moduleImagePath . 'original/' . $photo->images); ?>" data-fancybox-group="gallery">
                                                            <img src='<?php echo base_url($this->_moduleImagePath . 'original/' . $photo->images); ?>' style=" width: 100px; height: 100px;">
                                                        </a>
                                                    </div><!--thumb-->
                                                    <?php
                                                    break;
                                                }
                                                ?>
                                            <?php } ?>
                                        </td>
                                        <td class="">
                                            <a title="<?php echo $data->title; ?>" href="<?php echo admin_url($this->_module . '/update/' . $data->id) ?>"><?php echo!empty($data->title) ? $data->title : ""; ?></a>
                                        </td>                                                                                           

                                        <td class="">
                                            <a class="btn btn-success btn-xs" title="View" href="<?php echo admin_url($this->_module . '/view/' . $data->id); ?>"><i class="fa fa-check-circle"></i></a>
                                            <a class="btn btn-default btn-xs" title="Update" href="<?php echo admin_url($this->_module . '/update/' . $data->id) ?>"><i class="fa fa-pencil-square-o"></i></a>
                                            <a class="btn btn-danger btn-xs" title="Delete" onclick="return confirm('Do you really want to delete this item ?!');" href="<?php echo admin_url($this->_module . '/delete/' . $data->id) ?>">
                                                <i class="fa fa-ban"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </section>
    </div>
</div>