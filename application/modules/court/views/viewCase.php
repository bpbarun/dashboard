<?php
$court = json_decode($court);
if (!empty($court->data)) {
    $courtData = $court->data;
}
// $counterData = json_decode($counterData);
// if (!empty($counterData->data)) {
//     $countersData = $counterData->data;
// }
?>
<div class="page-container">
    <!--start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- <div id="viewButtonID" style="display: none;">
                <button class="btn btn-success" onclick=" window.open('<?php echo base_url() . 'token/viewScreen/2'; ?>', '_blank')"> View Screen</button>
            </div> -->
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line">
                        <div class="tab-content">
                            <div class="tab-pane active fontawesome-demo" id="tab1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-box">
                                            <div class="card-head">
                                                <div class="col-lg-12 p-t-20">
                                                    <div class="card-body " id="bar-parent10">
                                                        <form class="form-horizontal">
                                                            <div class="form-group row">
                                                                <div class="col-lg-12 col-md-12" id="counterDisplay" style="display: block">
                                                                    <label class="control-label">Select Court</label>
                                                                    <select class="form-control  select2" id="courtID" onchange="getCaseData(this.value)">
                                                                        <option value="">Select your court</option>
                                                                        <?php
                                                                        if (!empty($courtData)) {
                                                                            foreach ($courtData as $data) {
                                                                        ?>
                                                                                <option value="<?php echo $data->court_id; ?>"><?php echo $data->court_name; ?></option>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body" id="tokenDisplay" style="display: none">
                                                <div style="text-align: center">
                                                    <!-- <div>
                                                        <h1>AIIMS HOSPITAL RAIPUR, CG |<span id="SubName"></span></h1>
                                                    </div> -->
                                                    <h1>Current case</h1>
                                                    <div>
                                                        <h2>
                                                            <lable id="runningCase"></lable>
                                                        </h2>
                                                    </div>
                                                    <div>
                                                        <button id="finish_case" type="button" class="hidden mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-primary" onclick="finishCase();">Finish</button>
                                                    </div>
                                                    <div>
                                                        <form class="form-horizontal">
                                                            <div class="form-group row">
                                                                <div class="col-lg-12 col-md-12">
                                                                    <div style="float: left; margin-bottom: 5px;">
                                                                        <label class="control-label">Select case</label>
                                                                    </div>
                                                                    <select class="form-control  select2" id="goto" onchange="goToCase(this.value)">
                                                                        <option value="">Select case</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </form>
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
</div>
<!--end page container -->
<script>
    var $ajaxURLPart = "<?php echo base_url(); ?>";
    function getCaseData(courtID) {
        postedData = {};
        postedData['court_id'] = courtID;
        $.ajax({
            url: $ajaxURLPart + 'court/runningCase/',
            method: "POST",
            data: postedData,
            dataType: "JSON",
            beforeSend: function() {},
            complete: function() {},
            success: function(response) {
                //$('#upperLoaderBar').css('display', 'none');
                console.log('data ', response.data);
                var html = '';
                var msg = '';
                if (typeof(response.data) == 'undefined' || typeof(response.data[0].case_no) == 'undefined') {
                    $('#runningCase').html('');
                    $('#finish_case').addClass('hidden');
                    msg = 'No current case !!!';
                } else {
                    $('#runningCase').html(response.data[0].case_no);
                    $('#finish_case').removeClass('hidden');
                    i = response.data[0].case_no;
                    html += '<option selected="selected" value="' + i + '">' + i + '</option>';
                }
                if (response.data[0].next_case.length){
                    res = response.data[0].next_case.split(',');
                    res.map((i) => {
                            html += '<option value="' + i + '">' + i + '</option>';
                    })
                } else {
                    if (msg.length) {
                        msg = 'No current and upcoming case !!!';
                    } else {
                        msg = 'No upcoming case !!!';
                    }
                }
                if(html.length) {
                    html = '<option value="">Select case</option>' + html;
                }
                if(msg.length) {
                    info_message(msg);
                }
                $('#goto').html(html);
                // $('#caseName').html(' ' + response.data[0].case_no);
                $('#tokenDisplay').css("display", "block");
            },
            error: function() {
                // $('#upperLoaderBar').css('display', 'none');
                // $('#' + $saveBtn).button('reset');
                // ajaxErrorHandling(jqXHR);
            }
        });
    }

    function updateViewScreen(courtID, caseNO, status,refresh='') {
        console.log('running token id is===', caseNO);
        postedData = {};
        postedData['case_no'] = caseNO;
        postedData['is_active'] = status;
        $.ajax({
            url: $ajaxURLPart + 'court/updateRunningCase/',
            method: "POST",
            data: postedData,
            dataType: "JSON",
            beforeSend: function() {},
            complete: function() {},
            success: function(response) {
                console.log('updateViewScreen is ===', response);
                if (response.status) {
                    if (status == 4 && refresh!='notrefesh')
                        getCaseData(courtID);
                }
            },
            error: function() {
                $('#' + $saveBtn).button('reset');
                // error/exception handling
                ajaxErrorHandling(jqXHR);
            }
        });
    }
    /*
     * On Click on Next token button
     */
    function finishCase() {
        let courtID = $('#courtID').val();
        if (typeof(courtID) != 'undefined') {
            let caseNO = $('#runningCase').text();
            updateViewScreen(courtID, caseNO, 4);
            // getTokenData(subCount);
        }
    }

    function goToCase() {
        const caseNo = $('#goto').val();
        console.log('caseNo is is ===' + caseNo);
        let courtID = $('#courtID').val();

        let currentCaseNO = $('#runningCase').text();
        if (currentCaseNO) {
            updateViewScreen(courtID,currentCaseNO, 4,'notrefesh');
        }
        if (caseNo) {
            $('#runningCase').html(caseNo);
            $('#finish_case').removeClass('hidden');
            updateViewScreen(courtID,caseNo, 2);
        } else {
            $('#runningCase').html(caseNo);
            $('#finish_case').addClass('hidden');
        }
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

    function info_message($msg) {
        console.log('info message function is called');
        $.toast({
            heading: 'Info',
            text: $msg,
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'info',
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

    var input = document.getElementById("goToTOken");
    input.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("searchToken").click();
        }
    });
</script>
