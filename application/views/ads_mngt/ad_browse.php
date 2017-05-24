<div class="modal fade" id="ad-box" role="dialog">
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
                <?php echo form_open_multipart('ads_mngt/saveAd', array('id'=>'ads')); ?>
                  <div class="form-group">
                    <input name="ad_id" type="text" class="form-control hidden">
                  </div>
                  <div class="form-group">
                    <label for="video_title">Title:</label>
                    <input name="ad_name" type="text" class="form-control" id="video_title" placeholder="Title">
                  </div>
                  <div class="form-group">
                    <div class="form-group">
                      <label>Advertiser</label>
                      <select name="advertiser_id" class="form-control select2">
                        <?php 
                          foreach($advertiser as $row)
                          {
                        ?>
                          <option value= <?php echo $row[0];?> >
                            <?php echo $row[1]; ?>
                          </option>
                        <?php 
                          }
                        ?>
                      </select>
                      <a class="btn btn-link pull-right" href="#">Add Advertisers</a>
                    </div>
                  </div>
                <?php echo form_close(); ?>
            </div>
          </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Ad()">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Advertisement Data</h3>
    <div class="box-tools pull-right">
        <a class="btn btn-link add-link" href="<?php echo base_url('ads_mngt/upload') ?>"><i class="fa fa-plus-square-o">&nbsp;</i>New Ad</a>
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="ad-message-2"></div>
          <table id="ad_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>ADVERTISER</th>
                <th>VIDEO</th>
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
  $("#ad_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('ads_mngt/showAd') ?>",
      "type":"POST"
    },
    "columns": [
      null,
      null,
      null,
      null,
      {"width": "12%"},
    ]
  })
  // U P D A T E
  function edit_ad(ad_id) {
    $(window).scrollTop(0);
    $("#ad-box").modal('show');
    $.ajax({
      url: "<?php echo site_url('ads_mngt/editAd') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'ad_id='+ad_id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="ad_id"]').val(data.ad_id);
        $('input[name="ad_name"]').val(data.ad_name);
        $('select[name="advertiser_id"]').val(data.advertiser_id);
      }
    })
  }
  function update_Ad() {
    $.ajax({
      url: "<?php echo site_url('ads_mngt/updateAd') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#ads').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          $(window).scrollTop(0);
          $("#ad-message").fadeIn("slow");
          $('#ad-message').html(data.errors).addClass('alert alert-danger');
          setTimeout(function() {
              $('#ad-message').fadeOut('slow');
          }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#ad-box').modal('hide');
          $('#successModal').modal('show');
        }
      }
    })
  }
  // D E L E T E
  function delete_ad(ad_id) {
    swal({
      title: 'ARE YOU SURE?',
      text: "You cannot revert this action!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Delete',
      cancelButtonText: 'Cancel',
      confirmButtonClass: 'btn btn-success btn-fix',
      cancelButtonClass: 'btn btn-default',
      animation: false,
      customClass: 'animated fadeInDown',
      buttonsStyling: false
    }).then(function () {
        swal({
         //pede to ilagay sa success modal di ko mahanap kung saan
          title: 'DELETED SUCCESSFULLY',
          type: 'success',
          confirmButtonText: 'Okay',
          confirmButtonClass: 'btn btn-success btn-fix',
          buttonsStyling: false
        })
    }, function (dismiss) {
      if (dismiss === 'cancel') {
        swal({
          title: 'CANCELLED',
          type: 'error',
          confirmButtonText: 'Okay',
          confirmButtonClass: 'btn btn-default btn-fix',
          buttonsStyling: false
        })
      }
    })
    if(confirm('Do you really want to delete this Ad Record ??')){
      $.ajax({
        url: "<?php echo site_url('ads_mngt/deleteAd') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'ad_id='+ad_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#ad-message").fadeIn("slow");
              $('#ad-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#ad-message').fadeOut('slow');
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