<div class="modal fade" id="mediabox-add" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <?php echo form_open('mediaboxes/saveBox', array('id'=>'box-add-form')); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Mediabox Details</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="col-md-12">
            <div id="box-message-add"></div>
            <div class="form-group">
              <label>Box Tag</label>
              <input type="text" name="box_tag-add" class="form-control" placeholder="Enter Mediabox Tag"/>
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea name="box_description-add" class="form-control" cols="30" rows="7" placeholder="Add Description"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary save" onclick="save_Box()">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>
<div class="modal fade" id="mediabox-box" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Mediabox Details</h4>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <div class="col-md-12">
              <div id="box-message"></div>
              <?php echo form_open('mediaboxes/updateBox', array('id'=>'box')); ?>
              <div class="form-group">
                <input type="text" name="box_id" class="form-control hidden"/>
              </div>
              <div class="form-group">
                <label>Box Tag</label>
                <input type="text" name="box_tag" class="form-control" placeholder="Enter Mediabox Tag"/>
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea name="box_description" class="form-control" cols="30" rows="7" placeholder="Add Description"></textarea>
              </div>
              <?php echo form_close(); ?>
            </div>
          </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Box()">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Mediabox Data</h3>
    <div class="box-tools pull-right">
      <a class="btn btn-link add-link" href="javascript:void(0);" data-toggle="modal" data-target="#mediabox-add"><i class="fa fa-plus-square-o">&nbsp;</i>New Mediabox</a>
    </div>
  </div>
  <div class="box-body">
    <div id="box-delete-message"></div>
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <table id="box_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>TAG</th>
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
  function save_Box() {
    $.ajax({
      url: "<?php echo site_url('mediaboxes/saveBox') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#box-add-form').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          if(data.errors){
            $(window).scrollTop(0);
            $("#box-message-add").fadeIn("slow");
            $('#box-message-add').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#box-message-add').fadeOut('slow');
            }, 3000);
          }
        }else {
          $('#message-text').html(data.message);
          $('#mediabox-add').modal('hide');
          $('#successModal').modal('show');
        }
      }
    })
  }
  $("#box_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('mediaboxes/showBox') ?>",
      "type":"POST"
    },
    "columns": [
      null,
      null,
      { "width": "15%" },
      null
    ]
  })
  function edit_box(box_id) {
    $('#mediabox-box').modal('show');
    $.ajax({
      url: "<?php echo site_url('mediaboxes/editBox') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'box_id='+box_id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="box_id"]').val(data.box_id);
        $('input[name="box_tag"]').val(data.box_tag);
        $('textarea[name="box_description"]').val(data.box_description);
      }
    })
  }
  function update_Box() {
    $.ajax({
      url: "<?php echo site_url('mediaboxes/updateBox') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#box').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
            $(window).scrollTop(0);
            $("#box-message").fadeIn("slow");
            $('#box-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#box-message').fadeOut('slow');
            }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#mediabox-box').modal('hide');
          $('#successModal').modal('show');
        }
      }
    })
  }
  function delete_box(box_id) {
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
        url: "<?php echo site_url('mediaboxes/delete_Box/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'box_id='+box_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#box-delete-message").fadeIn("slow");
              $('#box-delete-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#box-delete-message').fadeOut('slow');
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
  function unassign_box(box_id) {
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
        url: "<?php echo site_url('mediaboxes/unassign_Box/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'box_id='+box_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#box-delete-message").fadeIn("slow");
              $('#box-delete-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#box-delete-message').fadeOut('slow');
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
  function checkInit() {
    $(".box_status").switchButton({
      on_label: 'ON',
      off_label: 'OFF',
      width: 100,
      height: 40,
      button_width: 60,
    });
    data_length = $('#box_data tr').length - 1;
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
  function toggleStatus(status, box_id) {
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
        url: "<?php echo site_url('mediaboxes/toggle_Status/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'box_id='+box_id,
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
      $("#box"+box_id).switchButton({checked: Xrevert});
      gready = 1;
    })
  }
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////
  // END OF MEDIABOX BROWSE JAVASCRIPT
</script>