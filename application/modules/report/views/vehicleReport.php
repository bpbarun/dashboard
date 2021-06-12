<?php
if (!empty($vehicleData)) {
    $vehicleAllData = json_decode($vehicleData);
    if (!empty($vehicleAllData->data)) {
        $vehicles = $vehicleAllData->data;
    }
}
$data = array();
$vehicleNameD = array();
$vehicleName = array();
$totalCount = 0;
if (!empty($vehicles)) {
    foreach ($vehicles as $vData) {
        $objName = $vData->object;
        if (!in_array($objName, $vehicleNameD)) {
            array_push($vehicleNameD, $objName);
            $totalCount = $totalCount + $vData->count;
        }
    }
}
?>
<style>
    .countDiv {
        padding-left: 40px;
    }
    body {
        font-family: 'Arial';
    }

    .container { 
        margin: 15px auto;
    }

    #chart {
        float: left;
        width: 70%;
    }

    #legend {
        float: right;
    }

    [class$="-legend"] {
        list-style: none;
        cursor: pointer;
        padding-left: 0;
    }

    [class$="-legend"] li {
        display: block;
        padding: 0 5px;
    }

    [class$="-legend"] li.hidden {
        text-decoration: line-through;
    }

    [class$="-legend"] li span {
        border-radius: 5px;
        display: inline-block;
        height: 10px;
        margin-right: 10px;
        width: 10px;
    }

