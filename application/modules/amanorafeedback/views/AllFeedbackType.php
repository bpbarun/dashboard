<?php
$feedbackType = json_decode($feedbackType);

if (!empty($feedbackType->data)) {
    $allFeedbackType = $feedbackType->data;
}
if (!empty($feedbackConfigData)) {
    $feedbackAllConfig = json_decode($feedbackConfigData);
    if (!empty($feedbackAllConfig->data)) {
        $configData = $feedbackAllConfig->data;
    }
}
if (!empty($feedbackHeaderData)) {
    $feedbackHeaderConData = json_decode($feedbackHeaderData);
    if (!empty($feedbackHeaderConData->data)) {
        $configHeaderData = $feedbackHeaderConData->data;
    }
}
//print_r($configHeaderData); die;
$imgData = array();
if (!empty($configData)) {
    foreach ($configData as $imageData) {
        $imgData = explode(",", $imageData->config_value);
    }
}
if (!empty($allFeedbackType))
    $feedbackCount = COUNT($allFeedbackType);
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    body {
        background: #f1f1f1;
    }

    /* The device with borders */
    .tablet {
        position: relative;
        width: 768px;
        height: 470px;
        margin: auto;
        border: 16px black solid;
        border-left-width: 60px;
        border-right-width: 60px;
        border-radius: 36px;
    }

    /* The horizontal line on the top of the device */
    .tablet:before {
        content: '';
        display: block;
        width: 60px;
        height: 5px;
        position: absolute;
        top: -30px;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #333;
        border-radius: 10px;
    }

    /* The circle on the bottom of the device */
    .tablet:after {
        content: '';
        display: block;
        width: 35px;
        height: 35px;
        position: absolute;
        left: 103%;
        bottom: 202px;
        transform: translate(-50%, -50%);
        background: #333;
        border-radius: 50%;
    }

    /* The screen (or content) of the device */
    .tablet .content {
        width: 647px;
        height: 437px;
        background: #353C48;
        margin: -1px;
    }
