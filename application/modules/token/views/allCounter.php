<?php
$counterData = json_decode($counterData);
if (!empty($counterData->data)) {
    $counter = $counterData->data;
}
?>

<div class="page-container">
    <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Counter List</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url() . 'token/addNewToken'; ?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="">Counter Detail</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Counter List</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line">
                        <div class="tab-content">
                            <div class="tab-pane active fontawesome-demo" id="tab1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-box">
                                            <div class="card-head">
                                                <header>All Counter</header>
                                                <!--                                                <div class="tools">
                                                                                                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                                                                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                                                                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                                                                                </div>-->
                                            </div>
                                            <div class="card-body ">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-6">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#counterModal">Add Counter<i class="fa fa-plus"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table-scrollable">
                                                    <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                           id="example4">
                                                        <thead>
                                                            <tr>
                                                                <th>Counter ID</th>
                                                                <th>Counter Name </th>
                                                                <th> Active </th>
                                                                <th> Action </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if (!empty($counter)) {
                                                                foreach ($counter as $data) {
                                                                    ?>
                                                                    <tr class = "odd gradeX">
                                                                        <td><?php echo $data->counter_id; ?></td>
                                                                        <td class = "left"> <?php echo $data->counter_name; ?></td>
                                                                        <?php $active = ($data->is_active == 1) ? 'Yes' : 'No'; ?> 
                                                                        <td><?php echo $active; ?></td>
                                                                        <td>
                                                                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#counterModal" onclick="fetchCounterData(<?php echo $data->counter_id; ?>);"><i class = "fa fa-pencil"></i></button>
                                                                            <button class = "btn btn-danger btn-xs" data-toggle="modal" data-target="#exampleModal" onclick="updateDeleteID(<?php echo $data->counter_id; ?>);">
                                                                                <i class = "fa fa-trash-o "></i>
                                                                            </button>

                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
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
                                            <div class="col-lg-6 p-t-20">
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
                                                <button id="counterSaveBtn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="saveCounter();">
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
                            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="deleteCounter()">Yes</button>
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
<script>
    var $ajaxURLPart = "<?php echo base_url(); ?>";
    function saveCounter() {
        console.log('ajaxURLPart is ===' + $ajaxURLPart);
        var counterName = $('#counterName').val();
        var counterStatus = $('#counterStatus').is(":checked") ? 1 : 0;
        console.log('counterStatus is ==', counterStatus);
        console.log('typr of counterName is ==', typeof (counterName));
        if (counterName == "") {
            error_message('Please enter the counter name');
            return false;
        }
        var counterLength = $('#counterName').val().length;
        if (counterLength > 30) {
            error_message('Counter length is greater than 30');
            return false;
        }
        // declare json object
        console.log('counter id is ====', typeof ($('#counterID').val()));

        var url = ($('#counterID').val() == '') ? 'token/addCounter/' :
                'token/updateCounter/'
        postedData = {};
        postedData['counter_name'] = counterName;
        postedData['is_active'] = counterStatus;
        if ($('#counterID').val() !== '') {
            postedData['counter_id'] = $('#counterID').val();
        }
        $('#counterSaveBtn').text('Saving...');
        $('#counterSaveBtn').prop('disabled', true);
        $.ajax({
            url: $ajaxURLPart + url,
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
                    console.log('your latest data is ==========', res.data);
                    if ($('#counterID').val() !== '') {
                        success_message('Record updated successfully');
                    } else
                        success_message('Record addded successfully');
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    $('#counterSaveBtn').text('Save');
                    $('#counterSaveBtn').prop('disabled', false);
                    error_message(res.error);
                    if (res.error == 'Invalid Authentication') {
                        logout();
                    }

                }
            }, error: function () {
                $('#counterSaveBtn').text('Save');
                $('#counterSaveBtn').prop('disabled', false);
                // error/exception handling
                if (response.error == 'Invalid Authentication') {
                    logout();
                }
                ajaxErrorHandling(jqXHR);
            }
        });
    }
    function deleteCounter() {
        postedData = {};
        postedData['counter_id'] = $deleteId;
        $.ajax({
            url: $ajaxURLPart + 'token/deleteCounter/',
            method: "POST",
            data: postedData,
            beforeSend: function () {
                // $('#' + $saveBtn).button('loading');
            }, complete: function () {
//                $('#' + $saveBtn).button('reset');
                //$('#ImgModal').modal('hide');
            }, success: function (response) {
                let res = JSON.parse(response);
                if (res.status) {
                    console.log('recoed deleted successfully==========', res.data);
                    success_message('Record deleted successfully');
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    error_message(res.error);
                    if (res.error == 'Invalid Authentication') {
                        logout();
                    }
                }
            }, error: function () {
                $('#' + $saveBtn).button('reset');
                // error/exception handling
                ajaxErrorHandling(jqXHR);
            }
        });
    }

    function updateDeleteID(id) {
        $deleteId = id;
    }
    function fetchCounterData(id) {
        postedData = {};
        postedData['counter_id'] = id;
        $.ajax({
            url: $ajaxURLPart + 'token/fetchCounter/',
            method: "POST",
            data: postedData,
            beforeSend: function () {
                // $('#' + $saveBtn).button('loading');
            }, complete: function () {
//                $('#' + $saveBtn).button('reset');
                //$('#ImgModal').modal('hide');
            }, success: function (response) {
                let res = JSON.parse(response);
                if (res.status) {
                    console.log('recoed deleted successfully==========', res.data);
                    console.log(res.data.counter_name);
                    $('#counterName').val(res.data.counter_name);
                    $('#counterID').val(res.data.counter_id);
                    if (res.data.is_active == 1) {
                        if (!$('#counterStatus').is(':checked')) {
                            $('#counterStatus').click();
                        }
                    } else {
                        if ($('#counterStatus').is(':checked')) {
                            $('#counterStatus').click();
                        }
                    }
//                    location.reload();
                } else {
                    console.log('error in adding the conter');
                    if (res.error == 'Invalid Authentication') {
                        logout();
                    }
                }
            }, error: function () {
                $('#' + $saveBtn).button('reset');
                if (response.error == 'Invalid Authentication') {
                    logout();
                }
                // error/exception handling
                ajaxErrorHandling(jqXHR);
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

    $('#counterModal').on('show.bs.modal', function () {
        $('#counterModal input:text').val('');
    });
</script>