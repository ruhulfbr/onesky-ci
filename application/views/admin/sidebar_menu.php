<!--sidebar start-->
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <li>
                <a <?php echo!empty($tabActive) && $tabActive == 'dashboard' ? 'class="active"' : ''; ?> href="<?php echo admin_url(); ?>">
                    <i class="fa fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a <?php echo!empty($tabActive) && $tabActive == 'banner' ? 'class="active"' : ''; ?> href="<?php echo admin_url('banner'); ?>">
                    <i class="fa fa-flag-checkered"></i>
                    <span>Banners</span>
                </a>
            </li>

            <li>
                <a <?php echo!empty($tabActive) && $tabActive == 'packages' ? 'class="active"' : ''; ?> href="<?php echo admin_url('packages'); ?>">
                    <i class="fa fa-tag"></i>
                    <span>Packages</span>
                </a>
            </li>

            <li>
                <a <?php echo!empty($tabActive) && $tabActive == 'branch' ? 'class="active"' : ''; ?> href="<?php echo admin_url('branch'); ?>">
                    <i class="fa fa-building-o" aria-hidden="true"></i>
                    <span>Branches</span>
                </a>
            </li>

            <li>
                <a <?php echo!empty($tabActive) && $tabActive == 'contact' ? 'class="active"' : ''; ?> href="<?php echo admin_url('branch/contact'); ?>">
                    <i class="fa fa-address-card" aria-hidden="true"></i>
                    <span>Contact</span>
                </a>
            </li>


        
<!--             <li class="sub-menu">
                <a href="javascript:void(0)" <?php echo!empty($tabActive) && $tabActive == 'gallery' ? 'class="active"' : ''; ?> >
                    <i class="fa fa-picture-o"></i>
                    <span>Photo Gallery</span>
                </a>
                <ul class="sub">
                    <li <?php echo!empty($subTabActive) && $subTabActive == 'gallery_manage' ? 'class="active"' : ''; ?>><a href="<?php echo admin_url('gallery'); ?>">Manage Photo Gallery</a></li>
                    <li <?php echo!empty($subTabActive) && $subTabActive == 'gallery_add' ? 'class="active"' : ''; ?>><a href="<?php echo admin_url('gallery/add'); ?>">Add Photo Gallery</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:void(0)" <?php echo!empty($tabActive) && $tabActive == 'video' ? 'class="active"' : ''; ?> >
                    <i class="fa fa-video-camera"></i>
                    <span> Video Gallery</span>
                </a>
                <ul class="sub">
                    <li <?php echo!empty($subTabActive) && $subTabActive == 'video_manage' ? 'class="active"' : ''; ?>><a href="<?php echo admin_url('video'); ?>">Manage  Video</a></li>
                    <li <?php echo!empty($subTabActive) && $subTabActive == 'video_add' ? 'class="active"' : ''; ?>><a href="<?php echo admin_url('video/add'); ?>">Add  Video</a></li>
                </ul>
            </li>

            <li>
                <a <?php echo!empty($tabActive) && $tabActive == 'settingmodule' ? 'class="active"' : ''; ?> href="<?php echo admin_url('settingmodule'); ?>">
                    <i class="fa fa-gear"></i>
                    <span>Setting Module</span>
                </a>
            </li> -->

        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->