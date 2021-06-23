<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/bootstrap-fileupload/bootstrap-fileupload.css'); ?>" />

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <?php echo $pageTitle; ?>
                <span class="tools pull-right">
                    <a class="iconlink btn btn-info" href="<?php echo admin_url($this->_module); ?>"><span><i class="fa fa-sign-out"></i> Manage</span></a>
                </span>
            </header>
            <div class="panel-body">
                <table class="table">
                    <colgroup>
                        <col width="20%">
                        <col width="3%">
                        <col width="70%">
                    </colgroup>
                    <tbody>
                      
                        <tr>
                            <td>Title</td>
                            <td> : </td>
                            <td> 
                                <?php echo!empty($get_info->title) ? trim($get_info->title) : "N/a"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>YouTube URL</td>
                            <td> : </td>
                            <td> 
                                <?php echo!empty($get_info->youtube_url) ? trim($get_info->youtube_url) : "N/a"; ?>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Created</td>
                            <td> : </td>
                            <td> <?php echo longDateHuman($get_info->created, 'full'); ?>  </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>