<div class="box box-success hidden" id="form-box">
  <div class="box-header with-border">
    <h3 class="box-title">Driver Details</h3>
    <div class="box-tools pull-right">
      <button class="btn btn-small btn-danger" onclick="closebox()">x</button>
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="driver-message"></div>
          <?php echo form_open('welcome', array('id'=>'driver')); ?>
          <div class="form-group hidden">
            <input type="text" name="driver_id" class="form-control"/>
          </div>
          <div class="form-group">
            <label>First Name</label>
            <input type="text" name="driver_fname" class="form-control" placeholder="Enter First Name"/>
          </div>
          <div class="form-group">
            <label>Middle Name</label>
            <input type="text" name="driver_mname" class="form-control" placeholder="Enter Middle Name"/>
          </div>
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="driver_lname" class="form-control" placeholder="Enter Last Name"/>
          </div>
          <div class="form-group">
            <label>Contact Information</label>
            <input type="text" name="driver_contact" class="form-control" placeholder="Enter Contact Information"/>
          </div>
          <div class="form-group">
            <label>Address</label>
            <textarea name="driver_address" class="form-control" cols="30" rows="7" placeholder="Enter Driver's Address"></textarea>
          </div>
          <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Driver()">Update</button>
          <?php echo form_close(); ?>
        </div>
      </div> 
  </div>
  <div class="box-footer">
  </div>
</div>
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Driver Data</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
    <div id="driver-delete-message"></div>
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <table id="driver_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>DRIVER NAME</th>
                <th>CONTACT</th>
                <th>ADDRESS</th>
                <th>CREATION DATE</th>
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
  $("#driver_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('drivers/showDriver') ?>",
      "type":"POST"
    }
  })
  // U P D A T E
  function edit_driver(driver_id) {
    $('#form-box').removeClass('hidden');
    $.ajax({
      url: "<?php echo site_url('drivers/editDriver') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'driver_id='+driver_id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="driver_id"]').val(data.driver_id);
        $('input[name="driver_fname"]').val(data.driver_fname);
        $('input[name="driver_mname"]').val(data.driver_mname);
        $('input[name="driver_lname"]').val(data.driver_lname);
        $('input[name="driver_contact"]').val(data.driver_contact);
        $('textarea[name="driver_address"]').val(data.driver_address);
      }
    })
  }
  function update_Driver() {
    $.ajax({
      url: "<?php echo site_url('drivers/updateDriver') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#driver').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
            $(window).scrollTop(0);
            $("#driver-message").fadeIn("slow");
            $('#driver-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#driver-message').fadeOut('slow');
            }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#successModal').modal('show');
        }
      }
    })
  }
  // D E L E T E
  function delete_driver(driver_id) {
  if(confirm('Do you really want to delete this Driver Record ??')){
      $.ajax({
        url: "<?php echo site_url('drivers/delete_Driver/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'driver_id='+driver_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#driver-delete-message").fadeIn("slow");
              $('#driver-delete-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#driver-delete-message').fadeOut('slow');
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
  function unassign_driver(driver_id) {
    if(confirm('Do you really want to unassign this Driver Record ??')){
      $.ajax({
        url: "<?php echo site_url('drivers/unassign_Driver/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'driver_id='+driver_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#driver-delete-message").fadeIn("slow");
              $('#driver-delete-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#driver-delete-message').fadeOut('slow');
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
  // END OF DRIVER BROWSE JAVASCRIPT
</script>