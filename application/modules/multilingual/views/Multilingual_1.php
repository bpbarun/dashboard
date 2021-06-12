<div class="page-container">
    <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Multilingual List</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url() . 'feedback/'; ?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="">Multilingual Detail</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Multilingual List</li>
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
                                            <div class="card-head">
                                                <div class="tools">
                                                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h2>Multilingual</h2>
                                                <div class="like_button_container" data-commentid="1" id="root"></div>
                                                <div id="like_button_container"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal" tabindex="-1" role="dialog" id="counterModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <div class="card-head">
                                            <header>Counter Form</header>
                                        </div>
                                        <div class="card-body row">
                                            <div class="col-lg-4 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield">
                                                    <input class="mdl-textfield__input" type="text" id="counterName" placeholder="Enter the counter name">
                                                    <input class="mdl-textfield__input" type="hidden" id="counterID" value="">
                                                    <!--<label class="mdl-textfield__label" for="text1">Simple Text Field</label>-->
                                                </div>
                                            </div>
                                            <div class="col-lg-8 p-t-20">
                                            </div>
                                            <div class="col-lg-12 p-t-20">
                                                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="counterStatus">
                                                    <input type="checkbox" id="counterStatus" name="counterStatus" class="mdl-switch__input" checked>
                                                    <span class="mdl-switch__label">Active/Inactive</span>
                                                </label>
                                            </div>
                                            <div class="col-lg-12 p-t-20">
                                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="saveCounter();">
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
            <!--Modal: modalConfirmDelete-->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel" style="color:black">Delete Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary" onclick="deletemultilingialData()">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<!-- Load React. -->
<script src="http://192.168.0.42:3000/static/js/bundle.js"></script>
<script src="http://192.168.0.42:3000/static/js/main.chunk.js"></script>
<script src="http://192.168.0.42:3000/static/js/0.chunk.js"></script>
<script src="http://192.168.0.42:3000/assets/axios.min.js"></script>
<!--<script src="https://unpkg.com/axios/dist/axios.min.js"></script>-->