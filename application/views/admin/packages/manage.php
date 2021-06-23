<!--dynamic table-->
<link href="<?php echo base_url('assets/admin/advanced-datatable/media/css/demo_page.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/admin/advanced-datatable/media/css/demo_table.css'); ?>" rel="stylesheet" />

<div class="row">
    <div class="col-sm-8">

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
                                <th width="15%">Info</th>
                                <th width="15%">Pricing</th>
                                <th width="15%">Type</th>
                                <th width="15%">Uptime/Support</th>
                                <th class="text-center" width="10%">View Order</th>
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
                                            <?php echo !empty($data->name) ? "<b>Name : ".$data->name."</b>" : "";  ?>
                                            <?php echo !empty($data->speed) ? "<p>Speed : ".$data->speed." Mbps</p>" : "";  ?>
                                            <?php echo !empty($data->category) ? "Category : ".$data->category."" : "";  ?>
                                        </td>

                                        <td>
                                            <?php echo !empty($data->price) ? "<b>Price : ".$data->price."</b>" : "";  ?>
                                            <?php echo !empty($data->otc) ? "<p>OTC : ".$data->otc."</p>" : "";  ?>
                                        </td>

                                        <td>
                                            <?php echo !empty($data->type) ? "<p>".$data->type."</p>" : "";  ?>
                                            <?php echo !empty($data->video) ? "<p>".$data->video."</p>" : "";  ?>
                                        </td>

                                        <td>
                                            <?php echo !empty($data->up_time) ? "<p>".$data->up_time."</p>" : "";  ?>
                                            <?php echo !empty($data->support) ? "<p>".$data->support."</p>" : "";  ?>
                                        </td>

                                        <td class="text-center">
                                            <?php echo !empty($data->view_order) ? "<p>".$data->view_order."</p>" : "";  ?>
                                        </td>

                                        <td class="text-center">
                                            <?php echo statusCheck($data->status); ?>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-default btn-xs" title="Update" href="<?php echo admin_url($this->_module . '/' . 'index/' . $data->id) ?>"><i class="fa fa-pencil-square-o"></i></a>
                                            <a class="btn btn-danger btn-xs" title="Delete" onclick="return confirm('Do You Want To Delete this item!');" href="<?php echo admin_url($this->_module . '/delete/' . $data->id) ?>">
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

            <div class="pull-right">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </section>
    </div>
    <div class="col-lg-4">

        <?php if (!empty($error)): ?>
            <div class="alert alert-block alert-danger fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="fa fa-times"></i>
                </button>
                <strong>Error!</strong> <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <section class="panel">
            <header class="panel-heading"><?php echo isset($package_id) && !empty($package) ? 'Update : ' . (!empty($package->name) ? $package->name : "") : 'Add New Package'; ?></header>
            <div class="panel-body">
                <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="" class="col-lg-3 col-sm-3 control-label">Category<span class="req">*</span></label>
                        <div class="col-lg-9">
                            <select class="form-control" name="category" required>
                                <?php
                                    $categories = ['Home', 'SME', 'Corporate', 'Out Of Dhaka'];
                                    foreach ($categories as $category) {
                                        $select = !empty($package) && $package->category == $category ? "selected" : "";
                                ?>
                                <option value="<?php echo $category; ?>" <?php echo $select; ?> ><?php echo $category; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-lg-3 col-sm-3 control-label">Name<span class="req">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="name" value="<?php echo!empty($package) ? $package->name : set_value('name'); ?>" placeholder="Package  name" class="form-control" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-lg-3 col-sm-3 control-label">Price<span class="req">*</span></label>
                        <div class="col-lg-9">
                            <input type="number" name="price" value="<?php echo!empty($package) ? $package->price : set_value('price'); ?>" class="form-control" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-lg-3 col-sm-3 control-label">Speed<span class="req">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="speed" value="<?php echo!empty($package) ? $package->speed : set_value('speed'); ?>" class="form-control" required placeholder="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-lg-3 col-sm-3 control-label">Type<span class="req">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="type" value="<?php echo!empty($package) ? $package->type : set_value('type'); ?>" class="form-control" required placeholder="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-lg-3 col-sm-3 control-label">OTC<span class="req">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="otc" value="<?php echo!empty($package) ? $package->otc : set_value('otc'); ?>" class="form-control" required placeholder="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-lg-3 col-sm-3 control-label">Video<span class="req">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="video" value="<?php echo!empty($package) ? $package->video : set_value('video'); ?>" class="form-control" required placeholder="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-lg-3 col-sm-3 control-label">Up Time<span class="req">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="up_time" value="<?php echo!empty($package) ? $package->up_time : set_value('up_time'); ?>" class="form-control" required placeholder="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-lg-3 col-sm-3 control-label">Support<span class="req">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="support" value="<?php echo!empty($package) ? $package->support : set_value('support'); ?>" class="form-control" required placeholder="" />
                        </div>
                    </div>

                    <?php if( !empty($package_id) ){ ?>
                        <div class="form-group">
                            <label for="" class="col-lg-3 col-sm-3 control-label">View Order <span class="req">*</span></label>
                            <div class="col-lg-9">
                                <input type="number" name="view_order" value="<?php echo!empty($package) ? $package->view_order : set_value('view_order'); ?>" placeholder="View Order" class="form-control" />
                            </div>
                        </div>
                    <?php } ?>

    
                    <div class="form-group">
                        <label class="control-label col-md-3">Status</label>
                        <div class="col-lg-9">
                            <label class="checkbox-inline">
                                <input type="radio" name="status" value="active" <?php echo!empty($package) && $package->status == 'active' ? 'checked' : set_radio('status', 1); ?> checked> Active
                            </label>
                            <label class="checkbox-inline">
                                <input type="radio" name="status" value="inactive" <?php echo!empty($package) && $package->status == 'inactive' ? 'checked' : set_radio('status', 0); ?>> Inactive
                            </label>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-block" name="submit" value="1"><?php echo isset($package_id) && !empty($package) ? 'Update' : 'Save'; ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>