</style>
<div class="page-container">
    <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-md-12">
                    <!--<div class="tabbable-line">-->
                    <div class="tab-content">
                        <div class="tab-pane active fontawesome-demo" id="tab1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-box">
                                        <div class="card-body ">
                                            <!--                                            <div class="row">
                                                                                            <div class="col-md-12">-->
                                            <!--<div>-->
                                            <div class="card card-topline-lightblue">
                                                <div class="card-body " id="chartjs_pie_parent">
                                                    <div class="row">
                                                        <div class="col-md-4" class="countDiv">
                                                            <div id="countDiv">

                                                                <?php
                                                                if (!empty($vehicles)) {
                                                                    foreach ($vehicles as $vData) {
                                                                        $objName = $vData->object;
                                                                        $count = $vData->count;
                                                                        if (!in_array($objName, $vehicleName)) {
                                                                            array_push($vehicleName, $objName);
//                                                                            echo "<br>" . $objName . ' : ' . $count;
                                                                            array_push($data, $count);
//                                                                        $totalCount = $totalCount + $vData->count;
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                            <div id="totalCountData">
                                                                Total : <span id="totalCont"><?php echo $totalCount; ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-8"> 
                                                            <canvas id="chartjs_pieMy" width="600" height="400"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--</div>-->
                                            <!--                                                </div>
                                                                                        </div>-->
                                        </div>
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
    <!-- end page container -->
    <script>
        var $ajaxURLPart = "<?php echo base_url(); ?>";
        /*********************************Pie chart********************************************/
        document.addEventListener("DOMContentLoaded", function () {
            counter = '<?php echo json_encode($data); ?>';
            counterName = '<?php echo json_encode($vehicleName); ?>';
            var color = Chart.helpers.color;
            var coloR = [];
            var dynamicColors = function () {
                var r = Math.floor(Math.random() * 200);
                var g = Math.floor(Math.random() * 200);
                var b = Math.floor(Math.random() * 200);
                return "rgb(" + r + "," + g + "," + b + ")";
            };
//            for(var i in counterName) {
            var counterNames = JSON.parse(counterName);
            var objNam = '';
            for (var i = 0; i < counterNames.length; i++) {
                objNam = counterNames[i];
                if (objNam.toLowerCase() == 'car') {
                    coloR.push('#003399');
                } else if (objNam.toLowerCase() == 'truck') {
                    coloR.push('#FF6347');
                } else if (objNam.toLowerCase() == 'person') {
                    coloR.push('#36CFFF');
                } else if (objNam.toLowerCase() == 'motorcycle') {
                    coloR.push('#FFFF00');
                } else {
                    coloR.push(dynamicColors());
                }

            }
            var config = {
                type: 'pie',
                indexLabelPlacement: "inside",
                data: {
                    datasets: [{
                            data: JSON.parse(counter),
//                            borderColor: coloR,
                            backgroundColor: coloR,
                            label: 'Dataset 1'
                        }],
                    labels: JSON.parse(counterName),
                },
                options: {
                    legend: {
                        display: false
                    },
                    legendCallback: function (chart) {
                        var text = [];
                        text.push('<ul class="0-legend">');
                        var ds = chart.data.datasets[0];
                        var sum = ds.data.reduce(function add(a, b) {
                            return parseInt(a) + parseInt(b);
                        }, 0);
                        for (var i = 0; i < (ds.data).length; i++) {
                            text.push('<li>');
                            var perc = Math.round(100 * (ds.data[i] / parseInt(sum)));
                            text.push('<span style="background-color:' + ds.backgroundColor[i] + '">' + '</span>' + chart.data.labels[i] + ' (' + ds.data[i] + ') (' + perc + '%)');
                            text.push('</li>');
                        }
                        text.push('</ul>');
                        return text.join("");
                    }
                }
            };
            var ctx = document.getElementById("chartjs_pieMy").getContext("2d");
//            window.myPie = new Chart(ctx, config);
            /*************************************/
            chart = new Chart(ctx, config);
            var myLegendContainer = document.getElementById("countDiv");
            console.log('myLegendContainer is -===', myLegendContainer);
// generate HTML legend
            myLegendContainer.innerHTML = chart.generateLegend();
// bind onClick event to all LI-tags of the legend
            var legendItems = myLegendContainer.getElementsByTagName('li');

        });
        setInterval(function () {
            getNewCall();
        }, 3000);
        /*
         *  search for a new call 
         */
        function getNewCall() {
            $.ajax({
                url: $ajaxURLPart + 'report/vehicleReportAjax/',
                method: "GET",
                dataType: "JSON",
                beforeSend: function () {
                }, complete: function () {
                }, success: function (response) {
                    /*********************************************/
                    var dataArray = [];
                    var vehicleName = [];
                    var html = '';
                    var totalCount = 0;
                    console.log('response', response);
                    var count = Object.keys(response.data).length;
                    $.each(response.data, function (key, value) {
                        totalCount = totalCount + parseInt(response.data[key]['count']);
                    });
                    var previousTotal = $('#totalCont').text();
                    console.log('previousTotal1111', previousTotal);
                    console.log('couurnet count', totalCount);
                    if (parseInt(previousTotal) !== totalCount) {
                        html += 'Total : <span id="totalCont">' + totalCount + '</span><br>';
                        $.each(response.data, function (key, value) {
                            vehicleName.push(response.data[key]['object']);
                            dataArray.push(response.data[key]['count']);
                        });
                        $('#totalCountData').html(html);
                        updateGraph(vehicleName, dataArray);
                    }
                }, error: function () {
                    console.log('inside error')
                    $('#' + $saveBtn).button('reset');
                    ajaxErrorHandling(jqXHR);
                }
            });
        }
        function updateGraph(counterName, counter) {
            var color = Chart.helpers.color;
            var coloR = [];
            var dynamicColors = function () {
                var r = Math.floor(Math.random() * 200);
                var g = Math.floor(Math.random() * 200);
                var b = Math.floor(Math.random() * 200);
                return "rgb(" + r + "," + g + "," + b + ")";
            };
            var counterNames = counterName;
            var objNam = '';
            for (var i = 0; i < counterNames.length; i++) {
                objNam = counterNames[i];
                if (objNam.toLowerCase() == 'car') {
                    coloR.push('#003399');
                } else if (objNam.toLowerCase() == 'truck') {
                    coloR.push('#FF6347');
                } else if (objNam.toLowerCase() == 'person') {
                    coloR.push('#36CFFF');
                } else if (objNam.toLowerCase() == 'motorcycle') {
                    coloR.push('#FFFF00');
                } else {
                    coloR.push(dynamicColors());
                }

            }
            var config = {
                type: 'pie',
                indexLabelPlacement: "inside",
                data: {
                    datasets: [{
                            data: counter,
//                            borderColor: coloR,
                            backgroundColor: coloR,
                            label: 'Dataset 1'
                        }],
                    labels: counterName,
                },
                options: {
                    legend: {
                        display: false
                    },
                    legendCallback: function (chart) {
                        var text = [];
                        text.push('<ul class="0-legend">');
                        var ds = chart.data.datasets[0];
                        var sum = ds.data.reduce(function add(a, b) {
                            return parseInt(a) + parseInt(b);
                        }, 0);
                        for (var i = 0; i < (ds.data).length; i++) {
                            text.push('<li>');
                            var perc = Math.round(100 * ds.data[i] / sum, 0);
                            console.log('sassss', perc);
                            text.push('<span style="background-color:' + ds.backgroundColor[i] + '">' + '</span>' + chart.data.labels[i] + ' (' + ds.data[i] + ') (' + perc + '%)');
                            text.push('</li>');
                        }
                        text.push('</ul>');
                        return text.join("");
                    }
                }
            };
            var ctx = document.getElementById("chartjs_pieMy").getContext("2d");
//            window.myPie = new Chart(ctx, config);
            console.log('new chart is ===', window.chart);
            /*************************************/
//            var chart = new Chart(ctx, config);
            window.chart.data.datasets[0].data = counter;
            window.chart.data.datasets[0].backgroundColor = coloR;
            window.chart.data.labels = counterName;
            window.chart.update();

//            window.chart.render();
            var myLegendContainer = document.getElementById("countDiv");
// generate HTML legend
            myLegendContainer.innerHTML = window.chart.generateLegend();
// bind onClick event to all LI-tags of the legend
            var legendItems = myLegendContainer.getElementsByTagName('li');
        }
        /*************************************/
    </script>