<?php
$files = scandir("uploads/images/1");
$assetsName = array();
$i = 0;
$img_formats = array('.jpg', '.png', '.jpeg');
foreach ($img_formats as $format) {
    foreach ($files as $file) {
        $pos = strpos($file, $format);
        if ($pos) {
            if ($i < 5) {
                if (in_array($file, array(".", ".."))) {
                    continue;
                }
                array_push($assetsName, $file);
                $i++;
            } else {
                break;
            }
        }
    }
}
?>
<div class="page-content">
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Responsive Carousel Slider</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="">UI Elements</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Carousel</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="owl-demo" class="owl-carousel">
                        <?php
                        if (!empty($assetsName)) {
                            foreach ($assetsName as $imgData) {
                                ?>
                                <div class="item"><img src="<?php echo base_url(); ?>uploads/images/1/<?php echo $imgData; ?>">
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!--<h1>One More Example</h1>-->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="owl-demo2" class="owl-carousel">
                        <div class="item"><img src="../assets/img/slider/owl1.jpg" alt="">
                        </div>
                        <div class="item"><img src="../assets/img/slider/owl2.jpg" alt="">
                        </div>
                        <div class="item"><img src="../assets/img/slider/owl3.jpg" alt="">
                        </div>
                        <div class="item"><img src="../assets/img/slider/owl4.jpg" alt="">
                        </div>
                        <div class="item"><img src="../assets/img/slider/owl5.jpg" alt="">
                        </div>
                        <div class="item"><img src="../assets/img/slider/owl6.jpg" alt="">
                        </div>
                        <div class="item"><img src="../assets/img/slider/owl7.jpg" alt="">
                        </div>
                        <div class="item"><img src="../assets/img/slider/owl8.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


