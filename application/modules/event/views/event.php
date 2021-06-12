<?php
if (!empty($event)) {
    $eventDatas = json_decode($event);
    if (!empty($eventDatas->data)) {
        $eventData = $eventDatas->data;
    }
}
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
    .delete-btn {
        display: inline-block;
        /*padding: 6px 12px;*/
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
                        <div class="page-title">Event List <?php
                            // if (!empty($albumResult['album_name'])) {
                            //     echo "<b>" . $albumResult['album_name'] . "</b>";
                            // }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-lg-6 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <input class="mdl-textfield__input" type="text" id="date" name="event_date">
                        <label class="mdl-textfield__label">Event End Date</label>
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
                                                    if (!empty($eventData)) {
                                                        foreach ($eventData as $key => $album) {
                                                            ?>
         <a href = "<?php echo base_url().'assets/event/'.$album->image;?>" id="prev- <?php echo $album->image; ?>"><img src = "<?php echo base_url().'assets/event/'.$album->image; ?>" alt ="<i class='fa fa-trash delete-btn' onclick=deleteMedia(<?php echo $album->event_id;?>); aria-hidden='true'></i> <label class='custom-file-upload'><input type='file' class='custom-file-upload ' id='uploadImage' name='uploadImage'><i class='fa fa-plus' id='uploadMedia' aria-hidden='true'></i></label>"></a>
                                                            <?php
                                                            }
                                                        } else {
                                                            ?>
        <a href = "<?php echo base_url(); ?>uploads/images/uploadmedia1.png"><img src = "<?php echo base_url(); ?>uploads/images/uploadmedia1.png" alt ="<label class='custom-file-upload'><input type='file' class='custom-file-upload ' id='uploadImage' name='uploadImage'><i class='fa fa-plus' id='uploadMedia' aria-hidden='true'></i></label>"></a>
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
            postedData['event_id'] = id;
            var del=confirm("Are you sure you want to delete this record?");
            if (del==true){
            
            
            $.ajax({
                url: "<?php echo base_url(); ?>event/toDelete/",
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
                        success_message('Event deleted successfully');
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
                var eventDate =  $('#date').val();
                 if(eventDate == ''){
                    error_message('Please enter the event date');
                    return false;
                 }
                 
                if (this.files && this.files[0]) {
                    var myFormData = new FormData();
                    myFormData.append('mediafile', this.files[0]);
                    myFormData.append('event_date', eventDate);
                    console.log('myFormData===',myFormData);
                  //  myFormData.append('album_id', albumID);
                    $('#upperLoaderBar').css('display', 'block');
                    $.ajax({
                        url: "<?php echo base_url(); ?>event/singleUpload/",
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
                                 success_message('Event added successfully');
                                setTimeout(function () {
                                    location.reload();
                                }, 100);

                            } else {
                                error_message(response.error);
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
    </script>
    <!-- end page container -->
