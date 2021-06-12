<style>
    .vl {
        border-left: 6px solid green;
        height: 50px;
        margin: 19px;
    }
</style>
<?php
$eventDatas = json_decode($eventData);
if (!empty($eventDatas->data)) {
    $event = $eventDatas->data;
}
?>
<?php
/*if (!empty($eventData)) {
    $allCounters = json_decode($eventData);
    $allCounters = (!empty($allCounters->data)) ? $allCounters->data : [];
    $html = '';
    $newArray = array();
    $arrayKey = array();
    if (!empty($allCounters)) {
        for ($i = 0; $i < COUNT($allCounters); $i++) {

            if (!empty($arrayKey)) {
                if (in_array($allCounters[$i]->counter_id, $arrayKey)) {
//                    echo $allCounters[$i]->counter_name; die;
                    $newArray[$allCounters[$i]->counter_name][$i]['room_no'] = $allCounters[$i]->room_no;
                    $newArray[$allCounters[$i]->counter_name][$i]['name'] = $allCounters[$i]->subcounter_name;
                    $newArray[$allCounters[$i]->counter_name][$i]['id'] = $allCounters[$i]->subcounter_id;
                    $newArray[$allCounters[$i]->counter_name][$i]['running'] = (!empty($allCounters[$i]->running)) ? $allCounters[$i]->running : '00';
                    $newArray[$allCounters[$i]->counter_name][$i]['pending'] = (!empty($allCounters[$i]->pending)) ? $allCounters[$i]->pending : '00';
                } else {
                    $newArray[$allCounters[$i]->counter_name][$i]['room_no'] = $allCounters[$i]->room_no;
                    $newArray[$allCounters[$i]->counter_name][$i]['name'] = $allCounters[$i]->subcounter_name;
                    $newArray[$allCounters[$i]->counter_name][$i]['id'] = $allCounters[$i]->subcounter_id;
                    $newArray[$allCounters[$i]->counter_name][$i]['running'] = (!empty($allCounters[$i]->running)) ? $allCounters[$i]->running : '00';
                    $newArray[$allCounters[$i]->counter_name][$i]['pending'] = (!empty($allCounters[$i]->pending)) ? $allCounters[$i]->pending : '00';
                }
            } else {
                $newArray[$allCounters[$i]->counter_name][$i]['room_no'] = $allCounters[$i]->room_no;
                $newArray[$allCounters[$i]->counter_name][$i]['name'] = $allCounters[$i]->subcounter_name;
                $newArray[$allCounters[$i]->counter_name][$i]['id'] = $allCounters[$i]->subcounter_id;
                $newArray[$allCounters[$i]->counter_name][$i]['running'] = (!empty($allCounters[$i]->running)) ? $allCounters[$i]->running : '00';
                $newArray[$allCounters[$i]->counter_name][$i]['pending'] = (!empty($allCounters[$i]->pending)) ? $allCounters[$i]->pending : '00';
            }
            array_push($arrayKey, $allCounters[$i]->counter_id);
        }
    }
}
\*
/* * ************************************************** */
?>
<div class="page-container">
    <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <!--<div class="page-title">Get Token</div>-->
                    </div>
                    <!--  <ol class="breadcrumb page-breadcrumb pull-right">
                                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                    </li>
                                    <li><a class="parent-item" href="">Professors</a>&nbsp;<i class="fa fa-angle-right"></i>
                                    </li>
                                    <li class="active">Get Token</li>
                                </ol>-->
                </div>
            </div>
            <div class="tab-pane" id="tab2">
               <div class = "row">
                <?php foreach($event as $eData) { ?>   
                      <div class = "col-md-3">
                                <div class = "card card-box">
                                    <div class = "card-body no-padding ">
                                        <div class = "doctor-profile">
                                            <img src = "<?php echo base_url(); ?>assets/img/bg-011.jpg" class = "doctor-pic" alt = "">
                                            <div class = "profile-usertitle">
                                                 <div class = "doctor-name"> <?php  echo (!empty($eData->event_name))?$eData->event_name :''; ?></div>
                                                <!--<div class = "name-center"> Mathematics </div> -->
                                            </div>
                                            <div>
                                                Description: <?php echo $eData->event_desc; ?>
                                            </div>
                                            <div class = "profile-userbuttons">
                                                <button  style="margin-left: 21px; text-transform: none;" class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-circle deepPink-bgcolor btn-sm' >
                                                    Detail
                                                </button>
                                                 <button  style="margin-left: 21px; text-transform: none;" class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-circle deepPink-bgcolor btn-sm' >
                                                    Edit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php  }
                        ?>
                    </div>
                <?php //} ?>

            </div>
        </div>
    </div>
