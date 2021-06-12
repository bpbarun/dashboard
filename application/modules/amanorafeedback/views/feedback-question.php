<?php
if (!empty($feedbackType)) {
    $types = json_decode($feedbackType);
    if (!empty($types->data)) {
        $feedbackTypeData = $types->data;
    }
}
?>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/html5gallery/html5gallery.js"></script>-->
<style type="text/css">
    div.guide {margin:12px 24px;}
    div.guide span {color:#ff0000; font:italic 14px Arial, Helvetica, sans-serif;}
    div.guide p {color:#000000; font:14px Arial, Helvetica, sans-serif;}
    div.guide pre {color:#990000;}
    div.guide p.title {color:#df501f; font:18px Arial, Helvetica, sans-serif;}
    input[type="file"] {
        display: none;
    }
    .custom-file-upload {
        /*border: 1px solid #ccc;*/
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
        #question {
            width: 380px;
            padding: 10px;
        }
    }
</style>
<!--tagsinput-->
<link href="<?php echo base_url() ?>assets/plugins/jquery-tags-input/jquery-tags-input.css" rel="stylesheet">
<body>
<!--    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/materialize/js/materialize.min.js"></script>-->
    <!--JavaScript at end of body for optimized loading-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <div class="page-container">
        <!-- start page content -->
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-bar">
                    <div class="page-title-breadcrumb">
                        <!--                    <div class=" pull-left">
                                                                        <div class="page-title">Album List <?php
                        if (!empty($albumResult['album_name'])) {
                            echo "<b>" . $albumResult['album_name'] . "</b>";
                        }
                        ?>
                                                                        </div>
                                            </div>-->
                        <ol class="breadcrumb page-breadcrumb pull-right">
                            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url() . 'token'; ?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                            </li>
                            <li><a class="parent-item" href="">Feedback Detail</a>&nbsp;<i class="fa fa-angle-right"></i>
                            </li>
                            <li class="active">Feedback List</li>
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
                                                <div class="card-body ">
                                                    <form class="form-horizontal" onsubmit="return false;">
                                                        <div class="col-lg-12 col-md-12" id="counterDisplay" style="display: block">
                                                            <select class="form-control  select2" id="feedbackType" onchange="getQuestionData(this.value);">
                                                                <option value="">Select Feedback Type</option>
                                                                <?php
                                                                if (!empty($feedbackTypeData)) {
                                                                    foreach ($feedbackTypeData as $data) {
                                                                        ?>
                                                                        <option value="<?php echo $data->feedback_type_id; ?>"><?php echo $data->feedback_type_name; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="card-body " id="bar-parent7">
                                                            <div class="form-group">
                                                                <label class="control-label">Question:</label>
                                                                <input type="text" id="question" class="tags tags-input" data-type="fruits-tags"
                                                                       data-highlight-color="#00C0EF" />
                                                            </div>
                                                        </div>
                                                        <!------------------------>
                                                        <div class="col-lg-12 p-t-20">
                                                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="savefeedbackQuestion();">
                                                                Save Feedback
                                                            </button>
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
    <script>
        var $ajaxURLPart = "<?php echo base_url(); ?>";
        function savefeedbackQuestion() {
            // declare json object
            postedData = {};
            console.log('called...........');
            console.log('ajaxURLPart is ===' + $ajaxURLPart);
            var feedBackType = $("#feedbackType").val();
            var id = $('.tags-input').attr('id');
            var feedBackQuestion = $('#' + id).val();
            console.log('typsss', typeof (allQuestion));
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

            if (feedBackType == "") {
                $('#my-toast-location').toastee('Please select feedback type', 'error');
                return false;
            }
            if (feedBackQuestion == "") {
                $('#my-toast-location').toastee('Please enter question', 'error');
                return false;
            }

            postedData['feedback_type_id'] = feedBackType;

            $.ajax({
                url: $ajaxURLPart + 'feedback/addfeedbckQuestion',
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
                        $('#my-toast-location').toastee('Feedback question added successfully', 'success');
                        setTimeout(function () {
                            location.reload();
                        }, 1000);

                    } else {
                        console.log('error in adding the conter');
                    }
                }, error: function () {
                    //                $('#' + $saveBtn).button('reset');
                    // error/exception handling
                    ajaxErrorHandling(jqXHR);
                }
            });
        }
        function getQuestionData(typeName) {
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
                        console.log('allQuestion is here===', allQuestion.toString());
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
//            console.log('item===', item.value);
            var fullquestion = [item.value].join(" ");
            return fullquestion;
        }
        function initializeInputType() {
            var id = $('.tags-input').attr('id');
//            var a = $('#' + id).val();
            var slen = $("input").siblings().length;
//            var ids = $("input").siblings("div").prop("id");
            $('input').tagsInput({
                width: 'auto'
            });
            if (slen > 2) {
                removeID = $('input').closest('div').find('div').next().prop('id');
                $('#' + removeID).remove();
            }
            $('#question_tagsinput').hide();
        }


        function arrDifference(arr1, arr2) {
            var arr = [];
            arr1 = arr1.toString().split(',').map(String);
            arr2 = arr2.toString().split(',').map(String);
            // for array1
            for (var i in arr1) {
                if (arr2.indexOf(arr1[i]) === -1)
                    arr.push(arr1[i]);
            }
            // for array2
            for (i in arr2) {
                if (arr1.indexOf(arr2[i]) === -1)
                    arr.push(arr2[i]);
            }
            console.log('fdff')
            return arr.sort((x, y) => x - y);
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
    <!-- end page container -->
