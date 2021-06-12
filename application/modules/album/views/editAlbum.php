<?php
if (!empty($albumData)) {
    $albumData = json_decode($albumData);
    if (!empty($albumData->data)) {
        $allAlbum = $albumData->data;
    }
}
?>
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
                        <div class="page-title">Edit Media</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url() . 'token'; ?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="">Album Detail</a>&nbsp;<i class="fa fa-angle-right"></i>
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
                                            <div class="table-scrollable">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                       id="example4">
                                                    <thead>
                                                        <tr>
                                                            <!--<th></th>-->
                                                            <th>Album Name </th>
                                                            <th> Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (!empty($allAlbum)) {
                                                            foreach ($allAlbum as $data) {
                                                                ?>
                                                                <tr class = "odd gradeX">
                                                                    <!--<td>#</td>-->
                                                                    <td class = "left"> <?php echo $data->album_name; ?></td> 
                                                                    <td>
                                                                        <a href="<?php echo base_url() . "album/albumAdmin/" . $data->album_id; ?>" class="btn btn-primary btn-xs"><i class = "fa fa-pencil"></i></a>
                                                                        <!--<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#counterModal" onclick="fetchCounterData(<?php echo $data->album_id; ?>);"><i class = "fa fa-pencil"></i></button>-->
                                                                        <button class = "btn btn-danger btn-xs" data-toggle="modal" data-target="#exampleModal" onclick="updateDeleteID(<?php echo $data->album_id; ?>);">
                                                                            <i class = "fa fa-trash-o "></i>
                                                                        </button>

                                                                    </td>
                                                                </tr>
                                                                <?php
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
    </div>
    <script>


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
        $(document).ready(function () {
            $("#saveBtn").click(function (e) {
                e.preventDefault();
                myDropzone.processQueue();
            });

            myDropzone.on('sending', function (file, xhr, formData) {
                formData.append('someParameter[userName]', 'bob');
            });
        })
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
