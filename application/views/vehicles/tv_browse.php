<div class="modal fade" id="tv-add" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <?php echo form_open('tvs/save', array('id'=>'tv-add-form')); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Television Details</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="col-md-12">
            <div id="tv-message-add"></div>
            <div class="form-group">
              <label>Television Serial</label>
              <input type="text" name="tv_serial-add" class="form-control" placeholder="Enter Television Serial"/>
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea name="tv_description-add" class="form-control" cols="30" rows="7" placeholder="Add Description"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary save" onclick="save_Tv()">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>
<div class="modal fade" id="tv-box" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Television Details</h4>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <div class="col-md-12">
              <div id="tv-message"></div>
              <?php echo form_open('tvs/update', array('id'=>'tv')); ?>
              <div class="form-group">
                <input type="text" name="tv_id" class="form-control hidden"/>
              </div>
              <div class="form-group">
                <label>Television Serial</label>
                <input type="text" name="tv_serial" class="form-control" placeholder="Enter Television Serial"/>
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea name="tv_description" class="form-control" cols="30" rows="7" placeholder="Add Description"></textarea>
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
    <h3 class="box-title">Television Data</h3>
    <div class="box-tools pull-right">
      <a class="btn btn-link add-link" href="javascript:void(0);" data-toggle="modal" data-target="#tv-add"><i class="fa fa-plus-square-o">&nbsp;</i>New Television</a>
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
                <th>SERIAL</th>
                <th>DESCRIPTION</th>
                <th>STATUS</th>
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
  function save_Tv() {
    $.ajax({
      url: "<?php echo site_url('tvs/save') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#tv-add-form').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          if(data.errors){
            $(window).scrollTop(0);
            $("#tv-message-add").fadeIn("slow");
            $('#tv-message-add').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#tv-message-add').fadeOut('slow');
            }, 3000);
          }
        }else {
          $('#message-text').html(data.message);
          $('#tv-add').modal('hide');
          $('#successModal').modal('show');
        }
      }
    })
  }
  $("#tv_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('tvs/show') ?>",
      "type":"POST"
    },
    "columns": [
      null,
      null,
      { "width": "15%" },
      null
    ]
  })
  function edit_tv(id) {
    $('#tv-box').modal('show');
    $.ajax({
      url: "<?php echo site_url('tvs/edit') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'tv_id='+id,
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
      url: "<?php echo site_url('tvs/update') ?>",
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
  function delete_tv(id) {
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
        url: "<?php echo site_url('tvs/delete/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'tv_id='+id,
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
            swal({
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
  function unassign_tv(id) {
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
        url: "<?php echo site_url('tvs/unassign/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'tv_id='+id,
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
            swal({
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
  var data_length = 0;
  function tvInit() {
    $(".tv_status").switchButton({
      on_label: 'ON',
      off_label: 'OFF',
      width: 100,
      height: 40,
      button_width: 60,
    });
    data_length = $('#tv_data tr').length - 1;
  }
  var gready = 1;
  function switchStatus(id) {
    if(data_length != 0 && gready == 1)
    {
      if($(id).is(':checked'))
      {
        toggleStatus(1, $(id).val());
      }
      else
      {
        toggleStatus(0, $(id).val());
      }
    }
  }
  function toggleStatus(status, id) {
    var Xtitle;
    var Xtext;
    var Xtype;
    var Xrevert;
    if(status)
    {
      Xtitle = "Turn On";
      Xtext = "Are you sure you want to turn on the device?";
      Xtype = "success";
      Xrevert = 0;
    }
    else
    {
      Xtitle = "Turn Off";
      Xtext = "Are you sure you want to turn off the device?";
      Xtype = "warning";
      Xrevert = 1;
    }
    swal({
      title: Xtitle,
      text: Xtext,
      type: Xtype,
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
        url: "<?php echo site_url('tvs/toggle_Status/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'tv_id='+id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              swal({
                title: 'Error',
                text: 'Something Went Wrong',
                type: 'error',
                confirmButtonText: 'Okay',
                confirmButtonClass: 'btn btn-default btn-fix',
                buttonsStyling: false,
                timer: 3000,
              })
            }
          }else {
            swal({
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
          timer: 3000,
        })
      }
      gready = 0;
      $("#tv"+id).switchButton({checked: Xrevert});
      gready = 1;
    })
  }
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////
  // END OF IP CAMERA BROWSE JAVASCRIPT
</script>