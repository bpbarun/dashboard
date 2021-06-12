<?php
$allTokenData = json_decode($tokenData);
$counterID = $this->uri->segment('3');
if (!empty($allTokenData->data)) {
    $tokensData = $allTokenData->data;
}
if (!empty($tokensData)) {
    foreach ($tokensData as $tData) {
        $counterName = $tData->counter_name;
        break;
    }
}
if (!empty($activeMedia)) {
    $activeMediaData = json_decode($activeMedia);
    if (!empty($activeMediaData->data)) {
        $activeMediaVal = $activeMediaData->data;
    }
    $url = base_url();
    foreach ($activeMediaVal as $data) {
        $html = '';
        if ($data->is_active == '1' && $data->config_type == 'image') {
            $imagePath = $data->config_value;
            $html .= '<img src="' . $url . 'uploads/' . $imagePath . '" class="tokenScreen-adv" width="500" height="500">';
//            $path = $data->config_value;
            break;
        } else if ($data->is_active == '1' && $data->config_type == 'video') {
            $vidoePath = $data->config_value;
            $html .= '<video class="tokenScreen-adv" width="500" height="500" controls autoplay loop>';
            $html .= '<source src = "' . $url . 'uploads/' . $vidoePath . '" type = "video/mp4">';
            $html .= '</video>';
            break;
        }
    }
}
?>

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
        <!--<link href="<?php echo base_url(); ?>assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/fonts/material-design-icons/material-icon.css" rel="stylesheet" type="text/css" />
        <!--bootstrap -->
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/plugins/summernote/summernote.css" rel="stylesheet">
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
        <style>
            body{
                overflow: hidden;
            }
        </style>
    </head>
    <!-- END HEAD -->

    <body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-dark dark-sidebar-color logo-dark dark-theme" id="aa">
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
                        <li><a href="#" class="menu-toggler sidebar-toggler fullscreen-btn"><i class="fa fa-arrows-alt"></i></a></li>
                    </ul>
                    <!-- start mobile menu -->
                    <!--                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                                            
                                            <span></span>
                                        </a>-->

                    <!-- end mobile menu -->
                    <!-- start header menu -->

                </div>
            </div>
            <!-- end header -->
            <!-- start color quick setting -->

            <!-------------------------------------------------------------!-->
            <div class="page-container">
                <!-- start page content -->
                <div class="page-content-wrapper">
                    <div class="page-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tabbable-line">
                                    <div class="tab-content">
                                        <div style="text-align: center">
                                            <h1>AIIMS HOSPITAL RAIPUR, CG | <span id="showCounterName"><?php if (!empty($counterName)) echo ' ' . $counterName; ?></span></h1>
                                        </div>
                                        <div class="tab-pane active fontawesome-demo" id="tab1">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card card-box">
                                                        <div class="card-head" style="text-align: right">
                                                            <?php echo "<h2>" . date("Y-m-d, h:i A") . "</h2>"; ?>
                                                        </div>
                                                        <div class="card-head">
                                                            <header>Current Token</header>
                                                        </div>
                                                        <div class="card-body ">
                                                            <div class="row"> 
                                                                <div class="col-sm-8 col-lg-8">
                                                                    <div class="table-scrollable">
                                                                        <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle tokenScreen-table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th> Counter </th>
                                                                                    <th> Token </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="viewSreen"> 

                                                                                <?php
                                                                                if (!empty($tokensData)) {
                                                                                    foreach ($tokensData as $data) {
                                                                                        if ($data->is_active == 2) {
                                                                                            ?>

                                                                                            <tr>
                                                                                                <td><?php echo "Counter-" . $data->subcounter_name . "</h2>"; ?></td>
                                                                                                <td><?php echo $data->token_id . "</h2>"; ?></td>
                                                                                            </tr>

                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>

                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 col-lg-4">
                                                                    <?php echo $html; ?>
                                                                    <!--<img src="<?php echo base_url() ?>uploads/<?php echo $path ?>" class="tokenScreen-adv" width="500" height="500"/>-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page content -->
                <!-- start chat sidebar -->

                <!-- end chat sidebar -->
            </div>
            <!-- start footer -->
            <div class="page-footer" style="padding-bottom: 114px;">
                <div class="page-footer-inner"> 2019 &copy; Powered by
                    <a href="http://www.displayfort.com">Displayfort</a>
                </div>
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>
            <!-- end footer -->
        </div>
        <!-- start js include path -->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/popper/popper.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-blockui/jquery.blockui.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <!-- bootstrap -->
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/sparkline/jquery.sparkline.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/pages/sparkline/sparkline-data.js"></script>
        <!-- data tables -->
        <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js"></script>
        <script src="../assets/js/pages/table/table_data.js"></script>
        <!-- Common js-->
        <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/layout.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/theme-color.js"></script>
        <!-- material -->
        <script src="<?php echo base_url(); ?>assets/plugins/material/material.min.js"></script>
        <!-- chart js -->
        <script src="<?php echo base_url(); ?>assets/plugins/chart-js/Chart.bundle.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/chart-js/utils.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/pages/chart/chartjs/home-data.js"></script>
        <!-- summernote -->
        <script src="<?php echo base_url(); ?>assets/plugins/summernote/summernote.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/pages/summernote/summernote-data.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.toastee.0.1.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/pages/material-loading/material-loading.js"></script>

        <!-- end js include path -->
        <script>
            //    $(document).ready(function () {
            //        $('#upperLoaderBar').css('display', 'none');
            //    });

            $(window).on('load', function () {
                setTimeout(function () {
                    $('#upperLoaderBar').css('display', 'none');
                }, 1000);

            });
        </script>

        <!-- end page container -->
        <script>
            var $ajaxURLPart = "<?php echo base_url(); ?>";
            function PrintElem(id, name) {
                postedData = {};
                postedData['subcounter_id'] = id;
                postedData['is_active'] = 1;
                if ($('#counterID').val() !== '') {
                    postedData['counter_id'] = $('#counterID').val();
                }
                $.ajax({
                    url: $ajaxURLPart + 'token/addToken/',
                    method: "POST",
                    data: postedData,
                    beforeSend: function () {
                        // $('#' + $saveBtn).button('loading');
                    }, complete: function () {
                        //                $('#' + $saveBtn).button('reset');
                        //$('#ImgModal').modal('hide');
                    }, success: function (response) {
                        console.log('response data is =', response);
                        console.log('after success statusis ==', response.status);
                        let res = JSON.parse(response);
                        if (res.status) {
                            console.log('your latest data is ==========', res.data.token_id);
                            var mywindow = window.open('', 'MY HOSPITAL NAME', 'height=400,width=600');
                            mywindow.document.write('<html><head><title>MY HOSPITAL NAME</title>');
                            mywindow.document.write('</head><body >');
                            mywindow.document.write('Token no : ' + name + '-' + res.data.token_id);
                            mywindow.document.write('</body></html>');
                            mywindow.print();
                            mywindow.close();
                            return true;
                        } else {
                            console.log('error in adding the conter');
                        }
                    }, error: function () {
                        $('#' + $saveBtn).button('reset');
                        // error/exception handling
                        ajaxErrorHandling(jqXHR);
                    }
                });
            }
            setInterval(function () {
                getNewCall();
            }, 3000);

            /*
             *  search for a new call 
             */
            function getNewCall() {
                var counterID = "<?php echo $counterID; ?>";
                $.ajax({
                    url: $ajaxURLPart + 'token/viewScreenRefresh/' + counterID,
                    method: "GET",
                    dataType: "JSON",
                    beforeSend: function () {
                    }, complete: function () {
                    }, success: function (response) {
                        var html = '';
                        console.log('type of response.data is ==', typeof (response.data));
                        if (typeof (response.data) != 'undefined') {
                            console.log('data ', response.data);
                            for (var i = 0; i < response.data.length; i++) {
                                if (response.data[i].is_active == 2) {
                                    html += '<tr>'
                                    html += '<td>';
                                    html += response.data[i].token_id;
                                    html += '</td>';
                                    html += '<td>';
                                    html += 'Counter-' + response.data[i].subcounter_name;
                                    html += '</td>';
                                    html += '</tr>';
                                }
                            }

                            $('#viewSreen').html(html);
                            $('#showCounterName').html(response.data[0].counter_name);
                        } else {
                            $('#viewSreen').html(html);
                        }

                    }, error: function () {
                        $('#' + $saveBtn).button('reset');
                        ajaxErrorHandling(jqXHR);
                    }
                });
            }

//                window.onload = function () {
//                    $('.fullscreen-btn').trigger('click');
//                };
        </script>

    </body>

</html>