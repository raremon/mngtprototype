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
              <?php echo form_open('welcome', array('id'=>'box')); ?>
              <div class="form-group">
                <input type="text" name="box_id" class="form-control hidden"/>
              </div>
              <div class="form-group">
                <label>Box Tag</label>
                <input type="text" name="box_tag" class="form-control" placeholder="Enter Mediabox Tag"/>
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
        <a class="btn btn-link add-link" href="<?php echo base_url('mediaboxes/add') ?>"><i class="fa fa-plus-square-o">&nbsp;</i>New Mediabox</a>
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
                <th>MEDIABOX TAG</th>
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
  $("#box_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('mediaboxes/showBox') ?>",
      "type":"POST"
    }
  })
  // U P D A T E
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
  // D E L E T E
  function delete_box(box_id) {
    if(confirm('Do you really want to delete this Box Record ??')){
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
            $('#message-text').html(data.message);
            $('#successModal').modal('show');
          }
        }
      });
    }
  }
  // U N A S S I G N
  function unassign_box(box_id) {
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
    if(confirm('Do you really want to unassign this Mediabox Record ??')){
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
  // END OF MEDIABOX BROWSE JAVASCRIPT
</script>