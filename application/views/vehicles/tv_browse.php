<div class="modal fade" id="tv-box" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">TV Details</h4>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <div class="col-md-12">
              <div id="tv-message"></div>
              <?php echo form_open('welcome', array('id'=>'tv')); ?>
              <div class="form-group">
                <input type="text" name="tv_id" class="form-control hidden"/>
              </div>
              <div class="form-group">
                <label>TV Serial</label>
                <input type="text" name="tv_serial" class="form-control" placeholder="Enter Television's Serial"/>
              </div>
              <div class="form-group">
                <label>TV Description</label>
                <textarea name="tv_description" class="form-control" cols="30" rows="7" placeholder="Enter Television's Description"></textarea>
              </div>
              <?php echo form_close(); ?>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Tv()">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Tv Data</h3>
    <div class="box-tools pull-right">
        <a class="btn btn-link add-link" href="<?php echo base_url('tvs/add') ?>"><i class="fa fa-plus-square-o">&nbsp;</i>New TV</a>
    </div>
  </div>
  <div class="box-body">
    <div id="tv-delete-message"></div>
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <table id="tv_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>TV SERIAL</th>
                <th>TV DESCRIPTION</th>
                <th>DATE CREATED</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="box-footer">
  </div>
</div>
<script type="text/javascript">
  ////////////////////////////////////////////////////////////////
  //          C  R  U  D    F  U  N  C  T  I  O  N  S           //
  ////////////////////////////////////////////////////////////////
  // O T H E R
  function closebox() {
    $('#form-box').addClass('hidden');
  }
  // R E A D
  $("#tv_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('tvs/showTv') ?>",
      "type":"POST"
    }
  })
  // U P D A T E
  function edit_tv(tv_id) {
    $('#tv-box').modal('show');
    $.ajax({
      url: "<?php echo site_url('tvs/editTv') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'tv_id='+tv_id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="tv_id"]').val(data.tv_id);
        $('input[name="tv_serial"]').val(data.tv_serial);
        $('textarea[name="tv_description"]').val(data.tv_description);
      }
    })
  }
  function update_Tv() {
    $.ajax({
      url: "<?php echo site_url('tvs/updateTv') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#tv').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
            $(window).scrollTop(0);
            $("#tv-message").fadeIn("slow");
            $('#tv-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#tv-message').fadeOut('slow');
            }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#tv-box').modal('hide');
          $('#successModal').modal('show');
        }
      }
    })
  }
  // D E L E T E
function delete_tv(tv_id) {
    swal({
      title: 'Are you sure you want to delete?',
      text: "You cannot revert this action!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Delete',
      cancelButtonText: 'Cancel',
      confirmButtonClass: 'btn btn-success btn-fix',
      cancelButtonClass: 'btn btn-default',
      animation: false,
      customClass: 'animated fadeInDown',
      buttonsStyling: false
    }).then(function () {
      $.ajax({
        url: "<?php echo site_url('tvs/delete_Tv/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'tv_id='+tv_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#tv-delete-message").fadeIn("slow");
              $('#tv-delete-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#tv-delete-message').fadeOut('slow');
              }, 3000);
            }
          }else {
//            $('#message-text').html(data.message);
//            $('#successModal').modal('show');
            swal({
             //pede to ilagay sa success modal di ko mahanap kung saan
              title: data.message,
              type: 'success',
              confirmButtonText: 'Okay',
              confirmButtonClass: 'btn btn-success btn-fix',
              buttonsStyling: false
            }).then(
              function () {
                window.location.reload();
              }
            )
          }
        }
      });
    }, function (dismiss) {
      if (dismiss === 'cancel') {
        swal({
          title: 'Cancelled',
          type: 'error',
          confirmButtonText: 'Okay',
          confirmButtonClass: 'btn btn-default btn-fix',
          buttonsStyling: false,
          timer: 3000
          
        })
      }
    })
  }    
  // U N A S S I G N
function unassign_tv(tv_id) {
    swal({
      title: 'Are you sure you want to unassign?',
      text: "You cannot revert this action!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes',
      cancelButtonText: 'Cancel',
      confirmButtonClass: 'btn btn-success btn-fix',
      cancelButtonClass: 'btn btn-default',
      animation: false,
      customClass: 'animated fadeInDown',
      buttonsStyling: false
    }).then(function () {
      $.ajax({
        url: "<?php echo site_url('tvs/unassign_Tv/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'tv_id='+tv_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#tv-delete-message").fadeIn("slow");
              $('#tv-delete-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#tv-delete-message').fadeOut('slow');
              }, 3000);
            }
          }else {
//            $('#message-text').html(data.message);
//            $('#successModal').modal('show');
            swal({
             //pede to ilagay sa success modal di ko mahanap kung saan
              title: data.message,
              type: 'success',
              confirmButtonText: 'Okay',
              confirmButtonClass: 'btn btn-success btn-fix',
              buttonsStyling: false
            }).then(
              function () {
                window.location.reload();
              }
            )
          }
        }
      });
    }, function (dismiss) {
      if (dismiss === 'cancel') {
        swal({
          title: 'Cancelled',
          type: 'error',
          confirmButtonText: 'Okay',
          confirmButtonClass: 'btn btn-default btn-fix',
          buttonsStyling: false,
          timer: 3000
          
        })
      }
    })
  }    
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////
  // END OF TV BROWSE JAVASCRIPT
</script>