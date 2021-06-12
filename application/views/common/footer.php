<!-- start footer -->
<div class="page-footer">
<!--     <div class="page-footer-inner"> 2019 &copy; Powered by
        <a href="http://displayfort.com">Displayfort</a>
    </div> -->
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- end footer -->
</div>
<!-- start js include path -->

<script src="<?php echo base_url(); ?>assets/plugins/popper/popper.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-blockui/jquery.blockui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
<!-- bootstrap -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/sparkline/jquery.sparkline.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/sparkline/sparkline-data.js"></script>
<!-- data tables -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/table/table_data.js"></script>

<!--------Data Table--------------->


    <!-- <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script> -->
    <!-- <script src="../assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js"></script> -->
    <script src="../assets/plugins/datatables/export/dataTables.buttons.min.js"></script>
    <script src="../assets/plugins/datatables/export/buttons.flash.min.js"></script>
    <script src="../assets/plugins/datatables/export/jszip.min.js"></script>
    <script src="../assets/plugins/datatables/export/pdfmake.min.js"></script>
    <script src="../assets/plugins/datatables/export/vfs_fonts.js"></script>
    <script src="../assets/plugins/datatables/export/buttons.html5.min.js"></script>
    <script src="../assets/plugins/datatables/export/buttons.print.min.js"></script>
    <!-- <script src="../assets/js/pages/table/table_data.js"></script> -->
<!--------Data Table--------------------->


<!-- Common js-->
<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
<script src="<?php echo base_url(); ?>assets/js/layout.js"></script>
<script src="<?php echo base_url(); ?>assets/js/theme-color.js"></script>
<!-- material -->
<script src="<?php echo base_url(); ?>assets/plugins/material/material.min.js"></script>
<!-- chart js -->
<script src="<?php echo base_url(); ?>assets/plugins/chart-js/Chart.bundle.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/chart-js/utils.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/chart/chartjs/home-data.js"></script>
<!-- summernote -->
<!--<script src="<?php echo base_url(); ?>assets/plugins/summernote/summernote.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/summernote/summernote-data.js"></script>-->
<script src="<?php echo base_url(); ?>assets/js/jquery.toastee.0.1.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/material-loading/material-loading.js"></script>
<!-- dropzone -->
<!--<script src="<?php echo base_url(); ?>assets/plugins/dropzone/dropzone.js"></script>-->
<script src="<?php echo base_url(); ?>assets/plugins/dropzone/src_dropzone.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/html5gallery/html5gallery.js"></script>
<!-- owl carousel -->
<script src="<?php echo base_url(); ?>assets/plugins/owl-carousel/owl.carousel.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/owl-carousel/owl_data.js"></script>
<!--tags input-->
<script src="<?php echo base_url(); ?>assets/plugins/jquery-tags-input/jquery-tags-input.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-tags-input/jquery-tags-input-init.js"></script>
<!--select2-->
<!--<script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.js"></script>-->
<script src="<?php echo base_url(); ?>assets/js/pages/select2/select2-init.js"></script>
<!-- end js include path -->
<script src="<?php echo base_url(); ?>assets/plugins/material-datetimepicker/moment-with-locales.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/material-datetimepicker/bootstrap-material-datetimepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/material-datetimepicker/datetimepicker.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jquery-toast/dist/jquery.toast.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jquery-toast/dist/toast.js"></script>
<script>
    $(window).on('load', function () {
        setTimeout(function () {
            $('#upperLoaderBar').css('display', 'none');
        }, 1000);
    });</script>

<script>
    Dropzone.autoDiscover = false;
    $(document).ready(function () {
        /*myDropzone = $("#id_dropzone").dropzone({
         maxFiles: 2000,
         //            autoProcessQueue: false,
         addRemoveLinks: true,
         url: "<?php echo base_url() ?>album/do_upload/",
         success: function (file, response) {
         console.log(response);
         }
         });*/
        /*******************2222222222**********************/
        var myDropzone = new Dropzone("#id_dropzone", {
            url: "<?php echo base_url() ?>album/do_upload/",
//            maxFilesize: 209715200,
//            acceptedFiles: "video/*",
            addRemoveLinks: true,
            dataType: "HTML",
            chunking: true,
            forceChunking: true,
            chunkSize: 20000000000,
            parallelChunkUploads: true,
            retryChunks: true,
            retryChunksLimit: 300,
            data: {id: ''},
            success: function (file, response, data) {
                var imgName = response;
                file.previewElement.classList.add("dz-success");
                $('#form_video').val(imgName);
            },
            error: function (file, response) {
                file.previewElement.classList.add("dz-error");
            },
            //Called just before each file is sent
            sending: function (file, xhr, chunk) {
                console.log('chunk is ==================', chunk);
                if (chunk)
                {
                    return
                    {
                        dzUuid = chunk.file.upload.uuid,
                                dzChunkIndex = chunk.index,
                                dzTotalFileSize = chunk.file.size,
                                dzCurrentChunkSize = chunk.dataBlock.data.size,
                                dzTotalChunkCount = chunk.file.upload.totalChunkCount,
                                dzChunkByteOffset = chunk.index * this.options.chunkSize,
                                dzChunkSize = this.options.chunkSize,
                                dzFilename = chunk.file.name;
                    }
                }
                //Execute on case of timeout only
                xhr.ontimeout = function (e) {
                    //Output timeout error message here
                    console.log('Server Timeout');
                };
            }
        })
        /*******************333333333**********************/
    })
    $(window).on('load', function () {
        $('#FeedbackTypeModal').on('hidden.bs.modal', function () {
            $('#FeedbackTypeModal input:text').val('');
            $('#FeedbackTypeModal #feedbackTypeID').val('');
            $('input[name="feebackImg"]:checked').prop('checked', false);
            var id = $('.tagsinput').attr('id');
            $('#' + id).tagsInput('removeAll');
            allQuestion = undefined;
            removeID = $('.tags-input').closest('div').find('div').next().prop('id');
            console.log('removeID id is ===', removeID);
            $('#' + removeID).remove();
            $('.tags-input').tagsInput({
                width: 'auto'
            });
        })
    });
</script>
</body>

</html>