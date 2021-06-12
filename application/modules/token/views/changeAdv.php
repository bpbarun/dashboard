<?php
if (!empty($activeMedia)) {
    $activeMedia = json_decode($activeMedia);
    if (!empty($activeMedia->data)) {
        $activeMediaData = $activeMedia->data;
    }
}
?>
<div class = "page-container">
    <!--start page content -->
    <div class = "page-content-wrapper">
        <div class = "page-content">
            <div class = "row">
                <div class = "col-md-12">
                    <div class = "tabbable-line">
                        <div class = "tab-content">
                            <div style = "text-align: center">
                                <div style = "text-align: center">
                                    <div class = "form-group row">
                                        <span>
                                            <?php
                                            if (!empty($error))
                                                echo "<div style=color:red>" . $error . "</div>";
                                            ?> 
                                            <?php if (!empty($data)) echo $data; ?> 
                                            <?php echo form_open_multipart('', 'id=addMedia'); ?>
                                            <?php echo "<input type='file' name='userfile' size='20' />"; ?>
                                            <?php echo "<input type='button'class='btn btn-success' onclick='saveData();' name='submit' value='upload' /> "; ?>
                                        </span>
                                        <div class="col-lg-2 p-t-20">
                                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
                                                <input type="radio" id="option-1" class="mdl-radio__button" name="config_type" value="image">
                                                <span class="mdl-radio__label">Image</span>
                                            </label>
                                        </div>
                                        <div class="col-lg-2 p-t-20">
                                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
                                                <input type="radio" id="option-2" class="mdl-radio__button" name="config_type" value="video">
                                                <span class="mdl-radio__label">Video</span>
                                            </label>
                                        </div>
                                        <?php echo "</form>" ?>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane active fontawesome-demo" id="tab1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-box">
                                            <div class="card-head" style="text-align: right">
                                                <?php echo "<h2>" . date("Y-m-d, h:i A") . "</h2>"; ?>
                                            </div>
                                            <div class="card-head">
                                                <header>Preview Screen</header>
                                            </div>
                                            <div class="card-body ">
                                                <div class="row"> 
                                                    <div class="col-sm-8">
                                                        <div class="table-scrollable">
                                                            <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle tokenScreen-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th> Token </th>
                                                                        <th> Counter </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="viewSreen">

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4" id="previewAdv">
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
<!-- end page container -->
<script>
    var $ajaxURLPart = "<?php echo base_url(); ?>";
    var $activeMediaData = <?php echo json_encode($activeMediaData); ?>;
    console.log($activeMediaData[0]['config_value']);
    var html = '';
    window.onload = function () {
        $('input[name="config_type"]').on("click", function (e) {
            /**************************/
            var html = '';
            var activeVal = $(this).val();
            console.log('activeVal is ===', activeVal);
            if (activeVal == 'image') {
                html += '<img src="' + $ajaxURLPart + 'uploads/' + $activeMediaData[1]['config_value'] + '" class="tokenScreen-adv" width="500" height="500">';
            } else {
                html += '<video class="tokenScreen-adv" width="500" height="500" controls autoplay loop>';
                html += '<source src = "' + $ajaxURLPart + 'uploads/' + $activeMediaData[0]['config_value'] + '" type = "video/mp4">';
                html += '</video>';
            }

            $('#previewAdv').html(html);
        });
    }
    function saveData() {
        if ($('input[name=config_type]:checked').length == 0) {
            $('#my-toast-location').toastee('Please select a media type', 'error');
            return false;
        }
        $('#upperLoaderBar').css('display', 'block');
        var postedData = new FormData($('#addMedia')[0]);
        $.ajax({
            url: $ajaxURLPart + 'token/do_upload/',
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
                    $('#my-toast-location').toastee(response.data, 'success');
                    setTimeout(function () {
                        location.reload();
                    }, 1000);

                } else {
                    $('#my-toast-location').toastee(response.error, 'error');
                }
                console.log('called............123');

            }, error: function () {
                $('#upperLoaderBar').css('display', 'none');
                $('#my-toast-location').toastee('Sonething get error please try after some time', 'error');
            }
        });
    }
</script>