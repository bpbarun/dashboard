<div class="page-container">
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Welcome to Dfort</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-6">
                            <!--                            <div class="btn-group">
                                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#throughtModal">Add Throught<i class="fa fa-plus"></i></button>
                                                        </div>-->
                        </div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="">Forms</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Form Editable</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                        <input class="mdl-textfield__input" type="text" id="blogTitle">
                        <label class="mdl-textfield__label" for="text4">Blog Title</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <textarea name="formsummernote" id="summernote" cols="30" rows="30">
                        <div class="alert alert-success">
                            <strong>Well done!</strong> Blog description.
                        </div>
                    </textarea>
                </div>
            </div>

            <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-success" onclick="saveData()" style="float: right">Save</button>
            <div class="modal" tabindex="-1" role="dialog" id="throughtModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <div class="card-head">
                                            <header>Throught Form</header>
                                        </div>
                                        <div class="card-body row">
                                            <div class="col-lg-6 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield">
                                                    <input class="mdl-textfield__input" type="text" id="throughtName" placeholder="Enter today throught">
                                                    <input class="mdl-textfield__input" type="hidden" id="throughtId" value="">
                                                    <label class="mdl-textfield__label" for="text1">Today Throught</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 p-t-20">
                                                <button id="saveBtn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="saveThrought();">
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
        </div>  
    </div>
    <!-- end page container -->
    <script>
        function saveData()
        {
            console.log('onclick is called')
            var title = $('#blogTitle').val();
            var description = $('#summernote').val();
            if (title == '') {
                error_message('Please enter the title');
                return false;
            }
            if (description == '') {
                error_message('Please enter the blog body');
                return false;
            }
            var $ajaxURLPart = "<?php echo base_url(); ?>";
            postedData = {};
            postedData['title'] = title;
            postedData['description'] = description;
            postedData['is_active'] = 1;
            $.ajax({
                url: $ajaxURLPart + 'dfort/addData/',
                method: "POST",
                data: postedData,
                beforeSend: function () {
                    // $('#' + $saveBtn).button('loading');
                }, complete: function () {
                    //$('#' + $saveBtn).button('reset');
                    //$('#ImgModal').modal('hide');
                }, success: function (response) {
                    let res = JSON.parse(response);
                    if (res.status) {
                        success_message('Data inserted successfully.');
                        setTimeout(function () {
                            location.reload();
                        }, 1000);

                    } else {
                        success_message('Data inserted with some error');
                    }
                }, error: function () {
                    error_message('There are something error please try sometime later');
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
                hideAfter: 3500,
                stack: 6
            });
        }
    </script>