</div>
<!--end page container -->
<script>
    function PrintElem(id, name, roomNo) {
        console.log('called123');
        var $ajaxURLPart = "<?php echo base_url(); ?>";
        postedData = {};
        postedData['subcounter_id'] = id;
        postedData['is_active'] = 1;
        if ($('#counterID').val() !== '') {
            postedData['counter_id'] = $('#counterID').val();
        }
        $.ajax({
            url: $ajaxURLPart + 'token/addToken/',
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
                    var date = new Date().toLocaleString();
                    console.log('your latest data is ==========', res.data.token_display_name);
                    var mywindow = window.open('', 'AIIMS HOSPITAL', 'height=500,width=600');
                    mywindow.document.write('<html>');
                    mywindow.document.write('<div style="text-align:center"><h2>AIIMS Hospital Kothipura Bilaspur</h2></div>');
                    mywindow.document.write('<hr>');
                    mywindow.document.write('<div style="text-align:center"><img src=" <?php echo base_url(); ?>assets/img/prof/user.png/"</div>');
                    mywindow.document.write('<div style="text-align:center" ><b>Room No: ' + roomNo + '</b></div>');
                    mywindow.document.write('<div style="text-align:center" ><b>' + name + '</b></div>');
                    mywindow.document.write('<div style="text-align:center">Token No.<b><h1>' + res.data.token_display_name + '</h1></b></div>');
                    mywindow.document.write('<div style="text-align:center" >' + date + '</div>');
                    mywindow.document.write('<div style="text-align:center" >Please wait for you turn...</div>');
                    mywindow.document.write('</body></html>');
                    mywindow.print();
                    mywindow.close();
                    return true;
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

    /*
     *  search for a new call 
     */
    $(document).ready(function () {
        console.log("document loaded");
        setInterval(function () {
            getNewCall();
        }, 3000);
    });
    var $ajaxURLPart = "<?php echo base_url(); ?>";
    function getNewCall() {
        //var counterID = "<?php //echo $counterID;                       ?>";
        $.ajax({
            url: $ajaxURLPart + 'token/addNewTokenRefresh',
            method: "GET",
            dataType: "JSON",
            beforeSend: function () {
            }, complete: function () {
            }, success: function (response) {
                var html = '';
                if (typeof (response.data) != 'undefined') {
                    console.log('data ', response.data);
                    console.log('length ', response.data.length);
                    for (var i = 0; i < response.data.length; i++) {
                        running = $('#' + response.data[i].subcounter_id + "-" + 'runningToken').text();
                        pending = $('#' + response.data[i].subcounter_id + "-" + 'pendingToken').text();
                        runningData = "'" + response.data[i].running + "'";
                        pendingData = "'" + response.data[i].pending + "'";
                        if (running != runningData) {
                            $('#' + response.data[i].subcounter_id + "-" + 'runningToken').text(response.data[i].running);
                        }
                        if (pending != pendingData) {
                            $('#' + response.data[i].subcounter_id + "-" + 'pendingToken').text(response.data[i].pending);
                        }
                    }

                    $('#viewSreen').html(html);
                    $('#showCounterName').html(response.data[0].counter_name);
                } else {
                    if (response.error == 'Invalid Authentication') {
                        logout();
                    }
                }

            }, error: function () {
                console.log('errrrrrr')
                $('#' + $saveBtn).button('reset');
                ajaxErrorHandling(jqXHR);
            }
        });
    }
</script>