<?php
$subCounterData = json_decode($subCounterData);
if (!empty($subCounterData->data)) {
    $subCounter = $subCounterData->data;
}
$counterData = json_decode($counterData);
if (!empty($counterData->data)) {
    $countersData = $counterData->data;
}
?>
<div class = "page-container">
    <!--start page content -->
    <div class = "page-content-wrapper">
        <div class = "page-content">
            <div id="viewButtonID" style="display: none;">
                <button class="btn btn-success" onclick=" window.open('<?php echo base_url() . 'token/viewScreen/2'; ?>', '_blank')"> View Screen</button>
            </div>
            <div class = "row">
                <div class = "col-md-12">
                    <div class = "tabbable-line">
                        <div class = "tab-content">
                            <div class = "tab-pane active fontawesome-demo" id = "tab1">
                                <div class = "row">
                                    <div class = "col-md-12">
                                        <div class = "card card-box">
                                            <div class = "card-head">
                                                <div class="col-lg-12 p-t-20">
                                                    <div class="card-body " id="bar-parent10">
                                                        <form class="form-horizontal">
                                                            <div class="form-group row">
                                                                <div class="col-lg-12 col-md-12" id="counterDisplay" style="display: block">
                                                                    <select class="form-control  select2" id="counterId" onchange="getSubCatData(this.value)">
                                                                        <option value="">Select Your Counter</option>
                                                                        <?php
                                                                        if (!empty($countersData)) {
                                                                            foreach ($countersData as $data) {
                                                                                ?>
                                                                                <option value="<?php echo $data->counter_id; ?>"><?php echo $data->counter_name; ?></option>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-12 col-md-12" id="subCounterDisplay" style="display: none">
                                                                    <select class="form-control  select2" id="subCounterId" onchange="getTokenData(this.value)">
                                                                        <option value="">Select Your SubCounter</option>
                                                                        <?php
                                                                        if (!empty($subCounter)) {
                                                                            foreach ($subCounter as $data) {
                                                                                ?>
                                                                                <option value="<?php echo $data->subcounter_id; ?>"><?php echo $data->subcounter_name; ?></option>
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
                                            <div class = "card-body" id="tokenDisplay" style="display: none">
                                                <div style="text-align: center">
                                                    <div>
                                                        <h1>AIIMS HOSPITAL RAIPUR, CG |<span id="SubName"></span></h1>
                                                    </div>
                                                    <h1>Current token no:</h1>
                                                    <div>
                                                        <h2>
                                                            <lable id="runningToken">-00-</lable>
                                                        </h2>
                                                    </div>
                                                    <div>
                                                        <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-primary" onclick="nextToken();">Next</button>
                                                        <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-info" onclick="skipToken();">Skip</button>
                                                    </div>
                                                    <div>
                                                        <div class="search-form-opened">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" placeholder="Go to" id="goToTOken">
                                                                <span class="input-group-btn">
                                                                    <a href="javascript:;" class="btn submit">
                                                                        <i class="fa fa-caret-square-o-down" id="searchToken" onclick="goToToken();"></i>
                                                                    </a>
                                                                </span>
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
    </div>
</div>
<!--end page container -->
<script>
    var $ajaxURLPart = "<?php echo base_url(); ?>";
    function getTokenData(subCatId) {
        let countID = $('#counterId').val();
        let btnHtml = '';
        btnHtml += '<a class="btn btn-success" href=' + $ajaxURLPart + 'token/viewScreen/' + countID + '>';
        btnHtml += 'View Screen</button>';
        console.log(btnHtml);
        $('#viewButtonID').html(btnHtml);
        $('#viewButtonID').css("display", "block");
        var subName = $("#subCounterId option:selected").text();
        console.log('sub cat name is ===', subName);
        postedData = {};
        postedData['subcounter_id'] = subCatId;
//        postedData['is_active'] = 1;
        if ($('#counterID').val() !== '') {
            postedData['counter_id'] = $('#counterID').val();
        }
        $('#upperLoaderBar').css('display', 'block');
        $.ajax({
            url: $ajaxURLPart + 'token/runningToken/',
            method: "POST",
            data: postedData,
            dataType: "JSON",
            beforeSend: function () {
            }, complete: function () {
            }, success: function (response) {
                $('#upperLoaderBar').css('display', 'none');
                console.log('data ', response.data);
                if (typeof (response.data) == 'undefined') {
                    $('#runningToken').html('000');
                    $('#my-toast-location').toastee('No token request found', 'info');
                } else {
                    if (response.data[0].is_active == 1) {
                        $('#runningToken').html(response.data[0].token_id);
                    }
                    updateViewScreen(response.data[0].token_id, 2);
                }
                $('#goToTOken').val('');
                $('#SubName').html(' ' + subName);
                $('#tokenDisplay').css("display", "block");
            }, error: function () {
                $('#upperLoaderBar').css('display', 'none');
                $('#' + $saveBtn).button('reset');
                ajaxErrorHandling(jqXHR);
            }
        });
    }
    function updateViewScreen(tokenId, status) {
        console.log('running token id is===', tokenId);
        postedData = {};
        postedData['token_id'] = tokenId;
        postedData['is_active'] = status;
        $.ajax({
            url: $ajaxURLPart + 'token/updateToken/',
            method: "POST",
            data: postedData,
            dataType: "JSON",
            beforeSend: function () {
            }, complete: function () {
            }, success: function (response) {
                console.log('updateViewScreen is ===', response);
            }, error: function () {
                $('#' + $saveBtn).button('reset');
// error/exception handling
                ajaxErrorHandling(jqXHR);
            }
        });
    }
    /*
     * On Click on Next token button
     */
    function nextToken() {
        let subCount = $('#subCounterId').val();
        if (typeof (subCount) != 'undefined') {
            var tokenId = $('#runningToken').text();
            updateViewScreen(tokenId, 4);
            getTokenData(subCount);
        }
    }
    /*
     * On Click on Skip token button
     */
    function skipToken() {
        var tokenId = $('#runningToken').text();
        console.log('Skip token is is ==', tokenId);
        updateViewScreen(tokenId, 3);
        nextToken();
    }
    function goToToken() {
        var tokenId = $('#goToTOken').val();
        console.log('token is is ===', tokenId);
        var subCount = $('#subCounterId').val();
//        updateViewScreen(tokenId, 1);
        postedData = {};
        postedData['token_id'] = tokenId;
        $('#upperLoaderBar').css('display', 'block');
        $.ajax({
            url: $ajaxURLPart + 'token/goToToken/',
            method: "POST",
            data: postedData,
            dataType: "JSON",
            beforeSend: function () {
            }, complete: function () {
            }, success: function (response) {
                $('#upperLoaderBar').css('display', 'none');
                console.log('response.data is ===', response.data);
                if (typeof (response.data) == 'undefined') {
                    $('#runningToken').html('000');
                    $('#my-toast-location').toastee('This token is not valid', 'error');
                    return false;
                } else {
                    console.log('data ', response.data);
                    if (response.data[0].subcounter_id !== subCount) {
                        // not for this sub counter
                        $('#my-toast-location').toastee('This token is related with: ' + response.data[0].subcounter_name + '', 'info');
                        return false;
                    } else if (response.data[0].is_active > 1) {
                        // allready served
                        $('#my-toast-location').toastee('This token has already served', 'info');
                        return false;
                    } else {
                        $('#runningToken').html(response.data[0].token_id);
                    }
                }
                updateViewScreen(response.data[0].token_id, 2);
            }, error: function () {
                $('#upperLoaderBar').css('display', 'none');
                $('#' + $saveBtn).button('reset');
                ajaxErrorHandling(jqXHR);
            }
        });
    }
    function getSubCatData(id) {
        if (typeof (id) != 'undefined') {
            console.log('running token id is===', id);
            postedData = {};
            postedData['counter_id'] = id;
            $('#upperLoaderBar').css('display', 'block');
            $.ajax({
                url: $ajaxURLPart + 'token/fetchSubCounter/',
                method: "POST",
                data: postedData,
                dataType: "JSON",
                beforeSend: function () {
                }, complete: function () {
                }, success: function (response) {
                    $('#upperLoaderBar').css('display', 'none');
                    var html = '';
                    console.log('updateViewScreen is ===', response.data);
                    var subCounterData = response.data;
                    console.log('length of token data is ===', subCounterData.length);
                    html += '<option value="">Select Your SubCounter</option>';
                    for (var i = 0; i < subCounterData.length; i++) {
                        console.log('counter id is ====', subCounterData[i].subcounter_name);
                        html += '<option value=' + subCounterData[i].subcounter_id + '>';
                        html += subCounterData[i].subcounter_name;
                        html += '</option>';
                    }
                    $('#subCounterId').html(html);
                    $("#subCounterDisplay").css("display", "block");
                }, error: function () {
                    $('#upperLoaderBar').css('display', 'none');
                    $('#' + $saveBtn).button('reset');
                }
            });
        }
    }
    var input = document.getElementById("goToTOken");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("searchToken").click();
        }
    });
</script>