<?php
print_r($multilangualConfigData); die;
if (!empty($multilangualConfigData)) {
    $configData = json_decode($multilangualConfigData);
    if (!empty($configData->data)) {
        $configData = $configData->data;
    }
}
echo "<pre>";
print_r($configData[0]->config_value);
die;
$moduleData = json_decode($configData[0]->config_value);
?>
<div class="page-container">
    <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Multilingual List</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url() . 'token'; ?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="">Multilingual Detail</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Multilingual List</li>
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
                                                <header>Multilingual Data</header>
                                                <div class="tools">
                                                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                                </div>
                                            </div>
                                            <div class="card-body ">
                                                <div class="col-lg-12 col-md-12" id="counterDisplay" style="display: block">
                                                    <select class="form-control  select2" id="feedbackType" onchange="getQuestionData(this.value);">
                                                        <option value="">Select Module</option>
                                                        <?php
                                                        if (!empty($moduleData)) {
                                                            for ($i = 0; $i < COUNT($moduleData->feedback); $i++) {
                                                                ?>
                                                                <option value="<?php echo $moduleData->feedback[$i]; ?>"><?php echo $moduleData->feedback[$i]; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                    </select>
                                                </div>
                                                <div class="table-scrollable">
                                                    <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                           id="example4">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>English</th>
                                                                <th>Othar Language</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $sno = 1;
                                                            if (!empty($allFeedback)) {
                                                                foreach ($allFeedback as $data) {
                                                                    ?>
                                                                    <tr class = "odd gradeX">
                                                                        <td><?php echo $sno; ?></td>
                                                                        <td class = "left"> <?php echo $data->feedback_type_name; ?></td>
                                                                        <td class = "left"> <?php echo $data->feedback_questions; ?></td>

                                                                        <?php
                                                                        $sno++;
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
                            <h5 class="modal-title" id="exampleModalLabel">Delete Counter</h5>
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
<script>
    var $ajaxURLPart = "<?php echo base_url(); ?>";
    function saveCounter() {
        console.log('ajaxURLPart is ===' + $ajaxURLPart);
        var counterName = $('#counterName').val();
        var counterStatus = $('#counterStatus').is(":checked") ? 1 : 0;
        console.log('counterStatus is ==', counterStatus);
        console.log('typr of counterName is ==', typeof (counterName));
        if (counterName == "") {
            $('#my-toast-location').toastee('Please enter the counter name', 'error');
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
                    location.reload();
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
                    location.reload();
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
                }
            }, error: function () {
                $('#' + $saveBtn).button('reset');
                // error/exception handling
                ajaxErrorHandling(jqXHR);
            }
        });
    }

</script>