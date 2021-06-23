<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/bootstrap-fileupload/bootstrap-fileupload.css'); ?>" />

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <?php echo $pageTitle; ?>
                <span class="tools pull-right">
                    <a class="iconlink btn btn-info" href="<?php echo admin_url($this->_module); ?>"><span>Manage</span></a>
                </span>
            </header>
            <div class="panel-body">
                <?php
                $image = !empty($get_info->image_name) ? getMediaUrl('news', 'thumbs', $get_info->image_name) : "";
                ?>
                <table class="table">
                    <colgroup>
                        <col width="20%">
                        <col width="3%">
                        <col width="70%">
                    </colgroup>
                    <tbody>
                        <tr>
                            <td>News Image</td>
                            <td> : </td>
                            <td> <img src='<?php echo $image; ?>' style="height: 200px;width: 200px;"> </td>
                        </tr>
                        <tr>
                            <td>News Title</td>
                            <td> : </td>
                            <td> <?php echo!empty($get_info->title) ? $get_info->title : "n/a"; ?>  </td>
                        </tr>


                        <tr>
                            <td>News Description</td>
                            <td> : </td>
                            <td> <?php echo!empty($get_info->description) ? $get_info->description : "n/a"; ?>  </td>
                        </tr>

                        <tr>
                            <td>News Date</td>
                            <td> : </td>
                            <td> <?php echo date('d M Y', strtotime($get_info->news_date)); ?>  </td>
                        </tr>
                         <tr>
                            <td>News Author</td>
                            <td> : </td>
                            <td> <?php echo $get_info->news_author; ?>  </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td> : </td>
                            <td> 
                                <?php
                                if ($get_info->status =='active') {
                                    echo 'Active';
                                } else {
                                    echo "Inactive";
                                }
                                ?> 
                            </td>
                        </tr>
                        <tr>
                            <td>Created</td>
                            <td> : </td>
                            <td> <?php echo longDateHuman($get_info->created_at, 'full'); ?>  </td>
                        </tr>

                        <tr>
                            <td>Modified</td>
                            <td> : </td>
                            <td>
                                <?php
                                if ($get_info->modified_at == '0000-00-00 00:00:00') {
                                    echo 'Not updated yet';
                                } else {
                                    echo longDateHuman($get_info->modified_at, 'full');
                                }
                                ?>  
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>