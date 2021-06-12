<style>
    .vl {
        border-left: 6px solid green;
        height: 50px;
        margin: 19px;
    }
</style>
<?php
if (!empty($allCounters)) {
    $allCounters = json_decode($allCounters);
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
                <?php
                foreach ($newArray as $key => $subCounterData) {
                    ?>
                    <div class = "row">
                        <div class = "page-header-inner ">
                            <div class = "doctor-name"><b style = "color: cyan";><?php echo $key; ?></b></div>
                            <select name="printer" id="printer"  style="float: right;">
                                <option value=" ">----SELECT PRINTER----</option>
                                <?php
                                for ($i=0; $i<count($available_printers); $i++) {
                                    echo "<option value=\"$available_printers[$i]\">$available_printers[$i]</option>";
                                }
                                ?>
                            </select>
                        </div>
                        </br>
                        <?php
                        foreach ($subCounterData as $data) {
                            $id = $data['id'];
                            $name = '"' . $data['name'] . '"';
                            $roomNo = (!empty($data['room_no'])) ? '"' . $data['room_no'] . '"' : '0';
                            ?>
                            <div class = "col-md-3">
                                <div class = "card card-box">
                                    <div class = "card-body no-padding ">
                                        <div class = "doctor-profile">
                                            <img src = "<?php echo base_url(); ?>assets/img/prof/user.png" class = "doctor-pic" alt = "">
                                            <div class = "profile-usertitle">
                                                <div class = "doctor-name"><?php echo $data['name']; ?></div>
                                                <!--<div class = "name-center"> Mathematics </div> -->
                                            </div>
                                            <div>
                                                Room No: <?php echo $data['room_no']; ?>
                                            </div>
                                            <div>
                                                Token Status:  <img src = "<?php echo base_url(); ?>assets/img/dr._icon .png" alt = "running" style="margine:8px; width: 17px;"><span id="<?php echo $id; ?>-runningToken" style="margin: 8px;"><?php echo $data['running']; ?></span><img src = "<?php echo base_url(); ?>assets/img/waiting_icon.png"  alt= "panding" style="margine:8px;width: 17px;"><span id="<?php echo $id; ?>-pendingToken" style="margin: 8px"><?php echo (!empty($data['pending'])) ? $data['pending'] : '00'; ?></span>
                                            </div>
                                            <div class = "profile-userbuttons">
                                                <button  style="margin-left: 21px; text-transform: none;" class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-circle deepPink-bgcolor btn-sm' value ="<?php echo $data['name']; ?>" onclick ='PrintElem(<?php echo $id; ?>, <?php echo $name; ?>,<?php echo $roomNo; ?>)'>
                                                    Print Token
                                                </button>
                                                  <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-primary" data-toggle="modal" data-target="#bookAppointMent" id="addFeedbackType"> Book Appointment</button>
                                                <!--<a href = "professor_profile.html" class = "btn btn-circle deepPink-bgcolor btn-sm">Print Token</a>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <hr>
                <?php } ?>

            </div>
        </div>
    </div>


<!---------------------------Modal--------------------------------->
<div class="modal" tabindex="-1" role="dialog" id="bookAppointMent">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<!--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
<div class="row">
<div class="col-sm-12">
<div class="card-box">
<div class="card-head">
<header>Book Appoitment</header>
</div>

<!-------------------------------------->
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="panel tab-border card-box">
            <header class="panel-heading panel-heading-gray custom-tab ">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a href="#home" data-toggle="tab" class="active">Today</a>
                    </li>
                    <li class="nav-item"><a href="#about" data-toggle="tab">Tomorrow</a>
                    </li>
                    <li class="nav-item"><a href="#profile" data-toggle="tab">Profile</a>
                    </li>
                </ul>
            </header>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                            industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                            scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into
                            electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release
                            of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like
                            Aldus PageMaker including versions of Lorem Ipsum..</p>
                        <p>Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
                            amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna
                            aliquyam erat, sed diam voluptua. At vero eos et accusam et justo.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------->
</div>
</div>
</div>
<!--</div>-->
</div>
</div>
</div>
</div>




</div>
<!--end page container -->
<script>
    function PrintElem(id, name, roomNo) {
        var $ajaxURLPart = "<?php echo base_url(); ?>";
        postedData = {};
        postedData['subcounter_id'] = id;
        postedData['is_active'] = 1;
        postedData['printerName'] = document.getElementById("printer").value;
        if (postedData['printerName'] == " ") {
            error_message('Printer not selected !!!');
            return;
        }
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
        getNewCall();
    }

    /*
     *  search for a new call 
     */
    $(document).ready(function () {
        console.log("document loaded");
        setInterval(function () {
            getNewCall();
        }, 5000);
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
                $('#' + $saveBtn).button('reset');
                ajaxErrorHandling(jqXHR);
            }
        });
    }
</script>
