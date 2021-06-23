<!--dynamic table-->
<link href="<?php echo base_url('assets/admin/advanced-datatable/media/css/demo_page.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/admin/advanced-datatable/media/css/demo_table.css'); ?>" rel="stylesheet" />

<div class="row">
    <div class="col-sm-12">

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
                Manage Contacts
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <table class="display table table-bordered" id="hidden-table-info">
                        <thead>
                            <tr>
                                <th width="15%">Name</th>
                                <th width="15%">Email</th>
                                <th width="15%">Phone</th>
                                <th width="15%" class="text-center">Company Name</th>
                                <th class="text-center" width="10%">Subject</th>
                                <th class="text-center" width="10%">Message</th>
                                <th class="text-center" width="10%">Date & time</th>
                            </tr>
                                                   
                        </thead>
                        <tbody class="">
                            <?php
                            if (!empty($allData) && count($allData)) {
                                foreach ($allData as $key => $data) {
                            ?>
                                    <tr class="">

 
                                        <td>
                                            <?php echo !empty($data->name) ? $data->name : "";  ?>
                                        </td>

                                        <td>
                                            <?php echo !empty($data->email) ? $data->email : "";  ?>
                                        </td>

                                        <td>
                                            <?php echo !empty($data->phone) ? $data->phone : "";  ?>
                                        </td>
                                        <td>
                                            <?php echo !empty($data->company_name) ? $data->company_name : "";  ?>
                                        </td>

                                        <td>
                                            <?php echo !empty($data->subject) ? $data->subject : "";  ?>
                                        </td>
                                        <td>
                                            <?php echo !empty($data->message) ? $data->message : "";  ?>
                                        </td>

                                        <td>
                                            <?php echo !empty($data->created_at) ? $data->created_at : "";  ?>
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
</div>