</style>
<link href="<?php echo base_url() ?>assets/plugins/jquery-tags-input/jquery-tags-input.css" rel="stylesheet">
<div class="page-container">
    <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Feedback Type</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url() . 'feedback/'; ?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="">Manage Feedback</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active"><a class="parent-item" href="<?php echo base_url() . 'feedback/'; ?>">Feedback Detail</a></li>
                    </ol>
                </div>
            </div>
            <!--<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-primary" data-toggle="modal" data-target="#FeedbackTypeModalIpad" id="addFeedbackType"> ADD Ipad Feedback Type</button>-->
            <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-primary" data-toggle="modal" data-target="#FeedbackTypeModal" id="addFeedbackType"> ADD Feedback Type</button>
            <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-primary" data-toggle="modal" data-target="#FeedbackConfigModal" onclick="FetchConfigData()"> ADD Config Data</button>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line">
                        <div class="tab-content">
                            <div class="tab-pane active fontawesome-demo" id="tab1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-box">
                                            <div class="card-head">
                                                <header>All Feedback Type</header>
                                                <div class="tools">
                                                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                                </div>
                                            </div>
                                            <div class="card-body ">
                                                <div class="table-scrollable">
                                                    <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                           id="example4">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Feedback Name</th>
                                                                <th>image</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $sno = 1;
                                                            if (!empty($allFeedbackType)) {
                                                                foreach ($allFeedbackType as $data) {
                                                                    ?>
                                                                    <tr class = "odd gradeX">
                                                                        <td><?php echo $sno; ?></td>
                                                                        <td class = "left"> <?php echo $data->feedback_type_name; ?></td>
                                                                        <td class = "left"><img src="<?php echo base_url(); ?>assets/img/<?php echo $data->feedback_type_image; ?>" alt="Happy" style="width: 40px; height: 40px;"/></td>
                                                                        <td>
                                                                            <button type="button" id="<?php echo $data->feedback_type_id; ?>" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#FeedbackTypeModal" type_string_id ="<?php echo $data->string_key_id; ?>" onclick="fetchFeedbackType(<?php echo $data->feedback_type_id; ?>);"><i class = "fa fa-pencil"></i></button>
                                                                            <button class = "btn btn-danger btn-xs" data-toggle="modal" data-target="#exampleModal" onclick="updateDeleteID(<?php echo $data->string_key_id; ?>);">
                                                                                <i class = "fa fa-trash-o "></i>
                                                                            </button>
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
            <!--------------Modal detail------------------>
            <div class="modal" tabindex="-1" role="dialog" id="FeedbackTypeModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <div class="card-head">
                                            <header>Feedback Type</header>
                                        </div>
                                        <div class="card-body row">
                                            <div class="col-lg-4 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield">
                                                    <input class="mdl-textfield__input" type="text" id="feedbackTypeName" placeholder="Excellent">
                                                    <input class="mdl-textfield__input" type="hidden" id="feedbackTypeID" value="">
                                                    <label class="mdl-textfield__label" for="text1">Simple Text Field</label>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <?php
                                                if (!empty($imgData)) {
                                                    foreach ($imgData as $img) {
                                                        ?>
                                                        <img src="<?php echo base_url(); ?>assets/img/<?php echo $img; ?>" alt="Happy" style="width: 80px; height: 80px;margin:5px;"/>
                                                        <span>
                                                            <input type="radio" name="feebackImg" value="<?php echo $img; ?>" class="buttom"/>
                                                        </span>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div class="col-lg-4 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield">
                                                    <input class="mdl-textfield__input" type="text" id="feedbackTypeHeader" placeholder="What Like you best?">
                                                    <label class="mdl-textfield__label" for="text1">Simple Heading</label>
                                                </div>
                                            </div>
                                            <div class="card-body " id="bar-parent7">
                                                <div class="form-group">
                                                    <label class="control-label">Quick Questions:</label>
                                                    <input type="text" id="question" class="tags tags-input" data-type="fruits-tags"
                                                           data-highlight-color="#00C0EF" />
                                                </div>
                                            </div>
                                            <div class="col-lg-12 p-t-20">
                                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="feedbacksaveBtn" onclick="savefeedbackType();">
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
            <!-- ------------------------>
            <div class="modal" tabindex="-1" role="dialog" id="FeedbackTypeModalIpad">
                <div class="modal-dialog" role="document">
                    <div class="modal-content"  style="width:164%">
                        <!--<div class="modal-header">-->
                        <!--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
                        <!--<div class="row">-->
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-body row">
                                    <div class="tablet">
                                        <div class="content">
                                            <div>

                                                <div class="form-group row">
                                                    <?php
                                                    if (!empty($imgData)) {
                                                        foreach ($imgData as $img) {
                                                            ?>
                                                            <img src="<?php echo base_url(); ?>assets/img/<?php echo $img; ?>" alt="Happy" style="width: 80px; height: 80px;margin:17px;"/>
                                                            <span>
                                                                <input type="radio" name="feebackImg" value="<?php echo $img; ?>" class="buttom"/>
                                                            </span>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-lg-4 p-t-20">
                                                    <div class="mdl-textfield mdl-js-textfield">
                                                        <input class="mdl-textfield__input" type="text" id="feedbackTypeName" placeholder="Excellent">
                                                        <input class="mdl-textfield__input" type="hidden" id="feedbackTypeID" value="">
                                                        <label class="mdl-textfield__label" for="text1">Simple Text Field</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 p-t-20">
                                                    <div class="mdl-textfield mdl-js-textfield">
                                                        <input class="mdl-textfield__input" type="text" id="feedbackTypeHeader" placeholder="What Like you best?">
                                                        <label class="mdl-textfield__label" for="text1">Simple Heading</label>
                                                    </div>
                                                </div>
                                                <div class="card-body " id="bar-parent7">
                                                    <div class="form-group" style=" margin: -20px;">
                                                        <label class="control-label">Quick Questions:</label>
                                                        <input type="text" id="question" class="tags tags-input" data-type="fruits-tags"
                                                               data-highlight-color="#00C0EF" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 p-t-20">
                                                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="feedbacksaveBtn" onclick="savefeedbackType();">
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
                    <!--</div>-->
                    <!--</div>-->
                </div>
            </div>
        </div>
        <!-- ------------------------>
        <div class="modal" tabindex="-1" role="dialog" id="FeedbackConfigModal" >
            <div class="modal-dialog" role="document" >
                <div class="modal-content" >
                    <div class="modal-header" style="display:block">
                        <!-- <div class="modal fade" id="FeedbackConfigModalq" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <div class="card-head">
                                        <header>Config Detail</header>
                                    </div>
                                    <div class="card-body row" style="padding: 54px;">
                                        <div class = "form-group row">
                                            <?php
                                            if (!empty($error))
                                                echo "<div style=color:red>" . $error . "</div>";
                                            ?> 
                                            <?php if (!empty($logoData)) echo $logoData; ?> 
                                            <?php echo form_open_multipart('', 'id=addMedia'); ?>

                                            <div class="col-lg-8 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield">
                                                    <input class="mdl-textfield__input" type="text" id="header_text" name="header_text" placeholder="Good Morning">
                                                    <input class="mdl-textfield__input" type="hidden" id="configID">
                                                    <label class="mdl-textfield__label" for="text1">Simple Heading</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield">
                                                    <input class="mdl-textfield__input" type="text" id="sub_header_text" name="sub_header_text" placeholder="Single Line comment">
                                                    <label class="mdl-textfield__label" for="text1">Simple Heading</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-8 p-t-20">
                                                <span>
                                                    <?php echo "<input type='file' name='userfile' size='20' />"; ?>
                                                    <?php echo "<input type='button'class='btn btn-success' onclick='saveConfigData();' name='submit' value='Save' style='margin-top:44px;' /> "; ?>
                                                </span>
                                            </div>
                                            <?php echo "</form>" ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
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
                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Delete Feedback Type</h5>
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
    function savefeedbackType() {
        var feedBackTypeImage = $("input[name='feebackImg']:checked").val();
        var feedBackTypeName = $.trim($('#feedbackTypeName').val());
        if (typeof (feedBackTypeImage) == 'undefined') {
            error_message('Please select any image');
            return false;
        }
        if (feedBackTypeName == "") {
            error_message('Please enter the feedback type');
            return false;
        }
        var url = ($('#feedbackTypeID').val() == '') ? 'feedback/addfeedbckType' :
                'feedback/updatefeedbckType';

        // declare json object
        postedData = {};
        postedData['feedback_type_name'] = feedBackTypeName;
        postedData['feedback_type_image'] = feedBackTypeImage;
        postedData['lang'] = 'en';
        if ($('#feedbackTypeHeader').val() !== '') {
            postedData['feedback_type_header'] = $('#feedbackTypeHeader').val();
        }

        /***********************************************************/
        var id = $('.tags-input').attr('id');
        var feedBackQuestion = '';
        feedBackQuestion = $('#' + id).val();
        if (typeof (allQuestion) != 'undefined') {
            var firstData = allQuestion.split(",");
            console.log('allQuestion is ===', allQuestion);
        }
        if (typeof (feedBackQuestion) != 'undefined') {
            var secondData = feedBackQuestion.split(",");
            console.log('feedBackQuestion is =====', feedBackQuestion);
        }
        if (typeof (firstData) != 'undefined' && typeof (secondData) != 'undefined') {
            var newData = arrDifference(firstData, secondData);
            postedData['feedback_questions'] = newData.toString();
        } else {
            postedData['feedback_questions'] = feedBackQuestion;
        }

        /***********************************************************/
        if ($('#feedbackTypeID').val() !== '') {
            postedData['feedback_type_id'] = $('#feedbackTypeID').val();
            var srtId = $('#' + $('#feedbackTypeID').val()).attr('type_string_id');
            console.log('srtId=======', srtId);
            postedData['string_key_id'] = srtId;
        }
        $.ajax({
            url: $ajaxURLPart + url,
            method: "POST",
            data: postedData,
            beforeSend: function () {
                $("#feedbacksaveBtn").attr("disabled", "disabled");
            }, complete: function () {
//                $('#' + $saveBtn).button('reset');
                //$('#ImgModal').modal('hide');
            }, success: function (response) {
                console.log('response data is =', response);
                console.log('after success statusis ==', response.status);
                let res = JSON.parse(response);
                if (res.status) {
//                    $('#my-toast-location').toastee('Feedback type updated successfully', 'success');
                    success_message('Feedback type updated successfully');
                    $("#feedbacksaveBtn").attr("disabled", false);
                    setTimeout(function () {
                        location.reload();
                    }, 1000);

                } else {
                    console.log('error in adding the conter');
                }
            }, error: function () {
                $("#feedbacksaveBtn").attr("disabled", false);
                // error/exception handling
                ajaxErrorHandling(jqXHR);
            }
        });
    }
    function deleteCounter() {
        postedData = {};
        postedData['feedback_type_id'] = $deleteId;
        $.ajax({
            url: $ajaxURLPart + 'feedback/deletefeedbckType/',
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
//                    $('#my-toast-location').toastee('Feedback type deleted successfully', 'success');
                    success_message('Feedback type deleted successfully');
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
    function fetchFeedbackType(id) {
        postedData = {};
        postedData['feedback_type_id'] = id;
        var srtId = $('#' + id).attr('type_string_id');
        console.log('srtId=======', srtId);
        $.ajax({
            url: $ajaxURLPart + 'feedback/fetchFeedbackType/',
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
                    console.log('fetched recoed ==========', res.data);
                    console.log(res.data.counter_name);
                    $('#feedbackTypeName').val(res.data.feedback_type_name);
                    $('#feedbackTypeID').val(res.data.feedback_type_id);
                    $('#feedbackTypeHeader').val(res.data.feedback_type_header);
                    $('#FeedbackTypeModalIpad').find(':radio[name=feebackImg][value="' + res.data.feedback_type_image + '"]').prop('checked', true);
                } else {
                    console.log('error in adding the conter');
                }
            }, error: function () {
                $('#' + $saveBtn).button('reset');
                // error/exception handling
                ajaxErrorHandling(jqXHR);
            }
        });
        getQuestionData(srtId);
    }
    function getQuestionData(typeName) {
        console.log('get question di ===', typeName);
        postedData = {};
        postedData['feedback_type_id'] = typeName;
        $.ajax({
            url: $ajaxURLPart + 'feedback/getfeedbckQuestion',
            method: "POST",
            data: postedData,
            beforeSend: function () {
                // $('#' + $saveBtn).button('loading');
            }, complete: function () {
            }, success: function (response) {
                console.log('response data is =', response);
                let res = JSON.parse(response);
                if (res.status) {
                    var ques = res.data[0].feed_back_question;
                    allQuestion = ques.map(getAllQuestion);
                    allQuestion = allQuestion.toString();
                    console.log('allQuestion is here===', allQuestion);
                    var id = $('.tags-input').attr('id');
                    $('#' + id).val('');
                    $('#' + id).val(allQuestion);
                    initializeInputType();
//                        $('#question_tagsinput').hide();
                } else {
                    var id = $('.tags-input').attr('id');
                    console.log('error in adding the conter');
                    $('#' + id).val('');
                }
            }, error: function () {
                $('.tags-input').attr('id').val('');
                //                $('#' + $saveBtn).button('reset');
                // error/exception handling
                ajaxErrorHandling(jqXHR);
            }
        });
    }
    function getAllQuestion(item) {
        var fullquestion = [item.value].join(" ");
        return fullquestion;
    }
    function initializeInputType() {
        var id = $('.tags-input').attr('id');
        console.log('aaaaaaaaaaaaaaaaa===', id);
        var slen = $("input").siblings().length;
        console.log('bbbbbbbbbbbbbbbbbb===', slen);
        $('.tags-input').tagsInput({
            width: 'auto'
        });
        if (slen > 2) {
            console.log('slen id ====', slen);
            removeID = $('.tags-input').closest('div').find('div').next().prop('id');
            console.log('removeID id is ===', removeID);
            $('#' + removeID).remove();
        }
        $('#question_tagsinput').hide();
    }

    function arrDifference(arr1, arr2) {
        var arr = [];
        arr1 = arr1.toString().split(',').map(String);
        arr2 = arr2.toString().split(',').map(String);
        for (var i in arr1) {
            if (arr2.indexOf(arr1[i]) === -1)
                arr.push(arr1[i]);
        }
        for (i in arr2) {
            if (arr1.indexOf(arr2[i]) === -1)
                arr.push(arr2[i]);
        }
        return arr.sort((x, y) => x - y);
    }

    function saveConfigData() {
        $('#upperLoaderBar').css('display', 'block');
        var configId = $('#configID').val();
        console.log('configId is =====', configId);
        var postedData = new FormData($('#addMedia')[0]);
        if (configId != '') {
            postedData.append('third_party_config_id', $('#configID').val());
        }
        console.log('postedData is ====', postedData);
        $.ajax({
            url: $ajaxURLPart + 'feedback/do_upload/',
            method: "POST",
            dataType: "JSON",
            data: postedData,
            contentType: false,
            processData: false,
            beforeSend: function () {
            }, complete: function () {
            }, success: function (response) {
                $('#upperLoaderBar').css('display', 'none');
                if (response.status) {
                    success_message(response.data);
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    error_message(response.error);
                }
                console.log('called............123');

            }, error: function () {
                $('#upperLoaderBar').css('display', 'none');
                $('#my-toast-location').toastee('Sonething get error please try after some time', 'error');
            }
        });
    }
    function FetchConfigData() {
        postedData = {};
        postedData['third_party_config_id'] = 1;
        $.ajax({
            url: $ajaxURLPart + 'feedback/getThirdPartyCofig',
            method: "POST",
            data: postedData,
            beforeSend: function () {
                // $('#' + $saveBtn).button('loading');
            }, complete: function () {
            }, success: function (response) {
                console.log('response data is =', response);
                let res = JSON.parse(response);
                if (res.status) {

                    for (var i = 0; i < res.data.length; i++) {
                        if (res.data[i]['config_type'] == 'header_text')
                            var headerTest = res.data[i]['string_name'];
                        if (res.data[i]['config_type'] == 'sub_header_text')
                            var subHeaderTest = res.data[i]['string_name'];
                        $('#header_text').val(headerTest);
                        $('#sub_header_text').val(subHeaderTest);
                        console.log('headerTest====', headerTest);
                    }

                } else {
                    var id = $('.tags-input').attr('id');
                    console.log('error in adding the conter');
                    $('#' + id).val('');
                }
            }, error: function () {
                $('.tags-input').attr('id').val('');
                //                $('#' + $saveBtn).button('reset');
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
    function info_message($msg) {
        console.log('info message function is called');
        $.toast({
            heading: 'Information',
            text: $msg,
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'success',
            hideAfter: 35000,
            stack: 6
        });
    }
    $(window).on('load', function () {
        feedbackLength = "<?php echo (!empty($feedbackCount)) ? $feedbackCount : 0; ?>";
        if (feedbackLength >= 5) {
            info_message('Max limit of 5 You have reached,Please delete any feedback type to add new one');
            $("#addFeedbackType").attr("disabled", "disabled");
        }
    });
    /*****************************************************************************/
//                                setInterval(isLogin(), 3000);
    $(document).ready(function () {
        console.log("document loaded");
        setInterval(function () {
            isLogin();
        }, 10000);
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