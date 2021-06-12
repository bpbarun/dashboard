<?php
$tokenData = json_decode($tokenData);
if (!empty($tokenData->data)) {
    $token = $tokenData->data;
}
?>
<div class="page-container">
    <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Token List</div>
                    </div>

                    <div class="page-title btn-group pull-right">
                        <a href="<?php echo base_url() . 'display/token/' ?>" id="addRow" class="btn btn-info">Running Token Screen</a>
                    </div>
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
                                                <header>All Token</header>
                                            </div>
                                            <div class="card-body ">
                                                <div class="col-12">
                                                        <div class="btn-group">
                                                            <a href="<?php echo base_url() . 'token/addNewToken' ?>" id="addRow" class="btn btn-info">Print Token <i class="fa fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                                <div class="table-scrollable">
                                                    <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                           id="example4">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th> Token ID </th>
                                                                <th> Counter </th>
                                                                <th> Sub Counter </th>
                                                                <th> Status </th>
                                                                <th> Action </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if (!empty($token)) {
                                                                $sno = 1;
                                                                foreach ($token as $data) {
                                                                    if ($data->is_active == 1) {
                                                                        $status = 'Pending';
                                                                    } else if ($data->is_active == 2) {
                                                                        $status = 'Running';
                                                                    } else if ($data->is_active == 3) {
                                                                        $status = 'Skip';
                                                                    } else {
                                                                        $status = 'Done';
                                                                    }
                                                                    ?>
                                                                    <tr class="odd gradeX">
                                                                        <td class="patient-img">
                                                                            <?php echo $sno; ?>
                                                                        </td>
                                                                        <td><?php echo $data->token_display_name; ?></td>
                                                                        <td><?php echo $data->counter_name; ?></td>
                                                                        <td class="left"><?php echo $data->subcounter_name; ?></td>
                                                                        <td class="left"><?php echo $status; ?></td>
                                                                        <td>
                                                                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#exampleModal" onclick="updateDeleteID(<?php echo $data->token_id; ?>);">
                                                                                <img src="<?php echo base_url(); ?>assets/img/delete.png" class="fa fa-arrow-left" style="color: blcck; margin: 5px; width: 12px" aria-hidden="true">
                                                                            </button>
                                                                        </td>
                                                                    </tr> 
                                                                    <?php
                                                                    $sno ++;
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
                            <h5 class="modal-title" id="exampleModalLabel" style="color:black">Delete Token</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="deleteToken()">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--Modal: modalConfirmDelete-->
            <!--------------Modal detail------------------>

            <!--------------Modal detail------------------>
        </div>
    </div>
</div>
<!-- end page container -->
<script>
    var $ajaxURLPart = "<?php echo base_url(); ?>";
    function updateDeleteID(id) {
        $deleteId = id;
    }
    function deleteToken() {
        postedData = {};
        postedData['token_id'] = $deleteId;
        $.ajax({
            url: $ajaxURLPart + 'token/deleteToken/',
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
                    success_message('Record deleted successfully');
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    console.log('error in deleteing the token');
                    console.log('res.error', res.error)
                    if (res.error == 'Invalid Authentication') {
                        logout();
                    }
                }
            }, error: function () {
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
</script>
