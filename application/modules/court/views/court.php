<?php

$courtData = json_decode($courtData);
if (!empty($courtData->data)) {
    $court = $courtData->data;
}
$caseData = json_decode($caseData);
if (!empty($caseData->data)) {
    $case = $caseData->data;
}
?>
<div class="page-container">
    <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Case List</div>
                    </div>

                    <!-- <div class="btn-group pull-right">
                        <a href="http://displayfort.com/tokenScreen.php" id="addRow" class="btn btn-info">
                            Running Token Screen
                        </a>
                    </div> -->

                    <!--<a href="../">Running Token Screen</a>-->
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
                                                <header>All Cases</header>
                                            </div>
                                            <div class="card-body ">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-6">
                                                        <div class="btn-group">
                                                            <a data-toggle="modal" data-target="#addCaseModal" class="btn btn-info" id="addCaseBtn">
                                                                <i class="fa fa-plus"></i> Case Hearing
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table-scrollable">
                                                    <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                                        <thead>
                                                            <tr>
                                                                <th> # </th>
                                                                <th> Case Number </th>
                                                                <th> Court </th>
                                                                <th> Date </th>
                                                                <th> Note </th>
                                                                <th> Action </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $sno = 1;
                                                            if (!empty($case)) {
                                                                foreach ($case as $data) { ?>
                                                                    <tr class="odd gradeX">
                                                                        <td><?php echo $sno;
                                                                            ?>
                                                                        </td>
                                                                        <td><?php echo $data->case_no;
                                                                            ?></td>
                                                                        <td><?php echo $data->court_name;
                                                                            ?></td>
                                                                        <td><?php echo $data->case_date;
                                                                            ?></td>
                                                                        <td><?php echo $data->notes;
                                                                            ?></td>
                                                                        <td>
                                                                            <button type="button" class="btn btn-secondary btn-xs hidden" onclick="printElem('<?php echo $data->case_no; ?>', '<?php echo $data->court_name; ?>')"><i class="fa fa-print"></i></button>
                                                                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addCaseModal" onclick="fetchCaseData(<?php echo $data->case_id; ?>);"><i class="fa fa-pencil"></i></button>
                                                                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#exampleModal" onclick="updateDeleteID(<?php echo $data->case_id; ?>);"><i class="fa fa-trash"></i></button>
                                                                        </td>
                                                                    </tr>
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
            <!-------------Modal popup data----------------->

            <!----------------------------------------------------------------------------------------------------------->
            <!--Modal: modalConfirmDelete-->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" style="color:black">Delete Case</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="deleteCase()">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--Modal: modalConfirmDelete-->
            <!--------------Modal detail------------------>
            <div class="modal" tabindex="-1" role="dialog" id="addCaseModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <div class="card-head">
                                            <header>Case Detail</header>
                                        </div>
                                        <div class="card-body row">
                                            <div class="col-lg-12 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
                                                    <input class="mdl-textfield__input" type="text" id="caseNo">
                                                    <label class="mdl-textfield__label" for="caseNo">Case Number</label>
                                                    <input class="mdl-textfield__input" type="hidden" id="caseID" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
                                                    <textarea class="mdl-textfield__input" type="text" rows="3" id="note"></textarea>
                                                    <label class="mdl-textfield__label" for="note">Note</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
                                                    <select class="form-control select2" id="courtId" name="courtId">
                                                        <option>Select court</option>
                                                        <?php
                                                        if (!empty($court)) {
                                                            foreach ($court as $data) {
                                                        ?>
                                                                <option value=<?php echo $data->court_id ?>><?php echo $data->court_name ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <label class="mdl-textfield__label" for="courtId">Court</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 p-t-20">
                                                <div class="form-control-wrapper mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
                                                    <input type="text" id="date-start1" name="date-start" class="floating-label mdl-textfield__input">
                                                    <label class="mdl-textfield__label" for="date-start1">Date Time</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 p-t-20">
                                                <button id="caseSaveBtn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="saveCase();">Save</button>
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
        </div>
    </div>
</div>
<!-- end page container -->
<script>
    const $ajaxURLPart = "<?php echo base_url(); ?>";

    function updateDeleteID(id) {
        $deleteId = id;
    }

    function saveCase() {
        let caseNumber = $('#caseNo').val();
        let courtId = $('#courtId').val();
        let date=  $('#date-start1').val();
      
        if(date == '' ){
            error_message('Please enter date time');
            return false;
        }
                                                                                      
        //let date = ($('#date-start1').val() !== '') ? $('#date-start1').val() : '';
                                                                                      
        if (caseNumber == "") 
        {
            error_message('Please enter Case Number');
            return false;
        } else if (!document.getElementById("caseNo").checkValidity()) {
            error_message('Please enter a Valid Case Number');
            return false;
        }
                                                                                              
        if (courtId == "") {
            error_message('Please select a Court');
            return false;
        }
        // declare json object
        const url = ($('#caseID').val() == '') ? 'court/addCase/' :
            'court/updateCase/'
        const postedData = {};
        postedData['case_no'] = caseNumber;
        postedData['court_id'] = courtId;
        postedData['is_active'] = 1;
        if ($('#note').val() !== '') {
            postedData['notes'] = $('#note').val();
        }
        if ($('#caseID').val() !== '') {
            postedData['case_id'] = $('#caseID').val();
        }
        postedData['case_date'] = date;
        $('#caseSaveBtn').text('Saving...');
        $('#caseSaveBtn').prop('disabled', true);
        $.ajax({
            url: $ajaxURLPart + url,
            method: "POST",
            data: postedData,
            beforeSend: function() {},
            complete: function() {},
            success: function(response) {
                console.log('response data is =', response);
                console.log('after success statusis ==', response.status);
                let res = JSON.parse(response);
                if (res.status) {
                    console.log('your latest data is ==========', res.data);
                    if ($('#caseID').val() !== '') {
                        success_message('Record updated successfully');
                        $('#caseID').val('');
                    } else
                        success_message('Record addded successfully');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    $('#caseSaveBtn').prop('disabled', false);
                    $('#caseSaveBtn').text('Save')
                    error_message(res.error);
                    if (res.error == 'Invalid Authentication') {
                        logout();
                    }
                }
            },
            error: function() {
                $('#caseSaveBtn').prop('disabled', false);
                $('#caseSaveBtn').text('Save')
                // error/exception handling
                ajaxErrorHandling(jqXHR);
            }
        });
    }

    function deleteCase() {
        postedData = {};
        postedData['case_id'] = $deleteId;
        $.ajax({
            url: $ajaxURLPart + 'court/deleteCase/',
            method: "POST",
            data: postedData,
            beforeSend: function() {
                // $('#' + $saveBtn).button('loading');
            },
            complete: function() {
                //$('#' + $saveBtn).button('reset');
                //$('#ImgModal').modal('hide');
            },
            success: function(response) {
                let res = JSON.parse(response);
                if (res.status) {
                    console.log('recoed deleted successfully==========', res.data);
                    success_message('Record deleted successfully');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    console.log('error in deleteing the token');
                    console.log('res.error', res.error)
                    if (res.error == 'Invalid Authentication') {
                        logout();
                    }
                }
            },
            error: function() {
                $('#' + $saveBtn).button('reset');
                // error/exception handling
                ajaxErrorHandling(jqXHR);
            }
        });
    }

    function fetchCaseData(id) {
        postedData = {};
        postedData['case_id'] = id;
        $.ajax({
            url: $ajaxURLPart + 'court/fetchCourtCase/',
            method: "POST",
            data: postedData,
            beforeSend: function() {},
            complete: function() {},
            success: function(response) {
                let res = JSON.parse(response);
                if (res.status) {
                    console.log('recoed fetched successfully==========', res.data);
                    console.log(res.data.counter_id);
                    $('#caseNo').val(res.data.case_no);
                    $('#caseID').val(res.data.case_id);
                    $("#courtId").find('option').attr("selected", false);
                    $('#note').val(res.data.notes);
                    // $("#date-start").find("input").val(res.data.case_date);
                    let dateControl = document.querySelector('input[name="date-start"]');
                    dateControl.value = res.data.case_date;
                    // $('#date-start').val(res.data.case_date);
                    $('select[name^="courtId"] option[value="' + res.data.court_id + '"]').attr("selected", "selected");
                } else {
                    console.log('error in adding the conter');
                    if (res.error == 'Invalid Authentication') {
                        logout();
                    }
                }
            },
            error: function() {
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

    function printElem(caseNo, courtName) {
        console.log('called123');
        console.log('case no is ==' + caseNo + ' courtName ==' + courtName)
        var date = new Date().toLocaleString();

        var mywindow = window.open('', 'Jabalpur High court', 'height=500,width=600');
        mywindow.document.write('<html>');
        mywindow.document.write('<div style="text-align:center"><h2>Jabalpur High court</h2></div>');
        mywindow.document.write('<hr>');
        mywindow.document.write('<div style="text-align:center"><img src=" <?php echo base_url(); ?>assets/img/prof/user.png/"</div>');
        mywindow.document.write('<div style="text-align:center" ><b>Court Name: ' + courtName + '</b></div>');
        mywindow.document.write('<div style="text-align:center">Case No.<b><h1>' + caseNo + '</h1></b></div>');
        mywindow.document.write('<div style="text-align:center" >' + date + '</div>');
        mywindow.document.write('<div style="text-align:center" >Please wait for you turn...</div>');
        mywindow.document.write('</body></html>');
        mywindow.print();
        mywindow.close();
        return true;
    }

    $('#addCaseBtn').on('click', function() {
        $('#caseNo').val('');
        $('#caseID').val('');
        $("#courtId").find('option').attr("selected", false);
        $('#note').val('');
        $('#date-start1').val('');
    });
</script>