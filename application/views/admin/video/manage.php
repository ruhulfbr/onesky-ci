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
                                <th class="" width="5%">Title</th>
                                <th class="" width="10%">YouTube URL</th>                               
                                <th class="" width="8%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($allData)) {
                                foreach ($allData as $key => $data) {
                                    ?>
                                    <tr class="gradeX">
                                        <td class=""><?php echo $key + 1; ?></td>
                                        <td class="">
                                              <a title="<?php echo!empty($data->title) ? $data->title : ""; ?>" href="<?php echo admin_url($this->_module . '/update/' . $data->id) ?>"><?php echo!empty($data->title) ? $data->title : ""; ?></a>
                                         </td>
                                        <td class="">
                                            <?php $y2u = !empty($data->youtube_url) ? trim($data->youtube_url) : ""; ?>
                                            <a title="<?php echo $y2u; ?>" href="<?php echo $y2u; ?>" target="_blank"><?php echo $y2u; ?></a>
                                        </td>
                                        
                                        <td class="">
                                            <a class="btn btn-success btn-xs" href="<?php echo admin_url($this->_module . '/view/' . $data->id); ?>"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-primary btn-xs" href="<?php echo admin_url($this->_module . '/update/' . $data->id) ?>"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger btn-xs" onclick="return confirm('Are you Sure??\nYou Want to Delete this item!');" href="<?php echo admin_url($this->_module . '/delete/' . $data->id) ?>">
                                                <i class="fa fa-trash"></i>
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