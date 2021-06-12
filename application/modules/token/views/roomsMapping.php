<?php
if (!empty($subCounterData)) {
    $subCounterData = json_decode($subCounterData);
    $counterData = json_decode($counterData);
    if (!empty($counterData->data))
        $mainCounter = $counterData->data;
    if (!empty($subCounterData->data))
        $subCounter = $subCounterData->data;
}
?>
<div class="page-container">
    <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Room Mapping List</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url() . 'token/addNewToken'; ?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="">Room Mapping Detail</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Room Mapping List</li>
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
                                                <header>All Room Mapping</header>
                                                <!--                                                <div class="tools">
                                                                                                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                                                                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                                                                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                                                                                </div>-->
                                            </div>
                                            <div class="card-body">
                                                <div class="table-scrollable">
                                                    <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                           id="example4">
                                                        <thead>
                                                            <tr>
                                                                <th class="center">Sno.</th>
                                                                <th class="center"> Room no. </th>
                                                                <th class="center"> Dr. Name </th>
                                                                <!--<th class="center"> Dr.Name. </th>-->
                                                                <th class="center"> Edit </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody> 
                                                            <?php
                                                            if (!empty($subCounter)) {
                                                                $sn = 1;
                                                                foreach ($subCounter as $data) {
                                                                    ?>
                                                                    <tr class="odd gradeX">
                                                                        <td class="patient-img">
                                                                            <?php echo $sn; ?> 
                                                                        </td>
                                                                        <td class="center"><?php echo (!empty($data->room_no)) ? $data->room_no : '--'; ?></td>
                                                                        <td class="center"><?php echo $data->subcounter_name; ?></td>
                                                                        <!--<td class="center"><?php echo $data->counter_name; ?></td>-->
                                                                        <?php // $status = ($data->is_active == 1) ? 'Yes' : 'No'; ?>
                                                                        <!--<td class="left"><?php echo $status; ?></td>-->
                                                                        <td class="center">
                                                                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#subCounterModal" onclick="fetchSubCounterData(<?php echo $data->subcounter_id; ?>);"><img src="<?php echo base_url(); ?>assets/img/edit.png" class="fa fa-arrow-left" style="color: blcck; margin: 5px; width: 12px" aria-hidden="true"></button>
        <!--                                                                            <button class = "btn btn-danger btn-xs" data-toggle="modal" data-target="#exampleModal" onclick="updateDeleteID(<?php echo $data->subcounter_id; ?>);">
                                                                                        <i class = "fa fa-trash-o "></i>
                                                                                    </button>-->
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                    $sn++;
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
            <!-------------------Create/Update Modal--------------------->
            <div class="modal" tabindex="-1" role="dialog" id="subCounterModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <div class="card-head">
                                            <header>Room Mapping</header>
                                        </div>
                                        <div class="card-body row">
                                            <div class="col-lg-8 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield">
                                                    <input class="mdl-textfield__input" type="text" id="room_no" placeholder="Enter the room number">
                                                </div>
                                            </div>
                                            <div class="col-lg-8 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield">
                                                    <input class="mdl-textfield__input" type="text" id="subCounterName" placeholder="Enter the doctor name">
                                                    <input class="mdl-textfield__input" type="hidden" id="subCounterID" value="">
                                                    <!--<label class="mdl-textfield__label" for="text1">Simple Text Field</label>-->
                                                </div>
                                            </div>

                                            <div class="col-lg-12 p-t-20" style="display:none">
                                                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="subCounterStatus">
                                                    <input type="checkbox" id="subCounterStatus" name="subCounterStatus" class="mdl-switch__input" checked>
                                                    <span class="mdl-switch__label">Active/Inactive</span>
                                                </label>
                                            </div>
                                            <div class="col-lg-12 p-t-20">
                                                <button id="subcounterSaveBtn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="saveSubCounter();">
                                                    Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!----------------------------------------------------------->
            <!--------------Delete Conformation------------------------------>
            <!--Modal: modalConfirmDelete-->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" style="color:black">Delete Sub-Counter</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="deleteSubCounter()">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--Modal: modalConfirmDelete-->
        </div>
    </div>
    <!-- end page content -->

</div>
<!-- end page container -->
<script>
    var $ajaxURLPart = "<?php echo base_url(); ?>";
    function saveSubCounter() {
        console.log('ajaxURLPart is ===' + $ajaxURLPart);
        var subCounterName = $('#subCounterName').val();
        if (subCounterName == "") {
            error_message('Please enter the subcounter name');
            return false;
        }

        var subCounterStatus = $('#subCounterStatus').is(":checked") ? 1 : 0;
        if (subCounterName == "") {
            error_message('please enter a counter name');
        }
        var subcounterLength = $('#subCounterName').val().length;
        if (subcounterLength > 30) {
            error_message('Sub-Counter length is greater than 30');
            return false;
        }
        // declare json object

        var url = ($('#subCounterID').val() == '') ? 'token/addSubCounter/' :
                'token/updateSubCounter/'
        postedData = {};
        postedData['subcounter_name'] = subCounterName;
        postedData['is_active'] = subCounterStatus;
        postedData['room_no'] = $('#room_no').val();
        if ($('#subCounterID').val() !== '') {
            postedData['subcounter_id'] = $('#subCounterID').val();
        }
        $('#subcounterSaveBtn').text('Saving...');
        $('#subcounterSaveBtn').prop('disabled', true);
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
                    if ($('#subCounterID').val() !== '') {
                        success_message('Record updated successfully');
                    } else
                        success_message('Record addded successfully');
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    $('#subcounterSaveBtn').prop('disabled', false);
                    $('#subcounterSaveBtn').text('Save')
                    error_message(res.error);
                    if (res.error == 'Invalid Authentication') {
                        logout();
                    }
                }
            }, error: function () {
                $('#subcounterSaveBtn').prop('disabled', false);
                $('#subcounterSaveBtn').text('Save')
                // error/exception handling
                if (response.error == 'Invalid Authentication') {
                    logout();
                }
                ajaxErrorHandling(jqXHR);
            }
        });
    }
    function deleteSubCounter() {
        postedData = {};
        postedData['subcounter_id'] = $deleteId;
        $.ajax({
            url: $ajaxURLPart + 'token/deleteSubCounter/',
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
                    console.log('error in adding the conter');
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
    function fetchSubCounterData(id) {
        postedData = {};
        postedData['subcounter_id'] = id;
        $.ajax({
            url: $ajaxURLPart + 'token/fetchSubCounter/',
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
                    console.log('recoed fetched successfully==========', res.data);
                    console.log(res.data.counter_id);
                    $('#subCounterName').val(res.data.subcounter_name);
                    $('#subCounterID').val(res.data.subcounter_id);
                    $('#room_no').val(res.data.room_no);
//                    $("select option:selected").each(function () {
//                    $("option:selected").prop("selected", false)
//                    });
                    $("#counterId").find('option').attr("selected", false);
                    $('select[name^="counterId"] option[value="' + res.data.counter_id + '"]').attr("selected", "selected");
                    if (res.data.is_active == 1) {
                        if (!$('#subCounterStatus').is(':checked')) {
                            $('#subCounterStatus').click();
                        }
                    } else {
                        if ($('#subCounterStatus').is(':checked')) {
                            $('#subCounterStatus').click();
                        }
                    }
//                    location.reload();
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
    $('#subCounterModal').on('show.bs.modal', function () {
        $('#subCounterModal input:text').val('');
        $("#counterId").find('option').attr("selected", false);
    });
</script>