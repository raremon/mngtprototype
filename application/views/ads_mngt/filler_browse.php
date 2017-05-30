<div class="modal fade" id="filler-box" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ad Details</h4>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <div class="col-md-12">
                <div id="ad-message"></div>
                <?php echo form_open_multipart('fillers/saveFiller', array('id'=>'filler')); ?>
                  <div class="form-group">
                    <input name="filler_id" type="text" class="form-control hidden">
                  </div>
                  <div class="form-group">
                    <label for="video_title">Title:</label>
                    <input name="filler_title" type="text" class="form-control" id="video_title" placeholder="Title">
                  </div>
                  <div class="form-group">
                    <label>Description:</label>
                    <textarea name="filler_description" class="form-control" cols="30" rows="7" placeholder="Description"></textarea>
                  </div>
                <?php echo form_close(); ?>
            </div>
          </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Filler()">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Filler Data</h3>
    <div class="box-tools pull-right">
        <a class="btn btn-link add-link" href="<?php echo base_url('fillers/upload') ?>"><i class="fa fa-plus-square-o">&nbsp;</i>New Filler</a>
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="filler-message-2"></div>
          <table id="filler_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>NAME</th>
                <th>DESCRIPTION</th>
                <th>CONTENT</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>        
    </div>
 </div>
  <div class="box-footer">
  </div>
</div>
<script>
  $(".select2").select2();
  $('.select2-selection__rendered').removeAttr('title');
  $('body').on('hidden.bs.modal', '.modal', function () {
    $('video').trigger('pause');
  });
  //Placeholder Text
  $(document).on('click', '.browse', function(){
    var file = $(this).parent().parent().parent().find('.file');
    file.trigger('click');
  });
  //Placeholder Text End
  $(document).on('change', '.file', function(){
    $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
  });
  ////////////////////////////////////////////////////////////////
  //          C  R  U  D    F  U  N  C  T  I  O  N  S           //
  ////////////////////////////////////////////////////////////////
  // R E A D
  $("#filler_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('fillers/showFiller') ?>",
      "type":"POST"
    },
    "columns": [
      null,
      null,
      null,
      {"width": "12%"},
    ]
  })
  // U P D A T E
  function edit_filler(id) {
    $(window).scrollTop(0);
    $("#filler-box").modal('show');
    $.ajax({
      url: "<?php echo site_url('fillers/editFiller') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'filler_id='+id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="filler_id"]').val(data.filler_id);
        $('input[name="filler_title"]').val(data.filler_title);
        $('textarea[name="filler_description"]').val(data.filler_description);
      }
    })
  }
  function update_Filler() {
    $.ajax({
      url: "<?php echo site_url('fillers/updateFiller') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#filler').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          $(window).scrollTop(0);
          $("#filler-message").fadeIn("slow");
          $('#filler-message').html(data.errors).addClass('alert alert-danger');
          setTimeout(function() {
              $('#filler-message').fadeOut('slow');
          }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#filler-box').modal('hide');
          $('#successModal').modal('show');
        }
      }
    })
  }
  // D E L E T E
  function delete_filler(id) {
    // swal({
    //   title: 'ARE YOU SURE?',
    //   text: "You cannot revert this action!",
    //   type: 'warning',
    //   showCancelButton: true,
    //   confirmButtonColor: '#3085d6',
    //   cancelButtonColor: '#d33',
    //   confirmButtonText: 'Delete',
    //   cancelButtonText: 'Cancel',
    //   confirmButtonClass: 'btn btn-success btn-fix',
    //   cancelButtonClass: 'btn btn-default',
    //   animation: false,
    //   customClass: 'animated fadeInDown',
    //   buttonsStyling: false
    // }).then(function () {
    //     swal({
    //      //pede to ilagay sa success modal di ko mahanap kung saan
    //       title: 'DELETED SUCCESSFULLY',
    //       type: 'success',
    //       confirmButtonText: 'Okay',
    //       confirmButtonClass: 'btn btn-success btn-fix',
    //       buttonsStyling: false
    //     })
    // }, function (dismiss) {
    //   if (dismiss === 'cancel') {
    //     swal({
    //       title: 'CANCELLED',
    //       type: 'error',
    //       confirmButtonText: 'Okay',
    //       confirmButtonClass: 'btn btn-default btn-fix',
    //       buttonsStyling: false
    //     })
    //   }
    // })
    if(confirm('Do you really want to delete this Filler Record ??')){
      $.ajax({
        url: "<?php echo site_url('fillers/deleteFiller') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'filler_id='+id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#filler-message-2").fadeIn("slow");
              $('#filler-message-2').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#filler-message-2').fadeOut('slow');
              }, 3000);
            }
          }else {
            $('#message-text').html(data.message);
            $('#successModal').modal('show');
          }
        }
      });
    }
  }
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////
  // END OF ADS BROWSE JAVASCRIPT
</script>