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
                                <th width="15%">Name</th>
                                <th width="15%">Address</th>
                                <th width="15%">Phone</th>
                                <th width="15%" class="text-center">Map</th>
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
                                            <?php echo !empty($data->name) ? $data->name : "";  ?><br>
                                            Category : <?php echo !empty($data->category) ? $data->category : ""; ?>
                                        </td>

                                        <td>
                                            <?php echo !empty($data->address) ? $data->address : "";  ?>
                                        </td>

                                        <td>
                                            <?php echo !empty($data->phone) ? $data->phone : "";  ?>
                                        </td>

                                        <td class="text-center">
                                            <?php if(!empty($data->map)){ ?>
                                                <a href="<?php echo $data->map; ?>" target="_blank" class="btn btn-xs btn-info">Google Map Link</a>
                                            <?php } ?>
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
            <header class="panel-heading"><?php echo isset($branch_id) && !empty($branch) ? 'Update : ' . (!empty($branch->name) ? $branch->name : "") : 'Add New Branch'; ?></header>
            <div class="panel-body">
                <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="" class="col-lg-3 col-sm-3 control-label">Category<span class="req">*</span></label>
                        <div class="col-lg-9">
                            <select class="form-control" name="category" required>
                                <?php
                                    $categories = ['Inside Dhaka', 'Out of Dhaka'];
                                    foreach ($categories as $category) {
                                        $select = !empty($branch) && $branch->category == $category ? "selected" : "";
                                ?>
                                <option value="<?php echo $category; ?>" <?php echo $select; ?> ><?php echo $category; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-lg-3 col-sm-3 control-label">Name<span class="req">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="name" value="<?php echo!empty($branch) ? $branch->name : set_value('name'); ?>" placeholder="Branch  name" class="form-control" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 col-sm-3 control-label">Address<span class="req">*</span></label>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="address" placeholder="Address" rows="4" required><?php echo!empty($branch) ? $branch->address : ""; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-lg-3 col-sm-3 control-label">Phone<span class="req">*</span></label>
                        <div class="col-lg-9">
                            <input type="number" name="phone" value="<?php echo!empty($branch) ? $branch->phone : set_value('phone'); ?>" class="form-control" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 col-sm-3 control-label">Map Link<span class="req">*</span></label>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="map" placeholder="Google Map Link" rows="4" required><?php echo!empty($branch) ? trim($branch->map) : set_value('map', $branch->map); ?></textarea>
                        </div>
                    </div>


                    <?php if( !empty($branch_id) ){ ?>
                        <div class="form-group">
                            <label for="" class="col-lg-3 col-sm-3 control-label">View Order <span class="req">*</span></label>
                            <div class="col-lg-9">
                                <input type="number" name="view_order" value="<?php echo!empty($branch) ? $branch->view_order : set_value('view_order'); ?>" placeholder="View Order" class="form-control" />
                            </div>
                        </div>
                    <?php } ?>

    
                    <div class="form-group">
                        <label class="control-label col-md-3">Status</label>
                        <div class="col-lg-9">
                            <label class="checkbox-inline">
                                <input type="radio" name="status" value="active" <?php echo!empty($branch) && $branch->status == 'active' ? 'checked' : set_radio('status', 1); ?> checked> Active
                            </label>
                            <label class="checkbox-inline">
                                <input type="radio" name="status" value="inactive" <?php echo!empty($branch) && $branch->status == 'inactive' ? 'checked' : set_radio('status', 0); ?>> Inactive
                            </label>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-block" name="submit" value="1"><?php echo isset($branch_id) && !empty($branch) ? 'Update' : 'Save'; ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>



