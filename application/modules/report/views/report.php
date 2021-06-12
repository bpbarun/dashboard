<?php
if (!empty($counterData)) {
    $counterAllData = json_decode($counterData);
    if (!empty($counterAllData->data)) {
        $counter = $counterAllData->data;
    }
}
//echo "<pre>";print_r($counter); die;
if (!empty($tokenData)) {
    $tokenAllData = json_decode($tokenData);
    if (!empty($tokenAllData->data)) {
        $token = $tokenAllData->data;
    }
}
$data = array();
$counterName = array();
if (!empty($counter)) {
    foreach ($counter as $counterData) {
        $cID = $counterData->counter_id;
        $i = 0;
        $ctnName = $counterData->counter_name;
        foreach ($token as $tokenData) {
            if ($tokenData->counter_id == $cID) {
                $i++;
            }
        }
        array_push($data, $i);
        array_push($counterName, $ctnName);
    }
}
//$counterStrData = implode(",", $data);
//$counterStrName = implode(",", $data);
?>
<div class="page-container">
    <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line">
                        <div class="tab-content">
                            <div class="tab-pane active fontawesome-demo" id="tab1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-box">
                                            <div class="card-body ">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card card-topline-lightblue">
                                                            <div class="card-head">
                                                                <header>BAR CHART</header>
                                                                <div class="tools">
                                                                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                                                </div>
                                                            </div>
                                                            <div class="card-body " id="chartjs_bar_parent">
                                                                <div class="row">
                                                                    <canvas id="chartjs_barMy"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card card-topline-lightblue">
                                                            <div class="card-head">
                                                                <header>Most Used Counter</header>
                                                                <div class="tools">
                                                                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                                                </div>
                                                            </div>
                                                            <div class="card-body " id="chartjs_pie_parent">
                                                                <div class="row">
                                                                    <canvas id="chartjs_pieMy" height="120"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card card-topline-red">
                                                            <div class="card-head">
                                                                <header>LINE CHART</header>
                                                                <div class="tools">
                                                                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                                                </div>
                                                            </div>
                                                            <div class="card-body " id="chartjs_line_parent">
                                                                <div class="row">
                                                                    <canvas id="chartjs_lineMy"></canvas>
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
        </div>
    </div>
    <!-- end page container -->
    <script>
        /*********************************Pie chart********************************************/
        document.addEventListener("DOMContentLoaded", function () {
            var counter = "<?php echo json_encode($data); ?>";
            var counterName = '<?php echo json_encode($counterName); ?>';
            var color = Chart.helpers.color;
            var coloR = [];
            var dynamicColors = function () {
                var r = Math.floor(Math.random() * 200);
                var g = Math.floor(Math.random() * 200);
                var b = Math.floor(Math.random() * 200);
                return "rgb(" + r + "," + g + "," + b + ")";
            };

            for (var i in counterName) {
                coloR.push(dynamicColors());
            }
            var config = {
                type: 'pie',
                data: {
                    datasets: [{
                            data: JSON.parse(counter),
                            borderColor: coloR,
                            backgroundColor: coloR,
                            label: 'Dataset 1'
                        }],
                    labels: JSON.parse(counterName),
                },
                options: {
                    responsive: true
                }
            };
            var ctx = document.getElementById("chartjs_pieMy").getContext("2d");
            window.myPie = new Chart(ctx, config);
        });

        /***********************************BAR CHART****************************/
        document.addEventListener("DOMContentLoaded", function () {
            var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            var color = Chart.helpers.color;
            var barChartData = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                        label: 'New Students',
                        backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                        borderColor: window.chartColors.red,
                        borderWidth: 1,
                        data: [
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor()
                        ]
                    }, {
                        label: 'Old Students',
                        backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                        borderColor: window.chartColors.blue,
                        borderWidth: 1,
                        data: [
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor()
                        ]
                    }]

            };
            var ctx = document.getElementById("chartjs_bar").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Bar Chart'
                    }
                }
            });
        });
        /******************************************line chart******************************/
        document.addEventListener("DOMContentLoaded", function () {
            var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            var configLine = {
                type: 'line',
                data: {
                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [{
                            label: "New Students",
                            backgroundColor: window.chartColors.red,
                            borderColor: window.chartColors.red,
                            data: [
                                randomScalingFactor(),
                                randomScalingFactor(),
                                randomScalingFactor(),
                                randomScalingFactor(),
                                randomScalingFactor(),
                                randomScalingFactor(),
                                randomScalingFactor()
                            ],
                            fill: false,
                        }, {
                            label: "Old Students",
                            fill: false,
                            backgroundColor: window.chartColors.blue,
                            borderColor: window.chartColors.blue,
                            data: [
                                randomScalingFactor(),
                                randomScalingFactor(),
                                randomScalingFactor(),
                                randomScalingFactor(),
                                randomScalingFactor(),
                                randomScalingFactor(),
                                randomScalingFactor()
                            ],
                        }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'UNIVERSITY SURVEY'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        xAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Month'
                                }
                            }],
                        yAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Students'
                                }
                            }]
                    }
                }
            };
            var ctxMy = document.getElementById("chartjs_lineMy").getContext("2d");
            window.myLine = new Chart(ctxMy, configLine);
        });
        /**************************************************bar chart****************************************************/
        document.addEventListener("DOMContentLoaded", function () {
            var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            var color = Chart.helpers.color;
            var barChartData = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                        label: 'New Students',
                        backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                        borderColor: window.chartColors.red,
                        borderWidth: 1,
                        data: [
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor()
                        ]
                    }, {
                        label: 'Old Students',
                        backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                        borderColor: window.chartColors.blue,
                        borderWidth: 1,
                        data: [
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor()
                        ]
                    }]

            };

            var ctxBar = document.getElementById("chartjs_barMy").getContext("2d");
            window.myBar = new Chart(ctxBar, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Bar Chart'
                    }
                }
            });

        });

        /**
         * function to generate random color in hex form
         */
        function getRandomColorHex() {
            var hex = "0123456789ABCDEF",
                    color = "#";
            for (var i = 1; i <= 6; i++) {
                color += hex[Math.floor(Math.random() * 16)];
            }
            return color;
        }

    </script>