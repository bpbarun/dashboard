<!DOCTYPE html>
<?php
if (!empty($exportData)) {
    $exportData = json_decode($exportData);
    $exportAllData = $exportData;
    if (!empty($exportData->data)) {
        $exportAllData = $exportData->data;
    }
    if (!empty($exportAllData)) {
        foreach ($exportAllData as $key) {
            $new_arr[] = $key->object;
        }
        $uniq_arr = array_unique($new_arr);
    }
}
?>
<html lang="en">
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta name="description" content="Responsive Admin Template" />
        <meta name="author" content="SmartUniversity" />
        <title></title>
        <!-- google font -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
        <!-- icons -->
        <!--        <link href="fonts/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
                <link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
                <link href="fonts/material-design-icons/material-icon.css" rel="stylesheet" type="text/css" />-->
        <!--bootstrap -->
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Material Design Lite CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/material/material.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/material_style.css">
        <!-- Data Tables -->
        <link href="<?php echo base_url(); ?>assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/plugins/datatables/export/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme Styles -->
        <link href="<?php echo base_url(); ?>assets/css/theme/dark/theme_style.css" rel="stylesheet" id="rt_style_components" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/theme/dark/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/theme/dark/theme-color.css" rel="stylesheet" type="text/css" />
        <!-- Date Time item CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/material-datetimepicker/bootstrap-material-datetimepicker.css" />
        <!-- favicon -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico" />
        <link href="<?php echo base_url(); ?>assets/css/icon.css" rel="stylesheet">

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
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <img src="<?php echo base_url(); ?>assets/img/flags/gb.png">
                                </a>
                            </li>
                            <!-- end language menu -->
                            <!-- start notification dropdown -->

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
                                        <a href="login.html">
                                            <i class="icon-logout"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- end manage user dropdown -->
                            <li class="dropdown dropdown-quick-sidebar-toggler">
                                <!--                                <a id="headerSettingButton" class="mdl-button mdl-js-button mdl-button--icon pull-right" data-upgraded=",MaterialButton">
                                                                    <i class="material-icons">more_vert</i>
                                                                </a>-->
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end header -->
            <!-- start color quick setting -->
            <!-- end color quick setting -->
            <!-- start page container -->
            <div class="page-container">
                <div class="page-content-wrapper">
                    <div class="page-content">
                        <!--                        <div class="pull-left" >
                                                    <i class="fa fa-file-excel-o" aria-hidden="true" onclick="export_data()" title="Export to Excel" style="cursor: pointer;"></i>
                                                    <input type="button" name="export" value="export" id="export" onclick="export_data()" class="dt-button buttons-excel buttons-html5" title="Export to Excel"> 
                                                </div>-->
                        <div class="card-head">
                            <header>Export Data</header>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="card card-box">
                                    <div class="card-head">

                                        <!--<header>Export Table</header>-->
                                        <div class="pull-right" >
                                            <!--<i class="fa fa-file-excel-o" aria-hidden="true" onclick="export_data()" title="Export to Excel" style="cursor: pointer;"></i>-->
                                            <!--<input type="button" name="export" value="export" id="export" onclick="export_data()" class="dt-button buttons-excel buttons-html5" title="Export to Excel">--> 
                                        </div>
                                        <label  class="pull-right"  onclick="clearSearchData()" style="background-color: #2ab9d0;border-radius: 16pc;padding-left: 0px;cursor: pointer;padding: 0px;width: 89px;text-align: center; box-shadow: 0 5px 20px 0 rgba(0, 0, 0, 0.2), 0 13px 24px -11px #2ab9d0;"> Clear Filter</label>
                                        <input  type="button" name="export" value="export" id="export" onclick="export_data()" class="dt-button buttons-excel buttons-html5 pull-right" title="Export to Excel" style="background-color: #2ab9d0;border-radius: 16pc;padding-left: 0px;cursor: pointer;padding: 0px;width: 89px;text-align: center;"> 
                                        <!------------------------------------------------------->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card-box">
                                                    <div class="card-head">
                                                        <!--<header>Object</header>-->
                                                    </div>
                                                    <div class="card-body" style="width: 370px;">
                                                        <div class="col-lg-9 col-md-8">
                                                            <div class="row">
                                                                <div class="col-md-12 p-t-20">
                                                                    <select class="form-control  select2" id="objectFilter">
                                                                        <option value="">All object</option>
                                                                        <?php
                                                                        if (!empty($uniq_arr)) {
                                                                            foreach ($uniq_arr as $onjData) {
                                                                                ?>
                                                                                <option value="<?php echo $onjData; ?>"><?php echo $onjData; ?></option>  
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--------------------Date Time picker------------------->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card-box">
                                                    <div class="card-head">
                                                        <!--<header>Date</header>-->
                                                    </div>
                                                    <div class="card-body ">
                                                        <span>
                                                            <div class="col-lg-6 p-t-20">
                                                                <div class="row">
                                                                    <div class="col-md-12 p-t-20">
                                                                        <div class="form-control-wrapper">
                                                                            <input type="text" id="date-start" name="date-start" class="floating-label mdl-textfield__input" placeholder="Start Date" style="width: 144px;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12 p-t-20">
                                                                        <div class="form-control-wrapper">
                                                                            <input type="text" id="date-end" name="date-end" class="floating-label mdl-textfield__input" placeholder="End Date" style="width: 144px;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--------------------------------->
                                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" data-mdl-for="panel-button">
                                            <li class="mdl-menu__item"><i class="material-icons">assistant_photo</i>Action</li>
                                            <li class="mdl-menu__item"><i class="material-icons">print</i>Another action</li>
                                            <li class="mdl-menu__item"><i class="material-icons">favorite</i>Something else here</li>
                                        </ul>

                                    </div>
                                    <div class="card-body " id="bar-parent">
                                        <!--<table id="exportTableMy" class="display nowrap" style="width:100%">-->
                                        <table id="exportTableMy" style="width:100%" class="display nowrap">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>Object</th>
                                                    <th dt="datefilter">Date</th>                                                    
                                                    <th>Confic</th>                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page content -->
                <!-- start chat sidebar -->
                <div class="chat-sidebar-container" data-close-on-body-click="false">
                    <div class="chat-sidebar">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="#quick_sidebar_tab_1" class="nav-link active tab-icon" data-toggle="tab"> <i class="material-icons">chat</i>Chat
                                    <span class="badge badge-danger">4</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#quick_sidebar_tab_3" class="nav-link tab-icon" data-toggle="tab"> <i class="material-icons">settings</i>
                                    Settings
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- end chat sidebar -->
            </div>
            <!-- end page container -->
            <!-- start footer -->
            <div class="page-footer">
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
        <!-- Common js-->
        <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/layout.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/theme-color.js"></script>
        <!-- Material -->
        <script src="<?php echo base_url(); ?>assets/plugins/material/material.min.js"></script>
        <!-- Data Table -->
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/export/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/export/buttons.flash.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/export/jszip.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/export/pdfmake.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/export/vfs_fonts.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/export/buttons.html5.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/export/buttons.print.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/pages/table/table_data.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/material-datetimepicker/moment-with-locales.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/material-datetimepicker/bootstrap-material-datetimepicker.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/material-datetimepicker/datetimepicker.js"></script>
        <!-- end js include path -->
    </body>

</html>
<script>
                                            $(document).ready(function () {
                                                /*****************************************************************************/
                                                table = $('#exportTableMy').DataTable({
                                                    "processing": true, //Feature control the processing indicator.
                                                    "serverSide": true, //Feature control DataTables' servermside processing mode.
                                                    //                                                    "dom": 'lBrtip',
                                                    "pageLength": 10,
                                                    //                                                    "buttons": ['csv', 'print', 'excel', 'pdf'],
                                                    //                                                    "dom": 'Bfrtip',
                                                    //                                                    "buttons": [
                                                    //                                                        'excelHtml5',
                                                    //                                                        'csvHtml5'
                                                    //                                                    ],
                                                    // Load data for the table's content from an Ajax source
                                                    //                                                    console.log('called exportTableMy function');
                                                    "ajax": {
                                                        "url": "<?php echo base_url() ?>report/exportAjax/",
                                                        "type": "POST",
                                                        "dataType": "json",
                                                    },
                                                    "columns": [
                                                        {"data": 'id', "name": 'id'},
                                                        {"data": 'object', "name": 'obj'},
                                                        {"data": 'date', "name": 'date_time'},
                                                        {"data": 'confic', "name": 'confic'},
                                                    ],
                                                });

                                                //                                                $('#exportTableMy_filter').hide();
                                                $('#date-start').bootstrapMaterialDatePicker().on('change', function (e, date) {
                                                    var minVal = ($(this).val()) ? $(this).val() : '';
                                                    var maxVal = ($('#date-end').val() !== '') ? $('#date-end').val() : '';
                                                    var daterang = "Date:" + minVal + "<>" + maxVal;
                                                    var objVal = ($('#objectFilter').val() !== '') ? $('#objectFilter').val() : '';
                                                    if (objVal != '' && minVal != '') {
                                                        console.log('aaaa')
                                                        fill_datatable(objVal, daterang);
                                                        return false;
                                                    }
                                                    table.search(daterang, 2, true, false, false, false);
                                                    table.draw();
                                                })
                                                $('#date-end').bootstrapMaterialDatePicker().on('change', function (e, date) {
                                                    var minVal = ($('#date-start').val() !== '') ? $('#date-start').val() : '';
                                                    var maxVal = ($(this).val()) ? $(this).val() : '';
                                                    var daterang = "Date:" + minVal + "<>" + maxVal;
                                                    var objVal = ($('#objectFilter').val() !== '') ? $('#objectFilter').val() : '';
                                                    if (objVal != '' && maxVal != '') {
                                                        console.log('bbbb')
                                                        fill_datatable(objVal, daterang);
                                                        return false;
                                                    }
                                                    table.search(daterang, 2, true, false, false, false);
                                                    table.draw();
                                                })
                                                /*****************************************************************************/
                                                $('#objectFilter').on('change', function (e) {
                                                    var objVal = ($(this).val() !== '') ? $(this).val() : "";
                                                    var minVal = ($('#date-start').val() !== '') ? $('#date-start').val() : '';
                                                    var maxVal = ($('#date-end').val()) ? $('#date-end').val() : '';
                                                    var daterang = "Date:" + minVal + "<>" + maxVal;
                                                    if (objVal != '' && minVal != '' || maxVal != '') {
                                                        fill_datatable(objVal, daterang);
                                                        console.log('fill_datatable')
                                                        return false;
                                                    }
                                                    console.log(objVal)
                                                    console.log('daterang', daterang)
                                                    table.search($(this).val(), 1);
                                                    fill_datatable(objVal, daterang);
                                                    console.log('called object function');
                                                    //                                                    table.draw();
                                                });
                                            });
                                            var object = '';
                                            var date = '';
                                            function fill_datatable(object = '', date = 'Date:<>') {
                                                console.log('called filter_datatable function');
                                                $('#exportTableMy').DataTable().destroy();
                                                //                                                $("#exportTableMy").DataTable().destroy(true);

                                                var dataTable = $('#exportTableMy').DataTable({
                                                    "processing": true,
                                                    "serverSide": true,
                                                    "pageLength": 10,
                                                    //dddddddddd
                                                    //                                                  "dom": 'lBrtip',
                                                    //                                                    "searching": false,
                                                    "ajax": {
                                                        url: "<?php echo base_url() ?>report/exportAjax/",
                                                        type: "POST",
                                                        data: {
                                                            object: object, date: date, order: []
                                                        }
                                                    },
                                                    "columns": [
                                                        {"data": 'id', "name": 'id'},
                                                        {"data": 'object', "name": 'obj'},
                                                        {"data": 'date', "name": 'date_time'},
                                                        {"data": 'confic', "name": 'confic'},
                                                    ],
                                                });
                                                //                                            $('#exportTableMy_filter').show();
                                            }

                                            function clearSearchData() {
                                                $("#exportTableMy").DataTable().search("").draw();
                                                $("#objectFilter").val("");
                                                $("#date-start").val("");
                                                $("#date-end").val("");
                                                $('#date').val("");
                                                $('#object').val("");
                                                fill_datatable();
                                                //                                                table.draw();
                                            }

                                            function export_data() {
                                                var from = $("#date-start").val();
                                                var to = $("#date-end").val();
                                                var search = $("#objectFilter").val();
                                                $.ajax({
                                                    type: "GET",
                                                    //                                                    url: "index.php?option=com_feedbacksui&task=get_exportData", //Relative or absolute path to response.php file
                                                    url: "<?php echo base_url() ?>report/createXLS/",
                                                    data: "search=" + search + "&from=" + from + "&to=" + to + "&format=html",
                                                    dataType: "HTML",
                                                    success: function () {
                                                        console.log('234567');
                                                        window.location.href = "createXLS?search=" + search + "&from=" + from + "&to=" + to + "&format=html";
                                                    }
                                                });

                                            }

</script>