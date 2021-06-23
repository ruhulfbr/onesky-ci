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
                    <a class="btn btn-info" href="<?php echo admin_url($this->_module . '/add'); ?>"><span>Add New</span></a>
                </span>
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <table class="display table table-bordered" id="hidden-table-info">
                        <thead>
                            <tr>
                                <th width="5%">SL#</th>
                                <th class="" width="10%">Photo</th>
                                <th class="" width="10%">Title</th>
                                <th class="" width="30%">Description</th>
                                <th class="" width="10%">News Author</th>
                                <th class="" width="10%">Date</th>
                                <th class="" width="10%">Status</th>
                                <th class="" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($allData)) {
                                foreach ($allData as $key => $data) {
                                    ?>
                                    <tr class="gradeX">
                                        <td class=""><a href="<?php echo admin_url($this->_module . '/update/' . $data->id) ?>"><?php echo $key + 1; ?></a></td>

                                        <td class="">
                                            <?php
                                            $image = !empty($data->image_name) ? getMediaUrl('news', 'thumbs', $data->image_name) : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
                                            ?>
                                            <img src='<?php echo $image; ?>' style=" width: 100px; ">
                                        </td>

                                        <td class="">
                                            <a href="<?php echo admin_url($this->_module . '/update/' . $data->id) ?>">
                                                <?php echo!empty($data->title) ? $data->title : ""; ?>
                                            </a>
                                        </td>

                                        <td class="">
                                            <?php echo!empty($data->description) ? limit_text($data->description, 150) : ""; ?>
                                        </td>

                                        <td class="">
                                            <?php echo!empty($data->news_author) ? $data->news_author : ""; ?>
                                        </td>

                                        <td class="">
                                            <?php echo!empty($data->news_date) ? date('d M Y', strtotime($data->news_date)) : ""; ?>
                                        </td>

                                        <td class=""> <?php echo statusCheck($data->status); ?> </td>
                                        <td class="">
                                            <a class="btn btn-success btn-xs" href="<?php echo admin_url($this->_module . '/view/' . $data->id); ?>"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-primary btn-xs" href="<?php echo admin_url($this->_module . '/update/' . $data->id) ?>"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger btn-xs" onclick="return confirm('Are you Sure??\nYou Want to Delete this item!');" href="<?php echo admin_url($this->_module . '/delete/' . $data->id) ?>">
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
        </section>
    </div>
</div>