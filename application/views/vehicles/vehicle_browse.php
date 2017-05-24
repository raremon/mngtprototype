<div class="modal fade" id="vehicle-box" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Vehicle Details</h4>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <div class="col-md-12">
              <div id="vehicle-message"></div>
              <?php echo form_open('welcome', array('id'=>'vehicle')); ?>
              <div class="form-group">
                <input type="text" name="vehicle_id" class="form-control hidden"/>
              </div>
              <div class="form-group">
                <label>Vehicle Name</label>
                <input type="text" name="vehicle_name" class="form-control" placeholder="Enter Vehicle Name"/>
              </div>
              <div class="form-group">
                <label>Plate Number</label>
                <input type="text" name="plate_number" class="form-control" placeholder="Enter Plate Number"/>
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea name="vehicle_description" class="form-control" cols="30" rows="7" placeholder="Enter Short Description"></textarea>
              </div>
              <div class="form-group">
                <label>Vehicle Type</label>
                <select name="vehicle_type" class="form-control select2">
                  <?php 
                    foreach($type as $row)
                    {
                  ?>
                    <option value= <?php echo $row[0];?> >
                      <?php echo $row[1]; ?>
                    </option>
                  <?php 
                    }
                  ?>
                </select>
                <a class="btn btn-link pull-right" href="<?php echo site_url('vehicles/browse_type') ?>">Browse Vehicle Types</a>
              </div>
              <?php echo form_close(); ?>
            </div>
          </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Vehicle()">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Vehicle Data</h3>
    <div class="box-tools pull-right">
        <a class="btn btn-link add-link" href="<?php echo base_url('vehicles/add') ?>"><i class="fa fa-plus-square-o">&nbsp;</i>New Vehicle</a>
    </div>
  </div>
  <div class="box-body">
    <div id="vehicle-delete-message"></div>
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <table id="vehicle_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>VEHICLE NAME</th>
                <th>PLATE NUMBER</th>
                <th>VEHICLE DESCRIPTION</th>
                <th>VEHICLE TYPE</th>
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
  $('.select2-selection__rendered').removeAttr('title');
  ////////////////////////////////////////////////////////////////
  //          C  R  U  D    F  U  N  C  T  I  O  N  S           //
  ////////////////////////////////////////////////////////////////
  // O T H E R
  function closebox() {
    $('#form-box').addClass('hidden');
  }
  // R E A D
  $("#vehicle_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('vehicles/showVehicle') ?>",
      "type":"POST"
    }
  })
  // U P D A T E
  function edit_vehicle(vehicle_id) {
    $('#vehicle-box').modal('show');
    $.ajax({
      url: "<?php echo site_url('vehicles/editVehicle') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'vehicle_id='+vehicle_id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="vehicle_id"]').val(data.vehicle_id);
        $('input[name="vehicle_name"]').val(data.vehicle_name);
        $('input[name="plate_number"]').val(data.plate_number);
        $('select[name="vehicle_type"]').val(data.vehicle_type);
        $('textarea[name="vehicle_description"]').val(data.vehicle_description);
      }
    })
  }
  function update_Vehicle() {
    $.ajax({
      url: "<?php echo site_url('vehicles/updateVehicle') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#vehicle').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
            $(window).scrollTop(0);
            $("#vehicle-message").fadeIn("slow");
            $('#vehicle-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#vehicle-message').fadeOut('slow');
            }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#vehicle-box').modal('hide');
          $('#successModal').modal('show');
        }
      }
    })
  }
  // D E L E T E
  function delete_vehicle(vehicle_id) {
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
    if(confirm('Do you really want to delete this Vehicle Record ??')){
      $.ajax({
        url: "<?php echo site_url('vehicles/delete_Vehicle/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'vehicle_id='+vehicle_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#vehicle-delete-message").fadeIn("slow");
              $('#vehicle-delete-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#vehicle-delete-message').fadeOut('slow');
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
  // END OF VEHICLE BROWSE JAVASCRIPT
</script>