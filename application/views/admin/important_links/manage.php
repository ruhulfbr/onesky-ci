<!--dynamic table-->
<link href="<?php echo base_url('assets/admin/advanced-datatable/media/css/demo_page.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/admin/advanced-datatable/media/css/demo_table.css'); ?>" rel="stylesheet" />

<div class="row">
    <div class="col-sm-7">

        <?php if ($this->session->flashdata('success_msg')) { ?>
            <div class="alert alert-success fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="fa fa-times"></i>
                </button>
                <?php echo $this->session->flashdata('success_msg'); ?>
            </div>
        <?php } ?>

        <section class="panel">
            <header class="panel-heading">
                Manage <?php echo $this->_moduleName; ?>
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <table class="display table table-bordered" id="hidden-table-info">
                        <thead>
                            <tr>
                                <th width="15%">Title</th>                                
                                <th width="15%">Link</th>
                                <th class="text-center" width="10%">Status</th>
                                <th class="text-center" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <?php
                            if (!empty($allData) && count($allData)) {
                                foreach ($allData as $key => $data) {
                                    ?>
                                    <tr class="">
                                        <td>
                                            <a href="<?php echo admin_url($this->_module . '/index/' . $data->id) ?>"><?php echo $data->title; ?></a>
                                        </td>

                                        <td>
                                            <?php if ($data->link): ?>
                                                <a href="<?php echo $data->link ?>" target="_blank"><i class="fa fa-link"></i> View Link</a>
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-center">
                                            <?php echo statusCheck($data->status); ?>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-default btn-xs" title="Update" href="<?php echo admin_url($this->_module . '/' . 'index/' . $data->id) ?>"><i class="fa fa-pencil-square-o"></i></a>
                                            <a class="btn btn-danger btn-xs" title="Delete" onclick="return confirm('Do You Want To Delete this item!');" href="<?php echo admin_url($this->_module . '/delete/' . $data->id) ?>">
                                                <i class="fa fa-times"></i>
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

            <div class="pull-right">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </section>
    </div>
    <div class="col-lg-5">

        <?php if (!empty($error)): ?>
            <div class="alert alert-block alert-danger fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="fa fa-times"></i>
                </button>
                <strong>Error!</strong> <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <section class="panel">
            <header class="panel-heading"><?php echo isset($important_links_id) && !empty($important_links) ? 'Update : ' . (!empty($important_links->title) ? $important_links->title : "") : 'Add New Important links'; ?></header>
            <div class="panel-body">
                <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="" class="col-lg-2 col-sm-2 control-label">Title<span class="req">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="title" value="<?php echo!empty($important_links) ? $important_links->title : set_value('title'); ?>" placeholder="Links Title" class="form-control" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="" class="col-lg-2 col-sm-2 control-label">Link</label>
                        <div class="col-lg-10">
                            <input type="text" name="link" value="<?php echo!empty($important_links) ? $important_links->link : set_value('link'); ?>" placeholder="Important links url" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Status</label>
                        <div class="col-lg-10">
                            <label class="checkbox-inline">
                                <input type="radio" name="status" value="active" <?php echo!empty($important_links) && $important_links->status == 'active' ? 'checked' : set_radio('status', 'active'); ?>> Active
                            </label>
                            <label class="checkbox-inline">
                                <input type="radio" name="status" value="inactive" <?php echo!empty($important_links) && $important_links->status == 'inactive' ? 'checked' : set_radio('status', 'inactive'); ?>> Inactive
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-block" name="submit" value="1"><?php echo isset($important_links_id) && !empty($important_links) ? 'Update' : 'Save'; ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>




