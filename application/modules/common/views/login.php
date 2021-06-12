<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login Dashboard</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico" />
        <!--<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/logincss/util.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/logincss/main.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jquery-toast/dist/jquery.toast.min.css">
        <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
        <style>
            .ripple {
                background-position: center;
                transition: background 0.8s;
            }
            .ripple:hover {
                background: #A94442 radial-gradient(circle, transparent 1%, #A94442 1%) center/15000%;
            }
            .ripple:active {
                background-color: #A94442;
                background-size: 100%;
                transition: background 0s;
            }
        </style>
    </head>
    <body>
        <div class="container-login100" style="background-image: url('<?php echo base_url(); ?>assets/img/bg/pexels-anand-dandekar-1532771-left.jpg');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30" style="opacity: 0.7;margin-left: 800px">
                <!--<form class="login100-form validate-form" method="POST" action="common/login">-->
                <form class="login100-form validate-form" onsubmit="return false">
<!--                    <span class="login100-form-title p-b-37">
                    Sign In
                </span>-->

                    <div class="wrap-input100 validate-input m-b-20" data-validate="Enter username or email">
                        <input class="input100" type="text" name="username" id="userName" placeholder="Username">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-25" data-validate = "Enter password">

                        <input class="input100" type="password" name="pass" id="password" placeholder="Password">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn ripple" onclick="login()">
                            Sign In
                        </button>
                    </div>
                    <!--                    <div class="text-center" style="margin-top: 10px;">
                                            <a href="" class="txt2 hov1" style="color: white;">
                                                Forgot Password
                                            </a>
                                        </div>-->
                </form>
            </div>
        </div>
        <!--<div id="dropDownSelect1"></div>-->
    <!--        <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
        <script src="vendor/animsition/js/animsition.min.js"></script>-->
        <!--<script src="<?php echo base_url() ?>assets/js/loginjs/main.js"></script>-->
        <!-- notifications -->
        <script src="<?php echo base_url() ?>assets/plugins/jquery-toast/dist/jquery.toast.min.js"></script>
        <script src="<?php echo base_url() ?>assets/plugins/jquery-toast/dist/toast.js"></script>
        <script>
                            function login() {
                                console.log('inside login function');
                                var userName = $('#userName').val();
                                var pass = $('#password').val();
                                if (userName == '') {
                                    error_message();
                                    return;
                                }
                                if (pass == '') {
                                    error_message();
                                    return;
                                }
                                var postedData = {};
                                postedData['user'] = userName;
                                postedData['password'] = pass;
                                $('.login100-form-btn').text('loading...')
                                $('.login100-form-btn').prop('disabled', true);
                                $.ajax({
                                    url: "<?php echo base_url() ?>common/login/",
                                    method: "POST",
                                    data: postedData,
                                    beforeSend: function () {
                                        // $('#' + $saveBtn).button('loading');
                                    }, complete: function () {
                                        //                $('#' + $saveBtn).button('reset');
                                        //$('#ImgModal').modal('hide');
                                    }, success: function (response) {
                                        console.log('response is ==', response);
                                        var res = JSON.parse(response);
                                        console.log('json response is ==', res.status)
                                        if (res.status) {
                                            success_message('Welcome to dashboard');
                                            setTimeout(function () {
                                                window.location.href = "<?php echo base_url(); ?>court/";
                                            }, 1000);
                                        } else {
                                            console.log('error in adding the conter');
                                            $('.login100-form-btn').text('Sign In')
                                            $('.login100-form-btn').prop('disabled', false);
                                            error_message();
                                        }
                                    }, error: function () {
                                        // error/exception handling
                                        error_message();
                                        $('.login100-form-btn').text('Sign In')
                                        $('.login100-form-btn').prop('disabled', false);
                                        ajaxErrorHandling(jqXHR);
                                    }
                                });
                            }
                            function error_message() {
                                console.log('error message function is called');
                                $.toast({
                                    heading: 'Failed to login',
                                    text: 'Invalid login credential, please try again.',
                                    position: 'top-right',
                                    loaderBg: '#ff6849',
                                    icon: 'error',
                                    hideAfter: 3500
                                });
                            }
                            function success_message() {
                                console.log('success message function is called');
                                $.toast({
                                    heading: 'Welcome to dashboard',
                                    text: 'You have successfully login',
                                    position: 'top-right',
                                    loaderBg: '#ff6849',
                                    icon: 'success',
                                    hideAfter: 35000,
                                    stack: 6
                                });
                            }

        </script>
    </body>
</html>