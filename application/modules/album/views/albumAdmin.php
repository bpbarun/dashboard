<?php // print_r($albumData); die;   ?>
<style type="text/css">
    div.guide {margin:12px 24px;}
    div.guide span {color:#ff0000; font:italic 14px Arial, Helvetica, sans-serif;}
    div.guide p {color:#000000; font:14px Arial, Helvetica, sans-serif;}
    div.guide pre {color:#990000;}
    div.guide p.title {color:#df501f; font:18px Arial, Helvetica, sans-serif;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

</script>
<div class="page-container">
    <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Add Media</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url() . 'token'; ?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="<?php echo base_url() . 'album/editAlbumView'; ?>">Edit Album</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Album List</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line">
                        <div class="tab-content">
                            <div class="tab-pane active fontawesome-demo" id="tab1">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-box">
                                            <div class="card-head">
                                                <header>Basic Information</header>
                                                <button id="panel-button" class="mdl-button mdl-js-button mdl-button--icon pull-right" data-upgraded=",MaterialButton">
                                                    <i class="material-icons">more_vert</i>
                                                </button>
                                                <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" data-mdl-for="panel-button">
                                                    <li class="mdl-menu__item"><i class="material-icons">assistant_photo</i>Action</li>
                                                    <li class="mdl-menu__item"><i class="material-icons">print</i>Another action</li>
                                                    <li class="mdl-menu__item"><i class="material-icons">favorite</i>Something else here</li>
                                                </ul>
                                            </div>
                                            <form action="javascript: void(0)" name="albumForm" id="albumForm" autocomplete="off" method="post" enctype="multipart/form-data"> 
                                                <div class="card-body row">
                                                    <div class="col-lg-6 p-t-20">
                                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                            <input class="mdl-textfield__input" type="text" id="albumCategoryName" name= "albumCategoryName" >
                                                            <label class="mdl-textfield__label">Category Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 p-t-20">
                                                        <label class="control-label col-md-3">Upload Photo
                                                        </label>
                                                        <div class="col-md-12">
                                                            <div id="id_dropzone" class="dropzone"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 p-t-20 text-center">
                                                        <button type="button" id="saveBtn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink" onclick="saveMediaData()">Submit</button>
                                                        <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default">Cancel</button>
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
    <script>
//        $(document).ready(function () {
//            var mockFile = {name: "1564403239-Digitel_Signage-3.jpg", size: 750605};
//            myDropzone.options.addedfile.call(myDropzone, mockFile);
//// And to show the thumbnail of the file:
//            myDropzone.options.thumbnail.call(myDropzone, mockFile, "/uploads/images/1");
//        })
        function saveMediaData() {
            console.log('called.........');
            var albumName = $('#albumCategoryName').val();
            postedData = {};
            postedData['album_name'] = albumName;
            $.ajax({
                url: "<?php echo base_url() ?>album/addAlbum/",
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
//                        location.reload();
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
//        $(document).ready(function () {
//            $("#saveBtn").click(function (e) {
//                e.preventDefault();
//                myDropzone.processQueue();
//            });
//
//            myDropzone.on('sending', function (file, xhr, formData) {
//                formData.append('someParameter[userName]', 'bob');
//            });
//        })
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
    </script>
    <!-- end page container -->
