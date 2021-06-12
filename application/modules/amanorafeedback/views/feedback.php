<?php
if (!empty($feedbackConfigData)) {
    $feedbackAllConfig = json_decode($feedbackConfigData);
    if (!empty($feedbackAllConfig->data)) {
        $configData = $feedbackAllConfig->data;
    }
}
$imgData = array();
if (!empty($configData)) {
    foreach ($configData as $imageData) {
        $imgData = explode(",", $imageData->config_value);
    }
}

//print_r($imgData); die;
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
    }
</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<div class="page-container">
    <!-- start page content -->

    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="window.location.href = '<?php echo base_url() ?>feedback/allFeedback'">
                    ALl Feedback
                </button>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="window.location.href = '<?php echo base_url() ?>feedback/allFeedbackType'">
                    ALl Feedback Type
                </button>
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Add New Feedback Type</div>
                    </div>
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
                                                    <div class="form-group row">
                                                        <div class="col-lg-12 col-md-12">
                                                            <input class="form-control" type="text"  id="feedbackTypeName" placeholder="Enter feedback type">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <?php
                                                        if (!empty($imgData)) {
                                                            foreach ($imgData as $img) {
                                                                ?>
                                                                <img src="<?php echo base_url(); ?>assets/img/<?php echo $img; ?>" alt="Happy" style="width: 80px; height: 80px;"/>
                                                                <span>
                                                                    <input type="radio" name="feebackImg" value="<?php echo $img; ?>" class="buttom"/>
                                                                </span>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="col-lg-12 p-t-20">
                                                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="savefeedbackType();">
                                                            Save Feedback type
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
    <script>


        var $ajaxURLPart = "<?php echo base_url(); ?>";
        function savefeedbackType() {
            console.log('called...........');
            console.log('ajaxURLPart is ===' + $ajaxURLPart);
            var feedBackTypeImage = $("input[name='feebackImg']:checked").val();
            var feedBackTypeName = $.trim($('#feedbackTypeName').val());
            console.log('feedBackTypeName is =====', feedBackTypeName);
            console.log('feedBackTypeImage is =====', typeof (feedBackTypeImage));
            if (typeof (feedBackTypeImage) == 'undefined') {
                $('#my-toast-location').toastee('Please select any image', 'error');
                return false;
            }
            if (feedBackTypeName == "") {
                $('#my-toast-location').toastee('Please enter the feedback type', 'error');
                return false;
            }
            // declare json object
            postedData = {};
            postedData['feedback_type_name'] = feedBackTypeName;
            postedData['feedback_type_image'] = feedBackTypeImage;
            $.ajax({
                url: $ajaxURLPart + 'feedback/addfeedbckType',
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
                        $('#my-toast-location').toastee('Feedback type added successfully', 'success');
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
