<?php
if (!empty($feedback)) {
    $feedback = json_decode($feedback);
    if (!empty($feedback->data)) {
        $allFeedback = $feedback->data;
    }
}
// echo "<pre>";
// print_r($allFeedback); die;
// $array1 = $allFeedback[1]->feedback_ques_id;
// $array2 = $allFeedback[2]->feedback_ans;
// print_r($array1);


if (!empty($feedbackQues)) {
    $feedbackQues = json_decode($feedbackQues);
    if (!empty($feedbackQues->data)) {
        $allfeedbackQues = $feedbackQues->data;
    }
}
// print_r($allfeedbackQues); die;

?>
<style>
    #block_container {
        text-align: center;
    }
    #block_container > div {
        display: inline-block;
        vertical-align: middle;
    }

</style>
<!-- data tables -->
<!--    <link href="../assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" /> -->
<div class="page-container">
    <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Feedback</div>
                    </div>

                </div>
            </div>
            <!--------------------Date Time picker------------------->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="card-head">
                            <header>Filter</header>
                        </div>
                        <div class="card-body" >
                            <div>
                               <div  style="float:left">
                                    <div class="form-control-wrapper">
                                        <input type="text" id="date-start1" name="date-start" class="floating-label mdl-textfield__input" placeholder="Start Date" style="width: 356px; margin-right: 24px">
                                    </div>
                                </div>

                                <div  style="float:left">
                                    <div class="form-control-wrapper">
                                        <input type="text" id="date-end1" name="date-end" class="floating-label mdl-textfield__input" placeholder="End Date" style="width: 356px; margin-right: 24px">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--------------------------------->
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line">
                        <div class="tab-content">
                            <div class="tab-pane active fontawesome-demo" id="tab1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-box">
                                            <!-- <div class="card-head">
                                            <header>All Feedback</header>
                                            
                                            </div> -->

                                            <div class="card-body ">

                                                <div class="table-scrollable">
                                                    <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                           id="myTableFeedback">
                                                        <thead>
                                                            <tr>

                                                                <?php foreach ($allfeedbackQues as $key => $value) { ?>
                                                                    <th>
                                                                        <?php echo $value->feedback_question; ?></th> 
                                                                <?php } ?>
                                                                <th>Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                           // print_r($allFeedback); die;
                                                            foreach ($allFeedback as $key => $value) {
                                                                // print_r($allfeedbackQues);die;
                                                                
                                                                $array1 = explode(',', $value->feedback_ques_id);
                                                                $array2 = explode(',', $value->feedback_ans);
                                                             
                                                                array_push($array1, 'Date');
                                                                array_push($array2, $value->date);

                                                                $lastData = array_combine($array1, $array2);
                                                                ?>   
                                                                <tr>
                                                                    <?php foreach ($lastData as $key => $value) { ?>
                                                                        <td>
                                                                            <?php echo (!empty($value)) ? $value : '--'; ?>

                                                                        </td> 

                                                                    <?php } ?>
                                                                </tr> <?php } ?>            
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
    </div>
</div>
<!-- end page container -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">


    $(document).ready(function () {
        var table = $('#myTableFeedback').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel'
            ]
        });
    /*********************/
  $('#date-end1, #date-start1').change(function () {
        table.draw();
    });
    /*********************/
 $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            // console.log('data is ===',data)
            // alert('ok');
            var min = $('#date-start1').val();
            var max = $('#date-end1').val();
            var startDate = data[3];
            // alert(min);
            // alert(max);
            // alert(startDate);
            console.log('start date is ===',startDate);
            console.log('min date is ===',min);
            console.log('max date is ===',max);
            if (min == '' && max == '') return true;
            if (min == '' && startDate <= max) return true;
            if (max == '' && startDate >= min) return true;
            if (startDate <= max && startDate >= min) return true;
            return false;
        }
    );

    });


   
</script>
