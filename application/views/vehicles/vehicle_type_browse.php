<div class="modal fade" id="vehicle-type-box" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Vehicle Type Details</h4>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <div class="col-md-12">
              <div id="type-message"></div>
              <?php echo form_open('welcome', array('id'=>'type')); ?>
              <div class="form-group">
                <input type="text" name="vehicle_type_id" class="form-control"/>
              </div>
              <div class="form-group">
                <label>Vehicle Type Name</label>
                <input type="text" name="vehicle_type_name" class="form-control" placeholder="Enter Vehicle Type Name"/>
              </div>
              <?php echo form_close(); ?>
            </div>
          </div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Type()">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Vehicle Type Data</h3>
    <div class="box-tools pull-right">
      <a class="btn btn-link add-link" href="<?php echo base_url('vehicles/add_type') ?>"><i class="fa fa-plus-square-o">&nbsp;</i>Add Vehicle Types</a>
    </div>
  </div>
  <div class="box-body">
    <div id="type-delete-message"></div>
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <table id="type_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>VEHICLE TYPE NAME</th>
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
  $(".select2").select2();
  ////////////////////////////////////////////////////////////////
  //          C  R  U  D    F  U  N  C  T  I  O  N  S           //
  ////////////////////////////////////////////////////////////////
  // O T H E R
  function closebox() {
    $('#form-box').addClass('hidden');
  }
  // R E A D
  $("#type_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('vehicles/showType') ?>",
      "type":"POST"
    }
  })
  // U P D A T E
  function edit_type(type_id) {
    $('#vehicle-type-box').modal('show');
    $.ajax({
      url: "<?php echo site_url('vehicles/editType') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'vehicle_type_id='+type_id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="vehicle_type_id"]').val(data.vehicle_type_id);
        $('input[name="vehicle_type_name"]').val(data.vehicle_type_name);
      }
    })
  }
  function update_Type() {
    $.ajax({
      url: "<?php echo site_url('vehicles/updateType') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#type').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
            $(window).scrollTop(0);
            $("#type-message").fadeIn("slow");
            $('#type-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#type-message').fadeOut('slow');
            }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#vehicle-type-box').modal('hide');
          $('#successModal').modal('show');
        }
      }
    })
  }
  // D E L E T E
  function delete_type(type_id) {
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
    if(confirm('Do you really want to delete this Vehicle Type Record ??')){
      $.ajax({
        url: "<?php echo site_url('vehicles/delete_Type/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'vehicle_type_id='+type_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#type-delete-message").fadeIn("slow");
              $('#type-delete-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#type-delete-message').fadeOut('slow');
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
  // END OF VEHICLE TYPE BROWSE JAVASCRIPT
</script>