<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Driver Details</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="driver-message"></div>
          <?php echo form_open('welcome', array('id'=>'driver')); ?>
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
          <button type="button" class="btn btn-primary save" onclick="save_Driver()">Save</button>
          <?php echo form_close(); ?>
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
  // C R E A T E
  function save_Driver() {
    $.ajax({
      url: "<?php echo site_url('drivers/saveDriver') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#driver').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          if(data.errors){
            $(window).scrollTop(0);
            $("#driver-message").fadeIn("slow");
            $('#driver-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#driver-message').fadeOut('slow');
            }, 3000);
          }
        }else {
          $('#message-text').html(data.message);
          $('#successModal').modal('show');
        }
      }
    })
  }
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////
  // END OF DRIVER ADD JAVASCRIPT
</script>