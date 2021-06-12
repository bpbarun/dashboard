<?php
if (!empty($feedback)) {
    $feedback = json_decode($feedback);
    if (!empty($feedback->data)) {
        $allFeedback = $feedback->data;
    }
}
if (!empty($feedbackType)) {
    $feedbackType = json_decode($feedbackType);
    if (!empty($feedbackType->data)) {
        $allFeedbackType = $feedbackType->data;
    }
}
//echo "<pre>";
//print_r($allFeedbackType);
//die;
?>
<style>
    #block_container {
        text-align: center;
    }
    #block_container > div {
        display: inline-block;
        vertical-align: middle;
    }
</style>
<div class="page-container">
    <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Feedback</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url() . 'feedback/'; ?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="<?php echo base_url() . 'feedback/allFeedbackType'; ?>">Manage Feedback</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active"> <a class="parent-item" href="">Feedback</a></li>
                    </ol>
                </div>
            </div>
            <!--------------------Date Time picker------------------->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="card-head">
                            <header>Filter</header>
                        </div>
                        <div class="card-body" >
                            <div>
                                <div  style="float:left">
                                    <div class="form-control-wrapper">
                                        <input type="text" id="date-start1" name="date-start" class="floating-label mdl-textfield__input" placeholder="Start Date" style="width: 356px; margin-right: 24px">
                                    </div>
                                </div>

                                <div  style="float:left">
                                    <div class="form-control-wrapper">
                                        <input type="text" id="date-end1" name="date-end" class="floating-label mdl-textfield__input" placeholder="End Date" style="width: 356px; margin-right: 24px">
                                    </div>
                                </div>
                                <div  style="float:left">
                                    <select class="form-control  select2" id="objectFilter" style="width: 176%;">
                                        <option value="">All Rating</option>
                                        <?php
                                        if (!empty($allFeedbackType)) {
                                            foreach ($allFeedbackType as $allData) {
                                                ?>
                                                <option value="<?php echo $allData->feedback_type_name; ?>"><?php echo $allData->feedback_type_name; ?></option>
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

            <!--------------------------------->
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line">
                        <div class="tab-content">
                            <div class="tab-pane active fontawesome-demo" id="tab1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-box">
                                            <div class="card-head">
                                                <header>All Feedback</header>
                                                <div class="tools">
                                                    <label  class="pull-right"  onclick="clearSearchData()" style="background-color: #2ab9d0;border-radius: 16pc;cursor: pointer;padding: 4px;width: 89px;text-align: center; box-shadow: 0 5px 20px 0 rgba(0, 0, 0, 0.2), 0 13px 24px -11px #2ab9d0;"> Clear Filter</label>
                                                    <input  type="button" name="export" value="export" id="export" onclick="export_data()" class="dt-button buttons-excel buttons-html5 pull-right" title="Export to Excel" style="background-color: #2ab9d0;border-radius: 16pc;cursor: pointer;padding: 5px;width: 89px;text-align: center;"> 
                                                </div>
                                            </div>
                                            <div class="card-body ">
                                                <div class="table-scrollable">
                                                    </table>
                                                    <table id="feedbackTable" style="width:100%" class="display nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th>Sno</th>
                                                                <th>Rating</th>
                                                                <th>User Feedback</th>
                                                                <th>Date</th>
                                                                <th>User Comment</th>
                                                                <th>User Mobile no</th>
                                                                <th>User Email id</th>                                                  
                                                                <th>Ipad Name</th>                                                  
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
                        </div>
                    </div>
                </div>
            </div>
            <!--------------Modal detail------------------>
            <div class="modal" tabindex="-1" role="dialog" id="counterModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <div class="card-head">
                                            <header>Counter Form</header>
                                        </div>
                                        <div class="card-body row">
                                            <div class="col-lg-4 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield">
                                                    <input class="mdl-textfield__input" type="text" id="counterName" placeholder="Enter the counter name">
                                                    <input class="mdl-textfield__input" type="hidden" id="counterID" value="">
                                                    <!--<label class="mdl-textfield__label" for="text1">Simple Text Field</label>-->
                                                </div>
                                            </div>
                                            <div class="col-lg-8 p-t-20">
                                            </div>
                                            <div class="col-lg-12 p-t-20">
                                                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="counterStatus">
                                                    <input type="checkbox" id="counterStatus" name="counterStatus" class="mdl-switch__input" checked>
                                                    <span class="mdl-switch__label">Active/Inactive</span>
                                                </label>
                                            </div>
                                            <div class="col-lg-12 p-t-20">
                                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="saveCounter();">
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
            <!--------------Delete Conformation------------------------------>
            <!--Modal: modalConfirmDelete-->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" style="color:black">Delete Counter</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary" onclick="deleteCounter()">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--Modal: modalConfirmDelete-->
            <!----------------Delete Conformation---------------------------->
        </div>
    </div>
</div>
<!-- end page container -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<script>

                                $(document).ready(function () {
                                    /*****************************************************************************/
                                    table = $('#feedbackTable').DataTable({
                                        "processing": true, //Feature control the processing indicator.
                                        "serverSide": true, //Feature control DataTables' servermside processing mode.
                                        "pageLength": 10,
                                        "columnDefs": [
                                            {orderable: false, targets: -1}
                                        ],
                                        "ajax": {
                                            "url": "<?php echo base_url() ?>feedback/exportAjax/",
                                            "type": "POST",
                                            "dataType": "json",
                                        },
                                        "columns": [
                                            {"data": 'feedback_id', "name": 'feedback_id'},
                                            {"data": 'rating', "name": 'rating'},
                                            {"data": 'feedback_question_name', "name": 'feedback_question_name'},
                                            {"data": 'date', "name": 'date'},
                                            {"data": 'user_comment', "name": 'user_comment'},
                                            {"data": 'user_mobileno', "name": 'user_mobileno'},
                                            {"data": 'user_emailid', "name": 'user_emailid'},
                                            {"data": 'user_name', "name": 'user_name'},
                                        ],
                                    });
                                    //                                                $('#exportTableMy_filter').hide();
                                    $('#date-start1').on('change', function (e, date) {
                                        var minVal = ($(this).val()) ? $(this).val() : '';
                                        var maxVal = ($('#date-end1').val() !== '') ? $('#date-end1').val() : '';
                                        var daterang = "Date:" + minVal + "<>" + maxVal;
                                        var objVal = ($('#objectFilter').val() !== '') ? $('#objectFilter').val() : '';
                                        if (objVal != '' && minVal != '') {
                                            console.log('aaaa')
                                            fill_datatable(objVal, daterang);
                                            return false;
                                        }
                                        table.search(daterang, 3, true, false, false, false);
                                        table.draw();
                                    })
                                    $('#date-end1').on('change', function (e, date) {

                                        var minVal = ($('#date-start1').val() !== '') ? $('#date-start1').val() : '';
                                        var maxVal = ($(this).val()) ? $(this).val() : '';
                                        var daterang = "Date:" + minVal + "<>" + maxVal;
                                        var objVal = ($('#objectFilter').val() !== '') ? $('#objectFilter').val() : '';
                                        if (objVal != '' && maxVal != '') {
                                            console.log('bbbb')
                                            fill_datatable(objVal, daterang);
                                            return false;
                                        }
                                        table.search(daterang, 3, true, false, false, false);
                                        table.draw();
                                    })
                                    /*****************************************************************************/
                                    $('#objectFilter').on('change', function (e) {
                                        var objVal = ($(this).val() !== '') ? $(this).val() : "";
                                        //                                            table.search($(this).val(), 1, true, false, true, true).draw();
                                        var minVal = ($('#date-start1').val() !== '') ? $('#date-start1').val() : '';
                                        var maxVal = ($('#date-end1').val() !== '') ? $('#date-end1').val() : '';
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
                                        console.log('called object  ');
                                        //                                                    table.draw();
                                    });
                                });
                                var object = '';
                                var date = '';
                                function fill_datatable(object = '', date = 'Date:<>') {
                                    console.log('called filter_datatable function');
                                    $('#feedbackTable').DataTable().destroy();
                                    //                                                $("#exportTableMy").DataTable().destroy(true);

                                    var dataTable = $('#feedbackTable').DataTable({
                                        "processing": true,
                                        "serverSide": true,
                                        "pageLength": 10,
                                        "columnDefs": [
                                            {orderable: false, targets: -1}
                                        ],
                                        //dddddddddd
                                        //                                                  "dom": 'lBrtip',
                                        //                                                    "searching": false,
                                        "ajax": {
                                            "url": "<?php echo base_url() ?>feedback/exportAjax/",
                                            type: "POST",
                                            data: {
                                                rating: object, date: date, order: []
                                            }
                                        },
                                        "columns": [
                                            {"data": 'feedback_id', "name": 'feedback_id'},
                                            {"data": 'rating', "name": 'rating'},
                                            {"data": 'feedback_question_name', "name": 'feedback_question_name'},
                                            {"data": 'date', "name": 'date'},
                                            {"data": 'user_comment', "name": 'user_comment'},
                                            {"data": 'user_mobileno', "name": 'user_mobileno'},
                                            {"data": 'user_emailid', "name": 'user_emailid'},
                                            {"data": 'user_name', "name": 'user_name'},
                                        ],
                                    });
                                    //                                            $('#exportTableMy_filter').show();
                                }

                                function clearSearchData() {
                                    $("#exportTableMy").DataTable().search("").draw();
                                    $("#objectFilter").val("");
                                    $("#date-start1").val("");
                                    $("#date-end1").val("");
                                    $('#date').val("");
                                    $('#object').val("");
                                    fill_datatable();
                                    //                                                table.draw();
                                }

                                function export_data() {
                                    var from = $("#date-start1").val();
                                    var to = $("#date-end1").val();
                                    var search = $("#objectFilter").val();
                                    var searchVal = $('input[type="search"]').val();
                                    if (from !== '')
                                        searchVal = '';
                                    if (to !== '')
                                        searchVal = '';
                                    console.log('searchVal ==', searchVal)
                                    $.ajax({
                                        type: "GET",
                                        //url: "index.php?option=com_feedbacksui&task=get_exportData", //Relative or absolute path to response.php file
                                        url: "<?php echo base_url() ?>feedback/createXLS/",
                                        data: "search=" + search + "&searchVal=" + searchVal + "&from=" + from + "&to=" + to + "&format=html",
                                        dataType: "HTML",
                                        success: function () {
                                            console.log('234567');
                                            window.location.href = "createXLS?search=" + search + "&searchVal=" + searchVal + "&from=" + from + "&to=" + to + "&format=html";
                                        }
                                    });
                                }

                                /*****************************************************************************/
//                                setInterval(isLogin(), 3000);
                                $(document).ready(function () {
                                    console.log("document loaded");
                                    setInterval(function () {
                                        isLogin();
                                    }, 3000);
                                });
                                function isLogin() {
                                    console.log('isLogin is called');
                                    $.ajax({
                                        url: "<?php echo base_url() ?>common/checkSession",
                                        method: "POST",
                                        beforeSend: function () {
                                            // $('#' + $saveBtn).button('loading');
                                        }, complete: function () {
                                        }, success: function (response) {
                                            console.log('response data is =', response);
                                        }, error: function () {
                                            //                $('#' + $saveBtn).button('reset');
                                            // error/exception handling
                                            ajaxErrorHandling(jqXHR);
                                        }
                                    });
                                }
                                /***********************************************/
</script>