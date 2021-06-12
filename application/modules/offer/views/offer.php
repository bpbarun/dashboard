<?php
if (!empty($offer)) {
    $offerDatas = json_decode($offer);
    if (!empty($offerDatas->data)) {
        $offerData = $offerDatas->data;
    }
    // $albumAssetsResult = array_combine($albumResult['image_id'], $albumResult['image_url']);
}
// $albumID = $this->uri->segment('3');
// echo "<pre>";
// print_r($eventData); die;
// foreach ($eventData as $key => $album) {
//     echo $album->image;
// }
// die;
?>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/html5gallery/html5gallery.js"></script>-->
<style type="text/css">
    div.guide {margin:12px 24px;}
    div.guide span {color:#ff0000; font:italic 14px Arial, Helvetica, sans-serif;}
    div.guide p {color:#000000; font:14px Arial, Helvetica, sans-serif;}
    div.guide pre {color:#990000;}
    div.guide p.title {color:#df501f; font:18px Arial, Helvetica, sans-serif;}
    input[type="file"] {
        display: none;
    }
    .custom-file-upload {
        /*border: 1px solid #ccc;*/
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
    }
</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<div class="page-container">
    <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Offer List <?php
                            // if (!empty($albumResult['album_name'])) {
                            //     echo "<b>" . $albumResult['album_name'] . "</b>";
                            // }
                            ?>
                        </div>
                    </div>
                    <!-- <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url() . 'token'; ?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="">Offer Detail</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Offer List</li>
                    </ol> -->
                </div>
            </div>
            
            <!------------------->
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line">
                        <div class="tab-content">
                            <div class="tab-pane active fontawesome-demo" id="tab1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-box">
                                            <div class="card-body ">
                                                <div style="display:block;margin:0 auto;" class="html5gallery" data-skin="darkness" data-width="580" data-height="472" data-resizemode="fill" >
                                                    <!-- Add images to Gallery -->
                                                    <?php
                                                    if (!empty($offerData)) {
                                                        foreach ($offerData as $key => $album) {
                                                            ?>
<a href = "<?php echo base_url().'assets/offer/'.$album->image;?>" id="prev- <?php echo $album->image; ?>"><img src = "<?php echo base_url().'assets/offer/'.$album->image; ?>" alt ="<i class='fa fa-trash' onclick=deleteMedia(<?php echo $album->offer_id;?>); aria-hidden='true'></i> <label class='custom-file-upload'><input type='file' class='custom-file-upload ' id='uploadImage' name='uploadImage'><i class='fa fa-plus' id='uploadMedia' aria-hidden='true'></i></label>"></a>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
 <a href = "<?php echo base_url(); ?>uploads/images/uploadmedia1.png"><img src = "<?php echo base_url(); ?>uploads/images/uploadmddedia1.png" alt ="<label class='custom-file-upload'><input type='file' class='custom-file-upload ' id='uploadImage' name='uploadImage'><i class='fa fa-plus' id='uploadMedia' aria-hidden='true'></i></label>"></a>
                                                    <?php }
                                                    ?>
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
    <script>
        function deleteMedia(id) {
            
            console.log('id', id)
            postedData = {};
            postedData['offer_id'] = id;
            var del=confirm("Are you sure you want to delete this record?");
            if (del==true){
            
            
            $.ajax({
                url: "<?php echo base_url(); ?>offer/toDelete/",
                method: "POST",
                dataType: "JSON",
                data: postedData,
                beforeSend: function () {
                }, complete: function () {
                }, success: function (response) {
                    $('#upperLoaderBar').css('display', 'none');
//                    console.log('response',response);
//                    console.log('response ka success=',response.status);
                    if (response.status) {
                        success_message('Offer deleted successfully');
                        setTimeout(function () {
                            location.reload();
                        }, 1000);

                    } else {
                        $('#my-toast-location').toastee(response.error, 'error');
                    }
                    console.log('called............123');

                }, error: function () {
                    $('#upperLoaderBar').css('display', 'none');
                    error_message('Sonething get error please try after some time');
                }
            });
         }
        }
        window.addEventListener('load', function () {

        document.querySelector('input[type="file"]').addEventListener('change', function () {
                console.log('file is selected...........');
                if (this.files && this.files[0]) {
                    var myFormData = new FormData();
                    myFormData.append('mediafile', this.files[0]);
                  //  myFormData.append('album_id', albumID);
                    $('#upperLoaderBar').css('display', 'block');
                    $.ajax({
                        url: "<?php echo base_url(); ?>offer/singleUpload/",
                        type: 'POST',
                        processData: false, // important
                        contentType: false, // important
                        dataType: 'json',
                        data: myFormData,
                        beforeSend: function () {
                        }, complete: function () {
                        }, success: function (response) {
                            console.log('success is ====',response);
                            $('#upperLoaderBar').css('display', 'none');
                            if (response.status) {
                                 success_message('Offer added successfully');
                                setTimeout(function () {
                                    location.reload();
                                }, 1000);

                            } else {
                                $('#my-toast-location').toastee(response.error, 'error');
                            }
                            console.log('called............123');

                        }, error: function () {
                            $('#upperLoaderBar').css('display', 'none');
                             error_message('Sonething get error please try after some time');
                        }
                    });
                }
            });
        });
        // $('#uploadMedia').on('click',function({
        //    console.log('dfggygytgygu');
        // });
        $("#uploadImage").on("click", function(){
  alert("The paragraph was clicked.");
});
    </script>
    <!-- end page container -->
