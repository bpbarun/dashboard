<?php
if (!empty($albumCommonData)) {
    $albumData = json_decode($albumCommonData);
    if (!empty($albumData->data)) {
        $album = $albumData->data;
    }
}
$roleData = $this->session->userdata('userRole');
if (!empty($roleData)) {
    $accessRole = json_decode($roleData);
    if (!empty($accessRole->data)) {
        $roleAccessData = $accessRole->data;
    }
}

$tabArray = array();
if (!empty($roleAccessData)) {
    foreach ($roleAccessData as $data) {
        $tabArray[] = json_decode($data->access);
    }
}
?>
<div class="sidebar-container">
    <div class="sidemenu-container navbar-collapse collapse fixed-menu">
        <div id="remove-scroll" class="left-sidemenu">
            <ul class="sidemenu  page-header-fixed slimscroll-style" data-keep-expanded="false" data-auto-scroll="true"
                data-slide-speed="200" style="padding-top: 20px">
                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler">
                        <span></span>
                    </div>
                </li>
                <!--                <li class="sidebar-user-panel">
                                    <div class="user-panel">
                                        <div class="pull-left image">
                                            <img src="<?php echo base_url(); ?>assets/img/prof/user.png" class="img-circle user-img-circle" alt="User Image" />
                                        </div>
                                        <div class="pull-left info">
                                            <p> Admin</p>
                                            <a href="#"><i class="fa fa-circle user-online"></i><span class="txtOnline"> Online</span></a>
                                        </div>
                                    </div>
                                </li>-->
                <li class="nav-item open">
                    <?php
                    if (!empty($tabArray)) {
                        foreach ($tabArray as $key => $value) {
                            foreach ($value as $val => $v) {
                                ?>
                            <li class="nav-item">
                                <a href="<?php
                                echo base_url();
                                echo "$v"
                                ?>" class="nav-link "> <span class="title"><?php echo $val; ?></span>
                                </a>
                            </li>
                            <?php
                        }
                    }
                }
                ?>

                <?php
                if (!empty($album)) {
                    foreach ($album as $data) {
                        ?>
                        <a href="<?php echo base_url(); ?>album/showAlbum/<?php echo $data->album_id; ?>" class="nav-link "> <span class="title"><?php echo $data->album_name; ?></span></a>
                        <?php
                    }
                }
                ?>
                </li>  
<!--                <li class="sidebar-user-panel">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url(); ?>assets/img/logo_etc.png" class="img-circle user-img-circle" alt="User Image" style="    position: fixed;
                                 width: 50px;
                                 bottom: 11px;"/>
                        </div>
                                                <div class="pull-left info">
                                                    <p> Admin</p>
                                                    <a href="#"><i class="fa fa-circle user-online"></i><span class="txtOnline"> Online</span></a>
                                                </div>
                    </div>
                </li>-->
            </ul>

        </div>
    </div>
</div>