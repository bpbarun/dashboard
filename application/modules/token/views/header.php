<!DOCTYPE html>
<html lang="en">
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta name="description" content="Responsive Admin Template" />
        <meta name="author" content="SmartUniversity" />
        <title>Smart University | Bootstrap Responsive Admin Template</title>
        <!-- google font -->
        <link href="<?php echo base_url(); ?>assets/fonts/font-awesome/css/css.css" rel="stylesheet" type="text/css" />
        <!-- icons -->
        <link href="<?php echo base_url(); ?>assets/fonts/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme Styles -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <!--<link href="<?php echo base_url(); ?>assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
        <link href="<?php echo base_url(); ?>assets/fonts/material-design-icons/material-icon.css" rel="stylesheet" type="text/css" />
        <!--bootstrap -->
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/plugins/summernote/summernote.css" rel="stylesheet">
        <!-- data tables -->
        <link href="../assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Material Design Lite CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/material/material.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/material_style.css">
        <!-- inbox style -->
        <link href="<?php echo base_url(); ?>assets/css/pages/inbox.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme Styles -->
        <link href="<?php echo base_url(); ?>assets/css/theme/dark/theme_style.css" rel="stylesheet" id="rt_style_components" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/theme/dark/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/theme/dark/theme-color.css" rel="stylesheet" type="text/css" />
        <!-- favicon -->

        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico" />
    </head>
    <!-- END HEAD -->

    <body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-dark dark-sidebar-color logo-dark dark-theme">
        <div class="page-wrapper">
            <!-- start header -->
            <div class="page-header navbar navbar-fixed-top">
                <div class="page-header-inner ">
                    <!-- logo start -->
                    <div class="page-logo">
                        <a href="index.html">
                            <span class="logo-icon material-icons fa-rotate-45"></span>
                            <span class="logo-default">Display Fort</span> 
                        </a>
                    </div>
                    <!-- logo end -->
                    <ul class="nav navbar-nav navbar-left in">
                        <li><a href="#" class="menu-toggler sidebar-toggler"><i class="icon-menu"></i></a></li>
                    </ul>
                    <!-- start mobile menu -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    <!-- end mobile menu -->
                    <!-- start header menu -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <li><a href="javascript:;" class="fullscreen-btn"><i class="fa fa-arrows-alt"></i></a></li>
                            <!-- start language menu -->
                            <li class="dropdown language-switch">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <img src="<?php echo base_url(); ?>assets/img/flags/gb.png"
                                                                                                              class="position-left" alt=""> English <span class="fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="deutsch"><img src="<?php echo base_url(); ?>assets/img/flags/de.png" alt=""> Deutsch</a>
                                    </li>
                                    <li>
                                        <a class="ukrainian"><img src="<?php echo base_url(); ?>assets/img/flags/ua.png" alt=""> Українська</a>
                                    </li>
                                    <li>
                                        <a class="english"><img src="<?php echo base_url(); ?>assets/img/flags/gb.png" alt=""> English</a>
                                    </li>
                                    <li>
                                        <a class="espana"><img src="<?php echo base_url(); ?>assets/img/flags/es.png" alt=""> España</a>
                                    </li>
                                    <li>
                                        <a class="russian"><img src="<?php echo base_url(); ?>assets/img/flags/ru.png" alt=""> Русский</a>
                                    </li>
                                </ul>
                            </li>

                            <!-- end language menu -->
                            <!-- start notification dropdown -->
                            <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="badge headerBadgeColor1"> 6 </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3><span class="bold">Notifications</span></h3>
                                        <span class="notification-label purple-bgcolor">New 6</span>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">just now</span>
                                                    <span class="details">
                                                        <span class="notification-icon circle deepPink-bgcolor"><i class="fa fa-check"></i></span>
                                                        Congratulations!. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">3 mins</span>
                                                    <span class="details">
                                                        <span class="notification-icon circle purple-bgcolor"><i class="fa fa-user o"></i></span>
                                                        <b>John Micle </b>is now following you. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">7 mins</span>
                                                    <span class="details">
                                                        <span class="notification-icon circle blue-bgcolor"><i class="fa fa-comments-o"></i></span>
                                                        <b>Sneha Jogi </b>sent you a message. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">12 mins</span>
                                                    <span class="details">
                                                        <span class="notification-icon circle pink"><i class="fa fa-heart"></i></span>
                                                        <b>Ravi Patel </b>like your photo. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">15 mins</span>
                                                    <span class="details">
                                                        <span class="notification-icon circle yellow"><i class="fa fa-warning"></i></span> Warning! </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">10 hrs</span>
                                                    <span class="details">
                                                        <span class="notification-icon circle red"><i class="fa fa-times"></i></span> Application error. </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="dropdown-menu-footer">
                                            <a href="javascript:void(0)"> All notifications </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- end notification dropdown -->
                            <!-- start message dropdown -->
                            <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge headerBadgeColor2"> 2 </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3><span class="bold">Messages</span></h3>
                                        <span class="notification-label cyan-bgcolor">New 2</span>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
                                            <li>
                                                <a href="#">
                                                    <span class="photo">
                                                        <img src="<?php echo base_url(); ?>assets/img/prof/prof2.jpg" class="img-circle" alt=""> </span>
                                                    <span class="subject">
                                                        <span class="from"> Sarah Smith </span>
                                                        <span class="time">Just Now </span>
                                                    </span>
                                                    <span class="message"> Jatin I found you on LinkedIn... </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="photo">
                                                        <img src="<?php echo base_url(); ?>assets/img/prof/prof3.jpg" class="img-circle" alt=""> </span>
                                                    <span class="subject">
                                                        <span class="from"> John Deo </span>
                                                        <span class="time">16 mins </span>
                                                    </span>
                                                    <span class="message"> Fwd: Important Notice Regarding Your Domain Name... </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="photo">
                                                        <img src="<?php echo base_url(); ?>assets/img/prof/prof1.jpg" class="img-circle" alt=""> </span>
                                                    <span class="subject">
                                                        <span class="from"> Rajesh </span>
                                                        <span class="time">2 hrs </span>
                                                    </span>
                                                    <span class="message"> pls take a print of attachments. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="photo">
                                                        <img src="<?php echo base_url(); ?>assets/img/prof/prof8.jpg" class="img-circle" alt=""> </span>
                                                    <span class="subject">
                                                        <span class="from"> Lina Smith </span>
                                                        <span class="time">40 mins </span>
                                                    </span>
                                                    <span class="message"> Apply for Ortho Surgeon </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="photo">
                                                        <img src="<?php echo base_url(); ?>assets/img/prof/prof5.jpg" class="img-circle" alt=""> </span>
                                                    <span class="subject">
                                                        <span class="from"> Jacob Ryan </span>
                                                        <span class="time">46 mins </span>
                                                    </span>
                                                    <span class="message"> Request for leave application. </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="dropdown-menu-footer">
                                            <a href="#"> All Messages </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- end message dropdown -->
                            <!-- start manage user dropdown -->
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="img-circle " src="<?php echo base_url(); ?>assets/img/dp.jpg" />
                                    <span class="username username-hide-on-mobile"> Kiran </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="user_profile.html">
                                            <i class="icon-user"></i> Profile </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-settings"></i> Settings
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-directions"></i> Help
                                        </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="lock_screen.html">
                                            <i class="icon-lock"></i> Lock
                                        </a>
                                    </li>
                                    <li>
                                        <a href="login.html">
                                            <i class="icon-logout"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- end manage user dropdown -->
                            <li class="dropdown dropdown-quick-sidebar-toggler">
                                <a id="headerSettingButton" class="mdl-button mdl-js-button mdl-button--icon pull-right" data-upgraded=",MaterialButton">
                                    <i class="material-icons">more_vert</i>
                                </a>
                            </li>
                        </ul>
                        <div id="my-toast-location" style="position: fixed; top: 0; right: 20px;"></div>
                    </div>

                </div>
                <div id="upperLoaderBar" class="mdl-progress mdl-js-progress mdl-progress__indeterminate"></div>
            </div>
            <!-- end header -->
            <!-- start color quick setting -->
            <div class="quick-setting-main">
                <button class="control-sidebar-btn btn" data-toggle="control-sidebar"><i class="fa fa-cog fa-spin"></i></button>
                <div class="quick-setting display-none">
                    <ul id="themecolors">
                        <li>
                            <p class="selector-title">Main Layouts</p>
                        </li>
                        <li class="complete">
                            <div class="theme-color layout-theme">
                                <a href="<?php echo base_url(); ?>light/index.html" data-theme="light"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="dark"><span class="head"></span><span class="cont"></span></a>
                            </div>
                        </li>
                        <li>
                            <p class="selector-title">Sidebar Color</p>
                        </li>
                        <li class="complete">
                            <div class="theme-color sidebar-theme">
                                <a href="#" data-theme="white"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="dark"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="blue"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="indigo"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="cyan"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="green"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="red"><span class="head"></span><span class="cont"></span></a>
                            </div>
                        </li>
                        <li>
                            <p class="selector-title">Header Brand color</p>
                        </li>
                        <li class="theme-option">
                            <div class="theme-color logo-theme">
                                <a href="#" data-theme="logo-white"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="logo-dark"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="logo-blue"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="logo-indigo"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="logo-cyan"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="logo-green"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="logo-red"><span class="head"></span><span class="cont"></span></a>
                            </div>
                        </li>
                        <li>
                            <p class="selector-title">Header color</p>
                        </li>
                        <li class="theme-option">
                            <div class="theme-color header-theme">
                                <a href="#" data-theme="header-white"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="header-dark"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="header-blue"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="header-indigo"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="header-cyan"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="header-green"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="header-red"><span class="head"></span><span class="cont"></span></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
