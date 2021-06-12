<!DOCTYPE html>
<html lang="en">
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta name="description" content="Responsive Admin Template" />
        <meta name="author" content="SmartUniversity" />
        <meta name="viewport" content="width=device-width, user-scalable=no" />
        <meta name="format-detection" content="telephone=no">
        <title>Dashboard</title>
        <!-- google font -->
        <link href="<?php echo base_url(); ?>assets/fonts/font-awesome/css/css.css" rel="stylesheet" type="text/css" />
        <!-- icons -->
        <link href="<?php echo base_url(); ?>assets/fonts/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme Styles -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <!--<link href="<?php echo base_url(); ?>assets/fonts/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
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
        <!-- dropzone -->
        <link href="<?php echo base_url(); ?>assets/plugins/dropzone/dropzone.css" rel="stylesheet" media="screen">
        <!-- Owl Carousel Assets -->
        <link href="../assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
        <link href="../assets/plugins/owl-carousel/owl.theme.css" rel="stylesheet">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">
        <link href="<?php echo base_url(); ?>assets/css/icon.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/material-datetimepicker/bootstrap-material-datetimepicker.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jquery-toast/dist/jquery.toast.min.css">
        <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

            <link href="<?php echo base_url(); ?>assets/plugins/datatables/export/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

    </head>
    <!-- END HEAD -->

    <body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-dark dark-sidebar-color logo-dark dark-theme">
        <div class="page-wrapper">
            <!-- start header -->
            <div class="page-header navbar navbar-fixed-top">
                <div class="page-header-inner ">
                    <!-- logo start -->
                    <div class="page-logo">
                        <a href="<?php echo base_url() . 'event/'; ?>">
                            <!--<span class="logo-icon material-icons fa-rotate-45"></span>-->
                            <span class="logo-default">Dashboard</span> 
                            <!--<img alt="" class="img-circle " src="<?php echo base_url(); ?>assets/img/prof/user.png"width="50" height="50" />-->
                        </a>
                    </div>
                    <!-- logo end -->
                    <ul class="nav navbar-nav navbar-left in">
                        <li><a href="#" class="menu-toggler sidebar-toggler"></a></li>
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

                            <!-- end message dropdown -->
                            <!-- start manage user dropdown -->
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                   <!--  <img alt="" class="img-circle " src="<?php echo base_url(); ?>assets/img/logo_etc.png" /> -->
                                    <span class="username username-hide-on-mobile"> <?php echo $_SESSION['name']->user_name; ?> </span>
<!--                                    <i class="fa fa-angle-down"></i>
                                    <img src="<?php echo base_url(); ?>assets/img/down.jpg" class="fa fa-arrow-left" style="color: blcck; background-color: black" aria-hidden="true">-->
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <!--  <li>
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
                                     </li> -->
                                    <li>
                                        <a onclick="logout();">
                                            <img src="<?php echo base_url(); ?>assets/img/logout.jpg" class="fa fa-arrow-left" style="color: black; margin: 5px; width: 12px" aria-hidden="true">Log Out 
                                        </a>
                                    </li>
                                    <li>
                                        <a data-toggle="modal" data-target="#changePassword">
                                            <!--<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#changePassword"><i class = "fa fa-pencil"></i></button>-->
                                            <img src="<?php echo base_url(); ?>assets/img/changepassword.png" class="fa fa-arrow-left" style="color: black; margin: 5px; width: 12px" aria-hidden="true">
                                            Change Password
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div id="my-toast-location" style="position: fixed; top: 0; right: 20px;"></div>
                    </div>

                </div>
                <div id="upperLoaderBar" class="mdl-progress mdl-js-progress mdl-progress__indeterminate"></div>
            </div>
            <!-- end header -->
            <!--------------Modal detail------------------>
            <div class="modal" tabindex="-1" role="dialog" id="changePassword">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <div class="card-head">
                                            <header>Change Password</header>
                                        </div>
                                        <div class="card-body row">
                                            <div class="col-lg-6 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield">
                                                    <input class="mdl-textfield__input" type="password" id="oldpassword" placeholder="Enter old password">
                                                </div>
                                                <div class="mdl-textfield mdl-js-textfield">
                                                    <input class="mdl-textfield__input" type="password" id="newpassword" placeholder="Enter new password">
                                                </div>
                                                <div class="mdl-textfield mdl-js-textfield">
                                                    <input class="mdl-textfield__input" type="password" id="confpassword" placeholder="Enter confirm password">
                                                </div>
                                            </div>
                                            <div class="col-lg-8 p-t-20">
                                            </div>

                                            <div class="col-lg-12 p-t-20">
                                                <button id="changePassBtn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="changePassword();">
                                                    Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            </div>
            <!--------------Modal detail------------------>
            <script>
                function changePassword() {
                    var oldPass = $('#oldpassword').val();
                    var newPass = $('#newpassword').val();
                    var confPass = $('#confpassword').val();
                    if (newPass !== confPass) {
                        error_message('Confirm password not match with New password');
                        return;
                    }
                    postedData = {};
                    postedData['oldPassword'] = oldPass;
                    postedData['password'] = newPass;
                    postedData['user_id'] = "<?php echo $_SESSION['name']->user_id; ?>";
                    $.ajax({
                        url: "<?php echo base_url(); ?>common/changePassword/",
                        method: "POST",
                        dataType: "JSON",
                        data: postedData,
                        beforeSend: function () {
                        }, complete: function () {
                        }, success: function (response) {
                            console.log('response', response);
                            $('#upperLoaderBar').css('display', 'none');
                            if (response.status) {
                                console.log('fddddddddddd', response)
                                success_message('Logout successfully.');
                                setTimeout(function () {
                                    window.location.href = "<?php echo base_url(); ?>";
                                }, 1000);

                            } else {
                                error_message(response.error);
                            }
                            console.log('called............123');
                        }, error: function () {
                            $('#upperLoaderBar').css('display', 'none');
                            error_message('Sonething get error please try after some time');
                        }
                    });
                }
                function logout() {
                    console.log('logout is called');
                    $.ajax({
                        url: "<?php echo base_url(); ?>common/logout/",
                        method: "POST",
                        dataType: "JSON",
                        beforeSend: function () {
                        }, complete: function () {
                        }, success: function (response) {
                            console.log('response', response);
                            $('#upperLoaderBar').css('display', 'none');
                            if (response) {
                                success_message('Logout successfully.');
                                setTimeout(function () {
                                    window.location.href = "<?php echo base_url(); ?>";
                                }, 1000);
                            } else {
                                error_message('Getting error please try after sometime');
                            }
                            console.log('called............123');
                        }, error: function () {
                            $('#upperLoaderBar').css('display', 'none');
                            $('#my-toast-location').toastee('Sonething get error please try after some time', 'error');
                        }
                    });
                }
                function error_message($msg) {
                    console.log('error message function is called');
                    $.toast({
                        heading: 'Error',
                        text: $msg,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500
                    });
                }
                function success_message($msg) {
                    console.log('success message function is called');
                    $.toast({
                        heading: 'Success',
                        text: $msg,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 35000,
                        stack: 6
                    });
                }
            </script>
