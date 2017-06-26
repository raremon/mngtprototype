<div class="modal fade" id="cctv-add" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <?php echo form_open('cctvs/save', array('id'=>'cctv-add-form')); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">CCTV Details</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="col-md-12">
            <div id="cctv-message-add"></div>
            <div class="form-group">
              <label>CCTV Serial</label>
              <input type="text" name="cctv_serial-add" class="form-control" placeholder="Enter CCTV Serial"/>
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea name="cctv_description-add" class="form-control" cols="30" rows="7" placeholder="Add Description"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary save" onclick="save_Cctv()">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>
<div class="modal fade" id="cctv-box" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">CCTV Details</h4>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <div class="col-md-12">
              <div id="cctv-message"></div>
              <?php echo form_open('cctvs/update', array('id'=>'cctv')); ?>
              <div class="form-group">
                <input type="text" name="cctv_id" class="form-control hidden"/>
              </div>
              <div class="form-group">
                <label>CCTV Serial</label>
                <input type="text" name="cctv_serial" class="form-control" placeholder="Enter CCTV Serial"/>
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea name="cctv_description" class="form-control" cols="30" rows="7" placeholder="Add Description"></textarea>
              </div>
              <?php echo form_close(); ?>
            </div>
          </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Cctv()">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">CCTV Data</h3>
    <div class="box-tools pull-right">
      <a class="btn btn-link add-link" href="javascript:void(0);" data-toggle="modal" data-target="#cctv-add"><i class="fa fa-plus-square-o">&nbsp;</i>New CCTV</a>
    </div>
  </div>
  <div class="box-body">
    <div id="cctv-delete-message"></div>
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <table id="cctv_data" class="table table-hover table-bordered">
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
  function save_Cctv() {
    $.ajax({
      url: "<?php echo site_url('cctvs/save') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#cctv-add-form').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          if(data.errors){
            $(window).scrollTop(0);
            $("#cctv-message-add").fadeIn("slow");
            $('#cctv-message-add').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#cctv-message-add').fadeOut('slow');
            }, 3000);
          }
        }else {
          $('#message-text').html(data.message);
          $('#cctv-add').modal('hide');
          $('#successModal').modal('show');
        }
      }
    })
  }
  $("#cctv_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('cctvs/show') ?>",
      "type":"POST"
    },
    "columns": [
      null,
      null,
      { "width": "15%" },
      null
    ]
  })
  function edit_cctv(id) {
    $('#cctv-box').modal('show');
    $.ajax({
      url: "<?php echo site_url('cctvs/edit') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'cctv_id='+id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="cctv_id"]').val(data.cctv_id);
        $('input[name="cctv_serial"]').val(data.cctv_serial);
        $('textarea[name="cctv_description"]').val(data.cctv_description);
      }
    })
  }
  function update_Cctv() {
    $.ajax({
      url: "<?php echo site_url('cctvs/update') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#cctv').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
            $(window).scrollTop(0);
            $("#cctv-message").fadeIn("slow");
            $('#cctv-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#cctv-message').fadeOut('slow');
            }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#cctv-box').modal('hide');
          $('#successModal').modal('show');
        }
      }
    })
  }
  function delete_cctv(id) {
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
        url: "<?php echo site_url('cctvs/delete/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'cctv_id='+id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#cctv-delete-message").fadeIn("slow");
              $('#cctv-delete-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#cctv-delete-message').fadeOut('slow');
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
  function unassign_cctv(id) {
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
        url: "<?php echo site_url('cctvs/unassign/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'cctv_id='+id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#cctv-delete-message").fadeIn("slow");
              $('#cctv-delete-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#cctv-delete-message').fadeOut('slow');
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
  function cctvInit() {
    $(".cctv_status").switchButton({
      on_label: 'ON',
      off_label: 'OFF',
      width: 100,
      height: 40,
      button_width: 60,
    });
    data_length = $('#cctv_data tr').length - 1;
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
        url: "<?php echo site_url('cctvs/toggle_Status/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'cctv_id='+id,
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
      $("#cctv"+id).switchButton({checked: Xrevert});
      gready = 1;
    })
  }
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////
  // END OF CCTV BROWSE JAVASCRIPT
</script>